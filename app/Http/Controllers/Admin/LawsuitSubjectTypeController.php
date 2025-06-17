<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lawsuit\LawsuitSubjectType;
use Illuminate\Http\Request;

class LawsuitSubjectTypeController extends Controller
{
    public function index()
    {
        return view("admin.lawsuit_subject_type.index");
    }

    public function store(Request $request)
    {
        try {
            LawsuitSubjectType::create([
                "lawsuit_type_id" => "1",
                "name" => $request->lawsuit_subject_type_name
            ]);
            return back()->withSuccess("Uyuşmazlık türü başarıyla eklendi.");
        } catch (\Exception $e) {
            return back()->withError("Bir hata oluştu.")->withInput();
        }
    }

    public function destroy(LawsuitSubjectType $lawsuit_subject_type)
    {
        try {
            $lawsuit_subject_type->delete();
            return back()->withSuccess("Uyuşmazlık türü başarıyla silindi.");
        } catch (\Exception $e) {
            return back()->withError("Bir hata oluştu.")->withInput();
        }
    }
}
