<?php

namespace App\Http\Controllers\Mediator;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Models\Document\Document;
use App\Http\Controllers\Controller;
use App\Services\Document\AuthorityDocumentService;

class AuthorityDocumentController extends Controller
{
    public function create(Lawsuit $lawsuit)
    {
        return view('mediator.document.authority_document.create', compact('lawsuit'));
    }

    public function store(Request $request, Lawsuit $lawsuit)
    {
        Log::create([
            "user_id" => Auth()->user()->id,
            "lawsuit_id" => $lawsuit->id,
            "event" => "Yetki Belgesi Oluşturuldu"
        ]);

        $document_content = $request->preview;

        Document::create([
            "document_type_id" => 17,
            "lawsuit_id" => $lawsuit->id,
            "html" => $document_content,
            "created_user_id" => Auth()->user()->id,
        ]);

        $response = view("mediator.document.print", compact('document_content'))->render();

        return response()->json($response);
    }

    public function preview(Request $request, Lawsuit $lawsuit)
    {
        $document_content = AuthorityDocumentService::replaceKeywords($request, $lawsuit);
        $response = view("mediator.document.preview", compact("document_content", "lawsuit"))->render();
        return response()->json($response);
    }
}
