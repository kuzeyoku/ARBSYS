<?php

namespace App\Services\Document;

use App\Models\Document\DocumentTypeTemplate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Services\HelperService;

class AuthorityDocumentService
{
    public static function replaceKeywords(Request $request, Lawsuit $lawsuit)
    {
        $list = array(
            "@ArabulucuAdSoyad" => auth()->user()->name,
            "@ArabuluculukBurosu" => $lawsuit->mediation_office->name . " Arabuluculuk Bürosu",
            "@BasvuruDosyaNo" => $lawsuit->application_document_no,
            "@ARBDosyaNo" => $lawsuit->mediation_document_no,
            "@BasvuranAdSoyad" => $lawsuit->claimants->first()->detail->name ?? "",
            "@BugunTarih" => Carbon::now()->format('d.m.Y'),
            "@ToplantiTarih" => Carbon::parse($request->meeting_date)->format('d/m/Y'),
            "@ToplantiSaat" => $request->meeting_hour,
        );

        $find = array_keys($list);
        $replace = array_values($list);

        $document = DocumentTypeTemplate::where("document_type_id", 17)
            ->where("lawsuit_subject_type_id", $lawsuit->lawsuit_subject_type_id)
            ->first();

        return str_ireplace($find, $replace, $document->html);
    }
}
