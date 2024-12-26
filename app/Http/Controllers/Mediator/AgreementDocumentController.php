<?php

namespace App\Http\Controllers\Mediator;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Models\Document\Document;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Document\AgreementDocumentService;
use Throwable;

class AgreementDocumentController extends Controller
{
    public function create(Lawsuit $lawsuit)
    {
        return view('mediator.document.agreement_document.create', compact('lawsuit'));
    }

    /**
     * @throws Throwable
     */
    public function store(Request $request, Lawsuit $lawsuit)
    {
        DB::beginTransaction();
        try {
            $document_content = $request->preview;
            Document::create([
                'document_type_id' => 5,
                'lawsuit_id' => $lawsuit->id,
                'html' => $document_content,
                'created_user_id' => auth()->id(),
            ]);
            $this->lawsuitMattersDiscussedUpdate($request, $lawsuit);
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
            "event" => "Anlaşma Belgesi Oluşturuldu",
        ]);
    }


    public function preview(Request $request, Lawsuit $lawsuit)
    {
        $document_content = AgreementDocumentService::replaceKeywords($request, $lawsuit);
        $sides = $request->side_ids;
        return view("mediator.document.preview", compact('document_content', "lawsuit", "sides"));
    }
}
