<?php

namespace App\Http\Controllers\Mediator;

use App\Http\Controllers\Controller;
use App\Models\System\SystemRequest;
use App\Models\System\SystemRequestCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SystemRequestController extends Controller
{
    public function index()
    {
        $systemRequestCategories = SystemRequestCategory::getSelectArray();
        return view('mediator.system_request.index', compact('systemRequestCategories'));
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'user_id' => Auth::id(),
                'system_request_category_id' => $request->request_type,
                'title' => $request->title,
                'description' => $request->description,
            ];
            SystemRequest::create($data);
            return redirect()->back()->withSuccess('Talebiniz Başarıyla Oluşturuldu');
        } catch (\Exception $e) {
            return redirect()->back()->withError('Talebiniz Oluşturulurken Bir Hata Oluştu');
        }
    }
}
