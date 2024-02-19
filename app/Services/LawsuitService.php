<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Side\Side;
use App\Models\Side\Lawyer;
use App\Models\Side\Person;
use App\Models\Lawsuit\Lawsuit;

class LawsuitService
{

    public static function nonParticipantSides($side_ids)
    {
        if (!is_array($side_ids)) {
            return null;
        }
        $side_text = "";
        for ($i = 0; $i < count($side_ids); $i++) {
            $side = Side::findOrFail($side_ids[$i]);
            $side_text .= $side->detail->name;
            if (count($side_ids) != ($i + 1)) {
                $side_text .= ", ";
            }
        }
        return $side_text;
    }

    public static function wageAgreementReplaceKeywords($request, $lawsuit)
    {
        $list = array(
            "@ArabuluculukBurosu" => $lawsuit->firm,
            "@BasvuruDosyaNo" => $lawsuit->firm_document_no,
            "@ARBDosyaNo" => $lawsuit->mediation_document_no,
            "@UyusmazlikKonu" => $lawsuit->subject,
            "@BugunTarih" => Carbon::now()->format('d.m.Y'),
        );

        $find = array_keys($list);
        $replace = array_values($list);

        $claimants = LawsuitService::getSidesByParams($request->lawsuit_id, \SideTypeOptions::CLAIMANT, null, [1, 2]);
        $defendants = LawsuitService::getSidesByParams($request->lawsuit_id, \SideTypeOptions::DEFENDANT, null, [1, 2]);
        $sides = LawsuitService::getSidesByParams($lawsuit->id, null, null, [1, 2]);

        $data = view('backend.document.wage_agreement.template', compact('sides', 'claimants', 'defendants', 'request'))->render();

        $string = str_ireplace($find, $replace, $data);

        return $string;
    }




    // public static function numberToOrdinalNumber($number)
    // {
    //     $number = (int) $number;
    //     $number++;

    //     $list = array(
    //         "10" => "onuncu",
    //         "11" => "onbirinci",
    //         "12" => "onikinci",
    //         "13" => "onüçüncü",
    //         "14" => "ondördüncü",
    //         "15" => "onbeşinci",
    //         "16" => "onaltıncı",
    //         "17" => "onyedinci",
    //         "18" => "onsekizinci",
    //         "19" => "ondokuzuncu",
    //         "20" => "yirminci",
    //         "30" => "otuzuncu",
    //         "31" => "otuzbirinci",
    //         "32" => "otuzikinci",
    //         "33" => "otuzüçüncü",
    //         "34" => "otuzdördüncü",
    //         "35" => "otuzbeşinci",
    //         "36" => "otuzaltıncı",
    //         "37" => "otuzyedinci",
    //         "38" => "otuzsekizinci",
    //         "39" => "otuzdokuzuncu",
    //         "40" => "kırkıncı",
    //         "1" => "ilk",
    //         "2" => "ikinci",
    //         "3" => "üçüncü",
    //         "4" => "dördüncü",
    //         "5" => "beşinci",
    //         "6" => "altıncı",
    //         "7" => "yedinci",
    //         "8" => "sekizinci",
    //         "9" => "dokuzuncu",
    //     );

    //     $find = array_keys($list);
    //     $replace = array_values($list);

    //     $string = str_ireplace($find, $replace, $number);

    //     return Ucwords($string);
    // }

    public static function getSidesByParams(Lawsuit $lawsuit, $side_type_id = null, $except_side_applicant_type_id = null, $only_side_applicant_type_id = null)
    {
        $query = Side::query();

        $query->orderBy('side_applicant_type_id', 'DESC');

        if (!is_null($lawsuit->id)) {
            $query->where('lawsuit_id', $lawsuit->id);
        }

        if (!is_null($side_type_id)) {
            $query->where('side_type_id', $side_type_id);
        }

        if (!is_null($except_side_applicant_type_id)) {
            $query->whereNotIn('side_applicant_type_id', $except_side_applicant_type_id);
        }

        if (!is_null($only_side_applicant_type_id)) {
            $query->whereIn('side_applicant_type_id', $only_side_applicant_type_id);
        }


        return $query->get();
    }

