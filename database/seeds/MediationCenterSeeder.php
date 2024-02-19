<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediationCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("mediation_centers")->insert([
            [
                'title' => 'ABM Arabuluculuk Uyuşmazlık Çözüm Merkezi',
                'address' => 'PolCenter - Büyükdere Cd. Ecza Sk. No:4/1 Nart Bussiness Levent / İSTANBUL'
            ],
            [
                'title' => 'A.B. Nayır Arabuluculuk Merkezi',
                'address' => 'Konyaaltı Cd. No:46 Cazip Apt. K:2 D:6 Muratpaşa / ANTALYA'
            ],
            [
                'title' => 'Alternatif Uyuşmazlık Enstitüsü Merkezi',
                'address' => 'Atatürk Bulvarı Bulvar Palas No: 141 C Blok Kat: 2 Çankaya / ANKARA'
            ],
            [
                'title' => 'Alternatif Uyuşmazlık Çözüm Merkezi',
                'address' => 'Ali Paşa Mh. Fuatpaşa Cd. Altıntaş Apt. No:15/A KÜTAHYA'
            ],
            [
                'title' => 'ACR Arabuluculuk Merkezi',
                'address' => 'Osmaniye Mh. Fabrikalar Cd. Aybar Sitesi B2 Blok No:47 D:2 Bakırköy / İSTANBUL'
            ],
            [
                'title' => 'ADR Arabuluculuk Hukuki Uzlaştırma Merkezi',
                'address' => 'İçerenköy Mh. Prof. Ali Nihat Tarhan Cd. Yeşil Belde Sk. Zehra Apt. Kat:2 D:14 Ataşehir / İSTANBUL'
            ],
            [
                'title' => 'Ahi Arabuluculuk Merkezi',
                'address' => 'Melikşah Mh. Şehit İsmail Kaya Sk. Konevi Plaza No:3 Meram / KONYA'
            ],
            [
                'title' => 'Akbulut Arabuluculuk Merkezi',
                'address' => 'Saraybosna Cd. HSA İş Merkezi No:26/2 Yakutiye / ERZURUM'
            ],
            [
                'title' => 'Akden Arabuluculuk Merkezi',
                'address' => 'Meltem Mh. 6.Cd Meltem Apt. No:9 D:14 Muratpaşa / ANTALYA'
            ],
            [
                'title' => 'Akdeniz Uyuşmazlık Çözüm ve Arabuluculuk Merkezi',
                'address' => '295/2 Sk. No:1 A Blok K:4 D:403 Bayraklı / İZMİR'
            ],
            [
                'title' => 'Altay Tahkim ve Arabuluculuk Merkezi',
                'address' => 'Atakent Mh. Mithatpaşa Cd No:116 Çağla Plaza Kat:3 Ümraniye / İSTANBUL'
            ],
            [
                'title' => 'Alteram Arabuluculuk ve Uyuşmazlık Çözüm Merkezi',
                'address' => 'Mahmut Şevket Paşa Cd. No:5 Yeşilköy / İSTANBUL'
            ],
            [
                'title' => 'Anatolia Arabuluculuk ve Çözüm Merkezi',
                'address' => 'Şili Meydanı Güneş Cd. No:1/3 Çankaya / ANKARA'
            ],
            [
                'title' => 'Ankara Arabuluculuk Merkezi (ANKARAMER)',
                'address' => 'Ceyhun Atuf Kansu Cd. Ata Plaza No:100/10 Balgat / ANKARA'
            ],
            [
                'title' => 'Ankara Tahkim ve Arabuluculuk Merkezi (ATAM)',
                'address' => 'Kızılay Mh. İzmir-2 Cd. No:45/11 Çankaya / ANKARA'
            ],
            [
                'title' => 'Ankara Batı Arabuluculuk ve Alternatif Çözüm Merkezi',
                'address' => ''
            ],
            [
                'title' => 'Ankara Mavi Arabuluculuk Merkezi',
                'address' => 'Mebusevleri Mh. Ergin Sk. Ata Apt. No:33/4 Çankaya / ANKARA'
            ],
            [
                'title' => 'Antant Arabuluculuk Alternatif Uyuşmazlık Çözüm ve Tahkim Merkezi',
                'address' => 'Remzi Oğuz Arık Mh. Atatürk Bulvarı Celal Bayar Plaza No:211/17 Çankaya / ANKARA'
            ],
            [
                'title' => 'Ant Antalya Arabuluculuk Merkezi',
                'address' => 'Etiler Mh. 829 Sk. No:3 A Plaza K:4 D:31 ANTALYA'
            ],
            [
                'title' => 'Amaç Arabuluculuk Merkezi',
                'address' => 'Kayalibağ Mh. Turhan Cemal Beriker Bulv. Kağizman İs Merkezi K:1 D:102 Seyhan / ADANA'
            ],
            [
                'title' => 'A Plus Arabuluculuk Merkezi',
                'address' => 'Tahran Cd. No:30 Dünya Ticaret Merkezi Kat:10 GOP / ANKARA'
            ],
            [
                'title' => 'Aydın Arabuluculuk Merkezi',
                'address' => 'Fatih Mh. 1101 Sk. No:4/2 Şelale Evleri Efeler / AYDIN'
            ],
            [
                'title' => 'AOM Arabuluculuk ve Alternatif Çözüm Merkezi',
                'address' => 'Cevizli Mh. Zuhal Cd. Mazaya Ritim Istanbul A3 Blok K:12 D:64 Maltepe / İSTANBUL'
            ],
            [
                'title' => 'ATEM Arabuluculuk Tahkim Eğitim Merkezi',
                'address' => 'Kocamansur Sk. No:71/5 Şişli / İSTANBUL'
            ],
            [
                'title' => 'Denizli Artı Arabuluculuk Uyuşmazlık Çözüm Merkezi',
                'address' => 'Sırakapılar Mh. Hastane Cd. No:3 Nur İş Merkezi K:4 Merkezefendi / DENİZLİ'
            ],
            [
                'title' => 'Aspendos Arabuluculuk Merkezi',
                'address' => 'Toros Mh. 853 Sk. Kurgu Plaza K:3 Konyaaltı / ANTALYA'
            ],
            [
                'title' => 'BAB Arabuluculuk Merkezi',
                'address' => 'Ergenekon Mh. Cumhuriyet Cd. Fransız Hastanesi Sk. Kaya Apt. No:1 K.1 D:2 Harbiye - Şişli / İSTANBUL'
            ],
            [
                'title' => 'Baki Arabuluculuk ve Tahkim Merkezi',
                'address' => 'Alişan Yeşilbaşlar Sk. Liman Apt. B Blok No:6-6 Bakırköy / İSTANBUL'
            ],
            [
                'title' => 'BAM-Bağımsız Arabuluculuk ve Alternatif Uyuşmazlık Çözüm Merkezi',
                'address' => 'Ebu Ziya Tevfik Sk. No:9/1 Çankaya / ANKARA'
            ],
            [
                'title' => 'Barış Arabuluculuk Merkezi',
                'address' => 'İçerenköy Mh. Çayır Cd. No:6 D:3 Ataşehir / İSTANBUL'
            ],
            [
                'title' => 'Bahariye Arabuluculuk Merkezi',
                'address' => 'Miralay Nazım Sk. Uğur Apt. No:21/3 Kadıköy / İSTANBUL'
            ],
            [
                'title' => 'Başkent Arabuluculuk Uyuşmazlık Çözüm Merkezi',
                'address' => 'Cevizlidere Cd. No:5/12 Çankaya / ANKARA'
            ],
            [
                'title' => 'Batman Arabuluculuk Merkezi',
                'address' => 'Bahçelievler Mh. 1611. Sk. No:2 D:5 BATMAN'
            ],
            [
                'title' => 'Batı Akdeniz Arabuluculuk ve uzlaştırma Merkezi',
                'address' => 'Yeni Mh. Fatih Bulv. Aktaş Apt. No:10/4 Finike / ANTALYA'
            ],
            [
                'title' => 'Arabuluculuk Merkezi',
                'address' => 'Kızılırmak Mh. Ufuk Üniversitesi Cd. No:4/29 (Next Level Loft Ofis) Söğütözü - Çankaya / ANKARA'
            ],
            [
                'title' => 'Bitlis Arabuluculuk ve Alternatif Uyuşmazlıklar Çözüm Merkezi',
                'address' => 'Kültür Mh. Şehmuz Zırhlı Cd. Adalet Plaza K:5 No:89 Tatvan / BİTLİS'
            ],
            [
                'title' => 'Boğaziçi Arabuluculuk Merkezi',
                'address' => 'Merkez Efendi Mh. Mevlana Cd.Tercüman Sitesi A-9 Blok D:12 Cevizlibağ - Zeytinburnu / İSTANBUL'
            ],
            [
                'title' => 'Bodrum Arabuluculuk Merkezi',
                'address' => 'Konacık Mh. Adliye Cd. No:24/E Bodrum / MUĞLA'
            ],
            [
                'title' => 'Bursa Arabuluculuk Merkezi',
                'address' => 'Panayır Mh. İstanbul Cd. No:387 Biçen Plaza K:6 D:42 Osmangazi / BURSA'
            ],
            [
                'title' => 'CCA Uyuşmazlık Çözüm Merkezi',
                'address' => 'Hacettepe Üniversitesi Teknoloji Kampüsü / ANKARA'
            ],
            [
                'title' => 'CADR Arabuluculuk Merkezi',
                'address' => 'İlkiz Sk. No:24/22 Sıhhiye - Çankaya / ANKARA'
            ],
            [
                'title' => 'CONSENSUS Arabuluculuk Merkezi',
                'address' => 'Mansuroğlu Mh. Selvili 2 Apt. B Blok No:3 K:5 D:13 Bayraklı / İZMİR'
            ],
            [
                "title" => "Çağlayan Arabuluculuk Merkezi",
                "address" => "Çağlayan Mah. Cihanşah Sok. No: 2 Onur İş Merkezi Kat: 4 Kağıthane / İSTANBUL"
            ],
            [
                'title' => 'Çankaya Arabuluculuk ve Alternatif Uyuşmazlık Çözüm Yöntemleri Merkezi',
                'address' => 'Kuloğlu Sk. No:15/1 Çankaya / ANKARA'
            ],
            [
                'title' => 'Çatı Arabuluculuk ve Alternatif Uyuşmazlık Çözüm Merkezi',
                'address' => ''
            ],
            [
                'title' => 'Çoban Hukuk ve Arabuluculuk Merkezi',
                'address' => 'Arapsuyu Mh. 666. Sk. No:4/8 Konyaaltı / ANTALYA'
            ],
            [
                'title' => 'Trakya Arabuluculuk Merkezi',
                'address' => 'Ali Paşa Mh. Yücel Sk. Akses 2 Apt. No:17 K:5 D:12 Çorlu / TEKİRDAĞ'
            ],
            [
                'title' => 'Çorum Arabuluculuk Merkezi',
                'address' => 'Ulukavak Mh. Mavral Sk. A Blok No:55/A ÇORUM'
            ],
            [
                'title' => 'Çözüm Arabuluculuk Merkezi',
                'address' => 'Gevhernesibe Mh. İstasyon Cd. Başalp İş Merkezi Kat:6 No:47/11 Kocasinan / KAYSERİ'
            ],
            [
                'title' => 'Çözüm Tahkim ve Arabuluculuk Merkezi',
                'address' => 'Fatih Mh. 22036 Nolu Sk. No:8 Şehitkamil / GAZİANTEP'
            ],
            [
                'title' => 'Denge Arabuluculuk Merkezi',
                'address' => 'Kayalıbağ Mh. T. Cemal Beriker Bulv. Adana Ticaret İş Merkezi K:15 No:77 Seyhan / ADANA'
            ],
            [
                'title' => 'Denar Denizli Arabuluculuk Merkezi',
                'address' => 'Sırakapılar Mh. Saltak Cd. No:67 K:6 D:12-13 Merkezefendi / DENİZLİ'
            ],
            [
                'title' => 'Diyalog Arabuluculuk Merkezi',
                'address' => ''
            ],
            [
                'title' => 'Diyarbakir Arabuluculuk ve Uyuşmazlık Çözüm Merkezi',
                'address' => 'Selahattin Yazıcıoğlu Cd. Oryil My Office A Blok 4/10 Yenisehir / DİYARBAKIR'
            ],
            [
                'title' => 'Dost Arabuluculuk Merkezi',
                'address' => 'Osmaniye Mh. Şirin Sk. B Blok No:6 D:7 Tekin Plaza Bakırköy / İSTANBUL'
            ],
            [
                'title' => 'Doğu Batı Arabuluculuk Merkezi',
                'address' => ''
            ],
            [
                'title' => 'Destek Arabuluculuk ve Müzakere Merkezi',
                'address' => 'Sezenler Cd. No:16/14 Sıhhiye / ANKARA'
            ],
            [
                'title' => 'Dostel Arabuluculuk Merkezi',
                'address' => 'Çetin Emeç Bulvarı No:60/7 Çankaya / ANKARA'
            ],
            [
                'title' => 'Dual Arabuluculuk Merkezi',
                'address' => 'Pınarbaşı Mh. Atatürk Bulvarı Taburlar Sitesi B Blok K:2 D:10 Konyaaltı / ANTALYA'
            ],
            [
                'title' => 'Ege Arabuluculuk Merkezi',
                'address' => ''
            ],
            [
                'title' => 'Ege Arabuluculuk Uyuşmazlık Çözüm Merkezi',
                'address' => 'Siteler Mh. Karacan Plaza No:2/202 Marmaris / MUĞLA'
            ],
            [
                'title' => 'Egem Arabuluculuk ve Alternatif Uyuşmazlıkar Çözüm Merkezi',
                'address' => 'Sırakapılar Mh. 493 Sk. No:6 Gözde Apt. K:1 Merkezefendi / DENİZLİ'
            ],
            [
                'title' => 'Emek Arabuluculuk Merkezi',
                'address' => 'Emek Mh. Kırım Cd. (10. Cad.) Yapı Sitesi D Blok No: 50/9 Çankaya / ANKARA'
            ],
            [
                'title' => 'Enerji Uyuşmazlıkları Arabuluculuk Merkezi',
                'address' => 'Dumlupınar Bulv. Next Level A Blok No:3 K: 16 D: 81 Söğütözü / ANKARA'
            ],
            [
                'title' => 'Eskişehir Arabuluculuk ve Uyuşmazlık Çözüm Merkezi',
                'address' => 'Cumhuriyet Bulv. Can Apt. No:69/22 Odunpazarı / ESKİŞEHİR'
            ],
            [
                'title' => 'Ertem Arabuluculuk Merkezi',
                'address' => ''
            ],
            [
                'title' => 'Etik Arabuluculuk Merkezi',
                'address' => 'Turan Gunes Bulv. Korman Sitesi 51/L Çankaya / ANKARA'
            ],
            [
                'title' => 'Etkin Arabuluculuk ve Alternatif Uyuşmazlık Çözüm Merkezi',
                'address' => 'Bağlarbaşı Mh. 1. Sedir Sk. Evke Onyx Offices Plaza K:6 D:33 Osmangazi / Bursa'
            ],
            [
                'title' => 'Eurasia Uyuşmazlık Çözüm Merkezi',
                'address' => 'Sakarya Mh. İnci Sk. No:1 Altındağ / ANKARA'
            ],
            [
                'title' => 'Gaziantep Alternatif Tahkim ve Arabuluculuk Merkezi (GATAM)',
                'address' => 'Mücahitler Mh. Mareşal Fevzi Çakmak Bulv. No:120/A Hayat Apt. Şehitkamil / GAZİANTEP'
            ],
            [
                'title' => 'Genç Arabuluculuk Merkezi',
                'address' => 'Hacıseyitali Mh. 153066 Sk. Ayvacı İş Merkezi (PTT yanı İş Bankası Üstü) Kat:3 No:4/C Seydişehir / KONYA'
            ],
            [
                'title' => 'Global Arabuluculuk Merkezi (GMC)',
                'address' => 'Gürsel Mh. Çampark Sk. No:25 K:1 Çağlayan - Kağıthane / İSTANBUL'
            ],
            [
                'title' => 'Global Arabuluculuk ve Uyuşmazlık Çözüm Merkezi',
                'address' => 'Cemalpaşa Mh. Cevat Yurdakul Cd. No:6/B Seyhan / ADANA'
            ],
            [
                'title' => 'Gümüşkapı Arabuluculuk Merkezi',
                'address' => 'Ortaklar Cd. No:12 D:9-10 Mecidiyeköy / İSTANBUL'
            ],
            [
                'title' => 'Gündoğan Arabuluculuk Merkezi',
                'address' => 'Kennedy Cd. No:24/8 k:2 Çankaya / ANKARA'
            ],
            [
                'title' => 'Forum Arabuluculuk ve Uyuşmazlık Çözüm Merkezi',
                'address' => 'Mahmutbey Mh. Taşocağı Yolu Cd. No:35 Bağcılar / İSTANBUL'
            ],
            [
                'title' => 'Hedef Arabuluculuk Merkezi',
                'address' => 'Meltem Mh. Dumlupinar Bulv. Anakent Sitesi 9A Blok K:1 D:6'
            ],
            [
                'title' => 'Hitit Arabuluculuk ve Uyuşmazlık Çözüm Merkezi',
                'address' => 'Oğuzlar Mh. 1372. Cd. Gürel İş Merkezi No:3/2 Balgat - Çankaya / ANKARA'
            ],
            [
                'title' => 'İHKİB Arabuluculuk Merkezi',
                'address' => 'Çobançeşme Mevkii Dış Ticaret Kompleksi B Blok Bahçelievler / İSTANBUL'
            ],
            [
                'title' => 'IZARAMER İzmir Arabuluculuk ve Alternatif Uyuşmazlıklar Çözüm Merkezi',
                'address' => 'Çınarlı Mh. Fatih Cd. 1587 Sk. No:2 K:8 D:801-802-803 Konak / İZMİR'
            ],
            [
                'title' => 'İkonion Alternatif Uyuşmazlık Çözümleri Merkezi',
                'address' => 'Armağan Mh. Melikşah Cd. No:9/1 Meram / KONYA'
            ],
            [
                'title' => 'İstanbul Arabuluculuk Merkezi',
                'address' => 'Gayrettepe Mh. Yıldız Posta Cd. Gönenoğlu Sk. Fidan Sitesi A Blok No:14/17 Beşiktaş / İSTANBUL'
            ],
            [
                'title' => 'İstanbul Ticari Arabuluculuk Merkezi',
                'address' => 'Büyükdere Cd. Kaynak Apartmanı No:156/11 Zincirlikuyu - Şişli / İSTANBUL'
            ],
            [
                'title' => 'İlağa Arabuluculuk Merkezi',
                'address' => ''
            ],
            [
                'title' => 'Kadeş arabuluculuk Merkezi',
                'address' => 'Yeni Yol Mh. Sel Sk. Adil Kayışoğlu İş Merk. No:30/1 ÇORUM'
            ],
            [
                'title' => 'Kalem Arabuluculuk Merkezi',
                'address' => 'Gevher Nesibe Mh. Tekin Sk. Miraboğlu İş merkezi K:6-7 KAYSERİ'
            ],
            [
                'title' => 'Kavaklıdere Arabuluculuk Merkezi',
                'address' => 'Tunalı Hilmi Cd. No:88 B Blok Kat:2 Kavaklıdere / ANKARA'
            ],
            [
                'title' => 'Kazanım Arabuluculuk Merkezi',
                'address' => 'İsmetiye Mh. Bölük Emin Sk. No:11 K:2 D:3 Battalgazi / MALATYA'
            ],
            [
                'title' => 'Kent Arabuluculuk ve Uyuşmazlık Çözüm Merkezi',
                'address' => 'İlkadım Mh. Yeşilvadi Cd. Çankaya Konut Kuleleri B Blok No:39/28 Dikmen - Çankaya / ANKARA'
            ],
            [
                'title' => 'Kocaeli Çözüm Arabuluculuk Merkezi',
                'address' => 'Korfez Mh. Ş.Rafet Karacan Sk. Eren Apt. B blok K:2 D:3 Izmit / Kocaeli'
            ],
            [
                'title' => 'Kocaeli Doğu Marmara Arabuluculuk Merkezi',
                'address' => ''
            ],
            [
                'title' => 'Kocaeli İlke Arabuluculuk Merkezi',
                'address' => ''
            ],
            [
                'title' => 'Kocaeli Kurumsal Arabuluculuk Merkezi',
                'address' => 'Karabaş Mh. Hafız Selim Sk. No:19 İzmit / KOCAELİ'
            ],
            [
                'title' => 'Konya Arabuluculuk Uyuşmazlık Çözüm Merkezi',
                'address' => 'Havzan Mh. Yeni Meram Cd. Sarı Ev Apt No:41/2 Meram / KONYA'
            ],
            [
                'title' => 'Libra Arabuluculuk ve Çözüm Merkezi',
                'address' => ''
            ],
            [
                'title' => 'Mersin Akdeniz Arabuluculuk Merkezi',
                'address' => 'Mahmudiye Mh. Zeytinlibahçe Cd. No:60 Akdeniz / MERSİN'
            ],
            [
                'title' => 'MSÇ Arabuluculuk Merkezi',
                'address' => 'Mustafa Kemal Mh. 2079 Sk. VIA Green İş Merkezi A/41 Çankaya / ANKARA'
            ],
            [
                'title' => 'MMC Marmara Arabuluculuk Merkezi (Marmara Mediation Center)',
                'address' => 'Cevizli Mh. Mustafa Kemal Cd. No:66 Hukukçular Towers B Blok K: 2 D:16 Kartal / İSTANBUL'
            ],
            [
                'title' => 'Marmara Arabuluculuk Merkezi',
                'address' => ''
            ],
            [
                'title' => 'Mediasi Arabuluculuk Tahkim ve Danışmanlık Merkezi A.Ş.',
                'address' => 'Mahir İz Cd. Suat Sümer İş Merk. No:30 B Blok K: 1 D:1 Altunizade / İSTANBUL'
            ],
            [
                'title' => 'Metropol Arabuluculuk Merkezi',
                'address' => 'General Ali Rıza Gürcan Cd. No:31/50 Merter / İSTANBUL'
            ],
            [
                'title' => 'Mavi Arabuluculuk Merkezi',
                'address' => 'Ritim İstanbul A1 Blok K:31 D: 307 Cevizli - Maltepe / İSTANBUL'
            ],
            [
                'title' => 'MTN Arabuluculuk Merkezi',
                'address' => 'EGS Business Park B1 Blok K:10 NO:350 Yeşilköy - Bakırköy / İSTANBUL'
            ],
            [
                'title' => 'NAS Arabuluculuk Merkezi',
                'address' => 'Meşruiyet Cd. No:26/12 K:6 Kızılay - Çankaya / ANKARA'
            ],
            [
                'title' => 'Nehir Arabuluculuk Merkezi',
                'address' => 'Nişancı Mh. Samancılar Sk. No:1-2 Eyüp Sultan / İSTANBUL'
            ],
            [
                'title' => 'NN Primus Arabuluculuk ve Çözüm Merkezi',
                'address' => 'Soğanlık Yeni Mh. Baltacı Mehmet Paşa Sk. Hellenium Twins A Blok K:6 D:33 Kartal / İSTANBUL'
            ],
            [
                'title' => 'NTN Partners Arabuluculuk Merkezi',
                'address' => 'Maslak Mh. Eski Büyükdere Cd. GİZ2000 Plaza No:7 D:15 Sarıyer / İSTANBUL'
            ],
            [
                'title' => 'NG Arabulucuk Merkezi',
                'address' => 'Cinnah Cd. No:28/7 Çankaya / ANKARA'
            ],
            [
                'title' => 'Ortak Karar Merkezi Arabuluculuk ve Alternatif Çözümler (OKM)',
                'address' => 'Yücetarla Cd. 3 Denge Apt. K:4 D:16 Zuhuratbaba - Bakırköy / İSTANBUL'
            ],
            [
                'title' => 'Ortak Çözüm Hukuk - Arabuluculuk - Tahkim Hizmetleri',
                'address' => 'Bamyasuyu Mh. 148. Sk. Kürkçüoğlu Apt. Kat:2 No:4 Haliliye / ŞANLIURFA'
            ],
            [
                'title' => 'Plus Arabuluculuk Merkezi',
                'address' => 'Merkez Mh. 29. Ekim Cd. İstanbul Vizyon Park 5. Giriş K:3 D:315-316 Yeni Bosna - Bahçelievler / İSTANBUL'
            ],
            [
                'title' => 'Portakal Arabuluculuk ve Alternatif Uyuşmazlık Çözüm Merkezi',
                'address' => 'Kızılırmak Mh. Dumlupınar Bulv. No:3 Next Level Ofis K:6 Çankaya / ANKARA'
            ],
            [
                'title' => 'Ponte & Biridge Arabuluculuk Tahkim ve Hukuk Danışmanlık Merkezi',
                'address' => 'Cumhuriyet Bulv. No 231/1 Piray Apt. Kat:1 D:51 Alsancak - Konak / İZMİR'
            ],
            [
                'title' => 'Referans ADR Uyuşmazlık Çözüm Merkezi',
                'address' => '23 Nisan Mh. Ata Bulv. Meriç Plaza Kat:2 Nilüfer / BURSA'
            ],
            [
                'title' => 'Reisbey Arabuluculuk Merkezi',
                'address' => 'Hobyar Mh. Ankara Cd. No:11 K:5 Fahrettin Kerim Gökay Vakfı İş Merkezi Cağaloğlu - Fatih / İSTANBUL'
            ],
            [
                'title' => 'Rize Arabuluculuk Merkezi',
                'address' => 'Piriçelebi Mh. Harem Sk. No:1 Güven Apt. K:4 RİZE'
            ],
            [
                'title' => 'Rota Arabuluculuk Merkezi',
                'address' => 'Bayar Cd. Şehit Mehmet Fatih Öngül Sk. No:3 Bağdatlıoğlu Plaza Kozyatağı / İSTANBUL'
            ],
            [
                'title' => 'Samsun Arabuluculuk Uyuşmazlık Çözüm ve Tahkim Merkezi',
                'address' => 'Kılıçdede Mh. Muhittin Özkefeli Bulv. No:20 İlkadım / SAMSUN'
            ],
            [
                'title' => 'Selçuklu Arabuluculuk Merkezi',
                'address' => 'Aşkan Mh. Yaka Cd. Gökdağ Sk. No:10/3 Meram / KONYA'
            ],
            [
                'title' => 'Solution Mediation Office Çözüm Arabuluculuk Merkezi',
                'address' => 'Konyaaltı Cd. Bahçelievler Mh. Bölükbaşı Apt. No:54 K:1 D:2 Muratpaşa / ANTALYA'
            ],
            [
                'title' => 'Söke Kuşadası Arabuluculuk Merkezi',
                'address' => 'Kemalpaşa Mh. Enstitü Sk. No:1 Söke / AYDIN'
            ],
            [
                'title' => 'Şanlıurfa Arabuluculuk Merkezi',
                'address' => 'Ertugrul Gazi Mh. Terim Cd. Ece Sitesi B Blok Altı No:19 Haliliye / ŞANLIURFA'
            ],
            [
                'title' => 'Şatam Arabuluculuk Danışmalık A.Ş',
                'address' => 'Paşabağı Mh. Cumhuriyet Cd. Aktaş İş Merkezi No:2/4 Haliliye / ŞANLIURFA'
            ],
            [
                'title' => 'Sedes Arabuluculuk Merkezi',
                'address' => 'Muhsin Yazıcıoğlu Cd. Regnum Sky Tower K:22 No:88 Çukurambar / ANKARA'
            ],
            [
                'title' => 'Talya Mediasyon Uyuşmazlık Çözüm Merkezi',
                'address' => 'Cevizli Mh. Mustafa Kemal Cd. No:30/2 Kartal / İSTANBUL'
            ],
            [
                'title' => 'TAM Arabuluculuk Merkezi',
                'address' => 'Atatürk Cd. No:174/1 Ekim Pasajı Kat:1/2 Konak / İZMİR'
            ],
            [
                'title' => 'Terazi Arabuluculuk Merkezi',
                'address' => 'Güvenevler Mh. Farabi Sk. No:38/8 Çankaya / ANKARA'
            ],
            [
                'title' => 'Teşvikiye Arabuluculuk Merkezi',
                'address' => 'Teşvikiye Cd. No:26/4 D:8 Nişantaşı / İSTANBUL'
            ],
            [
                'title' => 'Tetra Arabuluculuk Merkezi',
                'address' => 'Barbaros Bulv. No:58/5 Balmumcu - Beşiktaş / İSTANBUL'
            ],
            [
                'title' => 'Turkuaz Arabuluculuk Merkezi',
                'address' => 'Merdivenköy Mh. Sayım Sk. No:4/7 Kadıköy / İSTANBUL'
            ],
            [
                'title' => 'Trabzon Arabuluculuk Merkezi',
                'address' => ''
            ],
            [
                'title' => 'Uşak Arabuluculuk Merkezi',
                'address' => 'Fevzi Çakmak Mh. 1.Yay Sk. No:1 Ertuğrul Plus İş Merkezi K: 3 D:22 UŞAK'
            ],
            [
                'title' => 'Yıldırımoğlu Hukuk ve Arabuluculuk Merkezi',
                'address' => 'Seba Ofis Bulvar Ayazağa Mh. Mimar Sinan Sk. No:21 C Blok K: D:40 Sarıyer / İSTANBUL'
            ],
            [
                'title' => 'Yıldız Arabuluculuk Merkezi',
                'address' => '100. Yıl Bulv. Ostim Prestij İş Merkezi No:55 B Blok D: 26 Ostim - Yenimahalle / ANKARA'
            ],
        ]);
    }
}
