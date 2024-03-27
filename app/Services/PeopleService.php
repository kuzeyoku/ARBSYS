<?php

namespace App\Services;

use App\Models\Side\People;
use Illuminate\Http\Request;

class PeopleService
{
    public static function create(Request $request)
    {
        return People::create([
            "name" => $request->name,
            "identification" => $request->identification,
            "address" => $request->address,
            "phone" => $request->phone,
            "fixed_phone" => $request->fixed_phone,
            "email" => $request->email,
            "kep_address" => $request->kep_address,
            "check" => $request->check ? json_encode(array_keys($request->check)) : null,
            "tax_office_id" => $request->tax_office,
            "type_id" => $request->type,
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
            "check" => $request->check ? json_encode(array_keys($request->check)) : null,
            "tax_office_id" => $request->tax_office,
            "type_id" => $request->type,
        ]);
    }

    public static function delete(int $id)
    {
        $people = People::findOrFail($id);
        return $people->delete();
    }
}
