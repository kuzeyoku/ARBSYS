<?php

namespace App\Http\Controllers\Admin;

use App\Models\CalculationTool;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalculationToolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tools = CalculationTool::all();
        return view('admin.calculation_tools.index', compact('tools'));
    }

    public function update(Request $request)
    {
        try {
            $status = $request->status === "true" ? 1 : 0;
            CalculationTool::where('id', $request->id)->update([
                "status" => $status,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
