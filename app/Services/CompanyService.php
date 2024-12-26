<?php

namespace App\Services;

use App\Models\Side\Company;
use Illuminate\Http\Request;

class CompanyService
{
    public static function create(array $request)
    {
        return Company::create([
            "name" => array_key_exists("name", $request) ? $request["name"] : null,
            "tax_number" => array_key_exists("tax_number", $request) ? $request["tax_number"] : null,
            "tax_office_id" => array_key_exists("taxt_office_id", $request) ? $request["tax_office_id"] : null,
            "mersis_number" => array_key_exists("mersis_number", $request) ? $request["mersis_number"] : null,
            "detsis_number" => array_key_exists("detsis_number", $request) ? $request["detsis_number"] : null,
            "phone" => array_key_exists("phone", $request) ? $request["phone"] : null,
            "fixed_phone" => array_key_exists("fixed_phone", $request) ? $request["fixed_phone"] : null,
            "address" => array_key_exists("address", $request) ? $request["address"] : null,
            "email" => array_key_exists("email", $request) ? $request["email"] : null,
            "kep_address" => array_key_exists("kep_address", $request) ? $request["kep_address"] : null,
            "check" => array_key_exists("check", $request) ? json_encode(array_keys($request["check"])) : null,
            "trade_registry_id" => array_key_exists("trade_registry_id", $request) ? $request["trade_registry_id"] : null,
            "trade_registry_number" => array_key_exists("trade_registry_number", $request) ? $request["trade_registry_number"] : null,
            "person_type_id" => array_key_exists("person_type_id", $request) ? $request["person_type_id"] : null,
            "user_id" => auth()->user()->id,
        ]);
    }

    public static function update(array $request)
    {
        return Company::where("id", $request["id"])->update([
            "name" => array_key_exists("name", $request) ? $request["name"] : null,
            "tax_number" => array_key_exists("tax_number", $request) ? $request["tax_number"] : null,
            "tax_office_id" => array_key_exists("taxt_office_id", $request) ? $request["tax_office_id"] : null,
            "mersis_number" => array_key_exists("mersis_number", $request) ? $request["mersis_number"] : null,
            "detsis_number" => array_key_exists("detsis_number", $request) ? $request["detsis_number"] : null,
            "phone" => array_key_exists("phone", $request) ? $request["phone"] : null,
            "fixed_phone" => array_key_exists("fixed_phone", $request) ? $request["fixed_phone"] : null,
            "address" => array_key_exists("address", $request) ? $request["address"] : null,
            "email" => array_key_exists("email", $request) ? $request["email"] : null,
            "kep_address" => array_key_exists("kep_address", $request) ? $request["kep_address"] : null,
            "check" => array_key_exists("check", $request) ? json_encode(array_keys($request["check"])) : null,
            "trade_registry_id" => array_key_exists("trade_registry_id", $request) ? $request["trade_registry_id"] : null,
            "trade_registry_number" => array_key_exists("trade_registry_number", $request) ? $request["trade_registry_number"] : null,
        ]);
    }

    public static function delete(int $id)
    {
        $company = Company::findOrFail($id);
        return $company->delete();
    }
}
