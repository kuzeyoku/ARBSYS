<?php

use App\Models\System\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LetterOptionsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('letter_options')->insert([
            ['name' => 'Yok'],
            ['name' => 'Standart'],
            ['name' => 'Özel'],
        ]);
    }
}
