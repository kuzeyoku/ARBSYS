<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Models\User\Mediator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Mail\ChangeRequestConfirmationMail;
use App\Mail\ChangeRequestRejectionMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Notification\Notification;

class ChangeRequestController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', \RoleOptions::MEDIATOR)->where('change_request', true)->get();
        return view('admin.change_request.index', compact('users'));
    }

    public function edit(User $user)
    {
        if (!User::where('parent_id', $user->parent_id)->exists()) {
            return redirect()->route('admin.change_request.index');
        }

        return view('admin.change_request.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        DB::beginTransaction();
        try {
            $user->name = ucwords($request->name);
            $user->request_email = $request->email;
            $user->phone = $request->phone;
            $user->address = ucwords($request->address);
            $user->change_request = null;
            $user->request_email = null;
            $user->save();

            $mediator = Mediator::where('user_id', $user->id)->first();
            $mediator->registration_no = $request->registration_no;
            $mediator->iban = $request->iban;
            $mediator->mediation_center_id = ucwords($request->mediation_center);
            $mediator->meeting_address = ucwords($request->meeting_address);
            $mediator->meeting_address_proposal = $request->meeting_address_proposal ?? false;
            $mediator->save();

            $notification = new Notification();
            $notification->text = "Değişiklik talebiniz yetkililer tarafından düzenlendi.";
            $notification->user_id = $user->id;
            $notification->notification_category_id = 1;
            $notification->save();

            $request_user = User::where('parent_id', $user->id)->first();
            Mediator::where('user_id', $request_user->id)->delete();
            $request_user->delete();
            DB::commit();
        } catch (Exception $e) {
            Log::debug($e);
            DB::rollBack();
        }

        return redirect()->route('admin.change_request.index');
    }

    public function confirmation(User $user)
    {
        DB::beginTransaction();
        try {
            $realUser = User::findOrFail($user->parent_id);
            $realMediator = Mediator::where('user_id', $realUser->id)->firstOrFail();

            $realUser->name = ucwords($user->name);
            $realUser->phone = $user->phone;
            $realUser->email = $user->request_email;
            $realUser->address = ucwords($user->address);
            $realUser->change_request = null;
            $realUser->request_email = null;
            $realUser->save();

            $realMediator->identification = $user->mediator->identification;
            $realMediator->registration_no = $user->mediator->registration_no;
            $realMediator->iban = $user->mediator->iban;
            $realMediator->mediation_center_id = $user->mediator->mediation_center_id;
            $realMediator->meeting_address_proposal = $user->mediator->meeting_address_proposal ?? false;
            $realMediator->meeting_address = ucwords($user->mediator->meeting_address);
            $realMediator->save();

            $user->delete();
            $user->mediator->delete();

            $notification = new Notification();
            $notification->text = "Değişiklik talebiniz yetkililer tarafından onaylandı.";
            $notification->user_id = $realUser->id;
            $notification->notification_category_id = 1;
            $notification->save();

            DB::commit();
            $mailData = [
                "name" => $realUser->name,
                "email" =>  $realUser->email,
            ];
            Mail::to($realUser->email)->send(new ChangeRequestConfirmationMail((object)$mailData));
            return redirect()->route('admin.change_request.index')->withSuccess('Değişiklik talebi onaylandı.');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::debug($e);
            DB::rollBack();
            return redirect()->route('admin.change_request.index')->withError('İşlem Sırasında Bir Hata Oluştu.');
        }
    }

    public function rejected(Request $request, User $user)
    {
        DB::beginTransaction();
        try {
            if (is_null($user->change_request)) {
                return redirect()->route('admin.change_request.index')->withError("Bu kullanıcı için değişiklik talebi bulunmamaktadır.");
            } else {
                $notification = new Notification();
                $notification->text = "Değişiklik talebiniz yetkililer tarafından '" . $request->description . "' gerekcesiyle reddedildi.";
                $notification->user_id = $user->parent_id;
                $notification->notification_category_id = 1;
                $notification->save();
                $user->delete();
            }
            DB::commit();
            $mailData = [
                "name" => $user->name,
                "email" => $user->email,
                "reason" => $request->description
            ];
            Mail::to($user->parent->email)->send(new ChangeRequestRejectionMail((object)$mailData));
            return redirect()->route('admin.change_request.index')->withSuccess("Değişiklik talebi reddedildi.");
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::debug($e);
            DB::rollBack();
            return redirect()->route('admin.change_request.index')->withError("İşlem Sırasında Bir Hata Oluştu.");
        }
    }
}
