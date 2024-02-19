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
            "tax_office_id" => $request->tax_office,
            "mersis_number" => $request->mersis_number,
            "detsis_number" => $request->detsis_number,
            "address" => $request->address,
            "fixed_phone" => $request->fixed_phone,
            "email" => $request->email,
            "kep_address" => $request->kep_address,
            "check" => $request->check ? json_encode(array_keys($request->check)) : null,
            "trade_registry_id" => $request->trade_registry,
            "trade_registry_number" => $request->trade_registry_number,
            "user_id" => auth()->user()->id,
            "type_id" => $request->type,
        ]);
    }

    public static function update(Request $request)
    {
        return Company::where("id", $request->id)->update([
            "name" => $request->name,
            "tax_number" => $request->tax_number,
            "tax_office_id" => $request->tax_office,
            "mersis_number" => $request->mersis_number,
            "detsis_number" => $request->detsis_number,
            "address" => $request->address,
            "fixed_phone" => $request->fixed_phone,
            "email" => $request->email,
            "kep_address" => $request->kep_address,
            "check" => $request->check ? json_encode(array_keys($request->check)) : null,
            "trade_registry_id" => $request->trade_registry,
            "trade_registry_number" => $request->trade_registry_number,
            "user_id" => auth()->user()->id,
            "type_id" => $request->type,
        ]);
    }

    public static function delete(int $id)
    {
        $company = Company::findOrFail($id);
        return $company->delete();
    }
}
