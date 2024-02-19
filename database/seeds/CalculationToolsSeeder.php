<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalculationToolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calculation_tools')->insert([
            [
                "name" => "Arabuluculuk Ücreti Hesaplama",
                "description" => "(Saat Ücreti - AAÜT Birinci Kısım)",
                "status" => false,
                "url" => "/saat-ucreti-aaut-birinci-kisim-hesaplama",
            ],
            [
                "name" => "Arabuluculuk Ücreti Hesaplama",
                "description" => "(Nisbi Ücret - AAÜT İkinci Kısım)",
                "status" => false,
                "url" => "/saat-ucreti-aaut-ikinci-kisim-hesaplama",
            ],
            [
                "name" => "Arabuluculuk Serbest Meslek Makbuzu Hesaplama",
                "description" => "",
                "status" => false,
                "url" => "/serbest-meslek-makbuzu-hesaplama",
            ],
            [
                "name" => "Süre Hesaplama",
                "description" => "(Dava Şartı
                Uygulamalarında)",
                "status" => false,
                "url" => "/dava-sarti-uygulamalarinda-sure-hesaplama",
            ],
            [
                "name" => "Arabuluculuk Asgari Ücret Tarifesi",
                "description" => "",
                "status" => false,
                "url" => "/arabuluculuk-asgari-ucret-tarifesi",
            ],
            [
                "name" => "Savcılıklara Düzenlenecek Makbuz Örnekleri",
                "description" => "",
                "status" => false,
                "url" => "/savciliklara-duzenlenecek-makbuz-ornekleri",
            ],
        ]);
    }
}
