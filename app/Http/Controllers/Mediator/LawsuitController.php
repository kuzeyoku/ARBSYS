<?php

namespace App\Http\Controllers\Mediator;

use Carbon\Carbon;
use App\Models\Side\Side;
use App\Models\PersonType;
use App\Models\Side\Lawyer;
use App\Models\Side\People;
use App\Models\Side\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;
use App\Services\HelperService;
use App\Services\LawsuitService;
use Illuminate\Support\Facades\DB;
use App\Models\Lawsuit\LawsuitType;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Models\Lawsuit\LawsuitSubject;
use Illuminate\Support\Facades\Redirect;
use App\Models\Lawsuit\LawsuitResultType;
use App\Models\Lawsuit\LawsuitProcessType;
use App\Models\Lawsuit\LawsuitSubjectType;
use App\Models\AgreementType\AgreementType;
use ZipArchive;

class LawsuitController extends Controller
{
    protected $lawsuitTypes;
    protected $lawsuitProcessType;
    protected $lawsuitResultType;

    public function __construct()
    {
        $this->lawsuitTypes = collect(Cache::remember('lawsuitTypes', 3600 * 24, function () {
            return LawsuitType::all();
        }));
        $this->lawsuitProcessType = collect(Cache::remember('lawsuitProcessType', 3600 * 24, function () {
            return LawsuitProcessType::all();
        }));
        $this->lawsuitResultType = collect(Cache::remember('lawsuitResultType', 3600 * 24, function () {
            return LawsuitResultType::all();
        }));
    }

/*    public function getModalContent(Request $request): array
    {
        $personType = $request->type;
        if ($request->type == "person"):
            $type = PersonType::where("key", "taxpayer")->first();
        elseif ($request->type == "company"):
            $type = PersonType::where("key", "public")->first();
        else:
            $type = PersonType::where("key", $request->type)->first();
            $personType = $type->key;
        endif;
        $file = $type->group == 3 ? "company_" : "person_";
        $data = view('mediator.person.modals.' . $file . $type->key, compact('type'))->render();
        return compact('data', "type", "personType");
    }*/

    public function index()
    {
        $agreement_types = AgreementType::all();
        $lawsuits = Lawsuit::active()->get();
        return view('mediator.lawsuit.index', compact('agreement_types', "lawsuits"));
    }

