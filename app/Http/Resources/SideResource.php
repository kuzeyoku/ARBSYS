<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SideResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'Taraf No' => $this->id,
            'Ad Soyad' => $this->detail->name,
            'Taraf' => $this->side_type_id == 1 ? "Başvuran" : "Karşı Taraf",
            'Tip' =>  $this->title,
            'İşlemler' =>  null
        ];
    }
}
