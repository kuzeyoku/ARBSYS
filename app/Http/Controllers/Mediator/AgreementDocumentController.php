<?php

namespace App\Http\Controllers\Mediator;

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
                'document_type_id' => 6,
                'lawsuit_id' => $lawsuit->id,
                'html' => $document_content,
                'created_user_id' => auth()->id(),
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
        $document_content = AgreementDocumentService::replaceKeywords($request, $lawsuit);
        $sides = $request->side_ids;
        return view("mediator.document.preview", compact('document_content', "lawsuit", "sides"));
    }
}
