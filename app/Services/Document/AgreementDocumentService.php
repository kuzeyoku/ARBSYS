<?php

namespace App\Services\Document;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Services\HelperService;

class AgreementDocumentService
{
    public static function replaceKeywords(Request $request, Lawsuit $lawsuit)
    {
        $documentService = new DocumentService($lawsuit, 5);
        $meeting_address = $documentService->getMeetingAddress($request);

        $list = array(
            "@ArabuluculukBurosu" => $lawsuit->mediation_office->name . " Arabuluculuk Bürosu",
            "@BasvuruDosyaNo" => $lawsuit->application_document_no,
            "@ARBDosyaNo" => $lawsuit->mediation_document_no,
            "@Taraflar" => view("mediator.document.layout.sides", compact("lawsuit"))->render(),
            "@UyusmazlikTuru" => $lawsuit->lawsuit_subject_type->name,
            "@UyusmazlikKonu" => $lawsuit->subject,
            "@ToplantiAdres" => $meeting_address,
            "@MuzakereEdilenHususlar" => $lawsuit->matters_discussed_to_string ?? '<i class="fas fa-edit"></i> Müzakere Edilen Hususlar',
            "@NushaAdet" => HelperService::numberToText(count($request->side_ids) + 1),
            "@BugunTarih" => Carbon::now()->format('d.m.Y'),
            "@Sonuc" => $request->result,
        );

        return $documentService->replace($list);
    }
}
