<?php

namespace App\Http\Controllers\Mediator;

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

    public function store(Request $request, Lawsuit $lawsuit)
    {

        DB::beginTransaction();
        try {
            Log::create([
                "user_id" => auth()->user()->id,
                "lawsuit_id" => $lawsuit->id,
                "event" => "Arabuluculuk Sürecine İlişkin Bilgilendirme Tutanağı Oluşturuldu"
            ]);
            $document_content = $request->preview;
            Document::create([
                "document_type_id" => 2,
                "lawsuit_id" => $lawsuit->id,
                "html" => $document_content,
                "created_user_id" => auth()->id(),
            ]);

            $lawsuit->meeting()->update([
                "date" => $request->meeting_date,
                "start_hour" => $request->meeting_start_hour
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        $response = view("mediator.document.print", compact("document_content"))->render();

        return response()->json($response);
    }


    public function preview(Request $request, Lawsuit $lawsuit)
    {
        $document_content = ArbiterProcessInfoProtocolService::replaceKeywords($request, $lawsuit);
        $sides = $request->side_ids;
        return view("mediator.document.preview", compact('document_content', "lawsuit", 'sides'));
    }
}
