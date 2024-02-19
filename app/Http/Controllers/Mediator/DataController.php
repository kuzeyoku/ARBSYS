<?php

namespace App\Http\Controllers\Mediator;

use App\Http\Controllers\Controller;
use App\Models\MediationCenter;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function getMediationCenterAddress(Request $request)
    {
        $mediation_center = MediationCenter::findOrFail($request->id);
        return response()->json([
            "address" => $mediation_center->address,
        ]);
    }

    public function getPersonData(Request $request)
    {
        $person = \App\Models\Side\People::findOrFail($request->id);
        return response()->json([
            "name" => $person->name,
            "identification" => $person->identification,
            "address" => $person->address,
            "phone" => $person->phone,
            "fixed_phone" => $person->fixed_phone,
            "email" => $person->email,
            "kep_address" => $person->kep_address,
        ]);
    }
}
