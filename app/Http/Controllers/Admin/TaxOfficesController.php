<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaxOfficeStoreRequest;
use App\Models\TaxOffice;
use Illuminate\Http\Request;

class TaxOfficesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = cache()->remember("taxoffice", 3600, function () {
            return TaxOffice::all();
        });
        return view("admin.taxoffice.index", compact("data"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(TaxOfficeStoreRequest $request)
    {
        $data = [
            "province" => $request->province,
            "district" => $request->district,
            "informantCode" => $request->informantCode,
            "taxOfficeName" => $request->taxOfficeName
        ];
        $query = TaxOffice::create($data);

        if ($query) {
            cache()->forget("taxoffice");
            return redirect()->back()->with(["success" => "Vergi dairesi başarılı bir şekilde kaydedildi"]);
        }
        return redirect()->back()->with(["error" => "Vergi dairesi kaydedilirken bir hata oluştu"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
