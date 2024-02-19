<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("person_types")->insert(
            [
                [
                    "key" => "person_standard",
                    "name" => "Gerçek Kişi (Standart)",
                    "group" => 1
                ], 
                [
                    "key" => "person_taxpayer",
                    "name" => "Gerçek Kişi (Vergi Mükellefi)",
                    "group" => 1
                ],
                [
                    "key" => "person_lawyer",
                    "name" => "Gerçek Kişi (Avukat)",
                    "group" => 2
                ],
                [
                    "key" => "person_authorized",
                    "name" => "Gerçek Kişi (Yetkili)",
                    "group" => 1
                ],
                [
                    "key" => "person_employee",
                    "name" => "Gerçek Kişi (Çalışan)",
                    "group" => 1
                ],
                [
                    "key" => "person_representative",
                    "name" => "Gerçek Kişi (Kanuni Temsilci)",
                    "group" => 1
                ],
                [
                    "key" => "person_commissioner",
                    "name" => "Gerçek Kişi (Komisyon Üyesi)",
                    "group" => 1
                ],
                [
                    "key" => "company_private",
                    "name" => "Tüzel Kişi &nbsp;&nbsp;&nbsp; (Özel Hukuk)",
                    "group" => 3
                ],
                [
                    "key" => "company_public",
                    "name" => "Tüzel Kişi &nbsp;&nbsp;&nbsp; (Kamu Hukuku)",
                    "group" => 3
                ],
            ]
        );
    }
}
