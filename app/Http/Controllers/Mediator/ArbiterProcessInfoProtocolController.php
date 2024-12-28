<?php

namespace App\Http\Controllers\Mediator;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Models\Document\Document;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Services\Document\ArbiterProcessInfoProtocolService;

class ArbiterProcessInfoProtocolController extends Controller
{

    public function create(Lawsuit $lawsuit)
    {
        return view('mediator.document.arbiter_process_info_protocol.create', compact('lawsuit'));
    }

    public function store(Request $request, Lawsuit $lawsuit): JsonResponse
    {
        DB::beginTransaction();
        try {
            $document_content = $request->preview;
            Document::create([
                "document_type_id" => 2,
                "lawsuit_id" => $lawsuit->id,
                "html" => $document_content,
                "created_user_id" => auth()->id(),
            ]);
            $this->meetingCreate($request, $lawsuit);
            $this->storeLog($lawsuit);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        $response = view("mediator.document.print", compact("document_content"))->render();
        return response()->json($response);
    }

    private function meetingCreate($request, Lawsuit $lawsuit): void
    {
        $check = $lawsuit->meeting()->where("date", $request->meeting_date)->where("start_hour", $request->meeting_start_hour)->exists();
        if (!$check) {
            $lawsuit->meeting()->create([
                "user_id" => auth()->user()->id,
                "date" => $request->meeting_date,
                "start_hour" => $request->meeting_start_hour
            ]);
        }
    }

    private function storeLog(Lawsuit $lawsuit): void
    {
        Log::create([
            "user_id" => auth()->user()->id,
            "lawsuit_id" => $lawsuit->id,
            "event" => "Arabuluculuk Sürecine İlişkin Bilgilendirme Tutanağı Oluşturuldu."
        ]);
    }

    // public function preview(Request $request, Lawsuit $lawsuit)
    // {
    //     $document_content = ArbiterProcessInfoProtocolService::replaceKeywords($request, $lawsuit);
    //     $sides = $request->side_ids;
    //     return view("mediator.document.preview", compact('document_content', "lawsuit", 'sides'));
    // }

    public function preview(Request $request, Lawsuit $lawsuit)
    {
        $document_content = ArbiterProcessInfoProtocolService::replaceKeywords($request, $lawsuit);
        // $sides = $request->side_ids;
        $sides = $lawsuit->sides()->whereIn("id", $request->side_ids)->get();
        $response = [];
        foreach ($sides as $side_id) {
            $side = $lawsuit->sides()->find($side_id);

            if ($side) {
                $response[] = [
                    "id" => $side->id,
                    "view" => view("mediator.document.preview", compact('document_content', 'lawsuit', 'side'))->render(),
                ];
            }
        }
        return response()->json($response);
    }

    /*public function preview(Request $request, Lawsuit $lawsuit)
    {
        $document_content = ArbiterProcessInfoProtocolService::replaceKeywords($request, $lawsuit);
        $sides = $lawsuit->sides()->whereIn("id", $request->side_ids)->get();
        $response = [];
        foreach ($sides as $side_id) {
            $side = $lawsuit->sides()->find($side_id);
            if ($side) {
                $response[] = [
                    "id" => $side->id,
                    "view" => view("mediator.document.preview", compact('document_content', 'lawsuit', 'side'))->render(),
                ];
            }
        }
        return response()->json($response);
    }*/
}
