<?php

namespace App\Services\Document;

use Carbon\Carbon;
use App\Models\Side\Side;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Models\MediationCenter;
use App\Services\HelperService;
use App\Models\Document\DocumentTypeTemplate;

class InvitationLetterService
{

    public static function getDisagreement(Lawsuit $lawsuit): string
    {
        $disagreements = [
            2 => 'Başvurucu ' . HelperService::nameFormat($lawsuit->claimantName ?? null) . ' (' . HelperService::nameFormat($lawsuit->claimant->lawyer->detail->name ?? null) . ') şirketiniz aleyhine İzmir ....... İcra Müdürlüğü ‘nün ........... sayılı dosyası ile ilamsız takip başlattığını, takibe konu alacağın taraflar arasındaki cari hesaptan kaynaklandığını, ilamsız takibe karşı tarafınızca itiraz edildiğini ve takibin durduğunu, açmadan önce uyuşmazlığın arabuluculuk yoluyla çok daha kısa sürede, daha ekonomik ve dostane şekilde çözülebilmesi, bunun mümkün olmaması halinde ise dava şartının yerine getirilmiş olması için tarafınıza arabuluculuk daveti göndermemi talep etmiştir.',
            3 => 'Başvurucu ' . HelperService::nameFormat($lawsuit->claimantName ?? null) . ' (' . HelperService::nameFormat($lawsuit->claimant->lawyer->detail->name ?? null) . ')`nin eski çalışanınız olduğunu, iş koşullarıyla ilgili bazı sorunlar yaşadığını, (<span class="matters-discussed"><i class="fas fa-edit"></i> Müzakere Edilen Hususlar</span>) bu durum üzerine dava açmadan önce uyuşmazlığın arabuluculuk yoluyla çok daha kısa sürede, daha ekonomik ve dostane şekilde çözülebilmesi, bunun mümkün olmaması halinde ise dava şartının yerine getirilmiş olması için tarafınıza arabuluculuk daveti göndermemi talep etmiştir.',
            4 => 'Başvurucu ' . HelperService::nameFormat($lawsuit->claimantName ?? null) . ' (' . HelperService::nameFormat($lawsuit->claimant->lawyer->detail->name ?? null) . ')`nin satın aldığı ürün / hizmetle ilgili bazı sorunlar yaşadığını, (<span id="result" onclick="result_modal()"><i class="fas fa-edit"></i> Müzakere Edilen Hususlar</span>) bu durum üzerine açmadan önce uyuşmazlığın arabuluculuk yoluyla çok daha kısa sürede, daha ekonomik ve dostane şekilde çözülebilmesi, bunun mümkün olmaması halinde ise dava şartının yerine getirilmiş olması için tarafınıza arabuluculuk daveti göndermemi talep etmiştir.',
        ];

        return $disagreements[$lawsuit->lawsuit_subject_type_id];
    }

    public static function replaceKeywords(Request $request, Lawsuit $lawsuit, Side $side)
    {
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

        if ($request->want_write) {
            if ($request->each_side_write) {
                $disagreement = $request->{"disagreement-" . $side->id};
            } else {
                $disagreement = $request->disagreement;
            }
        } else {
            $disagreement = null;
        }


        //dd($disagreement);
        $list = array(
            "@DavaOzeti" => $disagreement,
            "@AliciAdSoyad" => "<strong>" . HelperService::nameFormat($side->detail->name) . " " . HelperService::nameFormat($side->detail->surname) . "</strong>" . ($side->side_applicant_type_id == 2 ? " Yetkilisi" : ""),
            "@AliciAdres" => HelperService::addressFormat($side->detail->address),
            "@ArabuluculukBurosu" => $lawsuit->mediation_office->name . " Arabuluculuk Bürosu",
            "@BasvuranAdSoyad" => HelperService::nameFormat($lawsuit->claimants->first()->detail->name) ?? "",
            "@BasvuranTCKNo" => $lawsuit->claimants->first()->detail->identification ?? "",
            "@BasvuranAvukat" => isset($side->claimant_lawyer->detail->name) && !is_null($side->claimant_lawyer->detail->name) ? "vekili " . HelperService::nameFormat($side->claimant_lawyer->detail->name) . ($side->claimant->side_applicant_type_id == 2 ? ", şirket vekili sıfatıyla" : "") : "",
            "@BugunTarih" => Carbon::now()->format('d.m.Y'),
            "@ToplantiTarih" => Carbon::parse($request->meeting_date)->format('d/m/Y'),
            "@ToplantiSaat" => $request->meeting_start_hour,
            "@ToplantiAdres" => HelperService::addressFormat($meeting_address),
            "@ArabulucuAdSoyad" => HelperService::nameFormat(auth()->user()->name),
            "@ArabulucuSicilNo" => auth()->user()->mediator->registration_no,
            "@ArabuluculukMerkezi" => $mediation_center_title,
        );
        $find = array_keys($list);
        $replace = array_values($list);

        $document = DocumentTypeTemplate::where("lawsuit_subject_type_id", $lawsuit->lawsuit_subject_type_id)
            ->where("document_type_id", 1)->first();

        $string = str_ireplace($find, $replace, $document->html);

        return $string;
    }
}
