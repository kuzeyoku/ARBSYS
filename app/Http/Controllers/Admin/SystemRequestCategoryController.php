<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\System\SystemRequestCategory;
use Illuminate\Http\Request;

class SystemRequestCategoryController extends Controller
{
    public function index()
    {
        $system_request_categories = SystemRequestCategory::all();

        return view('backend.pages.system_request_category.list', compact('system_request_categories'));
    }

    public function create()
    {
        return view('backend.pages.system_request_category.create');
    }

    public function edit($id)
    {
        $system_request_category = SystemRequestCategory::findOrFail($id);
        return view('backend.pages.system_request_category.edit', compact('system_request_category'));
    }

    public function store(Request $request)
    {
        $system_request = new SystemRequestCategory();
        $system_request->name = $request->name;
        $system_request->save();

        \GlobalFunction::sessionFlash('success', 'store');

        return redirect()->route('system_request_category.index');
    }

    public function update(Request $request, $id)
    {
        $system_request = SystemRequestCategory::findOrFail($id);
        $system_request->name = $request->name;
        $system_request->save();

        \GlobalFunction::sessionFlash('success', 'update');

        return redirect()->route('system_request_category.index');
    }
}
