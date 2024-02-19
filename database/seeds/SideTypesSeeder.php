<?php

use App\Models\Side\SideType;
use Illuminate\Database\Seeder;

class SideTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lawsuit_types = [
            ['name' => 'Başvurucu Taraf'],
            ['name' => 'Karşı Taraf']
        ];

        foreach ($lawsuit_types as $name) {
            SideType::create(
                $name
            );
        }
    }
}