    public static function newSideSave($sides, $new_side_ids, $lawsuit)
    {
        $side_ids = array();
        if (!is_null($sides)) {
            foreach ($sides as $side) {
                if ($side["side_applicant_type_id"] == 3) {
                    $new_side = new Side();

                    $lawyer = Lawyer::where('identification', $side["tc"])->where('user_id', auth()->id())->first();

                    if (is_null($lawyer)) {
                        $lawyer = new Lawyer();
                    }

                    $lawyer->name = ucwords($side["name"]);
                    $lawyer->identification = $side["tc"];
                    $lawyer->address = ucwords($side["address"]);
                    $lawyer->phone = $side["phone"];
                    $lawyer->fixed_phone = $side["fixedPhone"] ?? "";
                    $lawyer->email = $side["email"] ?? "";
                    $lawyer->baro_id = $side["baro"];
                    $lawyer->registration_no = $side["regNo"];
                    $lawyer->user_id = auth()->id();
                    $lawyer->save();

                    $new_side->parent_id = $side["side_id"];
                    $new_side->lawyer_id = $lawyer->id;
                    $new_side->side_applicant_type_id = $side["side_applicant_type_id"];
                    $new_side->lawsuit_id = $lawsuit->id;
                    $new_side->side_type_id = $side["side_type_id"];
                    $new_side->save();

                    if (is_array($new_side_ids) && in_array($side["tc"], $new_side_ids)) {
                        $side_ids[] = $new_side->id;
                    }
                } else {
                    $new_side = new Side();

                    $person = Person::where('identification', $side["tc"])->where('user_id', auth()->id())->first();

                    if (is_null($person)) {
                        $person = new Person();
                    }

                    $person->name = ucwords($side["name"]);
                    $person->identification = $side["tc"];
                    $person->address = ucwords($side["address"]);
                    $person->phone = $side["phone"];
                    $person->fixed_phone = $side["fixedPhone"] ?? "";
                    $person->email = $side["email"] ?? "";
                    $person->user_id = auth()->id();
                    $person->save();

                    $new_side->parent_id = $side["side_id"];
                    $new_side->person_id = $person->id;
                    $new_side->side_applicant_type_id = $side["side_applicant_type_id"];
                    $new_side->lawsuit_id = $lawsuit->id;
                    $new_side->side_type_id = $side["side_type_id"];
                    $new_side->save();

                    if (is_array($new_side_ids) && in_array($side["tc"], $new_side_ids)) {
                        $side_ids[] = $new_side->id;
                    }
                }
            }
        }
        return $side_ids;
    }

    public static function udfCreateSide($side, $lawsuit, $parent_side_id)
    {
        if ($side["side_applicant_type_id"] == 3) {
            $new_side = new Side();

            $lawyer = Lawyer::where('identification', $side["tc"])->where('user_id', auth()->id())->first();

            if (is_null($lawyer)) {
                $lawyer = new Lawyer();
            }

            $lawyer->name = ucwords($side["name"]);
            $lawyer->identification = $side["tc"];
            $lawyer->address = ucwords($side["address"]);
            $lawyer->phone = $side["phone"];
            $lawyer->fixed_phone = $side["fixedPhone"] ?? "";
            $lawyer->email = $side["email"] ?? "";
            $lawyer->baro_id = $side["baro"];
            $lawyer->registration_no = $side["regNo"];
            $lawyer->user_id = auth()->id();
            $lawyer->save();

            $new_side->parent_id = $parent_side_id;
            $new_side->lawyer_id = $lawyer->id;
            $new_side->side_applicant_type_id = $side["side_applicant_type_id"];
            $new_side->lawsuit_id = $lawsuit->id;
            $new_side->side_type_id = $side["side_type_id"];
            $new_side->save();
        } elseif (in_array($side["side_applicant_type_id"], [4, 5, 6, 7])) {
            $new_side = new Side();

            $person = Person::where('identification', $side["tc"])->where('user_id', auth()->id())->first();

            if (is_null($person)) {
                $person = new Person();
            }

            $person->name = ucwords($side["name"]);
            $person->identification = $side["tc"];
            $person->address = ucwords($side["address"]);
            $person->phone = $side["phone"];
            $person->fixed_phone = $side["fixedPhone"] ?? "";
            $person->email = $side["email"] ?? "";
            $person->user_id = auth()->id();
            $person->save();

            $new_side->parent_id = $parent_side_id;
            $new_side->person_id = $person->id;
            $new_side->side_applicant_type_id = $side["side_applicant_type_id"];
            $new_side->lawsuit_id = $lawsuit->id;
            $new_side->side_type_id = $side["side_type_id"];
            $new_side->save();
        }
    }

    public static function addAdditional($time)
    {
        $time = explode(":", $time)[1];
        switch ($time) {
            case "00":
                $text = "‘da";
                break;
            case "10":
                $text = "‘da";
                break;
            case "20":
                $text = "‘de";
                break;
            case "30":
                $text = "‘da";
                break;
            case "40":
                $text = "‘ta";
                break;
            case "50":
                $text = "‘de";
                break;
            default:
                $text = "‘da";
                break;
        }

        return $text;
    }
}
