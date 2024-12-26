<?php

namespace App\Services;

use App\Models\Side\People;
use Illuminate\Http\Request;

class PeopleService
{
    public static function create(array $request)
    {
        return People::create([
            "name" => array_key_exists("name", $request) ? $request["name"] : null,
            "identification" => array_key_exists("identification", $request) ? $request["identification"] : null,
            "address" => array_key_exists("address", $request) ? $request["address"] : null,
            "phone" => array_key_exists("phone", $request) ? $request["phone"] : null,
            "fixed_phone" => array_key_exists("fixed_phone", $request) ? $request["fixed_phone"] : null,
            "email" => array_key_exists("email", $request) ? $request["email"] : null,
            "kep_address" => array_key_exists("kep_address", $request) ? $request["kep_address"] : null,
            "check" => array_key_exists("check", $request) ? json_encode(array_keys($request["check"])) : null,
            "tax_office_id" => array_key_exists("tax_office_id", $request) ? $request["tax_office_id"] : null,
            "person_type_id" => array_key_exists("person_type_id", $request) ? $request["person_type_id"] : null,
            "user_id" => auth()->user()->id,
        ]);
    }

    public static function update(array $request)
    {
        return People::where("id", $request["id"])->update([
            "name" => array_key_exists("name", $request) ? $request["name"] : null,
            "identification" => array_key_exists("identification", $request) ? $request["identification"] : null,
            "address" => array_key_exists("address", $request) ? $request["address"] : null,
            "phone" => array_key_exists("phone", $request) ? $request["phone"] : null,
            "fixed_phone" => array_key_exists("fixed_phone", $request) ? $request["fixed_phone"] : null,
            "email" => array_key_exists("email", $request) ? $request["email"] : null,
            "kep_address" => array_key_exists("kep_address", $request) ? $request["kep_address"] : null,
            "check" => array_key_exists("check", $request) ? json_encode(array_keys($request["check"])) : null,
            "tax_office_id" => array_key_exists("tax_office_id", $request) ? $request["tax_office_id"] : null,
        ]);
    }
}
