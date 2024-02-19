<?php

namespace App\Http\Controllers\Mediator;

use App\Models\PersonType;
use App\Models\Side\Lawyer;
use App\Models\Side\People;
use App\Models\Side\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersonStoreRequest;

class PersonController extends Controller
{

    private function getPerson(int $id, int $group)
    {
        switch ($group) {
            case 1:
                $item = People::findOrFail($id);
                break;
            case 2:
                $item = Lawyer::findOrFail($id);
                break;
            case 3:
                $item = Company::findOrFail($id);
                break;
        }
        return $item;
    }

    public function index(Request $request)
    {
        if ($request->isMethod("post")) {
            $personList = $this->search($request);
        } else {
            $peoples = People::where("user_id", auth()->user()->id)->get();
            $lawyers = Lawyer::where("user_id", auth()->user()->id)->get();
            $companies = Company::where("user_id", auth()->user()->id)->get();
            $personList = collect([$peoples, $lawyers, $companies])->collapse();
        }

        return view('mediator.person.index', compact('personList'));
    }

    public function edit(Request $request)
    {
        $item = $this->getPerson($request->id, $request->type["group"]);
        $data = view("mediator.person.modals." . $request->type["key"], compact("item"))->render();
        $type = $request->type["name"];
        return compact("data", "type");
    }

    public function search(Request $request) // TODO: Bu fonksiyonu daha iyi bir hale getir.
    {
        $personList = People::where("user_id", auth()->id());
        $company = Company::where('user_id', auth()->id());
        $lawyer = Lawyer::where('user_id', auth()->id());
        if ($request->type != null) {
            $personList = $personList->where("type_id", $request->type);
            $company = $company->where("type_id", $request->type);
            $lawyer = $lawyer->where("type_id", $request->type);
        }
        if ($request->name != null) {
            $personList = $personList->where("name", "like", "%" . $request->name . "%");
            $company = $company->where("name", "like", "%" . $request->name . "%");
            $lawyer = $lawyer->where("name", "like", "%" . $request->name . "%");
        }
        $personList = $personList->get();
        $company = $company->get();
        $lawyer = $lawyer->get();
        $personList = $personList->merge($company);
        $personList = $personList->merge($lawyer);
        return $personList;
    }


    public function getModalContent(Request $request)
    {
        $type = PersonType::find($request->type);
        $data = view('mediator.person.modals.' . $type->key, compact('type'))->render();
        return compact('data', "type");
    }

    public function getEditModalContent(Request $request)
    {
        $old_type = PersonType::findOrFail($request->old_type);
        $item  = $this->getPerson($request->id, $old_type->group);
        $type = PersonType::findOrFail($request->type);
        $data = view("mediator.person.modals." . $type->key, compact("item"))->render();
        $type = $type->name;
        return compact("data", "type");
    }

    public function store(Request $request) // TODO: Request Düzenle
    {
        try {
            $type = PersonType::find($request->type);
            switch ($type->group) {
                case 1:
                    People::create([
                        "name" => ucwords($request->name),
                        "identification" => $request->identification,
                        "address" => ucwords($request->address),
                        "phone" => $request->phone,
                        "fixed_phone" => $request->fixed_phone,
                        "email" => $request->email,
                        "kep_address" => $request->kep_address,
                        "user_id" => auth()->id(),
                        "check" => $request->check ? json_encode(array_keys($request->check)) : null,
                        "type_id" => $request->type,
                    ]);
                    break;
                case 2:
                    Lawyer::create([
                        "name" => ucwords($request->name),
                        "identification" => $request->identification,
                        "address" => ucwords($request->address),
                        "phone" => $request->phone,
                        "fixed_phone" => $request->fixed_phone,
                        "email" => $request->email,
                        "baro_id" => $request->baro,
                        "registration_no" => $request->registration_no,
                        "kep_address" => $request->kep_address,
                        "user_id" => auth()->id(),
                        "check" => $request->check ? json_encode(array_keys($request->check)) : null,
                        "type_id" => $request->type
                    ]);
                    break;
                case 3:
                    Company::create([
                        "name" => ucwords($request->name),
                        "tax_number" => $request->tax_number,
                        "tax_office_id" => $request->tax_office,
                        "mersis_number" => $request->mersis_number,
                        "detsis_number" => $request->detsis_number,
                        "address" => ucwords($request->address),
                        "fixed_phone" => $request->fixed_phone,
                        "email" => $request->email,
                        "kep_address" => $request->kep_address,
                        "trade_registry_id" => $request->trade_registry,
                        "trade_registry_number" => $request->trade_registry_number,
                        "user_id" => auth()->id(),
                        "check" => $request->check ? json_encode(array_keys($request->check)) : null,
                        "type_id" => $request->type
                    ]);
                    break;
            }
            return redirect()->back()->withSuccess('Kişi Başarıyla Eklendi.');
        } catch (\Exception $e) {
            return redirect()->back()->withError("Kişi Eklenirken Hata Oluştu.");
        }
    }