    public function create()
    {
        $lawsuit_types = $this->lawsuitTypes;
        $personTypes = collect(Cache::remember('personTypes', 3600 * 24, function () {
            return PersonType::where("key", "person_taxpayer")->orWhere("key", "company_public")->get();
        }));
        return view('mediator.lawsuit.create', compact('lawsuit_types', "personTypes"));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $lawsuit = Lawsuit::create([
                "delivery_by" => $request->delivery_by,
                "lawsuit_type_id" => $request->lawsuit_type,
                "lawsuit_subject_type_id" => $request->lawsuit_subject_type,
                "lawsuit_subject_id" => $request->lawsuit_subject,
                "mediation_office_id" => $request->mediation_office,
                "mediation_center_id" => $request->mediation_center,
                "application_document_no" => $request->application_document_no,
                "mediation_document_no" => $request->mediation_document_no,
                "process_start_date" => Carbon::parse($request->process_start_date)->format('Y-m-d'),
                "application_date" => Carbon::parse($request->application_date)->format('Y-m-d'),
                "job_date" => Carbon::parse($request->job_date)->format('Y-m-d'),
                "lawsuit_process_type_id" => $request->process_type,
                "lawsuit_result_type_id" => $request->result_type,
                "result_date" => Carbon::parse($request->result_date)->format('Y-m-d'),
                "user_id" => auth()->user()->id,
            ]); //Dosya Oluşturuldu
            foreach ($request->sides as $side) {
                $parent_side_id = null;
                if ($side["type"] == 1) {
                    $person = People::create([
                        "name" => ucwords($side["name"]),
                        "identification" => $side["identification"],
                        "address" => ucwords($side["address"]),
                        "phone" => $side["phone"],
                        "fixed_phone" => $side["fixed_phone"] ?? "",
                        "email" => $side["email"] ?? "",
                        "user_id" => auth()->id(),
                        "type_id" => 1,
                    ]); //Kişi Oluşturuldu

                    $createSide = Side::create([
                        "person_id" => $person->id,
                        "side_applicant_type_id" => 1,
                        "lawsuit_id" => $lawsuit->id,
                        "side_type_id" => $side["applicantType"] == "BAŞVURUCU" ? 1 : 2,
                        "user_id" => auth()->user()->id,
                    ]); //Taraf Oluşturuldu
                    $parent_side_id = $createSide->id;

                } //Kişi Tarafı Oluşturuldu
                if ($side["type"] == 2) {

                    $company = Company::create([
                        "name" => ucwords($side["name"]),
                        "tax_number" => $side["tax_number"],
                        "tax_office_id" => $side["tax_office_id"] ?? 0,
                        //"mersis_number" => $side["mersis_number"],
                        //"detsis_number" => $side["detsis_number"],
                        "address" => ucwords($side["address"]),
                        "fixed_phone" => $side["fixed_phone"] ?? "",
                        "email" => $side["email"] ?? "",
                        "user_id" => auth()->id(),
                        "type_id" => $side["type"],

                    ]); //Şirket Oluşturuldu
                    $createSide = Side::create([
                        "company_id" => $company->id,
                        "side_applicant_type_id" => 2,
                        "lawsuit_id" => $lawsuit->id,
                        "side_type_id" => $side["applicantType"] == "BAŞVURUCU" ? 1 : 2,
                        "user_id" => auth()->user()->id,
                    ]); //Taraf Oluşturuldu

                    $parent_side_id = $createSide->id;
                } //Şirket Tarafı Oluşturuldu

                if (!empty($side["others"])) {
                    foreach ($side["others"] as $side_other) {
                        $person = People::updateOrCreate(["identification" => $side["identification"]], [
                            "name" => ucwords($side_other["name"]),
                            "identification" => $side_other["identification"],
                            "address" => ucwords($side_other["address"]),
                            "phone" => $side_other["phone"],
                            "fixed_phone" => $side_other["fixedPhone"] ?? "",
                            "email" => $side_other["email"] ?? "",
                            "user_id" => auth()->id(),
                            "type_id" => 1,
                        ]);

                        Side::create([
                            "parent_id" => $parent_side_id,
                            "person_id" => $person->id,
                            "side_applicant_type_id" => 4,
                            "lawsuit_id" => $lawsuit->id,
                            "side_type_id" => $side["applicantType"] == "BAŞVURUCU" ? 1 : 2,
                            "user_id" => auth()->user()->id,
                        ]);
                    }
                } //TODO: İncele

                if (!empty($side["lawyers"])) {
                    foreach ($side["lawyers"] as $lawyer) {
                        $lawyer = Lawyer::create([
                            "name" => ucwords($lawyer["name"]),
                            "identification" => $lawyer["identification"],
                            "address" => ucwords($lawyer["address"]),
                            "phone" => $lawyer["phone"],
                            "fixed_phone" => $lawyer["fixedPhone"] ?? "",
                            "email" => $lawyer["email"] ?? "",
                            "baro_id" => $lawyer["baro"],
                            "registration_no" => $lawyer["registration_no"],
                            "user_id" => auth()->user()->id,
                        ]);

                        Side::create([
                            "parent_id" => $parent_side_id,
                            "lawyer_id" => $lawyer->id,
                            "side_applicant_type_id" => 3,
                            "lawsuit_id" => $lawsuit->id,
                            "side_type_id" => $side["applicantType"] == "BAŞVURUCU" ? 1 : 2,
                            "user_id" => auth()->user()->id,
                        ]);
                    }
                }

                if (!empty($side["employees"])) {
                    foreach ($side["employees"] as $side_worker) {
                        $person = People::create([
                            "name" => ucwords($side_worker["name"]),
                            "identification" => $side_worker["identification"],
                            "address" => ucwords($side_worker["address"]),
                            "phone" => $side_worker["phone"],
                            "fixed_phone" => $side_worker["fixedPhone"] ?? "",
                            "email" => $side_worker["email"] ?? "",
                            "user_id" => auth()->user()->id,
                            "type_id" => 1,

                        ]);

                        Side::create([
                            "parent_id" => $parent_side_id,
                            "person_id" => $person->id,
                            "side_applicant_type_id" => 5,
                            "lawsuit_id" => $lawsuit->id,
                            "side_type_id" => $side["applicantType"] == "BAŞVURUCU" ? 1 : 2,
                            "user_id" => auth()->user()->id,
                        ]);
                    }
                }

                if (!empty($side["representatives"])) {
                    foreach ($side["representatives"] as $side_representative) {

                        $person = People::create([
                            "name" => ucwords($side_representative["name"]),
                            "identification" => $side_representative["identification"],
                            "address" => ucwords($side_representative["address"]),
                            "phone" => $side_representative["phone"],
                            "fixed_phone" => $side_representative["fixedPhone"] ?? "",
                            "email" => $side_representative["email"] ?? "",
                            "user_id" => auth()->id(),
                            "type_id" => 1,

                        ]);

                        Side::create([
                            "parent_id" => $parent_side_id,
                            "person_id" => $person->id,
                            "side_applicant_type_id" => 6,
                            "lawsuit_id" => $lawsuit->id,
                            "side_type_id" => $side["applicantType"] == "BAŞVURUCU" ? 1 : 2,
                            "user_id" => auth()->user()->id,
                        ]);
                    }
                }

                if (!empty($side["experts"])) {
                    foreach ($side["experts"] as $side_expert) {
                        $person = People::create([
                            "name" => ucwords($side_expert["name"]),
                            "identification" => $side_expert["identification"],
                            "address" => ucwords($side_expert["address"]),
                            "phone" => $side_expert["phone"],
                            "fixed_phone" => $side_expert["fixedPhone"] ?? "",
                            "email" => $side_expert["email"] ?? "",
                            "user_id" => auth()->id(),
                            "type_id" => 1,

                        ]);

                        Side::create([
                            "parent_id" => $parent_side_id,
                            "person_id" => $person->id,
                            "side_applicant_type_id" => 7,
                            "lawsuit_id" => $lawsuit->id,
                            "side_type_id" => $side["applicantType"] == "BAŞVURUCU" ? 1 : 2,
                            "user_id" => auth()->user()->id,
                        ]);
                    }
                }
            }
            DB::commit();
            return response()->json(compact("lawsuit"));
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->back()->with("error", "Dosya Oluşturulurken Bir Hata Oluştu");
        }

