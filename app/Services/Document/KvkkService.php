<?php

namespace App\Services\Document;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Services\HelperService;

class KvkkService
{
    public static function replaceKeywords(Request $request, Lawsuit $lawsuit)
    {
        $documentService = new DocumentService($lawsuit, 3);
        $list = [
            "@ArabuluculukBurosu" => $lawsuit->mediation_office->name,
            "@BugunTarih" => Carbon::now()->format('d.m.Y'),
            "@ToplantiTarih" => Carbon::parse($request->meeting_date)->format('d/m/Y'),
            "@ToplantiSaat" => $request->meeting_start_hour,
            // "@ToplantiAdres" => $meeting_address,
            // "@ArabuluculukMerkezi" => $mediation_center_title,
            "@ArabulucuAdSoyad" => auth()->user()->mediator->full_name,
            "@ArabulucuSicilNo" => auth()->user()->mediator->registration_no,
            "@NushaAdet" => HelperService::numberToText(count($request->side_ids) + 1),
        ];
        return $documentService->replace($list);
    }
}
