<?php

namespace App\Http\Controllers\Mediator\Document;

use App\Models\Document\Document;
use ZanySoft\LaravelPDF\PDF;
use App\Http\Controllers\Controller;


class PdfController extends Controller
{
    public function index(Document $document)
    {
        // $newData = explode("<td>", $document->html);
        // $newText = explode("</td>", $newData[2]);
        // $html = $newText[0];


        // $pdf = PDF::loadview("mediator.document.pdf", ["document_content" => $document->html]);
        // return $pdf->stream();

        // return PDF::loadView('mediator.document.pdf', ['document_content' => $document->html])->download(time() . '.pdf');

        $pdf = new PDF();
        $pdf->loadview("mediator.document.pdf", ["document_content" => $document->html]);
        return $pdf->download();
    }
}
