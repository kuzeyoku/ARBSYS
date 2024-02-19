<?php

namespace App\Http\Controllers\Mediator;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Models\Document\Document;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Document\ArbiterDefineProtocolService;

class ArbiterDefineProtocolController extends Controller
{
    public function create(Lawsuit $lawsuit)
    {
        return view('mediator.document.arbiter_define_protocol.create', compact('lawsuit'));
    }

    public function store(Request $request, Lawsuit $lawsuit)
    {
        DB::beginTransaction();
        try {
            Log::create([
                "user_id" => auth()->user()->id,
                "lawsuit_id" => $lawsuit->id,
                "event" => "Arabulucu Belirleme Tutanağı Oluşturuldu.",
            ]);
            $document_content = $request->preview;
            Document::create([
                'document_type_id' => 15,
                'lawsuit_id' => $lawsuit->id,
                'html' => $document_content,
                'created_user_id' => auth()->user()->id,
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
        return ArbiterDefineProtocolService::replaceKeywords($request, $lawsuit);
    }
}
