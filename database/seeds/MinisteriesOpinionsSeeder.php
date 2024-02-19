<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MinisteriesOpinionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("ministeries_opinions")->insert([
            [
                "title" => "04.06.2021 Yükleme Duyurusu Büro ve Arabulucu Bilgilendirme",
                "file" => "1.pdf",
                "order" => 0,
            ],
            [
                "title" => "18-5 Gereğince Dava Şartı Başvurusu Olmaz",
                "file" => "2.pdf",
                "order" => 1
            ],
            [
                "title" => "Arabulucu Belirleme Tutanağı Kaydedilmesin",
                "file" => "3.pdf",
                "order" => 2
            ],
            [
                "title" => "Arabulucu Talep Dilekçesi Gönderme",
                "file" => "4.pdf",
                "order" => 3
            ],
            [
                "title" => "Arabuluculuk Aidatlarına İlişkin Duyuru",
                "file" => "5.pdf",
                "order" => 4
            ],
            [
                "title" => "Arabuluculuk Dosya Türü Değişikliğinde Mahkemelerin Arabuluculuk Sürecini Görebilmeleri Hakkında Görüş",
                "file" => "6.pdf",
                "order" => 5
            ],
            [
                "title" => "Arabuluculuk Ücretlerinde KDV Tevkifatı Uygulanması Hakkında",
                "file" => "7.pdf",
                "order" => 6
            ],
            [
                "title" => "Arabuluculuk Ücretlerinin Ödenmesinde Makbuz Düzenlenmesi Hakkında Duyuru",
                "file" => "8.pdf",
                "order" => 7
            ],
            [
                "title" => "Avukatlık AÜT (2022) Md.16-2",
                "file" => "9.pdf",
                "order" => 8
            ],
            [
                "title" => "Bir Uyuşmazlığın Dava Şartı Kapsamında Olup Olmadığı ve Uyuşmazlık Türünün Belirlenmesine İlişkin Görüş",
                "file" => "10.pdf",
                "order" => 9
            ],
            [
                "title" => "Dosya Türü Değişikliği Talebi ile İlgili Görüş Talebi",
                "file" => "11.pdf",
                "order" => 10
            ],
            [
                "title" => "Gelir İdaresi Başkanlığı - Özelge",
                "file" => "12.pdf",
                "order" => 11
            ],
            [
                "title" => "Görüşmelerin Yüzyüze Yapılması Talebi",
                "file" => "13.pdf",
                "order" => 12
            ],
            [
                "title" => "İcra Dosyalarına İlişkin Arabuluculuk Uygulamaları Hakkında Görüş",
                "file" => "14.pdf",
                "order" => 13
            ],
            [
                "title" => "KDV Genel Uygulama Tebliği",
                "file" => "15.pdf",
                "order" => 14
            ],
            [
                "title" => "Kira Uyuşmazlıklarında Arabuluculuk Ücretinin Belirlenmesi",
                "file" => "16.pdf",
                "order" => 15
            ],
            [
                "title" => "Mekanlar En Az 3 Odalı Olmalı",
                "file" => "17.pdf",
                "order" => 16
            ],
            [
                "title" => "Puan İadesine İlişkin Duyuru",
                "file" => "18.pdf",
                "order" => 17
            ],
            [
                "title" => "Yıllara Göre Arabuluculuk Aidatları (2023)",
                "file" => "19.pdf",
                "order" => 18
            ]
        ]);
    }
}
