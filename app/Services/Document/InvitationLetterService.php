<?php

namespace App\Services\Document;

use Carbon\Carbon;
use App\Models\Side\Side;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Services\HelperService;

/**
 * @property int|mixed $document_type
 */
class InvitationLetterService
{
    public static function getDisagreement(Lawsuit $lawsuit): string
    {
        $matters_discussed = $lawsuit->matters_discussed_to_string ?? '<i class="fas fa-edit"></i> Müzakere Edilen Hususlar';
        $disagreements = [
            2 => 'Başvurucu ' . HelperService::nameFormat($lawsuit->claimantName ?? null) . ' (' . HelperService::nameFormat($lawsuit->claimant->lawyer->detail->name ?? null) . ') şirketiniz aleyhine İzmir ....... İcra Müdürlüğü ‘nün ........... sayılı dosyası ile ilamsız takip başlattığını, takibe konu alacağın taraflar arasındaki cari hesaptan kaynaklandığını, ilamsız takibe karşı tarafınızca itiraz edildiğini ve takibin durduğunu, açmadan önce uyuşmazlığın arabuluculuk yoluyla çok daha kısa sürede, daha ekonomik ve dostane şekilde çözülebilmesi, bunun mümkün olmaması halinde ise dava şartının yerine getirilmiş olması için tarafınıza arabuluculuk daveti göndermemi talep etmiştir.',
            3 => 'Başvurucu ' . HelperService::nameFormat($lawsuit->claimantName ?? null) . ' (' . HelperService::nameFormat($lawsuit->claimant->lawyer->detail->name ?? null) . ')`nin eski çalışanınız olduğunu, iş koşullarıyla ilgili bazı sorunlar yaşadığını, (<span class="matters-discussed">' . $matters_discussed . '</span>) bu durum üzerine dava açmadan önce uyuşmazlığın arabuluculuk yoluyla çok daha kısa sürede, daha ekonomik ve dostane şekilde çözülebilmesi, bunun mümkün olmaması halinde ise dava şartının yerine getirilmiş olması için tarafınıza arabuluculuk daveti göndermemi talep etmiştir.',
            4 => 'Başvurucu ' . HelperService::nameFormat($lawsuit->claimantName ?? null) . ' (' . HelperService::nameFormat($lawsuit->claimant->lawyer->detail->name ?? null) . ')`nin satın aldığı ürün / hizmetle ilgili bazı sorunlar yaşadığını, (<span id="result" onclick="result_modal()"><i class="fas fa-edit"></i> Müzakere Edilen Hususlar</span>) bu durum üzerine açmadan önce uyuşmazlığın arabuluculuk yoluyla çok daha kısa sürede, daha ekonomik ve dostane şekilde çözülebilmesi, bunun mümkün olmaması halinde ise dava şartının yerine getirilmiş olması için tarafınıza arabuluculuk daveti göndermemi talep etmiştir.',
        ];

        return $disagreements[$lawsuit->lawsuit_subject_type_id];
    }

    public static function replaceKeywords(Request $request, Lawsuit $lawsuit, Side $side)
    {
        $documentService = new DocumentService($lawsuit, 1);
        if ($request->has("disagreement-{$side->id}")) {
            $disagreement = $request->{"disagreement-{$side->id}"};
        } elseif ($request->has("disagreement")) {
            $disagreement = $request->disagreement;
        } else {
            $disagreement = null;
        }
        $meeting_address = $documentService->getMeetingAddress($request);
        $mediation_center_title = $documentService->getMediationCenterTitle($request);
        $list = array(
            "@DavaOzeti" => $disagreement,
            "@AliciAdSoyad" => $side->side_applicant_type_id == 2 ? $side->detail->name . " Yetkilisi" : $side->detail->name, //TODO: Yetkilisi Yada Temsilcisi Eklenebilir.
            "@AliciAdres" => $side->detail->address,
            "@ArabuluculukBurosu" => $lawsuit->mediation_office->name,
            "@BasvuranAdSoyad" => $lawsuit->sides->where("side_type_id", \SideTypeOptions::CLAIMANT)->first()->detail->name ?? "",
            "@BasvuranTCKNo" => $lawsuit->sides->where("side_type_id", \SideTypeOptions::CLAIMANT)->first()->detail->identification ?? "",
            "@BasvuranAvukat" => isset($side->claimant_lawyer->detail->name) && !is_null($side->claimant_lawyer->detail->name) ? "vekili " . $side->claimant_lawyer->detail->name . $side->claimant->side_applicant_type_id == 2 ? ", şirket vekili sıfatıyla" : "" : "",
            "@BugunTarih" => Carbon::now()->format('d.m.Y'),
            "@ToplantiTarih" => Carbon::parse($request->meeting_date)->format('d.m.Y'),
            "@ToplantiSaat" => $request->meeting_start_hour,
            "@ToplantiAdres" => $meeting_address,
            "@ArabulucuAdSoyad" => auth()->user()->mediator->name,
            "@ArabulucuSicilNo" => auth()->user()->mediator->registration_no,
            "@ArabuluculukMerkezi" => $mediation_center_title ?? "",
        );
        return $documentService->replace($list);
    }
}
