<?php

namespace App\Http\Controllers\Mediator;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Models\Document\Document;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Document\KvkkService;

class KvkkController extends Controller
{

    public function create(Lawsuit $lawsuit)
    {
        return view('mediator.document.kvkk.create', compact('lawsuit'));
    }

    public function store(Request $request, Lawsuit $lawsuit)
    {
        try {
            Document::create([
                "document_type_id" => 3,
                "lawsuit_id" => $lawsuit->id,
                "html" => $request->preview,
                "created_user_id" => auth()->user()->id,
            ]);
            $lawsuit->lawsuit_process_type()->associate(2);
            $lawsuit->save();
            Log::create([
                "user_id" => auth()->user()->id,
                "lawsuit_id" => $lawsuit->id,
                "event" => "Kvkk Belgesi oluşturuldu.",
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
        $response = view("mediator.document.print", ["document_content" => $request->preview])->render();
        return response()->json($response);
    }

    public function preview(Request $request, Lawsuit $lawsuit)
    {
        $document_content = KvkkService::replaceKeywords($request, $lawsuit);
        $sides = $request->side_ids;
        return view("mediator.document.preview", compact("document_content", "lawsuit", "sides"))->render();
    }
}
