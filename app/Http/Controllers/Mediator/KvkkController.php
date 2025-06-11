<?php

namespace App\Http\Controllers\Mediator;

use App\Models\Log;
use App\Services\Document\DocumentService;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Models\Document\Document;
use App\Http\Controllers\Controller;
use App\Services\Document\KvkkService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class KvkkController extends Controller
{

    public function create(Lawsuit $lawsuit)
    {
        return view('mediator.document.kvkk.create', compact('lawsuit'));
    }

    public function store(Request $request, Lawsuit $lawsuit)
    {
        try {
            $document_content = $request->preview;
            Document::create([
                "document_type_id" => 3,
                "lawsuit_id" => $lawsuit->id,
                "html" => $document_content,
                "created_user_id" => auth()->user()->id,
            ]);
            $this->storeLog($request, $lawsuit);
        } catch (\Exception $e) {
            throw $e;
        }
        $response = view("mediator.document.print", compact("document_content"))->render();
        return response()->json($response);
    }

    private function storeLog($request, Lawsuit $lawsuit)
    {
        Log::create([
            "user_id" => auth()->user()->id,
            "lawsuit_id" => $lawsuit->id,
            "event" => "Kvkk Belgesi oluşturuldu",
        ]);
    }

    public function previewPdf(Request $request)
    {
        $data = Cache::get("preview_" . $request->token);
        if (!$data) {
            return response()->json(['error' => 'Preview not found or expired'], 404);
        }
        return DocumentService::tempPdf($data);
    }

    public function refreshPdf(Request $request): ?string
    {
        $token = Str::uuid();
        Cache::put("preview_" . $token, $request->document_content, 60 * 60);
        return $token;
    }

    public function preview(Request $request, Lawsuit $lawsuit)
    {
        $document_content = KvkkService::replaceKeywords($request, $lawsuit);
        $token = Str::uuid();
        Cache::put("preview_" . $token, $document_content, 60 * 60);
        $sides = $request->side_ids;
        $preview = view("mediator.document.preview", compact("document_content", "lawsuit", "sides"))->render();
        return response()->json([
            "view" => $preview,
            "token" => $token,
        ]);
    }
}
