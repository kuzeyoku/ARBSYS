<?php

use App\Models\Notification\NotificationCategory;
use App\Models\Side\SideType;
use Illuminate\Database\Seeder;

class NotificationCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notification_categories = [
            ['name' => 'Bilgi', "name" => "Şikayet"]
        ];

        foreach ($notification_categories as $name) {
            NotificationCategory::create(
                $name
            );
        }
    }
}
