<?php

namespace App\Http\Controllers\Mediator;

use App\Models\Lawsuit\Lawsuit;
use App\Http\Controllers\Controller;

class Logs extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Lawsuit $lawsuit)
    {
        return view("mediator.lawsuit.logs", compact("lawsuit"));
    }
}
