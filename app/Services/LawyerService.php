<?php

namespace App\Services;

use App\Models\Side\Lawyer;
use Illuminate\Http\Request;

class LawyerService
{

    public static function create(array $request)
    {
        return Lawyer::create([
            "name" => $request["name"],
            "identification" => $request["identification"],
            "address" => $request["address"],
            "phone" => $request["phone"],
            "fixed_phone" => $request["fixed_phone"],
            "email" => $request["email"],
            "baro_id" => $request["baro"],
            "registration_no" => $request["registration_no"],
            "user_id" => auth()->user()->id,
            "person_type_id" => $request["person_type_id"],
            "kep_address" => $request["kep_address"],
            "check" => array_key_exists("check", $request) ? json_encode(array_keys($request["check"])) : null,
        ]);
    }

    public static function update(Request $request)
    {
        return Lawyer::where("id", $request->id)->update([
            "name" => $request->name,
            "identification" => $request->identification,
            "address" => $request->address,
            "phone" => $request->phone,
            "fixed_phone" => $request->fixed_phone,
            "email" => $request->email,
            "baro_id" => $request->baro_id,
            "registration_no" => $request->registration_no,
            "user_id" => auth()->user()->id,
            "kep_address" => $request->kep_address,
            "check" => $request->check ? json_encode(array_keys($request->check)) : null,
        ]);
    }

    public static function delete(int $id)
    {
        $lawyer = Lawyer::findOrFail($id);
        return $lawyer->delete();
    }
}
