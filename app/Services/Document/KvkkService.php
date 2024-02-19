<?php

namespace App\Services\Document;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Services\HelperService;
use App\Models\Document\DocumentTypeTemplate;

class KvkkService
{
    public static function replaceKeywords(Request $request, Lawsuit $lawsuit)
    {
        $list = [
            "@ArabuluculukBurosu" => $lawsuit->mediation_office->name . " Arabuluculuk Bürosu",
            "@BugunTarih" => Carbon::now()->format('d.m.Y'),
            "@ToplantiTarih" => Carbon::parse($request->meeting_date)->format('d/m/Y'),
            "@ToplantiSaat" => $request->meeting_start_hour,
            // "@ToplantiAdres" => $meeting_address,
            // "@ArabuluculukMerkezi" => $mediation_center_title,
            "@ArabulucuAdSoyad" => auth()->user()->name,
            "@ArabulucuSicilNo" => auth()->user()->mediator->registration_no,
            "@NushaAdet" => HelperService::numberToText(count($request->side_ids) + 1),
        ];

        $find = array_keys($list);
        $replace = array_values($list);

        $document = DocumentTypeTemplate::where("lawsuit_subject_type_id", $lawsuit->lawsuit_subject_type_id)
            ->where("document_type_id", 3)->first();

        $string = str_ireplace($find, $replace, $document->html);
        return $string;
    }
}
