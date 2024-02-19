<?php

namespace App\Services\Document;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Models\MediationCenter;
use App\Services\HelperService;
use App\Models\Document\DocumentTypeTemplate;

class AgreementDocumentService
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

        $list = array(
            "@ArabuluculukBurosu" => $lawsuit->mediation_office->name . " Arabuluculuk Bürosu",
            "@BasvuruDosyaNo" => $lawsuit->application_document_no,
            "@ARBDosyaNo" => $lawsuit->mediation_document_no,
            "@Taraflar" => view("mediator.document.layout.sides", compact("lawsuit"))->render(),
            "@UyusmazlikTuru" => $lawsuit->lawsuit_subject_type->name,
            "@UyusmazlikKonu" => $lawsuit->subject,
            "@ToplantiAdres" => HelperService::addressFormat($meeting_address),
            "@MuzakereEdilenHususlar" => $lawsuit->matters_discussed ?? "Müzakere Edilen Hususlar",
            "@NushaAdet" => HelperService::numberToText(count($request->side_ids) + 1),
            "@BugunTarih" => Carbon::now()->format('d.m.Y'),
            "@Sonuc" => $request->result,
        );

        $find = array_keys($list);
        $replace = array_values($list);

        $document = DocumentTypeTemplate::where([
            "lawsuit_subject_type_id" => $lawsuit->lawsuit_subject_type_id,
            "lawsuit_subject_id" => $lawsuit->lawsuit_subject_id,
            "document_type_id" => 5
        ])->first();


        $string = str_ireplace($find, $replace, $document->html);

        return $string;
    }
}
