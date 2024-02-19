<?php

namespace App\Http\Controllers\Mediator;

use App\Http\Controllers\Controller;
use App\Models\MinisteriesOpinion;

class MinisteriesOpinionsController extends Controller
{
    public function index()
    {
        $items = MinisteriesOpinion::where("status", true)->orderBy("order")->get();
        return view('mediator.ministeries_opinions', compact('items'));
    }
}
