<?php

namespace App\Services\Document;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Models\MediationCenter;
use App\Services\HelperService;

class ArbiterProcessInfoProtocolService

{
    public static function replaceKeywords(Request $request, Lawsuit $lawsuit)
    {
        $documentService = new DocumentService($lawsuit, 2);
        if ($request->meeting_adress_check == 1 && $request->meeting_address) {
            $meeting_address = ucwords($request->meeting_address);
        } else {
            if ($request->mediation_center) {
                $mediation_center = MediationCenter::find($request->mediation_center);
                $mediation_center_title = $mediation_center->title;
                $meeting_address = $mediation_center->address;
            } else {
                $mediation_center_title = $lawsuit->mediation_center->title ?? null;
                $meeting_address = $lawsuit->mediation_center->address ?? null;
            }
        }

        $list = array(
            "@ArabuluculukBurosu" => $lawsuit->mediation_office->name,
            "@ToplantiTarih" => Carbon::parse($request->meeting_date)->format('d/m/Y'),
            "@ToplantiSaat" => $request->meeting_start_hour,
            "@ToplantiAdres" => $meeting_address,
            "@ArabuluculukMerkezi" => $mediation_center_title,
            "@ArabulucuAdSoyad" => auth()->user()->name,
            "@ArabulucuSicilNo" => auth()->user()->mediator->registration_no,
            "@NushaAdet" => HelperService::numberToText(count($request->side_ids) + 1),
        );

        return $documentService->replace($list);
    }
}
