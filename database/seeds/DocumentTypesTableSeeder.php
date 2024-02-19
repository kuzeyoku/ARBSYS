<?php

use App\Models\Document\DocumentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lawsuit_types = [
            [
                'name' => 'Davet Mektubu',
                "keywords" => "@AliciAdSoyad,@AliciAdres,@ArabuluculukBurosu,@BasvuranAdSoyad,@BasvuranTCKNo,@BasvuranAvukat,@BugunTarih,@ToplantiTarih,@ToplantiSaat,@ToplantiAdres,@ArabulucuAdSoyad,@ArabulucuSicilNo,@ArabuluculukMerkezi,@Vekiller,@DavaOzeti"
            ],
            [
                'name' => 'Arabuluculuk Sürecine İlişkin Bilgilendirme Tutanağı',
                "keywords" => "@ArabuluculukBurosu,@BugunTarih,@ToplantiTarih,@ToplantiSaat,@ToplantiAdres,@ArabuluculukMerkezi,@ArabulucuAdSoyad,@ArabulucuSicilNo,@NushaAdet"
            ],
            [
                "name" => "Kvkk İle İlgili Bilgilendirme Tutanağı",
                "keywords" => "@ArabuluculukBurosu,@BugunTarih,@ToplantiTarih,@ToplantiSaat,@ArabulucuAdSoyad,@ArabulucuSicilNo,@NushaAdet"
            ],
            [
                'name' => 'İlk Toplantı Tutanağı',
                "keywords" => "@ToplantiTutanağiBasligi,@ArabuluculukBurosu,@BasvuruDosyaNo,@ARBDosyaNo,@UyusmazlikKonu,@ToplantiAdres,@BasvuruTarih,@GorevKabulTarih,@SurecinBaslangicTarih,@IlkToplantiTarih,@ToplantiBaslangicSaat,@ToplantiBitisSaat"
            ],
            [
                'name' => 'Anlaşma Belgesi',
                "keywords" => "@ArabuluculukBurosu,@BasvuruDosyaNo,@ARBDosyaNo,@UyusmazlikKonu,@ToplantiAdres,@MuzakereEdilenHususlar,@NushaAdet,@BugunTarih,@Sonuc"
            ],
            [
                'name' => 'Son Tutanak - Anlaşma',
                "keywords" => "@ArabuluculukBurosu,@BasvuruDosyaNo,@BugunTarih,@ARBDosyaNo,@UyusmazlikKonu,@ToplantiAdres,@BasvuruTarih,@GorevKabulTarih,@SurecinBaslangicTarih,@IlkToplantiTarih,@SonToplantiTarih,@CozumOnerisi,@OturumSayisi,@OturumSuresi,@MuzakereEdilenHususlar,@NushaAdet,@ToplantiyaKatilmayanTaraf"
            ],
            [
                "name" => "Son Tutanak - Görüşme Sonunda Anlaşamama",
                "keywords" => "@ArabuluculukBurosu,@BasvuruDosyaNo,@BugunTarih,@ARBDosyaNo,@UyusmazlikKonu,@ToplantiAdres,@BasvuruTarih,@GorevKabulTarih,@SurecinBaslangicTarih,@IlkToplantiTarih,@SonToplantiTarih,@CozumOnerisi,@OturumSayisi,@OturumSuresi,@MuzakereEdilenHususlar,@NushaAdet,@ToplantiyaKatilmayanTaraf"
            ],
            [
                "name" => "Son Tutanak - Görüşme Yapılmadan Anlaşamama",
                "keywords" => "@ArabuluculukBurosu,@BasvuruDosyaNo,@BugunTarih,@ARBDosyaNo,@UyusmazlikKonu,@ToplantiAdres,@BasvuruTarih,@GorevKabulTarih,@SurecinBaslangicTarih,@IlkToplantiTarih,@SonToplantiTarih,@CozumOnerisi,@OturumSayisi,@OturumSuresi,@MuzakereEdilenHususlar,@NushaAdet,@ToplantiyaKatilmayanTaraf"
            ],
            [
                "name" => "Son Tutanak - Arabulucuğa Uygun Olmaması",
                "keywords" => "@ArabuluculukBurosu,@BasvuruDosyaNo,@BugunTarih,@ARBDosyaNo,@UyusmazlikKonu,@ToplantiAdres,@BasvuruTarih,@GorevKabulTarih,@SurecinBaslangicTarih,@IlkToplantiTarih,@SonToplantiTarih,@CozumOnerisi,@OturumSayisi,@OturumSuresi,@MuzakereEdilenHususlar,@NushaAdet,@ToplantiyaKatilmayanTaraf"
            ],
            [
                "name" => "Son Tutanak - Konusuz Kalma - Başvurucunun Vazgeçmesi",
                "keywords" => "@ArabuluculukBurosu,@BasvuruDosyaNo,@BugunTarih,@ARBDosyaNo,@UyusmazlikKonu,@ToplantiAdres,@BasvuruTarih,@GorevKabulTarih,@SurecinBaslangicTarih,@IlkToplantiTarih,@SonToplantiTarih,@CozumOnerisi,@OturumSayisi,@OturumSuresi,@MuzakereEdilenHususlar,@NushaAdet,@ToplantiyaKatilmayanTaraf"
            ],
            [
                "name" => "Son Tutanak - Yetkisizlik",
                "keywords" => "@ArabuluculukBurosu,@BasvuruDosyaNo,@BugunTarih,@ARBDosyaNo,@UyusmazlikKonu,@ToplantiAdres,@BasvuruTarih,@GorevKabulTarih,@SurecinBaslangicTarih,@IlkToplantiTarih,@SonToplantiTarih,@CozumOnerisi,@OturumSayisi,@OturumSuresi,@MuzakereEdilenHususlar,@NushaAdet,@ToplantiyaKatilmayanTaraf"
            ],
            [
                "name" => "Son Tutanak - Sehven Kayıt",
                "keywords" => "@ArabuluculukBurosu,@BasvuruDosyaNo,@BugunTarih,@ARBDosyaNo,@UyusmazlikKonu,@ToplantiAdres,@BasvuruTarih,@GorevKabulTarih,@SurecinBaslangicTarih,@IlkToplantiTarih,@SonToplantiTarih,@CozumOnerisi,@OturumSayisi,@OturumSuresi,@MuzakereEdilenHususlar,@NushaAdet,@ToplantiyaKatilmayanTaraf"
            ],
            [
                "name" => "Son Tutanak - Kısmen Anlaşma",
                "keywords" => "@ArabuluculukBurosu,@BasvuruDosyaNo,@BugunTarih,@ARBDosyaNo,@UyusmazlikKonu,@ToplantiAdres,@BasvuruTarih,@GorevKabulTarih,@SurecinBaslangicTarih,@IlkToplantiTarih,@SonToplantiTarih,@CozumOnerisi,@OturumSayisi,@OturumSuresi,@MuzakereEdilenHususlar,@NushaAdet,@ToplantiyaKatilmayanTaraf"
            ],
            [
                "name" => "Son Tutanak - Taraf Katılmadı",
                "keywords" => "@ArabuluculukBurosu,@BasvuruDosyaNo,@BugunTarih,@ARBDosyaNo,@UyusmazlikKonu,@ToplantiAdres,@BasvuruTarih,@GorevKabulTarih,@SurecinBaslangicTarih,@IlkToplantiTarih,@SonToplantiTarih,@CozumOnerisi,@OturumSayisi,@OturumSuresi,@MuzakereEdilenHususlar,@NushaAdet,@ToplantiyaKatilmayanTaraf"
            ],
            [
                'name' => 'Arabulucu Belirleme Tutanağı',
                "keywords" => "@UyusmazlikKonu,@TeslimEdenAdSoyad,@TeslimEdenTCKNo,@BugunTarih,@ArabulucuSicilNo,@ArabulucuAdSoyad"
            ],
            [
                'name' => 'Yetki İtirazı Üst Yazısı',
                "keywords" => "@ArabuluculukBurosuBaslik,@ArabuluculukBurosu,@BasvuruDosyaNo,@ARBDosyaNo,@UyusmazlikKonu,@BasvuruTarih,@GorevKabulTarih,@SurecinBaslangicTarih,@IlkToplantiTarih,@BasvuranAdSoyad,@BasvuranAvukat,@TicaretOdası,@BelgeTarih,@BelgeSayı,@BelgeSayfa,@ÇalıştığıSüre,@ÇalıştığıYer,@BugunTarih"
            ],
            [
                'name' => 'Yetki Belgesi',
                "keywords" => "@ArabuluculukBurosuBaslik,@ArabuluculukBurosu,@BasvuruDosyaNo,@ARBDosyaNo,@UyusmazlikKonu,@BasvuruTarih,@GorevKabulTarih,@SurecinBaslangicTarih,@IlkToplantiTarih,@BasvuranAdSoyad,@BasvuranAvukat,@TicaretOdası,@BelgeTarih,@BelgeSayı,@BelgeSayfa,@ÇalıştığıSüre,@ÇalıştığıYer,@BugunTarih,@ArabuluculukBurosu,@BasvuruDosyaNo,@ARBDosyaNo,@BasvuranAdSoyad,@BugunTarih,@ToplantiTarih,@ToplantiSaat"
            ],
            [
                "name" => "SMM Üst Yazısı",
                "keywords" => ""
            ]
        ];

        DB::Table('document_types')->insert($lawsuit_types);
    }
}
