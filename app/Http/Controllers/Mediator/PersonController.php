<?php

namespace App\Http\Controllers\Mediator;

use App\Models\Side\Side;
use App\Models\PersonType;
use App\Models\Side\Lawyer;
use App\Models\Side\People;
use App\Models\Side\Company;
use Illuminate\Http\Request;
use App\Services\LawyerService;
use App\Services\PeopleService;
use App\Services\CompanyService;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod("post")) {
            $items = $this->search($request);
        } else {
            $peoples = auth()->user()->people;
            $lawyers = auth()->user()->lawyers;
            $companies = auth()->user()->companies;
            $items = collect([$peoples, $lawyers, $companies])->collapse();
        }
        return view('mediator.person.index', compact('items'));
    }

    public function edit($group, $id)
    {
        $item = $this->getPerson($id, $group);
        $file = $item->personType->group == 3 ? "company_" . $item->personType->key : "person_" . $item->personType->key;
        $data = view("mediator.person.modals." . $file, compact("item"))->render();
        return compact("data", "item");
    }

    public function store(Request $request) // TODO: Request Düzenle
    {
        try {
            $personType = PersonType::where("key", $request->type)->first();
            switch ($personType->group) {
                case 1:
                    PeopleService::create($request->all());
                    break;
                case 2:
                    LawyerService::create($request->all());
                    break;
                case 3:
                    CompanyService::create($request->all());
                    break;
            }
            return redirect()->back()->with("success", 'Kişi Başarıyla Eklendi.');
        } catch (\Exception $e) {
            return redirect()->back()->with("error", "Kişi Eklenirken Hata Oluştu.");
        }
    }

    public function update(Request $request)
    {
        $type = PersonType::findOrFail($request->person_type_id);
        try {
            switch ($type->group) {
                case 1:
                    PeopleService::update($request->all());
                    break;
                case 2:
                    LawyerService::update($request->all());
                    break;
                case 3:
                    CompanyService::update($request->all());
                    break;
            }
            return redirect()->back()->withSuccess('Kişi Başarıyla Güncellendi.');
        } catch (\Exception $e) {
            return redirect()->back()->withError("Kişi Güncellenirken Hata Oluştu.");
        }
    }

    /*public function update(Request $request) // TODO: Request Düzenle
    {
        try {
            $currentType = PersonType::find($request->current_type);
            $newType = PersonType::find($request->type);
            if ($currentType->group === $newType->group) {
                switch ($currentType->group) {
                    case 1:
                        PeopleService::update($request);
                        break;
                    case 2:
                        LawyerService::update($request);
                        break;
                    case 3:
                        CompanyService::update($request);
                        break;
                }
            } else {
                $item = $this->getPerson($request->id, $currentType->group);
                if ($newType->group === 1) {
                    $person = PeopleService::create($request);
                    Side::where("id", $item->side->id)->update(["person_id" => $person->id, "lawyer_id" => null, "company_id" => null]);
                    $item->delete();
                } else if ($newType->group === 2) {
                    $lawyer = LawyerService::create($request);
                    Side::where("id", $item->side->id)->update(["person_id" => null, "lawyer_id" => $lawyer->id, "company_id" => null]);
                    $item->delete();
                } else if ($newType->group === 3) {
                    $company = CompanyService::create($request);
                    Side::where("id", $item->side->id)->update(["person_id" => null, "lawyer_id" => null, "company_id" => $company->id]);
                    $item->delete();
                }
            }
            return redirect()->back()->withSuccess('Kişi Başarıyla Güncellendi.');
        } catch
        (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withError("Kişi Güncellenirken Hata Oluştu.");
        }
    }*/

    public function destroy(Request $request, $group, $id)
    {
        try {
            $person = $this->getPerson($id, $group);
            if ($person->side)
                $person->side->delete();
            $person->delete();
            return redirect()->back()->withSuccess('Kişi Başarıyla Silindi.');
        } catch (\Exception $e) {
            return redirect()->back()->withError('Kişi Silinirken Hata Oluştu.');
        }
    }

    public function search(Request $request)
    {
        $peoples = People::where("user_id", auth()->user()->id)->get();
        $lawyers = Lawyer::where("user_id", auth()->user()->id)->get();
        $companies = Company::where("user_id", auth()->user()->id)->get();
        $items = collect([$peoples, $lawyers, $companies])->collapse();
        if ($request->name) {
            $items = $items->filter(function ($item) use ($request) {
                return str_contains(strtolower($item->name), strtolower($request->name));
            });
        }
        return $items;
    }

    private function getPerson($id, $group)
    {
        if ($group == 1) {
            return People::findOrFail($id);
        } elseif ($group == 2) {
            return Lawyer::findOrFail($id);
        } elseif ($group == 3) {
            return Company::findOrFail($id);
        }
        return null;
    }
}
