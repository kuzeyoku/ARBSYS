<?php

namespace App\Services\Document;

use App\Models\Document\DocumentTypeTemplate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Services\HelperService;

class AuthorityObjectionService
{
    public static function replaceKeywords(Request $request, Lawsuit $lawsuit)
    {
        $documentService = new DocumentService($lawsuit, 16);
        $list = array(
            "@ArabuluculukBurosu" => $lawsuit->mediation_office->name . " Arabuluculuk Bürosu",
            "@BasvuruDosyaNo" => $lawsuit->application_document_no,
            "@ARBDosyaNo" => $lawsuit->mediation_document_no,
            "@Taraflar" => view("mediator.document.layout.sides", compact("lawsuit"))->render(),
            "@UyusmazlikTuru" => $lawsuit->lawsuit_subject_type->name,
            "@UyusmazlikKonu" => $lawsuit->lawsuit_subject->name,
            "@BasvuruTarih" => Carbon::parse($lawsuit->application_date)->format('d.m.Y'),
            "@GorevKabulTarih" => Carbon::parse($lawsuit->job_date)->format('d.m.Y'),
            "@SurecinBaslangicTarih" => Carbon::parse($lawsuit->process_start_date)->format('d.m.Y'),
            "@IlkToplantiTarih" => Carbon::parse($lawsuit->meeting_date)->format('d.m.Y'),
            "@BasvuranAdSoyad" => HelperService::nameFormat($lawsuit->claimants->first()->detail->name) ?? "",
            "@BasvuranAvukat" => isset($lawsuit->sides()->first()->claimant_lawyer->detail->name) && !is_null($lawsuit->sides()->first()->claimant_lawyer->detail->name) ? "vekili " . HelperService::nameFormat($lawsuit->sides()->first()->claimant_lawyer->detail->name) : "",
            "@TicaretOdasi" => $request->chamber_of_commerce ?? "",
            "@BelgeTarih" => $request->date ?? "",
            "@BelgeSayı" => $request->number ?? "",
            "@BelgeSayfa" => $request->page ?? "",
            "@CalistigiSure" => HelperService::numberToText($request->work_time) . " ( " . $request->work_time . " )" ?? "",
            "@CalistigiYer" => HelperService::nameFormat($request->work_name) ?? "",
            "@BugunTarih" => Carbon::now()->format('d.m.Y'),
        );
        return $documentService->replace($list);
    }
}
