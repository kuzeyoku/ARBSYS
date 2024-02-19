<?php

use App\Models\Side\SideApplicantType;
use Illuminate\Database\Seeder;

class SideApplicantTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lawsuit_types = [
            ['name' => 'Şahıs'],
            ['name' => 'Şirket'],
            ['name' => 'Avukat'],
            ['name' => 'Yetkili'],
            ['name' => 'Çalışan']
        ];

        foreach ($lawsuit_types as $name) {
            SideApplicantType::create(
                $name
            );
        }
    }
}
