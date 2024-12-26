<?php

namespace App\Services\Document;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Models\MediationCenter;
use App\Services\HelperService;
use App\Models\Lawsuit\LawsuitSubject;
use App\Models\Document\DocumentTypeTemplate;

class MeetingProtocolService
{
    public static function replaceKeywords(Request $request, Lawsuit $lawsuit)
    {
        $documentService = new DocumentService($lawsuit, 4);
        $meeting_address = $documentService->getMeetingAddress($request);
        $mediation_center_title = $documentService->getMediationCenterTitle($request);
        $list = array(
            "@ToplantiTutanağiBasligi" => "ARABULUCULUK " . HelperService::numberToOrdinal($lawsuit->meeting_count) . " TOPLANTI TUTANAĞI",
            "@ArabuluculukBurosu" => $lawsuit->mediation_office->name . " Arabuluculuk Bürosu",
            "@BasvuruDosyaNo" => $lawsuit->application_document_no,
            "@ARBDosyaNo" => $lawsuit->mediation_document_no,
            "@UyusmazlikTuru" => $lawsuit->lawsuit_subject_type->name,
            "@UyusmazlikKonu" => $lawsuit->subject,
            "@MuzakereEdilenHususlar" => $lawsuit->matters_discussed_to_string ?? '<i class="fas fa-edit"></i> Müzakere Edilen Hususlar',
            "@ToplantiAdres" => $meeting_address,
            "@Taraflar" => view("mediator.document.layout.sides", compact("lawsuit"))->render(),
            "@BasvuruTarih" => Carbon::parse($lawsuit->application_date)->format('d.m.Y'),
            "@GorevKabulTarih" => !is_null($lawsuit->job_date) ? Carbon::parse($lawsuit->job_date)->format('d.m.Y') : "",
            "@SurecinBaslangicTarih" => Carbon::parse($lawsuit->process_start_date)->format('d.m.Y'),
            "@IlkToplantiTarih" => Carbon::parse($lawsuit->meeting_date)->format('d.m.Y'),
            "@ToplantiBaslangicSaat" => $request->meeting_start_hour,
            "@ToplantiBitisSaat" => $request->meeting_end_hour,
            "@SonucButon" => '<span id="result">Sonuç</span>',
        );

        return $documentService->replace($list);
    }
}
