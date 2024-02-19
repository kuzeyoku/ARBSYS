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

        if ($request->meeting_address_check && $request->meeting_address) {
            $meeting_address = $request->meeting_address;
        } elseif ($request->mediation_center) {
            $mediation_center = MediationCenter::find($request->mediation_center);
            $meeting_address = $mediation_center->address;
        } else {
            $meeting_address = null;
        }

        $matters_discussed = LawsuitSubject::getMattersDiscussed($lawsuit);
        $selectMatters = $request->matters_discussed ?? [];
        $matters = array_reverse(array_intersect_key($matters_discussed, array_flip($selectMatters)));
        $matters = implode(", ", $matters) ?? [];

        $list = array(
            "@ToplantiTutanağiBasligi" => "ARABULUCULUK " . HelperService::numberToOrdinal($lawsuit->meeting_count) . " TOPLANTI TUTANAĞI",
            "@ArabuluculukBurosu" => $lawsuit->mediation_office->name . " Arabuluculuk Bürosu",
            "@BasvuruDosyaNo" => $lawsuit->application_document_no,
            "@ARBDosyaNo" => $lawsuit->mediation_document_no,
            "@UyusmazlikTuru" => $lawsuit->lawsuit_subject_type->name,
            "@UyusmazlikKonu" => $lawsuit->subject,
            "@MuzakereEdilenHususlar" => $lawsuit->matters_discussed ?? "Müzakere Edilen Hususlar",
            "@MuzakereButon" => "<button type='button' class='btn btn-primary btn-sm matters_discussed' data-toggle='modal' data-target='#matters-discussed-modal'>Müzakere Edilen Hususlar</button>",
            "@ToplantiAdres" => $meeting_address,
            "@Taraflar" => view("mediator.document.layout.sides", compact("lawsuit"))->render(),
            "@BasvuruTarih" => Carbon::parse($lawsuit->application_date)->format('d.m.Y'),
            "@GorevKabulTarih" => !is_null($lawsuit->job_date) ? Carbon::parse($lawsuit->job_date)->format('d.m.Y') : "",
            "@SurecinBaslangicTarih" => Carbon::parse($lawsuit->process_start_date)->format('d.m.Y'),
            "@IlkToplantiTarih" => Carbon::parse($lawsuit->meeting_date)->format('d.m.Y'),
            "@ToplantiBaslangicSaat" => $request->meeting_start_hour,
            "@ToplantiBitisSaat" => $request->meeting_end_hour,
            "@SonucButon" => "<button type='button' class='btn btn-primary btn-sm result' data-toggle='modal' data-target='#result-modal'>Sonuç</button>",
            "@Sonuc" => "Sonucu Buraya Yazınız."
        );

        $find = array_keys($list);
        $replace = array_values($list);

        $document = DocumentTypeTemplate::where('document_type_id', 4)->where("lawsuit_subject_type_id", $lawsuit->lawsuit_subject_type_id)->first();

        $string = str_ireplace($find, $replace, $document->html);

        return $string;
    }
}
