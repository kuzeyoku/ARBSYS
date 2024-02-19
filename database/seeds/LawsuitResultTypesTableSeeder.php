<?php

use App\Models\Lawsuit\LawsuitResultType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LawsuitResultTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('lawsuit_result_types')->truncate();

        $lawsuit_types = [
            ['name' => 'Anlaşma', "document_type_id" => 6],
            ['name' => 'Görüşme Sonunda Anlaşamama ', "document_type_id" => 7],
            ['name' => 'Görüşme Yapılmadan Anlaşamama ', "document_type_id" => 8],
            ['name' => 'Arabuluculuğa Uygun Olunmaması', "document_type_id" => 9],
            ['name' => 'Konusuz Kalma – Başvurucunun Vazgeçmesi', "document_type_id" => 10],
            ['name' => 'Yetkisizlik', "document_type_id" => 11],
            ['name' => 'Sehven Kayıt', "document_type_id" => 12],
            ['name' => 'Kısmi Anlaşma', "document_type_id" => 13],
            ["name" => "Taraf Katılmadı", "document_type_id" => 14]
        ];

        foreach ($lawsuit_types as $name) {
            LawsuitResultType::create(
                $name
            );
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
