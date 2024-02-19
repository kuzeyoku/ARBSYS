<?php

namespace App\Http\Controllers\Mediator;

use App\Http\Controllers\Controller;
use App\Models\Lawsuit\Lawsuit;
use App\Services\LawsuitService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WageAgreementController extends Controller
{
    public function create(Lawsuit $lawsuit)
    {
        return view('mediator.document.wage_agreement.create', compact('lawsuit'));
    }

    public function store(Request $request, Lawsuit $lawsuit)
    {
        DB::table('logs')->insert(
            [
                'userId' => Auth()->user()->id,
                "fileId" => (int) $request->lawsuit_id,
                "eventName" => "Ücret sözleşmesi oluşturuldu.",
            ],
        );
        $lawsuit = Lawsuit::findOrFail($request->lawsuit_id);

        $preview = $request->preview;

        if (is_null($request->preview)) {
            $preview = LawsuitService::finalProtocolReplaceKeywords($request, $lawsuit);
        }

        $claimants = LawsuitService::getSidesByParams($request->lawsuit_id, \SideTypeOptions::CLAIMANT, null, [1, 2]);
        $defendants = LawsuitService::getSidesByParams($request->lawsuit_id, \SideTypeOptions::DEFENDANT, null, [1, 2]);

        $data = view(
            'backend.document.wage_agreement.print',
            [
                'document_content' => $preview,
                'claimants' => $claimants,
                'defendants' => $defendants,

            ]
        )->render();

        return response()->json(['preview' => $data]);
    }


    public function preview(Request $request)
    {
        $lawsuit = Lawsuit::findOrFail($request->lawsuit_id);

        $preview = LawsuitService::wageAgreementReplaceKeywords($request, $lawsuit);

        return response()->json(['preview' => $preview, 'lawsuit_subject_id' => $lawsuit->lawsuit_subject_id]);
    }

    public function aautFirst(Request $request)
    {
        $total = 0;

        if (!is_null($request->opt1) && !is_null($request->opt2) && !is_null($request->saat)) {
            $saat = intval($request->saat);
            $opt1 = $request->opt1;
            $opt2 = $request->opt2;

            $indexArray = array(
                'a' => array(
                    'i' => 400,
                    'ii' => 420,
                    'iii' => 450,
                    'iv' => 480
                ),
                'b' => array(
                    'i' => 780,
                    'ii' => 800,
                    'iii' => 820,
                    'iv' => 840
                ),
                'c' => array(
                    'i' => 400,
                    'ii' => 420,
                    'iii' => 450,
                    'iv' => 480
                ),
                'd' => array(
                    'i' => 400,
                    'ii' => 420,
                    'iii' => 450,
                    'iv' => 480
                ),
                'e' => array(
                    'i' => 480,
                    'ii' => 500,
                    'iii' => 520,
                    'iv' => 540
                )
            );

            $total = $indexArray[$opt1][$opt2] * $saat;
        }

        return response()->json([
            'total' => $this->format($total, true),
            'totalHalf' => $this->format($total / 2, true)
        ]);
    }

    public function aautSecond(Request $request)
    {
        $toplamucret = 0;

        if (!is_null($request->ucret) && !is_null($request->opt) && !is_null($request->uyusmazlikturu) && !is_null($request->tarafli)) {
            if ($request->uyusmazlikturu === 'c' && $request->altsecenekler == '') {
            } else {
                $uyusmazlikturu = $request->uyusmazlikturu;
                $tarafli = $request->tarafli;
                if ($uyusmazlikturu === "d") {
                    $uyusmazlikturu = $request->altsecenekler1;
                }

                /*Calculate()*/
                $opt = $request->opt;
                $ucret = str_replace(" ₺", "", $request->ucret);
                $kdvli = str_replace(".", "", $ucret);
                $kdvli = str_replace(",", ".", $kdvli);
                $kalanucret = $kdvli;

                $dilimoran = array(
                    'a' => array(6, 5, 4, 3, 2, 1.5, 1, 0.50),
                    'b' => array(9, 7.5, 6, 4.5, 3, 2.5, 1.5, 1)
                );

                $altsecenekler = $uyusmazlikturu != 'c' ? '' : $request->altsecenekler;

                $uyusmazlikasgarileri = array(
                    'a' => array(800, 840, 900, 960),
                    'b' => array(1560, 1600, 1640, 1680),
                    'c1' => array(400, 420, 450, 480),
                    'c2' => array(780, 800, 820, 840),
                    'c3' => array(400, 420, 450, 480),
                    'c4' => array(400, 420, 450, 480),
                    'c5' => array(480, 500, 520, 540),
                );

                $uyusmazlikasgarisi = $uyusmazlikasgarileri[$uyusmazlikturu . $altsecenekler][$tarafli];
                $dilim = [50000, 80000, 130000, 260000, 780000, 1040000, 2080000, 4420000];
                //
                for ($i = 0; $i < count($dilim); $i++) {
                    if ($i === 7) {
                        $dusenmiktar[$i] = $kalanucret;
                        $arabuluculukucreti[$i] = $kalanucret * $dilimoran[$opt][$i] / 100;
                    } else if ($kalanucret > $dilim[$i]) {
                        $dusenmiktar[$i] = $dilim[$i];
                        $kalanucret = intval($kalanucret - $dilim[$i]);
                        $arabuluculukucreti[$i] = $dusenmiktar[$i] * $dilimoran[$opt][$i] / 100;
                    } else {
                        $dusenmiktar[$i] = $kalanucret;
                        $arabuluculukucreti[$i] = $dusenmiktar[$i] * $dilimoran[$opt][$i] / 100;
                        break;
                    }
                }
                $toplamucret = array_sum($arabuluculukucreti);
                /*Calculate*/
                if ((array_sum($arabuluculukucreti) < $uyusmazlikasgarisi)) {
                    $toplamucret = $uyusmazlikasgarisi;
                }
            }
        }

        return response()->json([
            'total' => $this->format($toplamucret, true)
        ]);
    }

    function format($number, $mask = false)
    {
        return $mask ? number_format((float)$number, 2, ',', '.') . " ₺" : $number;
    }
}
