<?php

use App\Models\System\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Yönetici'],
            ['name' => 'Arabulucu'],
        ]);
    }
}
