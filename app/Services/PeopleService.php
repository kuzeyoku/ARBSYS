<?php

namespace App\Services;

use App\Models\Lawsuit\Lawsuit;
use App\Models\Side\People;
use Illuminate\Http\Request;

class PeopleService
{
    public static function create(array $request)
    {
        return People::create([
            "name" => $request["name"],
            "identification" => $request["identification"],
            "address" => $request["address"],
            "phone" => $request["phone"],
            "fixed_phone" => $request["fixed_phone"],
            "email" => $request["email"],
            "kep_address" => $request["kep_address"],
            "check" => array_key_exists("check", $request) ? json_encode(array_keys($request["check"])) : null,
            "tax_office_id" => $request["tax_office_id"],
            "person_type_id" => $request["person_type_id"],
            "user_id" => auth()->user()->id,
        ]);
    }

    public static function update(Request $request)
    {
        return People::where("id", $request->id)->update([
            "name" => $request->name,
            "identification" => $request->identification,
            "address" => $request->address,
            "phone" => $request->phone,
            "fixed_phone" => $request->fixed_phone,
            "email" => $request->email,
            "kep_address" => $request->kep_address,
            "check" => $request->has("check") ? json_encode(array_keys($request->check)) : null,
            "tax_office_id" => $request->tax_office_id,
        ]);
    }

    public static function addSide(People $people, Lawsuit $lawsuit)
    {
        return Side::create([
            "person_id" => $people->id,
            "lawsuit_id" => $lawsuit->id,

        ]);
    }

    public static function delete(int $id)
    {
        $people = People::findOrFail($id);
        return $people->delete();
    }
}
