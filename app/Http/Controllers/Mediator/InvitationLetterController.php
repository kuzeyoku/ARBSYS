<?php

namespace App\Http\Controllers\Mediator;

use App\Models\Log;
use App\Services\Document\DocumentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Models\Document\Document;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Document\InvitationLetterService;

class InvitationLetterController extends Controller
{
    public function create(Lawsuit $lawsuit)
    {
        return view('mediator.document.invitation_letter.create', compact('lawsuit'));
    }

    public function store(Request $request, Lawsuit $lawsuit): JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->updateProcessType($lawsuit);
            $this->lawsuitMattersDiscussedUpdate($request, $lawsuit);
            foreach ($request->side_ids as $side) {
                $document_content = $request->{"preview-" . $side};
                $documents[] = [
                    "document_type_id" => 1,
                    "side_id" => $side,
                    "lawsuit_id" => $lawsuit->id,
                    "html" => $document_content,
                    "created_user_id" => auth()->user()->id,
                ];
                $response[$side] = view("mediator.document.print", compact("document_content"))->render();
            }
            Document::insert($documents);
            $this->meetingCreate($request, $lawsuit);
            $this->storeLog($lawsuit);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return response()->json($response);
    }

    private function updateProcessType(Lawsuit $lawsuit): void
    {
        $lawsuit->lawsuit_process_type()->associate(2);
        $lawsuit->save();
    }

    private function lawsuitMattersDiscussedUpdate($request, Lawsuit $lawsuit): void
    {
        $lawsuit->update([
            "matters_discussed" => json_encode($request->matters_discussed, JSON_UNESCAPED_UNICODE),
        ]);
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

    private function storeLog($lawsuit): void
    {
        Log::create([
            "user_id" => auth()->user()->id,
            "lawsuit_id" => $lawsuit->id,
            "event" => "Davet Mektubu Oluşturuldu",
        ]);
    }

    public function previewToPrint()
    {
        return DocumentService::tempPdf("testpdf");
    }

    public function preview(Request $request, Lawsuit $lawsuit): JsonResponse
    {
        $sides = $lawsuit->sides()->whereIn("id", $request->side_ids)->get();
        $response = [];
        foreach ($sides as $side) {
            $document_content = InvitationLetterService::replaceKeywords($request, $lawsuit, $side);
            $response[] = [
                "label" => $side->detail->name,
                "id" => $side->id,
                "view" => view('mediator.document.preview', compact("document_content"))->render(),
            ];
        }
        return response()->json($response);
    }
}
