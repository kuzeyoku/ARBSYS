<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Document\DocumentType;
use Illuminate\Support\Facades\Redirect;
use App\Models\Lawsuit\LawsuitSubjectType;
use App\Models\Document\DocumentTypeTemplate;
use App\Models\Lawsuit\Lawsuit;
use App\Models\Lawsuit\LawsuitSubject;

class TemplateController extends Controller
{
    public function index()
    {
        $lawsuitSubjectTypes = LawsuitSubjectType::all();
        return view('admin.template.index', compact("lawsuitSubjectTypes"));
    }

    public function subjects(LawsuitSubjectType $lawsuitSubjectType)
    {
        return view("admin.template.index", compact("lawsuitSubjectType"));
    }

    public function edit(LawsuitSubjectType $lawsuitSubjectType, LawsuitSubject $lawsuitSubject = null)
    {
        return view('admin.template.edit', compact("lawsuitSubjectType", "lawsuitSubject"));
    }


    public function create()
    {
        $documentTypes = DocumentType::pluck("name", "id");
        $lawsuitSubjectTypes = LawsuitSubjectType::pluck("name", "id");
        return view('admin.template.create', compact("documentTypes", "lawsuitSubjectTypes"));
    }

    public function store(Request $request)
    {
        try {
            $control = DocumentTypeTemplate::where("document_type_id", $request->input("document_type"))
                ->where("lawsuit_subject_type_id", $request->input("lawsuit_subject_type"))
                ->first();
            if ($control) {
                return Redirect::back()->withError('Bu dava konusu için bu belge şablonu zaten mevcut. Template güncelleme işlemini kullanınız');
            }
            $documentTypes = DocumentType::pluck("name", "id");
            $data["document_type_id"] = $request->input("document_type");
            $data["lawsuit_subject_type_id"] = $request->input("lawsuit_subject_type");
            $data["html"] = $request->input("html");
            DocumentTypeTemplate::create($data);
            return Redirect::route("admin.template.edit",$request->lawsuit_subject_type)->with(['success' => 'Template kaydınız başarılı bir şekilde oluşturuldu']);
        } catch (\Throwable $e) {
            return Redirect::route("admin.template.edit",$request->lawsuit_subject_type)->with(['error' => 'Template kaydınız oluşturulurken bir hata oluştu']);
        }
    }

    public function getLawsuitSubjectTypeTemplates(LawsuitSubjectType $lawsuitSubjectType)
    {
        $templates = DocumentTypeTemplate::where("lawsuit_subject_type_id", $lawsuitSubjectType->id)->get();
        return view('admin.template.edit', compact("templates", "lawsuitSubjectType"));
    }


    public function update(Request $request, DocumentTypeTemplate $template)
    {
        try {
            $text = str_replace("&gt;", ">", $request->input('html'));
            $template->html = $text;
            $template->save();
            return Redirect::back()->with(['success' => 'Template değişikliğiniz başarılı bir şekilde güncellendi']);
        } catch (\Throwable $e) {
            return Redirect::back()->with(['error' => 'Template değişikliğiniz güncellenirken bir hata oluştu']);
        }
    }
}
