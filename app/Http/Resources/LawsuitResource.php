<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class LawsuitResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    $processTypeId = DB::table("lawsuits")->select("lawsuit_process_type_id")->where("id", "=", $this->id)->get()[0]->lawsuit_process_type_id;

    return [
      'Sistem No' => $this->id,
      'Dosya Adı' => null,
      'Has Meeting Protocol' => $this->has_meeting_protocol,
      'Has Final Protocol' => $this->has_final_protocol,
      'Archive' => $this->is_archive,
      'Süreç' => $this->lawsuit_process_type_id,
      'Büro Dosya No' => $this->firm_document_number,
      'Arabuluculuk Dosya No' => $this->soother_document_number,
      'Görevin Kabul Tarihi' => Carbon::parse($this->job_date)->format('d.m.Y'),
      'Son Süre' => $this->last_time,
      'Yıl' => Carbon::parse($this->job_date)->format('Y'),
      'Uyuşmazlık Türü' => $this->checkLawsuitCustom($this->lawsuit_subject_type_id),
      'Başvuru Tarihi' => Carbon::parse($this->application_date)->format('d.m.Y'),
      'Başvurucu' => $this->claimant_name ?? "",
      'Karşı Taraf' => $this->defendant_name ?? "",
      'Sonuç' => $this->lawsuit_result_type->name ?? "",
      'Süreç Bilgisi' => $this->processCodeGenerator(DB::table("lawsuit_process_types")->select("name")->where("id", "=", $processTypeId)->get()[0]->name),
      'Agreement' => ($this->lawsuit_subject_id == 2 && is_null($this->agreement_type_id)) ? false : true,
      'İşlemler' => null
    ];
  }

  public function processCodeGenerator($processName)
  {
    $code = "";
    switch ($processName) {
      case "Açık":
        $code = '<div class="d-flex flex-column"><strong class="pb-2">Açık</strong><div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
              </div></div>';
        break;
      case "Açık – Toplantı günü verildi":
        $code = '<div class="d-flex flex-column"><strong class="pb-2">Toplantı günü verildi</strong><div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 50%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
              </div></div>';
        break;
      case "Açık – Görüşmeler başladı / sürüyor":
        $code = '<div class="d-flex flex-column"><strong class="pb-2">Görüşmeler başladı / sürüyor</strong><div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 75%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
              </div></div>';
        break;
      case "Süreç sona erdi":
        $code = '<div class="d-flex flex-column"><strong class="pb-2">Süreç sona erdi</strong><div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
              </div></div>';
        break;
      case "Dosya sistemden kapatıldı":
        $code = '<div class="d-flex flex-column"><strong class="pb-2">Dosya sistemden kapatıldı</strong><div class="progress">
                <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
              </div></div>';
        break;
      default:
        $code = "kod bulunamadı!";
    }

    return $code;
  }

  public function checkLawsuitCustom($lawsuit_subject_type_id)
  {
    if ($lawsuit_subject_type_id != 4) {
      return DB::table('lawsuit_subject_types')->select("name")->where('id', '=', $this->lawsuit_subject_type_id)->get()[0]->name;
    }

    return count(DB::table("custom_lawsuit_types")->where("lawsuit_id", "=", $this->id)->get()) != 0 ?
      DB::table("custom_lawsuit_types")->where("lawsuit_id", "=", $this->id)->where("user_id", "=", auth()->id())->get()[0]->lawsuit_subject_type_name
      : null;
  }
}
