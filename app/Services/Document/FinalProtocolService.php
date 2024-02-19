<?php

namespace  App\Services\Document;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Models\MediationCenter;
use App\Services\HelperService;
use App\Models\Lawsuit\LawsuitResultType;
use App\Models\Document\DocumentTypeTemplate;

class FinalProtocolService
{
    public static function replaceKeywords(Request $request, Lawsuit $lawsuit)
    {

        if ($request->meeting_adress_check == 1 && $request->meeting_address) {
            $meeting_address = ucwords($request->meeting_address);
        } else {
            if ($request->mediation_center) {
                $mediation_center = MediationCenter::find($request->mediation_center);
                $meeting_address = $mediation_center->title;
            } else {
                $meeting_address = $lawsuit->mediation_center->title ?? null;
            }
        }

        $suggested_solution = "";
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
            "@MuzakereEdilenHususlar" => $lawsuit->matters_discussed ?? "Müzakere Edilen Hususlar",
            "@NushaAdet" => HelperService::numberToText(count($lawsuit->sides) + 1),
            "@ToplantiyaKatilmayanTaraf" => "",
            "@BugunTarih" => Carbon::now()->format('d.m.Y'),
        );

        $result_type = LawsuitResultType::findOrFail($request->result_type);
        $document = DocumentTypeTemplate::where("lawsuit_subject_type_id", $lawsuit->lawsuit_subject_type_id)
            ->where("document_type_id", $result_type->document_type_id)->first();

        $find = array_keys($list);
        $replace = array_values($list);

        $string = str_ireplace($find, $replace, $document->html);

        return $string;
    }
}
