<?php

namespace App\Http\Controllers\Admin;

use RoleOptions;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Models\User\Mediator;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereRoleId(RoleOptions::MEDIATOR)->orderBy("created_at", "DESC")->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        try {
            $sicilNo = str_pad($request->registration_no, 6, "0", STR_PAD_LEFT);
            $query = User::create([
                "name" => $request->name,
                "gender" => $request->gender,
                "borndate" => $request->borndate,
                "phone" => $request->phone,
                "email" => $request->email,
                "password" => bcrypt($request->password),
                "address" => $request->address,
                "role_id" => RoleOptions::MEDIATOR,
            ]);

            if ($query) {
                Mediator::create([
                    "user_id" => $query->id,
                    "registration_no" => $sicilNo,
                    "iban" => $request->iban,
                    "meeting_address" => $request->meeting_address,
                ]);
            }
            return Redirect::route("admin.users")->withSuccess("Kayıt işlemi başarılı bir şekilde gerçekleşti");
        } catch (\Exception $e) {
            return Redirect::back()->withError("Kayıt işlemi sırasında bir hata meydana geldi");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        try {
            $sicilNo = str_pad($request->registration_no, 6, "0", STR_PAD_LEFT);
            $user->update([
                "name" => $request->name,
                "gender" => $request->gender,
                "borndate" => $request->borndate,
                "phone" => $request->phone,
                "email" => $request->email,
                "address" => $request->address,
                "role_id" => RoleOptions::MEDIATOR,
            ]);

            $user->mediator->update([
                "iban" => $request->iban,
                "registration_no" => $sicilNo,
                "meeting_address" => $request->meeting_address,
            ]);
            return Redirect::route("admin.users")->withSuccess("Kullanıcı Başarıyla Güncellendi");
        } catch (\Exception $e) {
            return Redirect::back()->withError("Kullanıcı Güncellenirken Bir Hata Meydana Geldi");
        }
    }

    public function dateUpdate(Request $request, User $user)
    {
        try {
            $request->validate([
                "date" => ["required"]
            ]);

            $user->end = $request->date;
            $user->save();

            return Redirect::back()->withSuccess("Başarılı bir şekilde süre atandı");
        } catch (\Exception $e) {
            return Redirect::back()->withError("Bir hata oluştu");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            if ($user->mediator) {
                $user->mediator->delete();
            }
            if ($user->notifications) {
                $user->notifications()->delete();
            }
            if ($user->requests) {
                $user->requests()->delete();
            }
            $user->delete();
            return \redirect()->back()->withSuccess("Silme işlemi başarılı bir şekilde gerçekleşti");
        } catch (\Exception $e) {
            dd($e->getMessage());
            return \redirect()->back()->withError("Silme işlemi sırasında bir hata meydana geldi");
        }
    }

    /**
     * Update userdata user is not active @Samet E.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function userBan(User $user)
    {
        $user->is_active = 0;
        $user->save();
        return Redirect::back()->withSuccess("Kullanıcı pasif hale getirildi");
    }

    public function userConfirm(User $user)
    {
        $user->is_active = 1;
        $user->save();
        return Redirect::back()->withSuccess("Kullanıcı aktif hale getirildi");
    }
}
