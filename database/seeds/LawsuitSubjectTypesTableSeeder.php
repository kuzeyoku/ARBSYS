<?php

use App\Models\Lawsuit\LawsuitSubjectType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LawsuitSubjectTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('lawsuit_subject_types')->truncate();
        $lawsuit_types = [
            ['name' => 'Aile Hukuku İle İlgili Uyuşmazlıklar', 'lawsuit_type_id' => 1],
            ['name' => 'Ticari Uyuşmazlıklar', 'lawsuit_type_id' => 1],
            ['name' => 'İşçi - İşveren Uyuşmazlıkları', 'lawsuit_type_id' => 1],
            ['name' => 'Tüketici Uyuşmazlıkları', 'lawsuit_type_id' => 1],
            ["name" => "Kira - Komşuluk - KMK Uyuşmazlıkları", "lawsuit_type_id" => 1],
            ["name" => "Ortaklığın Giderilmesi Uyuşmazlıkları", "lawsuit_type_id" => 1],
            ['name' => 'Diğer Tür Uyuşmazlıklar', 'lawsuit_type_id' => 1]
        ];

        foreach ($lawsuit_types as $type) {
            LawsuitSubjectType::create(
                $type
            );
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
