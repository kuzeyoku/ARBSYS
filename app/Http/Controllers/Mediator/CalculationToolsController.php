<?php

namespace App\Http\Controllers\Mediator;

use App\Http\Controllers\Controller;
use App\Models\CalculationTool;
use App\Rules\PaymentDateRule;
use App\Rules\PaymentRule;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalculationToolsController extends Controller
{
    function format($number)
    {
        return "&#8378;" . number_format((float)$number, 2, ',', '.');
        // Tl olarak gozuksun istenirse ustteki kod basina // getirilsin alttaki koddaki // kaldirilsin.
        // return number_format((float)$number, 2, ',', '.') . " TL";
    }

    public function hesaplama_araclari()
    {
        $tools = CalculationTool::whereStatus(true)->get();
        return view('mediator.calculation_tools.index', compact('tools'));
    }

    public function aaut_birinci_kisim(Request $request)
    {
        if ($request->getMethod() == "POST") {
            // tablo devamli gozuksun isteniyorsa alltaki $goster in yaninda yazan false, true olarak degistirilsin
            $goster = true;
            $minimessagegoster = false;

            if (isset($request->opt1) && isset($request->opt2) && isset($request->saat)) {

                if ($request->saat != '' && $request->opt1 != '0' && $request->opt2 != '0') {
                    $sure = intval($request->saat);
                    $saat = $request->saat;
                    $opt1 = $request->opt1;
                    $opt2 = $request->opt2;
                    $goster = true;
                    $minimessagegoster = true;
                    $indexArray = array(
                        'a' => array(
                            'i' => 800,
                            'ii' => 840,
                            'iii' => 900,
                            'iv' => 960
                        ),
                        'b' => array(
                            'i' => 1560,
                            'ii' => 1600,
                            'iii' => 1640,
                            'iv' => 1680
                        ),
                        'c' => array(
                            'i' => 800,
                            'ii' => 840,
                            'iii' => 900,
                            'iv' => 960
                        ),
                        'd' => array(
                            'i' => 800,
                            'ii' => 840,
                            'iii' => 900,
                            'iv' => 960
                        ),
                        'e' => array(
                            'i' => 960,
                            'ii' => 1000,
                            'iii' => 1040,
                            'iv' => 1080
                        )
                    );

                    $rakam = $indexArray[$opt1][$opt2] * $sure;

                    $aciklamaBaslik = array(
                        'a' => 'Aile Hukuku ile ilgili uyuşmazlıklarda',
                        'b' => 'Ticari uyuşmazlıklarda',
                        'c' => 'İşçi - işveren uyuşmazlıklarında',
                        'd' => 'Tüketici uyuşmazlıklarında',
                        'e' => 'Diğer tür uyuşmazlıklarda'
                    );

                    $aciklamaIcerik = array(
                        'i' => '2 taraflı işlerde',
                        'ii' => '3-5 taraflı işlerde, taraf sayısı gözetilmeksizin',
                        'iii' => '6-10 taraflı işlerde, taraf sayısı gözetilmeksizin',
                        'iv' => '11 ve daha fazla taraflı işlerde, taraf sayısı gözetilmeksizin'
                    );

                    $aciklama = $aciklamaBaslik[$opt1] . " " . $aciklamaIcerik[$opt2];

                    //if($opt2 === 'i'){
                    // $minimessage = 'Arabuluculuk Ücretinin Eşit Ödenecek Olması Halinde Taraf Başına Düşen Ücret Tutarı: '.format($rakam/2);
                    //}
                    $minimessage = "";
                    if ($opt2 === 'i') {
                        $minimessage = '<td>Arabuluculuk ücretinin eşit ödenecek olması halinde taraf başına düşen ücret tutarı: </td><td>' . $this->format($rakam / 2) . '</td>';
                    }
                }
            }

            return view('mediator.calculation_tools.aaut_birinci_kisim', compact('goster', 'saat', 'opt1', 'opt2', 'rakam', 'aciklama', 'minimessage', 'minimessagegoster'));
        } else {
            return view('mediator.calculation_tools.aaut_birinci_kisim');
        }
    }


    public function aaut_ikinci_kisim(Request $request)
    {
        $optSelectArray = [
            "a" => "Bir Arabulucu Görev Yaparsa",
            "b" => "Birden Fazla Arabulucu Görev Yaparsa"
        ];

        $typeOfDisputeSelectArray = [
            "c" => "İhtiyari Uyuşmazlıklar",
            "d" => "Dava Şartı Kapsamındaki Uyuşmazlıklar",
            "e" => "Diğer Uyuşmazlıklar"
        ];




        if ($request->getMethod() == "POST") {

            // tablo devamli gozuksun isteniyorsa alltaki $goster in yaninda yazan false, true olarak degistirilsin
            $goster = true;
            $minimessagegoster = false;

            $request->validate([
                "ucret" => "required",
                "opt" => "required",
                "uyusmazlikturu" => "required",
                "tarafli" => "required",
            ]);

            if ($request->uyusmazlikturu === 'c' && $request->altsecenekler == '') {
            } else {
                $uyusmazlikturu = $request->uyusmazlikturu;
                $altsecenekler1 = $request->altsecenekler1;
                $temp_ut = $uyusmazlikturu;
                $tarafli = $request->tarafli;
                if ($uyusmazlikturu === "d") {
                    $uyusmazlikturu = $request->altsecenekler1;
                }

                $goster = true;
                $minimessagegoster = true;
                $minimessage = '';
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

                $message = array(
                    'a' => "Bir arabulucu görev yaparsa, &#8378;" . $ucret . " için arabuluculuk Ücreti Hesabı",
                    'b' => "Birden fazla arabulucu görev yaparsa, &#8378;" . $ucret . " için arabuluculuk Ücreti Hesabı"
                );

                $kackisi = array(
                    'a' => "Bir arabulucu görev yaptığı,",
                    'b' => "Birden fazla arabulucu görev yaptığı,"
                );

                $uyusmazlikmesaji = array(
                    'a' => "İşçi - İşveren Uyuşmazlığında, ",
                    'b' => "Ticari Uyuşmazlıkta, ",
                    'c' => "İhtiyari Uyuşmazlıkta, ",
                    'd' => "Tüketici Hukuku Uyuşmazlığında, ",
                    'e' => "Diğer Tür Uyuşmazlıkta, ",
                    'f' => "Kira - Komşuluk - KMK Uyuşmazlığında, ",
                    'g' => "Ortaklığın Giderilmesi Uyuşmazlığında, ",
                );

                $altuyusmazlik = array(
                    '' => "",
                    '1' => "Aile Hukuku Uyuşmazlığında,",
                    '2' => "Ticari Uyuşmazlığında,",
                    '3' => "İş Hukuku Uyuşmazlığında,",
                    '4' => "Tüketici Uyuşmazlığında,",
                    '5' => "Diğer Tür Uyuşmazlığında,",
                    '6' => "Kira - Komşuluk - KMK Uyuşmazlığında,",
                    '7' => "Ortaklığın Giderilmesi Uyuşmazlığında,",
                );

                $taraflilik = array(
                    '0' => "2 taraflı işlerde",
                    '1' => "3-5 taraflı işlerde, taraf sayısı gözetilmeksizin",
                    '2' => "6-10 taraflı işlerde, taraf sayısı gözetilmeksizin",
                    '3' => "11 ve daha fazla taraflı işlerde, taraf sayısı gözetilmeksizin"
                );


                $altsecenekler = $request->altsecenekler;
                if ($uyusmazlikturu != 'c') {
                    $altsecenekler = '';
                };

                $messageNeo = '"' . "&#8378;" . $ucret . " Anlaşma Tutarlı, " . $kackisi[$opt] . ' ' . $uyusmazlikmesaji[$uyusmazlikturu] . $altuyusmazlik[$altsecenekler] . ' ' . $taraflilik[$tarafli] . '" arabuluculuk ücreti hesabı:';

                $uyusmazlikasgarileri = array(
                    'a' => array(1600, 1680, 1800, 1920),
                    'b' => array(3120, 3200, 3280, 3360),
                    'c1' => array(800, 840, 900, 960),
                    'c2' => array(1560, 1600, 1640, 1680),
                    'c3' => array(800, 840, 900, 960),
                    'c4' => array(800, 840, 900, 960),
                    'c5' => array(960, 1000, 1040, 1080),
                );

                $uyusmazlikasgarisi = $uyusmazlikasgarileri[$uyusmazlikturu . $altsecenekler][$tarafli];
                $dilim = [100000, 160000, 260000, 520000, 1560000, 2080000, 4160000, 8840000];
                $dilimaciklama = [
                    "İlk &#8378;100.000 için",
                    "Sonra Gelen &#8378;160.000 için",
                    "Sonra Gelen &#8378;260.000 için",
                    "Sonra Gelen &#8378;520.000 için",
                    "Sonra Gelen &#8378;1.560.000 için",
                    "Sonra Gelen &#8378;2.080.000 için",
                    "Sonra Gelen &#8378;4.160.000 için",
                    "&#8378;8.840.000'den Yukarısı için"
                ];
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
                $kacdilim = count($arabuluculukucreti) - 1;
                $toplamucret = array_sum($arabuluculukucreti);
                /*Calculate*/
                if ((array_sum($arabuluculukucreti) < $uyusmazlikasgarisi)) {
                    $toplamucret = $uyusmazlikasgarisi;
                }

                //if($tarafli == '0'){
                // $minimessage = 'Arabuluculuk Ücretinin Eşit Ödenecek Olması Halinde Taraf Başına Düşen Ücret Tutarı: '.format($toplamucret/2);
                //}
                if ($tarafli == '0') {
                    $minimessage = '<td colspan="3"><div class="el-content">Arabuluculuk Ücretinin Eşit Ödenecek Olması Halinde Taraf Başına Düşen Ücret Tutarı: </td><td class="sagahizala"><div class="el-content">' . $this->format($toplamucret / 2) . '</div></td>';
                }

                $uyusmazlikturu = $temp_ut;
            }

            return view('mediator.calculation_tools.aaut_ikinci_kisim', compact("optSelectArray", "typeOfDisputeSelectArray", 'ucret', 'opt', 'uyusmazlikturu', 'altsecenekler', 'altsecenekler1', 'uyusmazlikasgarisi', 'tarafli', 'goster', 'messageNeo', 'kacdilim', 'dilimaciklama', 'dilimoran', 'dusenmiktar', 'arabuluculukucreti', 'toplamucret', 'minimessage', 'minimessagegoster'));
        } else {
            return view('mediator.calculation_tools.aaut_ikinci_kisim', compact('optSelectArray', "typeOfDisputeSelectArray"));
        }
    }

    public function iscilik_alacaklari_ise_iade()
    {
        return view('mediator.calculation_tools.iscilik_alacaklari_sayfasi');
    }

    public function iscilik_alacaklari_ise_iade_hesaplama(Request $request)
    {
        $request->validate([
            'tarih' => 'required',
            'sure_tutar' => 'required',
            'tazminat_tutar' => 'required',
        ]);

        $sure_tutar = $request->sure_tutar;
        $tazminat_tutar = $request->tazminat_tutar;

        return view('mediator.calculation_tools.iscilik_alacaklari_sayfasi', compact('sure_tutar', 'tazminat_tutar'));
    }

    public function serbest_meslek_makbuzu_hesaplama(Request $request)
    {

        $selectMethodArray = [
            "a" => "KDV Ve Stopaj Dahil",
            "b" => "KDV Dahil Stopaj Hariç",
            "c" => "KDV Ve Stopaj Hariç",
            "d" => "KDV Hariç Stopaj Dahil"
        ];

        if (request()->getMethod() == "POST") {
            $kdv = $request->kdv == null || $request->kdv == 0 ? 20 : $request->kdv;
            $stopaj = $request->stopaj == null || $request->stopaj == 0 ? 20 : $request->stopaj;
            $kdv = $kdv / 100;
            $stopaj = $stopaj / 100;

            if (!isset($request->fee) || !isset($request->opt)) {
                return redirect()->back()->withError('Lütfen Tüm Alanları Doldurunuz');
            }

            // tablo devamli gozuksun isteniyorsa alltaki $goster in yaninda yazan false, true olarak degistirilsin
            $goster = true;
            function format($number)
            {
                return "&#8378;" . number_format((float)$number, 2, ',', '.');
                // Tl olarak gozuksun istenirse ustteki kod basina // getirilsin alttaki koddaki // kaldirilsin.
                // return number_format((float)$number, 2, ',', '.') . " TL";
            }

            if (isset($request->fee) && isset($request->opt)) {

                if ($request->fee != '' && $request->opt != '0') {
                    $kdv = $request->kdv == null || $request->kdv == 0 ? 0.2 : $request->kdv / 100;
                    $stopaj = $request->stopaj == null || $request->stopaj == 0 ? 0.2 : $request->stopaj / 100;
                    $goster = true;
                    $opt = $request->opt;
                    $fee = str_replace("₺", "", $request->fee);
                    $fee = str_replace(",", "", $fee);
                    $kdvli = intval($fee);
                    $brut = ($kdvli / 120) * 100;
                    $a1 = $a2 = $a3 = $a4 = $a5 = $a6 = $b1 = $b2 = $b3 = $b4 = $b5 = $b6 = '';

                    $message = "&#8378;" . $fee . " için " . $selectMethodArray[$opt] . ' Serbest Meslek Makbuzu Hesabı';

                    switch ($opt) {
                        case 'a':
                            $a1 = $brut;
                            $a2 = $brut * $kdv;
                            $a3 = $a1 - $a2;
                            $a4 = $brut * $stopaj;
                            $a5 = $a3 + $a4;
                            $b1 = $brut;
                            $b3 = $brut;
                            $b4 = $brut * $stopaj;
                            $b5 = $kdvli;
                            break;
                        case 'b':

                            $a1 = $kdvli / 0.98;
                            $a2 = $a1 * $stopaj;
                            $a3 = $a1 + $a2;
                            $a4 = $a1 * $kdv;
                            $a5 = $a3 - $a4;

                            $b1 = $brut;
                            $b2 = $brut * $stopaj;
                            $b3 = $brut;
                            $b5 = $kdvli;
                            break;
                        case 'c':

                            $a1 = $kdvli * 1.25;
                            $a2 = $a1 * $kdv;
                            $a3 = $kdvli;
                            $a4 = $a1 * $stopaj;
                            $a5 = $a3 + $a4;
                            $b1 = $kdvli;
                            $b3 = $kdvli;
                            $b4 = $kdvli * $stopaj;
                            $b5 = $b3 + $b4;

                            break;
                        case 'd':

                            $a1 = $kdvli;
                            $a2 = $kdvli * $kdv;
                            $a3 = $a1 - $a2;
                            $a4 = $kdvli * $stopaj;
                            $a5 = $a3 + $a4;
                            $b1 = $kdvli;
                            $b3 = $kdvli;
                            $b4 = $kdvli * $stopaj;
                            $b5 = $b3 + $b4;
                            break;
                        default:
                            break;
                    }
                }

                return view('mediator.calculation_tools.serbest_meslek_makbuzu', compact('selectMethodArray', "kdv", "stopaj", 'fee', 'opt', 'goster', 'message', 'a1', 'b1', 'a4', 'b4', 'a5', 'a2', 'b3', 'a2', 'b2', 'b5', 'a3'));
            }
        } else {
            return view('mediator.calculation_tools.serbest_meslek_makbuzu', compact('selectMethodArray'));
        }
    }

    // SELECT * FROM `payment_calculate` inner JOIN invoices on payment_calculate.invoice_id = invoices.invoice_id;

    public function iscilik_alacaklari_odeme_tablosu()
    {
        $paymentCalculate = DB::table('payment_calculate')
            ->join('invoices', 'payment_calculate.invoice_id', '=', 'invoices.invoice_id')
            ->get();
        return view('mediator.calculation_tools.iscilik_alacaklari_odeme_tablosu', compact('paymentCalculate'));
    }

    public function iscilik_alacaklari_odeme_tablosu_hesaplama(Request $request)
    {
        $request->validate([
            'tutar' => ['required', new PaymentRule($request->input('tutar'))],
            'tarih' => ['required', new PaymentDateRule($request->input('tarih'))],
        ]);

        $getDataId = DB::table('invoices')->insertGetId([
            'invoice_user_name' => $request->input('odeyecek_kisi'),
            'payment_type' => $request->input('odeme_turu'),
            'person_from_pay' => $request->input('odeyecek_kisi'),
            'person_to_pay' => $request->input('odemeyi_alacak_kisi'),
        ]);

        for ($i = 0; $i < count($request->input('tarih')); $i++) {
            DB::table('payment_calculate')->insert([
                'amount' => $request->input('tutar')[$i],
                'amount_date' => $request->input('tarih')[$i],
                'amount_type' => $request->input('para_birimi')[$i],
                'invoice_id' => $getDataId,
            ]);
        }

        return redirect()->back()->with('message', 'Fatura Ekleme işlemi Tamamlandı');
    }

    public function dava_sarti_uygulamalarinda_sure_get()
    {
        return view('mediator.calculation_tools.dava_sarti_uygulamalarinda_sure');
    }

    public function dava_sarti_uygulamalarinda_sure_post(Request $request)
    {
        // tablo devamli gozuksun isteniyorsa alltaki $goster in yaninda yazan false, true olarak degistirilsin
        $goster = true;

        if (isset($request->tarih)) {

            if ($request->tarih != '') {
                $input = $request->tarih;
                $start_date = DateTime::createFromFormat('d.m.Y', $input);
                $three_week = DateInterval::createFromDateString('3 week');
                $one_week = DateInterval::createFromDateString('1 week');
                $two_week = DateInterval::createFromDateString('2 week');
                $start_date->add($three_week);
                $first = $start_date->format('d.m.Y');
                $start_date->add($one_week);
                $second = $start_date->format('d.m.Y');
                $start_date->add($two_week);
                $third = $start_date->format('d.m.Y');
                $start_date->add($two_week);
                $fourth = $start_date->format('d.m.Y');

                $goster = true;
            }
        }

        return view('mediator.calculation_tools.dava_sarti_uygulamalarinda_sure', compact('goster', 'first', 'second', 'third', 'fourth'));
    }

    public function iscilik_alacaklari_alacak_kalemleri_tablosu()
    {
        $payChart = DB::table('pay_chart')->get();
        return view('mediator.calculation_tools.iscilik_alacaklari_alacak_kalemleri_tablosu', compact('payChart'));
    }

    public function iscilik_alacaklari_alacak_kalemleri_tablosu_hesaplama(Request $request)
    {
        for ($i = 0; $i < count($request->input('tarih')); $i++) {
            DB::table('pay_chart')->insert([
                'net_burut' => $request->input('net_burut')[$i],
                'date' => $request->input('tarih')[$i],
                'tutar' => $request->input('tutar')[$i],
                'para_birimi' => $request->input('para_birimi')[$i],
            ]);
        }

        return redirect()->back()->with('message', 'Fatura Ekleme işlemi Tamamlandı');
    }
}
