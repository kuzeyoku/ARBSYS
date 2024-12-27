<?php

namespace App\Http\Controllers\Mediator;

use App\Http\Controllers\Controller;
use App\Models\AgreementType;
use App\Models\Document\Document;
use App\Models\Lawsuit\Lawsuit;
use App\Services\Document\MeetingProtocolService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MeetingProtocolController extends Controller
{
    public function create(Lawsuit $lawsuit)
    {
        $agreement_types = AgreementType::all();
        return view('mediator.document.meeting_protocol.create', compact('lawsuit', 'agreement_types'));
    }

    public function store(Request $request, Lawsuit $lawsuit): JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->updateProcessType($lawsuit);
            $document_content = $request->preview;
            $this->lawsuitMattersDiscussedUpdate($request, $lawsuit);
            Document::create([
                'document_type_id' => 4,
                'lawsuit_id' => $lawsuit->id,
                'html' => $document_content,
                'created_user_id' => auth()->id()
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        $response = view("mediator.document.print", compact("document_content"))->render();
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


    public function preview(Request $request, Lawsuit $lawsuit): JsonResponse
    {
        $document_content = MeetingProtocolService::replaceKeywords($request, $lawsuit);
        $sides = $request->side_ids;
        $response = view("mediator.document.preview", compact("document_content", "lawsuit", "sides"))->render();
        return response()->json($response);
    }
}
