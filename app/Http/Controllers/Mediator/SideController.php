<?php

namespace App\Http\Controllers\Mediator;

use App\Models\Side\Side;
use App\Models\PersonType;
use App\Models\Side\Lawyer;
use App\Models\Side\People;
use App\Models\Side\Company;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Http\Controllers\Controller;
use App\Http\Resources\SideResource;

class SideController extends Controller
{
    /**
     * index degisiklikleri kiritik olup bircok yerde kullanilmaktadir. @Samet E 
     */
    public function index(Lawsuit $lawsuit)
    {
        return view('mediator.side.index', compact('lawsuit'));
    }

    public function edit(Side $side)
    {
        $data = view("mediator.person.modals." . $side->detail->type->key, compact("side"))->render();
        $type = PersonType::find($side->detail->type->id)->name;
        return compact("data", "type");
    }

    public function getEditModalContent(Request $request)
    {
        $type = PersonType::findOrFail($request->type);
        $side = Side::findOrFail($request->id);
        $data = view("mediator.person.modals." . $type->key, compact("side"))->render();
        $type = $type->name;
        return compact("data", "type");
    }



    public function show(Side $side)
    {
        if ($side->id == "new") {
            return response()->json(["status" => -1]);
        }

        if ($side->side_applicant_type_id == 2) {
            $item = Company::findOrFail($side->company_id);
        } else if ($side->side_applicant_type_id == 3) {
            $item = Lawyer::findOrFail($side->lawyer_id);
        } else {
            $item = People::findOrFail($side->person_id);
        }

        return response()->json(["status" => 200, "data" => $item]);
    }

    public function store(Request $request)
    {
        if ($request->side_applicant_type_id == "1") {
            $person = People::find($request->id);
            if (is_null($person)) {
                $person = new People();
            }

            $person->name = ucwords($request->name);
            $person->identification = $request->tc;
            $person->address = ucwords($request->address);
            $person->phone = $request->phone;
            $person->fixed_phone = $request->fixed_phone ?? "";
            $person->email = $request->email ?? "";
            $person->user_id = auth()->id();
            $person->save();

            $new_side = new Side();
            $new_side->person_id = $person->id;
            $new_side->side_applicant_type_id = $request->side_applicant_type_id;
            $new_side->lawsuit_id = $request->lawsuit_id;
            $new_side->side_type_id = $request->side_id;
            $new_side->save();
        } else if ($request->side_applicant_type_id == "2") {
            $new_side = new Side();

            $company = Company::find($request->id);
            if (is_null($company)) {
                $company = new Company();
            }

            $company->name = ucwords($request->name);
            $company->tax_number = $request->tax_number;
            $company->tax_office = $request->tax_office;
            $company->mersis_number = $request->mersis;
            $company->detsis_number = $request->detsis;
            $company->address = ucwords($request->address);
            $company->fixed_phone = $request->fixed_phone ?? "";
            $company->email = $request->email ?? "";
            $company->user_id = auth()->id();
            $company->save();

            $new_side->company_id = $company->id;
            $new_side->side_applicant_type_id = $request->side_applicant_type_id;
            $new_side->lawsuit_id = $request->lawsuit_id;
            $new_side->side_type_id = $request->side_id;
            $new_side->save();
        } else if ($request->side_applicant_type_id == "3") {
            $new_side = new Side();

            $lawyer = Lawyer::find($request->id);
            if (is_null($lawyer)) {
                $lawyer = new Lawyer();
            }

            $lawyer->name = ucwords($request->name);
            $lawyer->identification = $request->tc;
            $lawyer->address = ucwords($request->address);
            $lawyer->phone = $request->phone;
            $lawyer->fixed_phone = $request->fixed_phone ?? "";
            $lawyer->email = $request->email ?? "";
            $lawyer->baro_id = $request->baro_id;
            $lawyer->registration_no = $request->registration_no;
            $lawyer->user_id = auth()->id();
            $lawyer->save();


            $new_side->lawyer_id = $lawyer->id;
            $new_side->side_applicant_type_id = $request->side_applicant_type_id;
            $new_side->lawsuit_id = $request->lawsuit_id;
            $new_side->side_type_id = $request->side_id;
            $new_side->save();
        } else {
            $side = Side::findOrFail($request->side_id);

            $person = People::find($request->id);
            if (is_null($person)) {
                $person = new People();
            }

            $person->name = ucwords($request->name);
            $person->identification = $request->tc;
            $person->address = ucwords($request->address);
            $person->phone = $request->phone;
            $person->fixed_phone = $request->fixed_phone ?? "";
            $person->email = $request->email ?? "";
            $person->user_id = auth()->id();
            $person->save();

            $new_side = new Side();
            $new_side->parent_id = $side->id;
            $new_side->person_id = $person->id;
            $new_side->side_applicant_type_id = $request->side_applicant_type_id;
            $new_side->lawsuit_id = $side->lawsuit_id;
            $new_side->side_type_id = $side->side_type_id;
            $new_side->save();
        }

        return response()->json([
            "status" => true,
            "message" => "Başarılı bir şekilde eklendi.",
            "data" => $new_side
        ]);
    }

    public function update(Request $request)
    {
        $side = Side::findOrFail($request->id);
        $type = PersonType::findOrFail($request->type);
        if ($side->detail->type->id != $type->id) {
            $wilBeDeleted = $side->detail;
            $side->person_id = null;
            $side->company_id = null;
            $side->lawyer_id = null;
            $side->save();
            $wilBeDeleted->delete();
            $query = $type->service()->create($request);
            $side->{$type->row()} = $query->id;
            $side->save();
            return back()->withSuccess("Kişi Başarıyla Güncellendi");
        } else {
            $request->merge(["id" => $side->detail->id]);
            $side->detail->type->service()->update($request);
            return back()->withSuccess("Kişi Başarıyla Güncellendi");
        }
    }

    public function filterByParams(Request $request)
    {
        $query = Side::query();

        $query->where('lawsuit_id', $request->lawsuit_id);

        if (!is_null($request->columns[0]["search"]["value"])) {
            $query->where('side_type_id', $request->columns[0]["search"]["value"]);
        }

        if (!is_null($request->columns[1]["search"]["value"])) {
            $query->where('side_applicant_type_id', $request->columns[1]["search"]["value"]);
        }

        switch ($request->order[0]["column"]) {
            case 2:
                $query->orderBy('side_type_id', $request->order[0]["dir"]);
                break;
            case 3:
                $query->orderBy('side_applicant_type_id', $request->order[1]["dir"]);
                break;
        }


        $count = $query->count();
        $sides = $query->skip($request->start)->take($request->length)->get();
        $data = [
            "iTotalRecords" => $count,
            "iTotalDisplayRecords" => $count,
            "sEcho" => 0,
            "aaData" => SideResource::collection($sides)
        ];

        return response()->json($data);
    }
}
