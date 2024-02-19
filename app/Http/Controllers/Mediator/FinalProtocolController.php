<?php

namespace App\Http\Controllers\Mediator;

use App\Http\Controllers\Controller;
use App\Models\Document\Document;
use App\Models\Lawsuit\Lawsuit;
use App\Models\Lawsuit\LawsuitProcessType;
use App\Models\Lawsuit\LawsuitResultType;
use App\Services\Document\FinalProtocolService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinalProtocolController extends Controller
{
    public function create(Lawsuit $lawsuit)
    {
        $process_types = LawsuitProcessType::all();
        $result_types = LawsuitResultType::all();

        return view('mediator.document.final_protocol.create', compact('lawsuit', 'process_types', 'result_types'));
    }

    public function store(Request $request, Lawsuit $lawsuit)
    {
        DB::table('logs')->insert(
            [
                'user_id' => Auth()->user()->id,
                "lawsuit_id" => $lawsuit->id,
                "event" => "Son Tutanak oluşturuldu.",
            ],
        );

        $lawsuit->lawsuit_process_type_id = 4;
        $lawsuit->lawsuit_result_type_id = $request->result_type;
        $lawsuit->save();

        $document_content = $request->preview;

        Document::create([
            "document_type_id" => 6,
            "lawsuit_id" => $lawsuit->id,
            "html" => $document_content,
            "created_user_id" => auth()->id(),
        ]);

        $response = view('mediator.document.print', compact('document_content'))->render();
        return response()->json($response);
    }


    public function preview(Request $request, Lawsuit $lawsuit)
    {
        $document_content = FinalProtocolService::replaceKeywords($request, $lawsuit);
        $sides = $lawsuit->sides->pluck("id")->toArray();
        return view('mediator.document.preview', compact('document_content', 'lawsuit', "sides"));
    }
}
