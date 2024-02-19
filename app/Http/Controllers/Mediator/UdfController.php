<?php

namespace App\Http\Controllers\Backend\UDFConverter;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Psr7\Request as Psr7Request;

class UdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $request->validate([
            'file' => "required",
        ]);

        $fileName = time() . "." . $request->file("file")->extension();

        $request->file->move(public_path('uploads'), $fileName);

        $client = new Client();
        $options = [
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => Utils::tryFopen(public_path('uploads') . '/' . $fileName, 'r'),
                    'filename' => $fileName,
                    'headers'  => [
                        'Content-Type' => '<Content-type header>'
                    ]
                ]
            ]
        ];
        $request = new Psr7Request('POST', 'https://udf-convert.herokuapp.com/v1/convert/upload');
        $res = $client->sendAsync($request, $options)->wait();
        return Redirect::back()->with([
            'data' => (string) $res->getBody(),
            'success' => 'UDF uzantısına başarılı bir şekilde çevrildi lütfen indir butonuna tıklayarak indirin.'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
