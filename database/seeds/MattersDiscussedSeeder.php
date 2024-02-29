<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MattersDiscussedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("matters_discusseds")->insert([
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Ayrımcılık Tazminatı Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Asgari Geçim İndirimi (AGİ) Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Bakiye Süre Ücret Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Cezai Şart Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Çocuk Parası Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Eğitim Yardımı Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Fazla Çalışma Ücreti Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Gece Vardiyası Zammı Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Gemiadamı İaşe Bedeli Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Hafta Tatili Ücreti Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Haksız Fesih Tazminatı Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "İhbar Tazminatı Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "İlave Tediye Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "İş Arama İzni Ücreti Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "İşe İade Sonrası Boşta Geçen Süre Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "İşe Başlatmama Tazminatı Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Kıdem Tazminatı Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Kötü niyet Tazminatı Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Manevi Tazminat Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Ölüm Tazminatı Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Prim/ikramiye Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Sendikal Tazminat Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Toplu İş Söz. Kaynaklı Alacaklar"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Transfer Ücreti Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Ulusal Bayram ve Genel Tatil Ücreti"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Ücret (Maaş) Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Yıllık Ücretli İzin Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Yarım Ücret Alacağı"],
            ["lawsuit_subject_type_id" => 3, "lawsuit_subject_id" => 21, "title" => "Yol Parası Alacağı"],
        ]);
    }
}
