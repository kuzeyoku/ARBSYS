<?php

namespace App\Services\Document;

use App\Models\Document\DocumentType;
use App\Models\Lawsuit\Lawsuit;
use App\Models\Log;
use App\Models\MediationCenter;

/**
 * @method static getMeetingAddress(\Illuminate\Http\Request $request)
 */
class DocumentService
{
    private $documentTemplate;
    private $documentTypeId;
    private $lawsuit;

    public function __construct(Lawsuit $lawsuit, $documentTypeId)
    {
        $this->lawsuit = $lawsuit;
        $this->documentTypeId = $documentTypeId;
        $this->documentTemplate = $lawsuit->lawsuit_subject_type->documentType($documentTypeId);
    }

    public function replace($list)
    {
        $find = array_keys($list);
        $replace = array_values($list);
        return str_ireplace($find, $replace, $this->documentTemplate->html);
    }

    public function storeLog()
    {
        $documentType = DocumentType::find($this->documentTypeId);
        Log::create([
            "user_id" => auth()->user()->id,
            "lawsuit_id" => $this->lawsuit->id,
            "event" => $documentType->name . " oluşturuldu.",
        ]);
    }

    public function getMediationCenterTitle($request)
    {
        if ($request->mediation_center) {
            $mediation_center = MediationCenter::find($request->mediation_center);
        } else {
            $mediation_center = $this->lawsuit->mediation_center;
        }
        return $mediation_center->title ?? null;
    }

    public function getMeetingAddress($request)
    {
        if ($request->meeting_adress_check == 1 && $request->meeting_address) {
            return ucwords($request->meeting_address);
        } else {
            if ($request->mediation_center) {
                $mediation_center = MediationCenter::find($request->mediation_center);
            } else {
                $mediation_center = $this->lawsuit->mediation_center;
            }
            return $mediation_center->address;
        }
    }
}