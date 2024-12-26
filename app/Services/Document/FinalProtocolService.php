<?php

namespace App\Services\Document;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Services\HelperService;
use App\Models\Lawsuit\LawsuitResultType;

class FinalProtocolService
{
    public static function replaceKeywords(Request $request, Lawsuit $lawsuit)
    {
        $resultType = LawsuitResultType::findOrFail($request->result_type);
        $documentService = new DocumentService($lawsuit, $resultType->document_type_id);
        $meeting_address = $documentService->getMeetingAddress($request);
        if ($request->suggested_solution) {
            $suggested_solution = "Taraflara çözüm önerisinde bulunulmuştur.";
        } else {
            $suggested_solution = "Taraflara çözüm önerisinde bulunulmamıştır.";
        }

        $list = array(
            "@ArabuluculukBurosu" => $lawsuit->mediation_office->name,
            "@BasvuruDosyaNo" => $lawsuit->application_document_no,
            "@BugunTarih" => Carbon::now()->format('d.m.Y'),
            "@ARBDosyaNo" => $lawsuit->mediation_document_no,
            "@Taraflar" => view("mediator.document.layout.sides", compact("lawsuit"))->render(),
            "@UyusmazlikTuru" => $lawsuit->subject_type . "(" . $lawsuit->subject . ")",
            "@ToplantiAdres" => $meeting_address,
            "@BasvuruTarih" => Carbon::parse($lawsuit->application_date)->format('d.m.Y'),
            "@GorevKabulTarih" => Carbon::parse($lawsuit->job_date)->format('d.m.Y'),
            "@SurecinBaslangicTarih" => Carbon::parse($lawsuit->process_start_date)->format('d.m.Y'),
            "@IlkToplantiTarih" => Carbon::parse($lawsuit->meeting_date)->format('d.m.Y'),
            "@SonToplantiTarih" => Carbon::today()->format('d.m.Y'),
            "@CozumOnerisi" => $suggested_solution,
            "@OturumSayisi" => $request->session_count,
            "@OturumSuresi" => $request->session_time,
            "@MuzakereEdilenHususlar" => $lawsuit->matters_discussed_to_string ?? '<i class="fas fa-edit"></i> Müzakere Edilen Hususlar',
            "@NushaAdet" => HelperService::numberToText(count($lawsuit->sides) + 1),
            "@ToplantiyaKatilmayanTaraf" => "",
            "@BugunTarih" => Carbon::now()->format('d.m.Y'),
        );

        return $documentService->replace($list);
    }
}
