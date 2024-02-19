<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MinisteriesOpinion;
use App\Http\Controllers\Controller;

class MinisteriesOpinionsController extends Controller
{
    public function index()
    {
        $items = MinisteriesOpinion::all();
        return view("admin.ministeries_opinions.index", compact("items"));
    }

    public function create()
    {
        return view("admin.ministeries_opinions.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required",
            "file" => "nullable",
            "status" => "required",
            "order" => "required",
        ]);

        try {
            MinisteriesOpinion::create([
                "title" => ucwords($request->title),
                "file" => $this->fileUpload($request->file),
                "status" => $request->status,
                "order" => $request->order,
            ]);
            return redirect()->route("admin.ministeries_opinions")->withSuccess("Veri Ekleme İşlemi Başarıyla Tamamlandı.");
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withError("Bir hata oluştu.")->withInput();
        }
    }

    public function edit(MinisteriesOpinion $item)
    {
        return view("admin.ministeries_opinions.edit", compact("item"));
    }

    public function update(Request $request, MinisteriesOpinion $item)
    {
        $request->validate([
            "title" => "required",
            "file" => "nullable",
            "status" => "required",
            "order" => "required",
        ]);
        try {
            if ($request->hasFile("file")) {
                if ($item->file == null)
                    $fileName = $this->fileUpload($request->file);
                else
                    $fileName = $this->fileUpload($request->file, $item->file);
            } else {
                $fileName = $item->file;
            }
            $item->update([
                "title" => ucwords($request->title),
                "status" => $request->status,
                "order" => $request->order,
                "file" => $fileName,
            ]);
            return redirect()->route("admin.ministeries_opinions")->withSuccess("Veri Güncelleme İşlemi Başarıyla Tamamlandı.");
        } catch (Exception $e) {
            return redirect()->back()->withError("Bir hata oluştu.")->withInput();
        }
    }

    public function destroy(MinisteriesOpinion $item)
    {
        try {
            $file = public_path("uploads/ministeries_opinions/" . $item->file);
            if (file_exists($file))
                unlink($file);
            $item->delete();
            return redirect()->route("admin.ministeries_opinions")->withSuccess("Veri Silme İşlemi Başarıyla Tamamlandı.");
        } catch (Exception $e) {
            return redirect()->back()->withError("Bir hata oluştu.")->withInput();
        }
    }


    private function fileUpload($file, $name = null)
    {
        if (is_null($name))
            $fileName = Str::random(10) . "." . $file->getClientOriginalExtension();
        else
            $fileName = $name;
        $file->move(public_path("uploads/ministeries_opinions"), $fileName);
        return $fileName;
    }
}
