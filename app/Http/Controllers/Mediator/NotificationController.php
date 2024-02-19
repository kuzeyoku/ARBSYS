<?php

namespace App\Http\Controllers\Mediator;

use App\Http\Controllers\Controller;
use App\Models\Notification\Notification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Notification::whereUserId(auth()->id())->get();
        $notReadMessages = Notification::whereUserId(auth()->id())->where("is_read", 0)->get();
        $readMessages = Notification::whereUserId(auth()->id())->where("is_read", 1)->get();
        return view("mediator.notification", compact("messages", "readMessages", "notReadMessages"));
    }

    public function update(Notification $notification)
    {
        $notification->update(["is_read" => 1]);
        return redirect()->back()->with("success", "Mesaj okundu olarak işaretlendi.");
    }
}