    public function update(Request $request) // TODO: Request Düzenle
    {
        $old_type = PersonType::find($request->old_type);
        $new_type = PersonType::find($request->type);
        if ($request->old_type === $request->type) {
            switch ($old_type->group) {
                case 1:
                    People::where("id", $request->id)->where("user_id", auth()->id())->update([
                        "name" => ucwords($request->name),
                        "identification" => $request->identification,
                        "address" => ucwords($request->address),
                        "phone" => $request->phone,
                        "fixed_phone" => $request->fixed_phone,
                        "email" => $request->email,
                        "kep_address" => $request->kep_address,
                        "check" => $request->check ? json_encode(array_keys($request->check)) : null,
                        "type_id" => $request->type
                    ]);
                    break;
                case 2:
                    Lawyer::where("id", $request->id)->where("user_id", auth()->id())->update([
                        "name" => ucwords($request->name),
                        "identification" => $request->identification,
                        "address" => ucwords($request->address),
                        "phone" => $request->phone,
                        "fixed_phone" => $request->fixed_phone,
                        "email" => $request->email,
                        "baro_id" => $request->baro,
                        "registration_no" => $request->registration_no,
                        "kep_address" => $request->kep_address,
                        "check" => $request->check ? json_encode(array_keys($request->check)) : null,
                        "type_id" => $request->type
                    ]);
                    break;
                case 3:
                    Company::where("id", $request->id)->where("user_id", auth()->id())->update([
                        "name" => ucwords($request->name),
                        "tax_number" => $request->tax_number,
                        "tax_office_id" => $request->tax_office,
                        "mersis_number" => $request->mersis_number,
                        "detsis_number" => $request->detsis_number,
                        "address" => ucwords($request->address),
                        "fixed_phone" => $request->fixed_phone,
                        "email" => $request->email,
                        "kep_address" => $request->kep_address,
                        "trade_registry_id" => $request->trade_registry,
                        "trade_registry_number" => $request->trade_registry_number,
                        "check" => $request->check ? json_encode(array_keys($request->check)) : null,
                        "type_id" => $request->type
                    ]);
                    break;
            }
        } else {
            $item = $this->getPerson($request->id, $old_type->group);
            if ($item->side)
                $item->side->delete();
            $item->delete();
            $this->store($request);
        }
        try {
            return redirect()->back()->withSuccess('Kişi Başarıyla Güncellendi.');
        } catch (\Exception $e) {
            return redirect()->back()->withError("Kişi Güncellenirken Hata Oluştu.");
        }
    }

    public function destroy(Request $request)
    {
        try {
            $item = $this->getPerson($request->id, $request->type);
            if ($item->side)
                $item->side->delete();
            $item->delete();
            return redirect()->back()->withSuccess('Kişi Başarıyla Silindi.');
        } catch (\Exception $e) {
            return redirect()->back()->withError('Kişi Silinirken Hata Oluştu.');
        }
    }
}
