<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lawsuit\LawsuitSubject;
use Illuminate\Http\Request;

class LawsuitSubjectController extends Controller
{
    public function store(Request $request)
    {
        try {
            LawsuitSubject::create([
                "name" => $request->name,
                "lawsuit_subject_type_id" => $request->lawsuit_subject_type
            ]);
            return back()->withSuccess("Uyuşmazlık konusu başarıyla eklendi.");
        } catch (\Exception $e) {
            return back()->withError("Bir hata oluştu.")->withInput();
        }
    }

    public function destroy(LawsuitSubject $lawsuit_subject)
    {
        try {
            $lawsuit_subject->delete();
            return back()->withSuccess("Uyuşmazlık konusu başarıyla silindi.");
        } catch (\Exception $e) {
            return back()->withError("Bir hata oluştu.")->withInput();
        }
    }
}
