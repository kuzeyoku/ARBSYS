<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function cacheClear()
    {
        Artisan::call('cache:clear');

        // Rota Önbelleğini Temizle
        Artisan::call('route:clear');

        // Yapılandırma Önbelleğini Temizle
        Artisan::call('config:clear');

        // Derlenmiş View'ları Temizle
        Artisan::call('view:clear');

        return back()->with("success","Önbellek Başarıyla Temizlendi");
    }
}
