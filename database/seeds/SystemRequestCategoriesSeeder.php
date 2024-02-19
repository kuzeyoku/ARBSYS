<?php

use App\Models\Side\SideType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\System\SystemRequest;
use App\Models\System\SystemRequestCategory;

class SystemRequestCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("system_request_categories")->insert(
            [
                ['name' => 'Görüş'],
                ["name" => "Öneri",],
                ["name" => "İstek",],
                ["name" => "Şikayet",],
                ["name" => "Diğer",]
            ]
        );
    }
}
