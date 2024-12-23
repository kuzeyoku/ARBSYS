<?php

namespace App\Http\Controllers\Mediator;

use Exception;
use App\Models\User\User;
use App\Models\User\Mediator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Notification\Notification;
use App\Rules\EvenLastDigitRule;

class MediatorController extends Controller
{

    public function index()
    {
        $user = User::findOrFail(auth()->id());
        return view('mediator.profile.index', compact('user'));
    }


    public function password_change(Request $request)
    {
        $user = User::findOrFail(auth()->id());
        $message = "Bilinmeyen bir hata oluştu.";
        $status = false;

        if (!Hash::check($request->current_password, $user->password)) {
            $message = "Kullanmış olduğunuz şifreyi yanlış girdiniz.";
            $status = false;
        } elseif (Hash::check($request->new_password, $user->password)) {
            $message = "Yeni şifreniz, eski şifrenizle aynı olmamalı.";
            $status = false;
        } elseif ($request->new_password != $request->verify_password) {
            $message = "Yeni girdiğiniz şifre bir biriyle uyuşmuyor.";
            $status = false;
        } elseif ((Hash::check($request->current_password, $user->password)) && ($request->new_password == $request->verify_password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            $message = "Şifreniz başarılı bir şekilde değiştirildi.";
            $status = true;
        }

        $data = [
            'message' => $message,
            'status' => $status,
        ];

        return response()->json($data);
    }

    public function update(UserUpdateRequest $request)
    {
        $user = User::where("parent_id", auth()->id())->first();
        if ($user)
            return redirect()->back()->withError("Henüz Değerlendirilmemiş Bir Talebiniz Bulunmaktadır. Yeni Talep Oluşturmak İçin Lütfen Önceki Talebinizin Değerlendirilmesini Bekleyiniz.");
        DB::beginTransaction();
        try {
            $parent_user = User::where('parent_id', auth()->id())->first();
            if (!is_null($parent_user)) {
                Mediator::where('user_id', $parent_user->id)->delete();
                $parent_user->delete();
            }

            $user = new User();
            $user->name = ucwords($request->name);
            $user->request_email = $request->email;
            $user->phone = $request->phone;
            $user->address = ucwords($request->address);
            $user->change_request = true;
            $user->is_active = false;
            $user->role_id = \RoleOptions::MEDIATOR;
            $user->parent_id = auth()->id();
            $user->save();

            $mediator = new Mediator();
            $mediator->user_id = $user->id;
            $mediator->identification = $request->identification;
            $mediator->registration_no = $request->registration_no;
            $mediator->iban = $request->iban;
            $mediator->mediation_center_id = $request->mediation_center_id;
            $mediator->meeting_address = ucwords($request->meeting_address);
            $mediator->meeting_address_proposal = $request->meeting_address_proposal ?? false;
            $mediator->save();

            $notification = new Notification();
            $notification->text = "Değişiklik talebiniz yetkililer tarafından inceleniyor.";
            $notification->user_id = auth()->id();
            $notification->notification_category_id = 1;
            $notification->save();

            DB::commit();
            return redirect()->route('mediator.profile')->with('success', 'Değişiklik talebiniz yetkililere iletildi.');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::debug($e);
            DB::rollBack();
            return redirect()->route('mediator.profile')->with('error', 'Bilinmeyen bir hata oluştu. Lütfen yetkililere durumu bildirin!');
        }
    }

    public function letter_option_save(Request $request)
    {
        $mediator = Mediator::where('user_id', auth()->id())->first();
        $mediator->letter_option_id = $request->letter_option_id;
        $mediator->letter_top = $request->letter_top;
        $mediator->letter_bottom = $request->letter_bottom;
        $mediator->save();

        $data = [
            'message' => "Antet seçimi başarılı bir şekilde kaydedildi.",
            'status' => true,
            'mediator' => $mediator
        ];

        return response()->json($data);
    }

    public function logo_save(Request $request)
    {
        $mediator = Mediator::where('user_id', auth()->id())->first();
        $folderPath = $mediator->path;

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file_name =  sha1(date('YmdHis') . rand()) . '.png';
        $file = $folderPath . "/" . $file_name;

        file_put_contents($file, $image_base64);

        if (!is_null($mediator->letter_logo) && file_exists($mediator->path . $mediator->letter_logo)) {
            unlink($mediator->path . $mediator->letter_logo);
        }

        $mediator->letter_logo = $file_name;
        $mediator->save();

        $data = [
            'message' => "Antet seçimi başarılı bir şekilde kaydedildi.",
            'status' => true,
            'mediator' => $mediator
        ];

        return response()->json($data);
    }
}
