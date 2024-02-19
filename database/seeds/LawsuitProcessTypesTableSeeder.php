<?php

use App\Models\Lawsuit\LawsuitProcessType;
use Illuminate\Database\Seeder;

class LawsuitProcessTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lawsuit_types = [
            ['name' => 'Açık'],
            ['name' => 'Açık – Toplantı günü verildi'],
            ['name' => 'Açık – Görüşmeler başladı / sürüyor'],
            ['name' => 'Süreç sona erdi'],
            ['name' => 'Dosya sistemden kapatıldı'],
        ];

        foreach ($lawsuit_types as $name) {
            LawsuitProcessType::create(
                $name
            );
        }
    }
}
