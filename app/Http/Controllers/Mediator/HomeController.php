<?php

namespace App\Http\Controllers\Mediator;

use App\Models\Lawsuit\Lawsuit;
use App\Models\Document\Document;
use App\Http\Controllers\Controller;
use App\Models\Document\DocumentType;
use App\Models\Lawsuit\LawsuitProcessType;

class HomeController extends Controller
{
    public function index()
    {
        $lawsuits = Lawsuit::where('user_id', auth()->id())->get();
        $lawsuitProcessTypes = LawsuitProcessType::pluck('name', 'id')->toArray();
        $documents = Document::where("created_user_id", auth()->id())->get();
        $documentTypes = DocumentType::pluck('name', 'id')->toArray();
        $documentTypesCount = $documents->groupBy('document_type_id')->map(function ($item) {
            return $item->count();
        });
        $lawsuitProcessTypesCount = $lawsuits->groupBy('lawsuit_process_type_id')->map(function ($item) {
            return $item->count();
        });
        return view('mediator.index', compact('lawsuits', 'lawsuitProcessTypes', 'lawsuitProcessTypesCount', 'documents', 'documentTypes', 'documentTypesCount'));
    }
}
