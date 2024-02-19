<?php

namespace App\Http\Controllers\Mediator;

use App\Http\Controllers\Controller;
use App\Http\Resources\SideApplicantResource;
use App\Models\Document\Document;
use App\Models\Lawsuit\Lawsuit;
use App\Models\Side\Side;
use App\Services\LawsuitService;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Lawsuit $lawsuit)
    {
        return view('mediator.document.index', compact('lawsuit'));
    }

    public function getcontent(Document $document)
    {
        return response()->json([
            'status' => true,
            'content' => view("mediator.document.print", ["document_content" => $document->html])->render(),
        ]);
    }

    public function deleteDocument(Request $request)
    {
        $document = Document::where('created_user_id', auth()->id())
            ->where('id', $request->id)
            ->first();

        if (!is_null($document)) {
            if ($document->document_type_id) {
                if (file_exists(public_path('/files/lawsuits/' . $document->lawsuit->id . '/documents/' . $document->html))) {
                    unlink(public_path('/files/lawsuits/' . $document->lawsuit->id . '/documents/' . $document->html));
                }
            }

            $document->delete();

            return response()->json([
                'status' => true,
                'message' => "Evrak başarılı bir şekilde silindi!"
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "Evrak silme sırasında bir hata oluştu!"
        ]);
    }

    public function fileUpload(Request $request)
    {
        foreach ($request->documents as $file) {
            $rand = sha1(date('YmdHis') . rand());

            $name = explode('.', $file->getClientOriginalName());

            $file_name = $rand . "." . $name[count($name) - 1];

            $document = new Document();
            $document->lawsuit_id = $request->lawsuit_id;
            $document->document_type_id = 8;
            $document->name = $name[0];
            $document->html = $file_name;
            $document->created_user_id = auth()->id();
            $document->save();

            $file->move($document->path, $file_name);
        }

        return redirect()->back();
    }

    public function fileDownload($document_id, $type, $side_id = null)
    {
        $document = Document::findOrFail($document_id);

        if ($document->document_type_id == 8) {
            return redirect($document->file);
        } else {
            $client = new Client();

            if (is_null($side_id)) {
                $html = view('mediator.document.template.docx', ['document_content' => $document->html])->render();
            } else {
                $side = Side::findOrFail($side_id);

                $data = LawsuitService::printInvitationLetterReplaceKeywords($side, $document->html);

                $html = view('mediator.document.template.docx', ['document_content' => $data])->render();
            }

            $body = [
                'htmlString' => $html
            ];

            $response = $client->post(
                "http://uye.arabulucusistemi.com:20000/convert-to-" . $type,
                [
                    'headers'  => ['content-type' => 'application/json', 'Accept' => 'application/json'],
                    'body' => json_encode($body),
                ]
            );

            $result = json_decode($response->getBody()->getContents());

            return response()->json($result);
        }
    }

    public function destroy(Document $document)
    {
        try {
            $document->delete();
            return redirect()->back()->withSuccess("Evrak başarılı bir şekilde silindi!");
        } catch (Exception $e) {
            return redirect()->back()->withError("İşlem sırasında bir hata oluştu!");
        }
    }

    public function updateDocument(Request $request)
    {
        $document = Document::findOrFail($request->document_id);
        $document->html = $request->html;
        $document->save();

        return redirect()->back();
    }

    public function getSides(Lawsuit $lawsuit)
    {
        $sides = $lawsuit->sides;
        return response()->json(SideApplicantResource::collection($sides));
    }

    public function printDocument(Request $request)
    {
        $document = Document::findOrFail($request->document_id);
        $side = Side::findOrFail($request->side_id);

        return LawsuitService::printInvitationLetterReplaceKeywords($side, $document->html);
    }
}
