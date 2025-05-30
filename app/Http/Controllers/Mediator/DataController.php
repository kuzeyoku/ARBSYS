<?php

namespace App\Http\Controllers\Mediator;

use App\Http\Controllers\Controller;
use App\Models\Lawsuit\LawsuitSubjectType;
use App\Models\MediationCenter;
use App\Models\PersonType;
use App\Models\Side\Company;
use App\Models\Side\People;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function getLawsuitSubjects(Request $request): JsonResponse
    {
        $lawsuit_subject_type = LawsuitSubjectType::findOrFail($request->lawsuit_subject_type_id);
        return response()->json($lawsuit_subject_type->lawsuitSubjects->pluck("name", "id"));
    }

    public function getMediationCenterAddress(Request $request): JsonResponse
    {
        $mediation_center = MediationCenter::findOrFail($request->id);
        return response()->json([
            "address" => $mediation_center->address,
        ]);
    }

    public function getPersonModalContent(Request $request): JsonResponse
    {
        $personType = new \stdClass();
        if (is_numeric($request->person_type_id)):
            $personType = PersonType::findOrFail($request->person_type_id);
            $file = $personType->group == 3 ? "mediator.person.modals.company_" . $personType->key : "mediator.person.modals.person_" . $personType->key;
            $formContent = view($file, compact("personType"))->render();
            $saveId = $personType->key;
        else:
            if ($request->person_type_id === "person"):
                $persons = People::selectToArray();
                $formContent = view("mediator.person.modals.general_person", compact("persons"))->render();
                $personType->name = "Gerçek Kişi";
                $saveId = $request->person_type_id;
            elseif ($request->person_type_id === "company"):
                $companies = Company::selectToArray();
                $formContent = view("mediator.person.modals.general_company", compact("companies"))->render();
                $personType->name = "Tüzel Kişi";
                $saveId = $request->person_type_id;
            else:
                $personType = PersonType::where("key", $request->person_type_id)->first();
                $file = $personType->group == 3 ? "mediator.person.modals.company_" . $personType->key : "mediator.person.modals.person_" . $personType->key;
                $formContent = view($file, compact("personType"))->render();
                $saveId = $personType->key;
            endif;
        endif;
        return response()->json(compact("formContent", "personType", "saveId"));
    }

    public function getPersonData(Request $request): JsonResponse
    {
        $person = People::findOrFail($request->id);
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

    public function getCompanyData(Request $request): JsonResponse
    {
        $company = Company::findOrFail($request->id);
        return response()->json([
            "name" => $company->name,
            "tax_number" => $company->tax_number,
            "mersis_number" => $company->mersis_number,
            "detsis_number" => $company->detsis_number,
            "address" => $company->address,
            "phone" => $company->phone,
            "fixed_phone" => $company->fixed_phone,
            "email" => $company->email,
            "kep_address" => $company->kep_address,
        ]);
    }
}
