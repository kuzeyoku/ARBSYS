<?php

namespace App\Services;

use App\Models\Side\Company;
use Illuminate\Http\Request;

class CompanyService
{
    public static function create(Request $request)
    {
        return Company::create([
            "name" => $request->name,
            "tax_number" => $request->tax_number,
            "tax_office_id" => $request->tax_office_id,
            "mersis_number" => $request->mersis_number,
            "detsis_number" => $request->detsis_number,
            "address" => $request->address,
            "phone" => $request->phone,
            "fixed_phone" => $request->fixed_phone,
            "email" => $request->email,
            "kep_address" => $request->kep_address,
            "check" => $request->has("check") ? json_encode(array_keys($request->check)) : null,
            "trade_registry_id" => $request->trade_registry_id,
            "trade_registry_number" => $request->trade_registry_number,
            "person_type_id" => $request->person_type_id,
            "user_id" => auth()->user()->id,
        ]);
    }

    public static function update(Request $request)
    {
        return Company::where("id", $request->id)->update([
            "name" => $request->name,
            "tax_number" => $request->tax_number,
            "tax_office_id" => $request->tax_office_id,
            "mersis_number" => $request->mersis_number,
            "detsis_number" => $request->detsis_number,
            "phone" => $request->phone,
            "fixed_phone" => $request->fixed_phone,
            "address" => $request->address,
            "email" => $request->email,
            "kep_address" => $request->kep_address,
            "check" => $request->has("check") ? json_encode(array_keys($request->check)) : null,
            "trade_registry_id" => $request->trade_registry_id,
            "trade_registry_number" => $request->trade_registry_number,
            "person_type_id" => $request->person_type_id,
            "user_id" => auth()->user()->id,
        ]);
    }

    public static function delete(int $id)
    {
        $company = Company::findOrFail($id);
        return $company->delete();
    }
}