        // $claimants = LawsuitService::getSidesByParams($lawsuit->id, \SideTypeOptions::CLAIMANT, null, [1, 2]);
        // $defendants = LawsuitService::getSidesByParams($lawsuit->id, \SideTypeOptions::DEFENDANT, null, [1, 2]);
        // $passive_side_add_buttons = true;

        // $sides = view('mediator.lawsuit.partials.sides', compact('claimants', 'defendants', 'passive_side_add_buttons'))->render();

        //$print = LawsuitService::lawsuitPrintReplaceKeywords($lawsuit);

        // return response()->json(['sides' => $sides, 'lawsuit' => $lawsuit]);
    }

    public function edit(Lawsuit $lawsuit)
    {
        $process_types = $this->lawsuitProcessType;
        $result_types = $this->lawsuitResultType;
        $lawsuit_types = $this->lawsuitTypes;
        $subject_types = null;
        if (!is_null($lawsuit->lawsuit_type_id)) {
            $subject_types = LawsuitSubjectType::all();
        }
        $subjects = null;
        if (!is_null($lawsuit->lawsuit_subject_type_id)) {
            $subjects = LawsuitSubject::where('lawsuit_subject_type_id', $lawsuit->lawsuit_subject_type_id)->get();
        }

        return view('mediator.lawsuit.edit', compact('process_types', 'result_types', 'lawsuit_types', 'subject_types', 'subjects', 'lawsuit'));
    }

    public function update(Request $request, Lawsuit $lawsuit)
    {
        //step1
        $lawsuit->delivery_by = $request->delivery_by;
        $lawsuit->lawsuit_type_id = $request->lawsuit_type_id;
        $lawsuit->lawsuit_subject_type_id = $request->lawsuit_subject_type_id;
        $lawsuit->lawsuit_subject_id = $request->lawsuit_subject_id;
        //step2
        $lawsuit->mediation_office_id = $request->mediation_office;
        $lawsuit->application_document_no = $request->application_document_no;
        $lawsuit->mediation_document_no = $request->mediation_document_no;
        $lawsuit->process_start_date = Carbon::parse($request->process_start_date)->format('Y-m-d');
        $lawsuit->application_date = Carbon::parse($request->application_date)->format('Y-m-d');
        $lawsuit->job_date = Carbon::parse($request->job_date)->format('Y-m-d');
        $lawsuit->lawsuit_process_type_id = $request->process_type_id;
        $lawsuit->lawsuit_result_type_id = $request->result_type_id;
        $lawsuit->result_date = Carbon::parse($request->result_date)->format('Y-m-d');
        $lawsuit->save();

        return response()->json(['status' => true]);
    }

    public function archive_index()
    {
        $items = Lawsuit::archive()->get();
        return view('mediator.lawsuit.archive', compact('items'));
    }

    public function archive(Lawsuit $lawsuit)
    {
        $lawsuit->is_archive = true;
        $lawsuit->save();
        return redirect()->back()->with('success', 'Dava Arşivlendi');
    }

    public function unArchive(Lawsuit $lawsuit): RedirectResponse
    {
        $lawsuit->is_archive = false;
        $lawsuit->save();
        return redirect()->back()->with('success', 'Dava Arşivden Çıkarıldı');
    }

    public function destroy(Lawsuit $lawsuit)
    {
        $lawsuit->documents()->delete();
        $lawsuit->delete();
        return Redirect::back()->with("success", "Dosya silindi");
    }

    public function report(Request $request)
    {
        if ($request->method() == "POST")
            return $this->report_search($request);

        $result_types = LawsuitResultType::all();
        $agreement_types = AgreementType::all();
        $data = Lawsuit::whereUserId(auth()->id())->get();
        return view('mediator.lawsuit.report', compact('result_types', 'agreement_types', "data"));
    }

    public function report_search(Request $request)
    {
        $query = Lawsuit::query();

        if ($request->from == "lawsuit") {
            $query->whereNull('lawsuit_result_type_id');
        }

        if (!is_null($request->is_archive)) {
            $query->where('is_archive', $request->is_archive);
        }

        if (!is_null($request->application_document_no)) {
            $query->where('application_document_no', 'like', "%" . $request->application_document_no . "%");
        }

        if (!is_null($request->mediation_document_no)) {
            $query->where('mediation_document_no', 'like', "%" . $request->mediation_document_no . "%");
        }

        if (!is_null($request->application_date["start"]) && !is_null($request->application_date["end"])) {
            $start = Carbon::parse($request->application_date["start"])->format('Y-m-d');
            $end = Carbon::parse($request->application_date["end"])->format('Y-m-d');

            $query->where('application_date', '>=', $start);
            $query->where('application_date', '<=', $end);
        }

        if (!is_null($request->job_date["start"]) && !is_null($request->job_date["end"])) {
            $start = Carbon::parse($request->job_date["start"])->format('Y-m-d');
            $end = Carbon::parse($request->job_date["end"])->format('Y-m-d');

            $query->where('job_date', '>=', $start);
            $query->where('job_date', '<=', $end);
        }

        if (!is_null($request->result_type_id)) {
            $query->where('lawsuit_result_type_id', $request->result_type_id);
        }

        if (!is_null($request->result_date["start"]) && !is_null($request->result_date["end"])) {
            $start = Carbon::parse($request->result_date["start"])->format('Y-m-d');
            $end = Carbon::parse($request->result_date["end"])->format('Y-m-d');

            $query->where('result_date', '>=', $start);
            $query->where('result_date', '<=', $end);
        }

        $query->orderBy('id', 'DESC');

        $data = $query->get();

        $result_types = LawsuitResultType::all();
        $agreement_types = AgreementType::all();


        return view('mediator.lawsuit.report', compact('result_types', 'agreement_types', "data"));
    }

    public function processTypeUpdate(Request $request)
    {
        $lawsuit = Lawsuit::findOrFail($request->lawsuit_id);
        $lawsuit->lawsuit_process_type_id = 5;
        $lawsuit->save();

        return response()->json($lawsuit);
    }

    public function agreementTypeUpdate(Request $request)
    {
        $lawsuit = Lawsuit::findOrFail($request->lawsuit_id);
        $lawsuit->agreement_type_id = $request->agreement_type_id;
        $lawsuit->save();

        return response()->json($lawsuit);
    }

    public function saveWithFile(Request $request)
    {

        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return redirect()->back()->withError('Lütfen Bir UDF Dosyası Yükleyiniz!');
        } else {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            if ($extension != "udf") {
                return redirect()->back()->withError('Lütfen Bir UDF Dosyası Yükleyiniz!');
            }
        }

        $values = array();

        $source = $request->file('file')->getPathname();

        $target = public_path('extracted/' . time() . '/');

        if (!is_dir(public_path('extracted'))) {
            mkdir(public_path('extracted'), 0777, true);
        }
        mkdir($target, 0777, true);

        $time = time();
        $saved_file_location = $target . $time;

        if (move_uploaded_file($source, $saved_file_location)) {
            $zip = new ZipArchive();
            $x = $zip->open($saved_file_location);
            if ($x === true) {
                $zip->extractTo($target);
                $zip->close();
            } else {
                return redirect()->back()->withError('Bir problem oluştu lütfen daha sonra tekrar deneyin!');
                // return response()->json("There was a problem. Please try again!");
            }
        } else {
            return redirect()->back()->withError('Problem oluştu lütfen teknik ekiple iletişime geçin!');
            // return response()->json("There was a problem. Sorry!");
        }

        $xml_file = $target . "/content.xml";
        $file = simplexml_load_file($xml_file);
        $myfile = fopen("content.txt", "w") or die("Unable to open file!");
        chmod("content.txt", 0777);
        fwrite($myfile, $file->content);
        fclose($myfile);
        $fh = fopen('content.txt', 'r');


        $string = "GENEL";
        $claimants = array();
        $claimant_count = -1;
        $defendants = array();
        $defendant_count = -1;
        $selectedItems = [];
        while ($line = fgets($fh)) {
            $sign = false;
            $key = "";
            $value = "";

            if (substr(trim($line), -1) === 'X') {
                $selectedItems[] = trim(str_replace('X', ',', trim($line)));
            }

            if (strrpos($line, ":") !== false) {
                $array = str_split($line, 1);
                $counter = 0;
                for ($i = 0; $i < count($array); $i++) {
                    if ($array[$i] == ":") {
                        if ($counter == 0) {
                            $counter++;
                        }
                    }
                    if ($counter == 0 && $array[$i] != ":")
                        $key .= $array[$i];
                    else if ($counter != 0) {
                        if ($sign == true) {
                            $value .= $array[$i];
                        } else if ($sign == false) {
                            $sign = true;
                            continue;
                        }
                    }
                }

                if ($string == "BAŞVURU SAHİBİ BİLGİLERİ") {
                    if (HelperService::clear($key) == "Adres") {
                        $cep = null;
                        $tel = null;


                        if (strrpos($value, "TEL:") !== false) {
                            $tel = explode("TEL:", HelperService::clear($value));
                        } elseif (strrpos($value, "Cep Tel : ") !== false) {
                            $cep = explode("Cep Tel : ", HelperService::clear($value));
                        } else if (strrpos(strtolower($value), "cad") !== false || strrpos(strtolower($value), "no") !== false) {
                            $claimants[$claimant_count]["Adres"] = ucwords(HelperService::clear($value));
                        }


                        if (!is_null($cep) && count($cep)) {
                            $claimants[$claimant_count]["Adres"] = isset($cep[0]) ? ucwords($cep[0]) : "";
                            if (substr(HelperService::clear($cep[1]), 0, 2) == "05") {
                                $claimants[$claimant_count]["Cep"] = $cep[1];
                            } else {
                                $claimants[$claimant_count]["Tel"] = $cep[1];
                            }
                        }

                        if (!is_null($tel) && count($tel)) {
                            $claimants[$claimant_count]["Adres"] = isset($tel[0]) ? ucwords($tel[0]) : "";
                            if (substr(HelperService::clear($tel[1]), 0, 2) == "05") {
                                $claimants[$claimant_count]["Cep"] = $tel[1];
                            } else {
                                $claimants[$claimant_count]["Tel"] = $tel[1];
                            }
                        }
                    } else if (HelperService::clear($key) == "Vekil") {
                        $cep = null;
                        $tel = null;

                        if (strrpos($value, "TEL:") !== false) {
                            $tel = explode("TEL:", HelperService::clear($value));
                        } elseif (strrpos($value, "GSM.") !== false) {
                            $cep = explode("GSM.", HelperService::clear($value));
                        }

                        if (!is_null($cep) && count($cep)) {
                            $claimants[$claimant_count]["Vekil Ad Soyad"] = $cep[0] ?? "";
                            if (substr(HelperService::clear($cep[1]), 0, 2) == "05") {
                                $claimants[$claimant_count]["Vekil Cep"] = $cep[1];
                            } else {
                                $claimants[$claimant_count]["Vekil Tel"] = $cep[1];
                            }
                        }

                        if (!is_null($tel) && count($tel)) {
                            $claimants[$claimant_count]["Vekil Ad Soyad"] = $tel[0] ?? "";
                            if (substr(HelperService::clear($tel[1]), 0, 2) == "05") {
                                $claimants[$claimant_count]["Vekil Cep"] = $tel[1];
                            } else {
                                $claimants[$claimant_count]["Vekil Tel"] = $tel[1];
                            }
                        }
                    } else if (HelperService::clear($key) == "Cep Tel") {
                        if (substr(HelperService::clear($value), 0, 2) == "05") {
                            $claimants[$claimant_count]["Cep"] = HelperService::clear($value);
                        } else {
                            $claimants[$claimant_count]["Tel"] = HelperService::clear($value);
                        }
                    } else {
                        $claimants[$claimant_count][HelperService::clear($key)] = HelperService::clear($value);
                    }
                } else if ($string == "KARŞI TARAF BİLGİLERİ") {
                    if (HelperService::clear($key) == "Adres") {
                        $cep = null;
                        $tel = null;

                        if (strrpos($value, "TEL:") !== false) {
                            $tel = explode("TEL:", HelperService::clear($value));
                        } else if (strrpos($value, "TEL :") !== false) {
                            $tel = explode("TEL :", HelperService::clear($value));
                        } else if (strrpos($value, "Cep Tel :") !== false) {
                            $cep = explode("Cep Tel :", HelperService::clear($value));
                        } else if (strrpos(strtolower($value), "cad") !== false || strrpos(strtolower($value), "no") !== false) {
                            $defendants[$defendant_count]["Adres"] = ucwords(HelperService::clear($value));
                        }

                        if (!is_null($cep) && count($cep)) {
                            $defendants[$defendant_count]["Adres"] = isset($cep[0]) ? ucwords($cep[0]) : "";
                            if (substr(HelperService::clear($cep[1]), 0, 2) == "05") {
                                $defendants[$defendant_count]["Cep"] = $cep[1];
                            } else {
                                $defendants[$defendant_count]["Tel"] = $cep[1];
                            }
                        } else if (!is_null($tel) && count($tel)) {
                            $defendants[$defendant_count]["Adres"] = isset($tel[0]) ? ucwords($tel[0]) : "";
                            if (substr(HelperService::clear($tel[1]), 0, 2) == "05") {
                                $defendants[$defendant_count]["Cep"] = $tel[1];
                            } else {
                                $defendants[$defendant_count]["Tel"] = $tel[1];
                            }
                        }
                    } else if (HelperService::clear($key) == "Vekil") {
                        $cep = null;
                        $tel = null;

                        if (strrpos($value, "TEL:") !== false) {
                            $tel = explode("TEL:", HelperService::clear($value));
                        } elseif (strrpos($value, "GSM.") !== false) {
                            $cep = explode("GSM.", HelperService::clear($value));
                        }

                        if (!is_null($cep) && count($cep)) {
                            $defendants[$defendant_count]["Vekil Ad Soyad"] = $cep[0] ?? "";
                            $defendants[$defendant_count]["Vekil Cep"] = $cep[1] ?? "";
                            if (substr(HelperService::clear($cep[1]), 0, 2) == "05") {
                                $defendants[$defendant_count]["Vekil Cep"] = $cep[1];
                            } else {
                                $defendants[$defendant_count]["Vekil Tel"] = $cep[1];
                            }
                        } else if (!is_null($tel) && count($tel)) {
                            $defendants[$defendant_count]["Vekil Ad Soyad"] = $tel[0] ?? "";
                            if (substr(HelperService::clear($tel[1]), 0, 2) == "05") {
                                $defendants[$defendant_count]["Vekil Cep"] = $tel[1];
                            } else {
                                $defendants[$defendant_count]["Vekil Tel"] = $tel[1];
                            }
                        }
                    } elseif (HelperService::clear($key) == "Cep Tel") {
                        if (substr(HelperService::clear($value), 0, 2) == "05") {
                            $defendants[$defendant_count]["Cep"] = HelperService::clear($value);
                        } else {
                            $defendants[$defendant_count]["Tel"] = HelperService::clear($value);
                        }
                    } elseif (HelperService::clear($key) == "TEL") {
                        if (substr(HelperService::clear($value), 0, 2) == "05") {
                            $defendants[$defendant_count]["Cep"] = HelperService::clear($value);
                        } else {
                            $defendants[$defendant_count]["Tel"] = HelperService::clear($value);
                        }
                    } else {
                        $defendants[$defendant_count][HelperService::clear($key)] = HelperService::clear($value);
                    }
                } else {
                    $values[HelperService::clear($key)] = HelperService::clear($value);
                }
            } else {
                if (\GlobalFunction::startsWith(HelperService::clear($line), "BAŞVURU SAHİBİ BİLGİLERİ") == true) {
                    $string = "BAŞVURU SAHİBİ BİLGİLERİ";
                    ++$claimant_count;
                    continue;
                } else if (\GlobalFunction::startsWith(HelperService::clear($line), "KARŞI TARAF BİLGİLERİ") == true) {
                    $string = "KARŞI TARAF BİLGİLERİ";
                    ++$defendant_count;
                    continue;
                }
            }
        }
        fclose($fh);
        $this->deleteDirectory(public_path('extracted'));
        unlink(public_path('content.txt'));

        \GlobalFunction::rrmdir($target);

        if (isset($values["BAŞVURU NUMARASI"]) && is_numeric($values["BAŞVURU NUMARASI"][0])) {
            $values["application_number"] = $values["BAŞVURU NUMARASI"];
            unset($values["BAŞVURU NUMARASI"]);
        } else {
            $values["application_number"] = null;
        }
        if (isset($values["BAŞVURU TARİHİ"]) && is_numeric($values["BAŞVURU TARİHİ"][0])) {
            $values["application_date"] = Carbon::createFromFormat("d/m/Y", substr($values["BAŞVURU TARİHİ"], 0, 10))->format('Y-m-d');
            unset($values["BAŞVURU TARİHİ"]);
        } else {
            $values["application_date"] = null;
        }

        $newSelectedItem = [];

        foreach ($selectedItems as $item) {
            $newSelectedItem[] = array_map('trim', explode(',', $item));
        }

        $telNo = isset($claimants[0]["Cep Telefonu(Zorunlu)"]) ? explode(" ", $claimants[0]["Cep Telefonu(Zorunlu)"])[0] : null;
        $email = isset($claimants[0]["Cep Telefonu(Zorunlu)"]) ? explode(" ", $claimants[0]["Cep Telefonu(Zorunlu)"])[1] : null;
        $baro_name = isset($claimants[0]["Baro Sicil Numarası"]) ? explode(" ", $claimants[0]["Baro Sicil Numarası"])[0] : null;
        $sicil_no = isset($claimants[0]["Baro Sicil Numarası"]) ? explode(" ", $claimants[0]["Baro Sicil Numarası"])[2] : null;

        isset($defendants[0]["Dosya Türü"]) || isset($defendants[0]["Dava Türü"]) ?: null;

        if (isset($defendants[0]["Dosya Türü"]) || isset($defendants[0]["Dava Türü"])) {
            if (isset($defendants[0]["Dosya Türü"])) {
                $defendants[0]["Dosya Türü"] = mb_strtoupper($defendants[0]["Dosya Türü"], 'UTF-8');
            } else {
                $defendants[0]["Dava Türü"] = mb_strtoupper($defendants[0]["Dava Türü"], 'UTF-8');
            }
        }

        // strtoupper($defendants[0]["Dosya Türü"]);
        if (count($claimants) != 0) {
            return view('mediator.lawsuit.udf', compact('values', 'claimants', 'defendants', 'newSelectedItem', 'baro_name', 'sicil_no', 'telNo', 'email'));
        }

        return redirect()->back()->withError('eksik udf bilgileri bulunmakta lütfen kontrol ediniz.');
    }

    public function confirm_udf(Request $request)
    {

        DB::beginTransaction();
        try {
            $lawsuit = Lawsuit::create([
                "delivery_by" => "Sistem Üzerinden",
                "lawsuit_type_id" => 1,
                "lawsuit_process_type_id" => 1,
                "user_id" => auth()->id(),
                "application_date" => $request->application_date,
                "mediation_document_no" => $request->mediation_document_no,
                "job_date" => $request->job_date,
                "mediation_office_id" => $request->mediation_office,
                "application_document_no" => $request->application_document_no,
                "udf_subject" => $request->udf_subject,
                "lawsuit_subject_type_id" => $request->lawsuit_subject_type_id,
                "lawsuit_subject_id" => $request->lawsuit_subject_id,
            ]);

            for ($i = 0; $i < $request->claimant_count; $i++) {
                if ($request->{'claimant_' . $i . '_side_applicant_type_id'} == 1) {
                    $person = People::create([
                        "name" => ucwords($request->{'claimant_' . $i . '_name'}),
                        "identification" => $request->{'claimant_' . $i . '_identification'},
                        "type_id" => 2,
                        "address" => ucwords($request->{'claimant_' . $i . '_address'}),
                        "phone" => $request->{'claimant_' . $i . '_phone'},
                        "fixed_phone" => $request->{'claimant_' . $i . '_fixed_phone'},
                        "email" => $request->{'claimant_' . $i . '_email'},
                        "user_id" => auth()->id(),
                    ]);
                    $side = Side::create([
                        "person_id" => $person->id,
                        "side_applicant_type_id" => 1,
                        "lawsuit_id" => $lawsuit->id,
                        "side_type_id" => 1,
                        "user_id" => auth()->user()->id
                    ]);
                    $parent_side_id = $side->id;
                } else {
                    $company = Company::create([
                        "name" => ucwords($request->{'claimant_' . $i . '_name'}),
                        "tax_number" => $request->{'claimant_' . $i . '_tax_number'},
                        "tax_office_id" => $request->{'claimant_' . $i . '_tax_office'},
                        "mersis_number" => $request->{'claimant_' . $i . '_mersis_number'},
                        "detsis_number" => $request->{'claimant_' . $i . '_detsis_number'},
                        "address" => ucwords($request->{'claimant_' . $i . '_address'}),
                        "fixed_phone" => $request->{'claimant_' . $i . '_fixed_phone'},
                        "email" => $request->{'claimant_' . $i . '_email'},
                        "type_id" => 8,
                        "user_id" => auth()->id(),
                    ]);
                    $side = Side::create([
                        "company_id" => $company->id,
                        "side_applicant_type_id" => 2,
                        "lawsuit_id" => $lawsuit->id,
                        "side_type_id" => 1,
                        "user_id" => auth()->user()->id
                    ]);
                    $parent_side_id = $side->id;
                }

                if ($request->{'claimant_' . $i . '_lawyer_name'} != "") {
                    $lawyer = Lawyer::create([
                        "name" => ucwords($request->{'claimant_' . $i . '_lawyer_name'}),
                        "identification" => $request->{'claimant_' . $i . '_lawyer_tc'},
                        "address" => ucwords($request->{'claimant_' . $i . '_lawyer_address'}),
                        "phone" => $request->{'claimant_' . $i . '_lawyer_phone'},
                        "fixed_phone" => $request->{'claimant_' . $i . '_lawyer_fixed_phone'},
                        "email" => $request->{'claimant_' . $i . '_lawyer_email'},
                        "baro_id" => $request->{'claimant_' . $i . '_lawyer_baro'},
                        "registration_no" => $request->{'claimant_' . $i . '_lawyer_registration_no'},
                        "type_id" => 3,
                        "user_id" => auth()->id(),
                    ]);

                    $side = Side::create([
                        "parent_id" => $parent_side_id,
                        "lawyer_id" => $lawyer->id,
                        "side_applicant_type_id" => 3,
                        "lawsuit_id" => $lawsuit->id,
                        "side_type_id" => 1,
                        "user_id" => auth()->user()->id
                    ]);
                }

                if (isset($request->sides) && count($request->sides)) {
                    foreach ($request->sides as $side) {
                        if ($side["side_type_id"] == $request->{'claimant_' . $i . '_side_type_id'} && $side["side_id"] == $i) {
                            LawsuitService::udfCreateSide($side, $lawsuit, $parent_side_id);
                        }
                    }
                }
            }

            for ($i = 0; $i < $request->defendant_count; $i++) {
                if ($request->{'defendant_' . $i . '_side_applicant_type_id'} == 1) {
                    $person = People::create([
                        "name" => ucwords($request->{'defendant_' . $i . '_name'}),
                        "identification" => $request->{'defendant_' . $i . '_identification'},
                        "address" => ucwords($request->{'defendant_' . $i . '_address'}),
                        "phone" => $request->{'defendant_' . $i . '_phone'},
                        "fixed_phone" => $request->{'defendant_' . $i . '_fixed_phone'},
                        "email" => $request->{'defendant_' . $i . '_email'},
                        "type_id" => 2,
                        "user_id" => auth()->id(),
                    ]);

                    $side = Side::create([
                        "person_id" => $person->id,
                        "side_applicant_type_id" => 1,
                        "lawsuit_id" => $lawsuit->id,
                        "side_type_id" => 2,
                        'user_id' => auth()->user()->id
                    ]);

                    $parent_side_id = $side->id;
                } else {

                    $company = Company::create([
                        "name" => ucwords($request->{'defendant_' . $i . '_name'}),
                        "tax_number" => $request->{'defendant_' . $i . '_tax_number'},
                        "tax_office_id" => $request->{'defendant_' . $i . '_tax_office'},
                        "mersis_number" => $request->{'defendant_' . $i . '_mersis_number'},
                        "detsis_number" => $request->{'defendant_' . $i . '_detsis_number'},
                        "tax_mersis_desis" => $request->{'defendant_' . $i . '_mersis_desis_vergi_number'},
                        "address" => ucwords($request->{'defendant_' . $i . '_address'}),
                        "fixed_phone" => $request->{'defendant_' . $i . '_fixed_phone'},
                        "email" => $request->{'defendant_' . $i . '_email'},
                        "type_id" => 8,
                        "user_id" => auth()->id(),
                    ]);

                    $side = Side::create([
                        "company_id" => $company->id,
                        "side_applicant_type_id" => 2,
                        "lawsuit_id" => $lawsuit->id,
                        "side_type_id" => 2,
                        "user_id" => auth()->user()->id
                    ]);

                    $parent_side_id = $side->id;
                }

                if ($request->{'defendant_' . $i . '_lawyer_name'} != "") {
                    $lawyer = Lawyer::create([
                        "name" => ucwords($request->{'defendant_' . $i . '_lawyer_name'}),
                        "identification" => $request->{'defendant_' . $i . '_lawyer_tc'},
                        "address" => ucwords($request->{'defendant_' . $i . '_lawyer_address'}),
                        "phone" => $request->{'defendant_' . $i . '_lawyer_phone'},
                        "fixed_phone" => $request->{'defendant_' . $i . '_lawyer_fixed_phone'},
                        "email" => $request->{'defendant_' . $i . '_lawyer_email'},
                        "baro_id" => $request->{'defendant_' . $i . '_lawyer_baro'},
                        "registration_no" => $request->{'defendant_' . $i . '_lawyer_registration_no'},
                        "type_id" => 3,
                        "user_id" => auth()->id(),
                    ]);

                    $side = Side::create([
                        "parent_id" => $parent_side_id,
                        "lawyer_id" => $lawyer->id,
                        "side_applicant_type_id" => 3,
                        "lawsuit_id" => $lawsuit->id,
                        "side_type_id" => 2,
                        "user_id" => auth()->user()->id
                    ]);
                }

                if (isset($request->sides) && count($request->sides)) {
                    foreach ($request->sides as $side) {
                        if ($side["side_type_id"] == $request->{'defendant_' . $i . '_side_type_id'} && $side["side_id"] == $i) {
                            LawsuitService::udfCreateSide($side, $lawsuit, $parent_side_id);
                        }
                    }
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            dd($e->getMessage());
            Log::debug($e);
            DB::rollback();
        }

        if (in_array('anlasilan_hususlar', $request->input())) {
            $new_anlasilan_hususlar = [];

            foreach ($request->input('anlasilan_hususlar') as $key => $value) {
                array_push($new_anlasilan_hususlar, ["name" => $value, 'lawsuit_id' => $lawsuit->id]);
            }

            DB::table('understood_status')->insert($new_anlasilan_hususlar);
        }

        // custom lawsuit type db add.
        if ($request->input('lawsuit_subject_type_name') || $request->input('lawsuit_subject_name')) {
            DB::table("custom_lawsuit_types")->insert([
                "lawsuit_subject_type_name" => $request->input("lawsuit_subject_type_name"),
                "lawsuit_subject_name" => $request->input("lawsuit_subject_name"),
                "lawsuit_id" => (int)$lawsuit->id,
                "user_id" => (int)auth()->id(),
            ]);
        }

        return redirect()->route('lawsuit.index')->withSuccess('Dava Dosyası Başarıyla Oluşturuldu.');
    }

    public function getTypes()
    {
        $types = LawsuitType::all();

        return response()->json($types);
    }

    public function allSubjectTypes()
    {
        $subject_types = LawsuitSubjectType::all();

        return response()->json($subject_types);
    }

    public function getSubjectTypes($lawsuit_type_id)
    {
        $subject_types = LawsuitSubjectType::where('lawsuit_type_id', $lawsuit_type_id)->get();

        return response()->json($subject_types);
    }

    public function getSubjects($lawsuit_subject_type_id)
    {
        $subjects = LawsuitSubject::where('lawsuit_subject_type_id', $lawsuit_subject_type_id)->get();

        return response()->json($subjects);
    }

    public function getApplicants(Request $request)
    {
        $applicants = LawsuitService::getSidesByParams($request->lawsuit_id);

        return response()->json($applicants);
    }

    public function getReelByName(Request $request)
    {
        $users = DB::table('people')
            ->where('name', 'like', $request->name . '%')
            ->get();

        return response()->json($users);
    }

    public function getTaxNumber(Request $request)
    {
        $taxNumber = DB::table("companies")
            ->where('mersis_number', 'like', $request->mersis_number . '%')
            ->get();

        return response()->json($taxNumber);
    }

    public function getTaxOfficesName(Request $request)
    {
        $taxOfficeName = DB::table("taxoffices")->where("taxOfficeName", "like", $request->vergi_daire_adi . "%")->get();
        return response()->json($taxOfficeName);
    }

    public function getCompanyByTaxNumber(Request $request)
    {
        $tax_number = trim(str_replace('_', '', $request->tax_number));

        $data = Company::where('user_id', auth()->id())
            ->where(DB::raw('CONCAT(tax_number," ",LOWER(name))'), 'LIKE', "%" . strtolower($tax_number) . "%")
            ->get();

        return response()->json($data);
    }

    public function getLawyerByTc(Request $request)
    {
        $tc = str_replace('_', '', $request->tc);

        $data = Lawyer::where('user_id', auth()->id())
            ->where(DB::raw('CONCAT(identification," ",name)'), 'LIKE', $tc . "%")
            ->get();

        return response()->json($data);
    }

    function deleteDirectory($dir)
    {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }

        return rmdir($dir);
    }

    public function noteView(Lawsuit $lawsuit)
    {
        return view('mediator.lawsuit.note', compact('lawsuit'));
    }

    public function noteSave(Request $request, Lawsuit $lawsuit)
    {
        try {
            if ($lawsuit->notes) {
                \App\Models\Lawsuit\LawsuitNotes::where("lawsuit_id", $lawsuit->id)->update([
                    "note" => $request->notes
                ]);
            } else {
                \App\Models\Lawsuit\LawsuitNotes::create([
                    "lawsuit_id" => $lawsuit->id,
                    "user_id" => auth()->user()->id,
                    "note" => $request->notes,
                ]);
            }
            return redirect()->back()->withSuccess('Notlar başarıyla güncellendi.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withError("Bir Hata Oluştu");
        }
    }
}
