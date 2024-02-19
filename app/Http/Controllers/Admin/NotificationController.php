<?php

namespace App\Http\Controllers\Admin;

use App\Models\User\User;
use App\Rules\SelectedUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Notification\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $users = User::distinct()->get();
        return view("admin.notification.index", compact("users"));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'message' => ['required', new SelectedUser($request->input("selected") == null ? 0 : count($request->input("selected")))],
            ]);

            foreach ($request->input("selected") as $user) {
                Notification::create([
                    'notification_category_id' => 1,
                    'user_id' => $user,
                    'text' => $request->message,
                ]);
            }
            return redirect()->back()->withSuccess('Bildirim başarılı bir şekilde gönderildi');
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->withError('Bildirim gönderilirken bir hata oluştu!');
        }
    }
}
