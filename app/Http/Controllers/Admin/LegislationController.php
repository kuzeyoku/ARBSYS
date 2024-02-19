<?php

namespace App\Http\Controllers\Admin;

use App\Models\Legislation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LegislationController extends Controller
{
    public function index()
    {
        $legislations = Legislation::all();
        return view('admin.legislation.index', compact('legislations'));
    }

    public function create()
    {
        return view('admin.legislation.create');
    }

    public function store(Request $request)
    {
        try {
            Legislation::create([
                "title" => ucwords($request->title),
                "slug" => Str::slug($request->title),
                "content" => $request->content,
                "status" => $request->status
            ]);
            return redirect()->route('admin.legislation')->withSuccess('Sayfa Başarıyla Eklendi');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withError('Sayfa Eklenirken Bir Hata Oluştu')->withInput();
        }
    }

    public function edit(Legislation $legislation)
    {
        return view('admin.legislation.edit', compact('legislation'));
    }

    public function update(Request $request, Legislation $legislation)
    {
        try {
            Legislation::where("id", $legislation->id)->update([
                "title" => ucwords($request->title),
                "slug" => Str::slug($request->title),
                "content" => $request->content,
                "status" => $request->status
            ]);
            return redirect()->route('admin.legislation')->withSuccess('Sayfa Başarıyla Güncellendi');
        } catch (\Exception $e) {
            return redirect()->back()->withError('Sayfa Güncellenirken Bir Hata Oluştu')->withInput();
        }
    }

    public function destroy(Legislation $legislation)
    {
        try {
            $legislation->delete();
            return redirect()->route('admin.legislation')->withSuccess('Sayfa Başarıyla Silindi');
        } catch (\Exception $e) {
            return redirect()->back()->withError('Sayfa Silinirken Bir Hata Oluştu');
        }
    }
}
