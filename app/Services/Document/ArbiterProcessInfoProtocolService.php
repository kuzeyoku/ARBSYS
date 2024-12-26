<?php

namespace App\Services\Document;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Services\HelperService;

/**
 * @method getMediationCenterTitle(Request $request)
 * @method getMeetingAddress(Request $request)
 */
class ArbiterProcessInfoProtocolService

{
    public static function replaceKeywords(Request $request, Lawsuit $lawsuit)
    {
        $service = new DocumentService($lawsuit, 2);
        $meeting_address = $service->getMeetingAddress($request);
        $mediation_center_title = $service->getMediationCenterTitle($request);
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

        return $service->replace($list);
    }
}
