<?php

namespace App\Http\Controllers\Mediator\Document;


use App\Http\Controllers\Controller;
use App\Models\Document\Document;

class DocxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Document $document)
    {
        $phpword = new \PhpOffice\PhpWord\PhpWord;
        $html = '';
        \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(false); // xml parsing error fixed @Samet E

        $newData = explode("<td>", $document->html);
        $newText = strip_tags(explode("</td>", $newData[2])[0]);
        $subline = str_replace("\r\n", "<br/>", $newText);
        $lastData = str_replace("\n", "<br/>", $subline);
        $temizcumle = preg_replace('/\s\s+/', ' ', $lastData);

        $temizcumlex = preg_replace("/<br\W*?\/>/", "\n", $temizcumle, 3);

        $html .= $temizcumlex;
        $html = preg_replace('/>\s+</', '><', $html);
        $section = $phpword->addSection();
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpword, 'Word2007');
        $objWriter->save('emp-' . time() . ".docx");

        return response()->download('emp-' . time() . ".docx");
    }
}
