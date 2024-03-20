<?php

namespace App\Http\Controllers\Mediator;

use App\Models\Lawsuit\Lawsuit;
use App\Models\Document\Document;
use App\Http\Controllers\Controller;
use App\Models\Document\DocumentType;
use App\Models\Lawsuit\LawsuitProcessType;

class HomeController extends Controller
{
    public function index()
    {


        // $text = "T.C.
        // İzmir Arabuluculuk Bürosu
        // ARABULUCULUK BAŞVURU FORMU
        // BAŞVURU NUMARASI	: 2023/2645 
        // BAŞVURU TARİHİ	: 20/10/2023 17:30(Avukat Portal Başvurusu)
        // BAŞVURU SAHİBİ BİLGİLERİ
        // TC Kimlik No	: 21050237000 
        // Adı Soyadı		: ALİ RAMAZAN MAVİŞ (TEL: 000)
        // Adres		: MUSTAFA KEMAL MAH. 686/53 SK. NO:1 İÇ KAPI NO:6   BUCA/İZMİR  Cep Tel : 05535817929
        // Vekili		:Av. SİBEL BARDAKÇI (TEL: 05553163446
        // BAŞVURU SAHİBİ BİLGİLERİ
        // TC Kimlik No	: 18500320122 
        // Adı Soyadı		: DEVLET KAPLANKIRAN (TEL: 000)
        // Adres		: CAMİKEBİR MAH. ŞEHİT GENERAL TEMEL CİNGÖZ CAD. NO:20-26 İÇ KAPI NO:2   SEFERİHİSAR/İZMİR  Cep Tel : 05395516687
        // Vekili		:Av. SİBEL BARDAKÇI (TEL: 000)
        // BAŞVURU SAHİBİ BİLGİLERİ
        // TC Kimlik No	: 21068236446 
        // Adı Soyadı		: ERDİNÇ MAVİŞ (TEL: 000)
        // Adres		: ATİLLA MAH. 513 SK. NO:26 İÇ KAPI NO:9   KONAK/İZMİR  Cep Tel : 05462354244
        // Vekili		:Av. SİBEL BARDAKÇI (TEL: 000)
        // BAŞVURU SAHİBİ BİLGİLERİ
        // TC Kimlik No	: 21062236664 
        // Adı Soyadı		: HÜSEYİN MAVİŞ (TEL: 000)
        // Adres		: BAHAR MAH. 2904 SK. NO:30 İÇ KAPI NO:8   KARABAĞLAR /İZMİR  Cep Tel : 05356255690
        // Vekili		:Av. SİBEL BARDAKÇI (TEL: 000)
        // BAŞVURU SAHİBİ BİLGİLERİ
        // TC Kimlik No	: 21059236738 
        // Adı Soyadı		: MEHMET ÇAĞLAYAN MAVİŞ (TEL: 000)
        // Adres		: BAHAR MAH. 2904 SK. NO:30 İÇ KAPI NO:7   KARABAĞLAR /İZMİR  Cep Tel : 05373886742
        // Vekili		:Av. SİBEL BARDAKÇI (TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 63544074272
        // Adı Soyadı		: ABDULMENAV KAÇAN (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1658 SK. NO:36 İÇ KAPI NO:2   BORNOVA/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // Adı Soyadı		: ABİDİN ZAFER DİŞÇİOĞLU (TEL: 000)
        // Adres		: TC YOK
        // KARŞI TARAF BİLGİLERİ	Adı Soyadı		: AHMET DÜZOVALI (TEL: 000)
        // Adres		: (ÖLÜ)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 10889193908
        // Adı Soyadı		: AHMET TAŞTAN (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1655 SK. NO:52 İÇ KAPI NO:4   BORNOVA/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 22135430606
        // Adı Soyadı		: AHMET NURETTİN ÖÇAL (TEL: 000)
        // Adres		:   ÖLÜ
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 12157699358
        // Adı Soyadı		: AHMET ÜMİT KAYLAN (TEL: 000)
        // Adres		: GAYRETTEPE MAH. FAHRİ GİZDEN SK. NO:9 İÇ KAPI NO:19   BEŞİKTAŞ/İSTANBUL
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 10361592052
        // Adı Soyadı		: AKIN ÇIĞIRGİL (TEL: 000)
        // Adres		: MURAT REİS MAH. 256 SK. NO:21 İÇ KAPI NO:5   KONAK/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 10367591844
        // Adı Soyadı		: ALİ ÇIĞIRGİL (TEL: 000)
        // Adres		: GÜNGÖR MAH. 376 SK. NO:15 İÇ KAPI NO:6   KONAK/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 
        // Adı Soyadı		: ALİ TANFER DİŞÇİOĞLU (TEL: 000)
        // Adres		: 
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 10343592636
        // Adı Soyadı		: ALTAN ÇIĞIRGİL (TEL: 000)
        // Adres		: ŞİRİNKENT MAH. 3318 SK. NO:19   URLA/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 25642094002
        // Adı Soyadı		: ANTİKA YILDIZHAN (TEL: 000)
        // Adres		: 164 SK. FATİH MAH. NO:13 İÇ KAPI NO:2   AĞRI MERKEZ/AĞRI
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 10349592418
        // Adı Soyadı		: AYSAN ÇIĞIRGİL TENDALL (TEL: 000)
        // Adres		: ROCKFORD /AMERİKA BİRLEŞİK DEVLETLERİ  
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 
        // Adı Soyadı		: AYSEL KOYUNCUOĞLU (TEL: 000)
        // Adres		: TC YOK 
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 14437326886
        // Adı Soyadı		: AYŞE ADIYAMAN (TEL: 000)
        // Adres		: YELALTI MAH. BALERİN SK. NO:42 İÇ KAPI NO:1   URLA/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 12151699576
        // Adı Soyadı		: AYŞE BELGİN KAYLAN (TEL: 000)
        // Adres		: GAYRETTEPE MAH. FAHRİ GİZDEN SK. NO:9 İÇ KAPI NO:19   BEŞİKTAŞ/İSTANBUL
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 11147565550
        // Adı Soyadı		: AZİZ DÜZOVALI (TEL: 000)
        // Adres		: (ÖLÜ)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 32992837586
        // Adı Soyadı		: AZİZ FEHMİ GENİŞ (TEL: 000)
        // Adres		:  (ÖLÜ)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 24047354728
        // Adı Soyadı		: BİLAL ALTINBAŞ (TEL: 000)
        // Adres		: YEŞİL MAH. SATILMIŞ CAD. NO:157   SELENDİ/MANİSA
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 60550174064
        // Adı Soyadı		: BURHAN İNCU (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1523 SK. NO:3 İÇ KAPI NO:6   BORNOVA/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 11704550890
        // Adı Soyadı		: CEMAL DEMİROK (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1658 SK. NO:26 İÇ KAPI NO:2   BORNOVA/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 58879229718
        // Adı Soyadı		: CEVHER BULCAR (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1655 SK. NO:44 İÇ KAPI NO:1   BORNOVA/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 28003657090
        // Adı Soyadı		: CİHAN KANMAZ (TEL: 000)
        // Adres		: YILDIZ MAH. 206/66 SK. NO:44 İÇ KAPI NO:4   BUCA/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 24757300244
        // Adı Soyadı		: ÇETİN GÜRSOY (TEL: 000)
        // Adres		: FEVZİPAŞA-VEHBİBEY MAH. BARBAROS CAD.3. SK. NO:30 İÇ KAPI NO:2   AYVALIK/BALIKESİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 58477243178
        // Adı Soyadı		: EMRAH MANTAŞ (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1658 SK. NO:30 İÇ KAPI NO:2   BORNOVA/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 62452110652
        // Adı Soyadı		: ERKAN KATI (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1660 SK. NO:35 İÇ KAPI NO:2   BORNOVA/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 23800100442
        // Adı Soyadı		: FADİME ÇAKAR (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1565 SK. NO:26/1   BORNOVA/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 34780412616
        // Adı Soyadı		: FAHRETTİN ÖZEL (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1521 SK. NO:67 İÇ KAPI NO:5   BORNOVA/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 60886162872
        // Adı Soyadı		: FARİS İNÇAMUR (TEL: 000)
        // Adres		: EMİNPAŞA MAH. GÖL SK. NO:41 İÇ KAPI NO:6   EDREMİT/VAN/VAN
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 47068368956
        // Adı Soyadı		: FATMA ANTEKİN (TEL: 000)
        // Adres		:    ÖLÜ 
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 35527382612
        // Adı Soyadı		: FATMA ÇALIŞKAN (TEL: 000)
        // Adres		: AKINCILAR MAH. 530 SK. NO:19 İÇ KAPI NO:3   BUCA/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 31057902276
        // Adı Soyadı		: FATMA ÇOLPAN (TEL: 000)
        // Adres		:    ÖLÜ
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 10364591908
        // Adı Soyadı		: FATMA BİNGÜL ÇIĞIRGİL (TEL: 000)
        // Adres		: 150 EVLER MAH. ŞEHİT ÜST.KONURALP ÖZCAN CAD.5. SK. NO:4 İÇ KAPI NO:7   AYVALIK/BALIKESİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 61123154902
        // Adı Soyadı		: FAYSAL İLDENİZ (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1655 SK. NO:39 İÇ KAPI NO:3   BORNOVA/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 
        // Adı Soyadı		: FETHİYE CANBAZ (TEL: 000)
        // Adres		: 
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 31627906352
        // Adı Soyadı		: FİKRİ DENİZ (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1653 SK. NO:2 İÇ KAPI NO:1   BORNOVA/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 56179064794
        // Adı Soyadı		: GÜLŞEN SANLI (TEL: 000)
        // Adres		:    (ÖLÜ)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 18745520394
        // Adı Soyadı		: GÜLÜMSER VARAN (TEL: 000)
        // Adres		: SARIKIZ MAH. SAKARYA CAD. NO:6 İÇ KAPI NO:2   EDREMİT/BALIKESİR/BALIKESİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 47059369238
        // Adı Soyadı		: HALİDE ANTEKİN (TEL: 000)
        // Adres		:    
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 11135565906
        // Adı Soyadı		: HALİL DÜZOVALI (TEL: 000)
        // Adres		: DOĞANAY MAH. YILDIZ CAD. NO:60 İÇ KAPI NO:5   KARABAĞLAR /İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 
        // Adı Soyadı		: HAMİDE ÜNAL (TEL: 000)
        // Adres		: TC YOK
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 40642356684
        // Adı Soyadı		: HASAN ATAY (TEL: 000)
        // Adres		: KUZEYTEPE MAH. 84. SK. NO:8   ANTAKYA/HATAY
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 10241620196
        // Adı Soyadı		: HASAN DİNLER (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1660 SK. NO:46 İÇ KAPI NO:1   BORNOVA/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 37303693318
        // Adı Soyadı		: HASAN NAHİT BAŞARANER (TEL: 000)
        // Adres		:    ÖLÜ
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 21733847724
        // Adı Soyadı		: HAYRETTİN ÖZKAN (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1650 SK. NO:51 İÇ KAPI NO:1   BORNOVA/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 62482109664
        // Adı Soyadı		: HAZİRAN KATI (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1660 SK. NO:35 İÇ KAPI NO:3   BORNOVA/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 32986837714
        // Adı Soyadı		: HÜSEYİN GENİŞ (TEL: 000)
        // Adres		:    ÖLÜ
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 12146242046
        // Adı Soyadı		: HÜSEYİN SARIKAYA (TEL: 000)
        // Adres		: BERLİN /ALMANYA FEDERAL CUMHURİYETİ  
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 37306693254
        // Adı Soyadı		: HÜSEYİN CAHİT BAŞARANER (TEL: 000)
        // Adres		: HUZUR MAH. ÖĞRETMENLER SK. NO:7/12   NARLIDERE/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 
        // Adı Soyadı		: HÜSEYİN FEHMAN KAYNAR (TEL: 000)
        // Adres		: TC YOK 
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 10370591770
        // Adı Soyadı		: HÜSEYİN HULKİ ÇIĞIRGİL (TEL: 000)
        // Adres		: KOCATEPE MAH. 556 SK. NO:10 İÇ KAPI NO:10   KONAK/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 11141565778
        // Adı Soyadı		: HÜSNÜ DÜZOVALI (TEL: 000)
        // Adres		: UĞUR MUMCU MAH. 5787 SK. NO:43A   KARABAĞLAR /İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 10382591324
        // Adı Soyadı		: İLHAN ÇIĞIRGİL (TEL: 000)
        // Adres		:    ÖLÜ
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 47062369164
        // Adı Soyadı		: KAMURAN ANTEKİN (TEL: 000)
        // Adres		:    ÖLÜ
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 24307315230
        // Adı Soyadı		: KEMALE ANTEKİ (TEL: 000)
        // Adres		:    ÖLÜ 
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 62446110880
        // Adı Soyadı		: LEYLA KATI (TEL: 000)
        // Adres		: ŞABANİYE MAH. HASANBEY CAD. NO:102 İÇ KAPI NO:2   EDREMİT/VAN/VAN
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 35800743550
        // Adı Soyadı		: MAŞUK ÖÇAL (TEL: 000)
        // Adres		:    ÖLÜ 
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 10241595760
        // Adı Soyadı		: MEHMET DÜZOVALI (TEL: 000)
        // Adres		: KOCATEPE MAH. 568 SK. NO:62-2 İÇ KAPI NO:1   KONAK/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 22528142826
        // Adı Soyadı		: MEHMET ÖZ (TEL: 000)
        // Adres		: BÖREKÇİLER MAH. SULTANBAĞI CAD. NO:101 İÇ KAPI NO:1   KÜTAHYA MERKEZ/KÜTAHYA
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 19477922944
        // Adı Soyadı		: MEHMET TEKİN (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1650 SK. NO:57 İÇ KAPI NO:2   BORNOVA/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 29606506846
        // Adı Soyadı		: MEHMET EMİN EKİNCİ (TEL: 000)
        // Adres		: MEVLANA MAH. 1710 SK. NO:23 İÇ KAPI NO:2   BORNOVA/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 
        // Adı Soyadı		: MEHMET NECMETTİN ANTEKİN (TEL: 000)
        // Adres		: TC YOK
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 61726153258
        // Adı Soyadı		: MEHMET SAİT GÖRGÜN (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1655 SK. NO:43 İÇ KAPI NO:1   BORNOVA/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 44509088312
        // Adı Soyadı		: MEMET ALİ ÖZEL (TEL: 000)
        // Adres		: ABDURRAHMAN GAZİ MAH. 2.GÜNEY SK. NO:3 İÇ KAPI NO:2   PALANDÖKEN /ERZURUM
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 12154699412
        // Adı Soyadı		: MİHRİYE ENGİN KAYLAN (TEL: 000)
        // Adres		: GAYRETTEPE MAH. FAHRİ GİZDEN SK. NO:9 İÇ KAPI NO:19   BEŞİKTAŞ/İSTANBUL
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 61972126600
        // Adı Soyadı		: MUHİTTİN KAYMAZ (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1660 SK. NO:54 İÇ KAPI NO:2   BORNOVA/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 10352592344
        // Adı Soyadı		: MURAT ÇIĞIRGİL (TEL: 000)
        // Adres		: ROCKFORD /AMERİKA BİRLEŞİK DEVLETLERİ  
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 47056369392
        // Adı Soyadı		: MUSTAFA ANTEKİN (TEL: 000)
        // Adres		:     ÖLÜ 
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 11153565322
        // Adı Soyadı		: MUSTAFA DÜZOVALI (TEL: 000)
        // Adres		: UĞUR MUMCU MAH. 5785 SK. NO:4 İÇ KAPI NO:2   KARABAĞLAR /İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 
        // Adı Soyadı		: MUSTAFA KENAN (TEL: 000)
        // Adres		: TAPU DA KAYDI YOK
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 10388591106
        // Adı Soyadı		: MUSTAFA KENAN ÇIĞIRGİL (TEL: 000)
        // Adres		:    ÖLÜ 
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 19840736772
        // Adı Soyadı		: MÜJGAN NEVİN GÜRSOY ŞENAY (TEL: 000)
        // Adres		: BAHRİYE ÜÇOK MAH. RÜŞTÜ ŞARDAĞ CAD. NO:68 İÇ KAPI NO:15   KARŞIYAKA/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 18872309794
        // Adı Soyadı		: MÜŞERREF GALİP (TEL: 000)
        // Adres		: ORTA MAH. ULU ÖNDER ATATÜRK CAD. NO:31   MENDERES/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 10391590738
        // Adı Soyadı		: MÜZEYYEN YALIRGAV (TEL: 000)
        // Adres		:    ÖLÜ 
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 62419111746
        // Adı Soyadı		: NAZLI İNAN (TEL: 000)
        // Adres		: BAHAR MAH. 3.IŞIK SK. NO:24 İÇ KAPI NO:2   OSMANGAZİ/BURSA
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 24304315394
        // Adı Soyadı		: NECAHİR ANTEKİ (TEL: 000)
        // Adres		: ÖLÜ
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 10565271074
        // Adı Soyadı		: NECATİ ÖZMERMER (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1654 SK. NO:9 İÇ KAPI NO:2   BORNOVA/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 
        // Adı Soyadı		: NECLA TİLAVER (TEL: 000)
        // Adres		: 
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 23747147432
        // Adı Soyadı		: NEVAL DÜZOVALI (TEL: 000)
        // Adres		: TINAZTEPE MAH. 568 SK. NO:32 İÇ KAPI NO:3   KONAK/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // Adı Soyadı		: NUSRAT GENİŞ (TEL: 000)
        // Adres		: ÖLÜ
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 37315692972
        // Adı Soyadı		: ÖMER LÜTFİ BAŞARANER (TEL: 000)
        // Adres		:    ÖLÜ
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 44533079690
        // Adı Soyadı		: ÖZGÜL PALO (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1650 SK. NO:45   BORNOVA/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 62425111518
        // Adı Soyadı		: REMZİYE İLDENİZ (TEL: 000)
        // Adres		: DOĞANLAR MAH. 7404/5 SK. NO:22 İÇ KAPI NO:1   BORNOVA/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 57820010160
        // Adı Soyadı		: SANİYE ARSIN (TEL: 000)
        // Adres		:    ÖLÜ
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 44725073260
        // Adı Soyadı		: SEHER PALO (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1650 SK. NO:47 İÇ KAPI NO:2   BORNOVA/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 12568521606
        // Adı Soyadı		: SELAHATTİN TAŞDEMİR (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1650 SK. NO:55   BORNOVA/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 20903752806
        // Adı Soyadı		: SELVİ YAŞAR (TEL: 000)
        // Adres		: YUNUS EMRE MAH. 7518 SK. NO:18/1   BORNOVA/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 26089876602
        // Adı Soyadı		: SUAT ÇOBAN (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1650 SK. NO:49 İÇ KAPI NO:3   BORNOVA/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 62470110078
        // Adı Soyadı		: SÜHEYLA KÖNİ (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1660 SK. NO:39 İÇ KAPI NO:2   BORNOVA/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 10373591616
        // Adı Soyadı		: ŞAHVER ÇIĞIRGİL (TEL: 000)
        // Adres		: ATİLLA MAH. EŞREFPAŞA CAD. NO:316 İÇ KAPI NO:4   KONAK/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 21292250676
        // Adı Soyadı		: ŞAKİR ALHAN (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1515 SK. NO:8 İÇ KAPI NO:2   BORNOVA/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 34033819438
        // Adı Soyadı		: ŞİRVAN ÖNKOL (TEL: 000)
        // Adres		: MANAVKUYU MAH. SAKARYA CAD. NO:4 İÇ KAPI NO:3   BAYRAKLI/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 21706848680
        // Adı Soyadı		: TAHİR ÖZKAN (TEL: 000)
        // Adres		:    ÖLÜ
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 42859536798
        // Adı Soyadı		: TAHSİN ÇİÇEKÇİ (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1655 SK. NO:45 İÇ KAPI NO:2   BORNOVA/İZMİR
        // Vekili		:Av. 	(TEL: 000)
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 58855230578
        // Adı Soyadı		: VAHDETTİN BULCAR (TEL: 000)
        // Adres		: DOĞANLAR MAH. 1658 SK. NO:25 İÇ KAPI NO:3   BORNOVA/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 14900432878
        // Adı Soyadı		: YALÇIN GÜRSOY (TEL: 000)
        // Adres		: DONANMACI MAH. 1740/1 SK. NO:24 İÇ KAPI NO:3   KARŞIYAKA/İZMİR
        // KARŞI TARAF BİLGİLERİ	
        // TC Kimlik No	: 13918485098
        // Adı Soyadı		: YUNUS ÖZTÜRK (TEL: 000)
        // Adres		: EVKA 3 MAH. 119/32 SK. NO:72 İÇ KAPI NO:6   BORNOVA/İZMİR
        // BAŞVURU BİLGİLERİ
        // Dava Türü			: [Paylı Mülkiyette (Maktu)]
        // Karşı Taraf Bilgi Sahibi Mi		: HAYIR
        // Başvuru Konusu Müracaat Durumu	: başvuru formunda yazılı talepleri içerir.
        
        //     Başkaca bir usul kararlaştırılmadıkça arabulucunun taraflarca seçileceğini bildiğimi, başvuru dilekçesinde yer alan tüm açıklamaları okuyup anladığımı, başvuru konusuna ilişkin sahip olduğum tüm bilgi ve belgeleri işbu başvuru dilekçesi ve ekinde doğru ve eksiksiz olarak ibraz ettiğimi beyan eder, işbu başvurunun işleme konulmasını arz ve talep ederim.  
        // EKİ : VEKALETNAME SURETİ, ARABULUCULUK BAŞVURU ÖN FORMU
        
         
        // Başvurucu
         
        // Başvurucu
         
        // Başvurucu
         
        // Başvurucu
         
        // Başvurucu
        // Ali Ramazan Maviş 
        // Devlet Kaplankıran 
        // Erdinç Maviş 
        // Hüseyin Maviş 
        // Mehmet Çağlayan Maviş 
         
         
         
         
         
        // Vekili	Av. SİBEL BARDAKÇI
        
        
        
        
        
        // NOT : BAŞVURUCU/VEKİLİNİN TALEBİ İLE İZMİR KOMİSYONUNDAN ATAMA YAPILMIŞTIR.
        
        //   ___________________________________________________________________________
        // Adres : İzmir Arabuluculuk Bürosu	Ayrıntılı Bilgi İçin : ŞEBNEM CENGİZ ZABIT KÂTİBİ  ";  // Buraya metninizi yerleştirin
        // $trans = array(
        //     'Ç' => 'ç', 'İ' => 'i', 'Ö' => 'ö', 'Ş' => 'ş', 'Ü' => 'ü',
        //     'Ğ' => 'ğ', 'I' => 'ı', 'A' => 'a', 'B' => 'b', 'C' => 'c',
        //     'D' => 'd', 'E' => 'e', 'F' => 'f', 'G' => 'g', 'H' => 'h',
        //     'J' => 'j', 'K' => 'k', 'L' => 'l', 'M' => 'm', 'N' => 'n',
        //     'O' => 'o', 'P' => 'p', 'Q' => 'q', 'R' => 'r', 'S' => 's',
        //     'T' => 't', 'U' => 'u', 'V' => 'v', 'W' => 'w', 'X' => 'x',
        //     'Y' => 'y', 'Z' => 'z', "\t\t" => " ", "\t" => " ", "\r" => '', "  " => " ", "   " => " ", "/" => " "
        // );
        

        // $text = strtr($text, $trans);
        

        // //dd($text);

        // $basvuru_bilgileri = [];

        // // Başvuru tarihini çıkarma
        // preg_match("/başvuru tarihi\s?:\s?(.*?)\s/", $text, $matches);
        // $basvuru_bilgileri['basvuru_tarihi'] = $matches[1];

        // // Başvuru numarasını çıkarma
        // preg_match("/başvuru numarası\s?:\s?(.*?)\s/", $text, $matches);
        // $basvuru_bilgileri['basvuru_no'] = $matches[1];

        // // Arabuluculuk bürosunu çıkarma
        // preg_match("/adres\s?:\s?(.*?)\s?arabuluculuk bürosu/", $text, $matches);
        // $basvuru_bilgileri['arabuluculuk_burosu'] = $matches[1];


        // $basvuru_sahipleri = [];

        // // Başvuru sahiplerinin bilgilerini çıkarma
        // preg_match("/başvuru sahibi bilgileri(.*?)karşı taraf bilgileri/s", $text, $matches);
        // $basvuru_sahipleri_text = $matches[1];

        // // Her bir başvuru sahibi için bilgileri çıkarma
        // preg_match_all("/tc kimlik no\s?:\s?(.*?)\sadı soyadı\s?:\s?(.*?)\sadres\s?:\s?(.*?)cep tel\s?:\s?(.*?)\svekili\s?:\s?(.*?)\s\(tel:\s?(.*?)\)\s/s", $basvuru_sahipleri_text, $matches, PREG_SET_ORDER);

        // foreach ($matches as $match) {
        //     $basvuru_sahibi = [];
        //     $basvuru_sahibi['tc_kimlik_no'] = ucwords(trim($match[1]));
        //     $basvuru_sahibi['adi_soyadi'] = ucwords(trim($match[2]));
        //     $basvuru_sahibi['adres'] = ucwords(trim($match[3]));
        //     $basvuru_sahibi['cep_tel'] = ucwords(trim($match[4]));
        //     $basvuru_sahibi['vekili'] = ['ad' => ucwords(trim($match[5])), 'tel' => ucwords(trim($match[6]))];
        //     $basvuru_sahipleri[] = $basvuru_sahibi;
        // }

        // $karşı_taraflar = [];

        // // Karşı taraf bilgilerini çıkarma
        // preg_match_all("/karşı taraf bilgileri\s(.*?)adı soyadı\s?:\s?(.*?)\sadres\s?:\s?(.*?)0\s?:?\s?(\d+)?\s/s", $text, $matches, PREG_SET_ORDER);

        // foreach ($matches as $match) {
        //     $karsi_taraf = [];
        //     $karsi_taraf['adi_soyadi'] = ucwords(trim($match[2]));
        //     $karsi_taraf['adres'] = isset($match[3]) ? ucwords(trim($match[3])) : null;
        //     $karsi_taraf['tel'] = isset($match[4]) ? '0' . ucwords(trim($match[4])) : null;
        //     $karşı_taraflar[] = $karsi_taraf;
        // }
        // echo "<pre>";
        // print_r($basvuru_bilgileri);
        // print_r($basvuru_sahipleri);
        // print_r($karşı_taraflar);
        
        // exit();


        $lawsuits = Lawsuit::where('user_id', auth()->id())->get();
        $lawsuitProcessTypes = LawsuitProcessType::pluck('name', 'id')->toArray();
        $documents = Document::where("created_user_id", auth()->id())->get();
        $documentTypes = DocumentType::pluck('name', 'id')->toArray();
        $documentTypesCount = $documents->groupBy('document_type_id')->map(function ($item) {
            return $item->count();
        });
        $lawsuitProcessTypesCount = $lawsuits->groupBy('lawsuit_process_type_id')->map(function ($item) {
            return $item->count();
        });
        return view('mediator.index', compact('lawsuits', 'lawsuitProcessTypes', 'lawsuitProcessTypesCount', 'documents', 'documentTypes', 'documentTypesCount'));
    }
}
