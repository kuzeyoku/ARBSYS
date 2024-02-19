<?php

use App\Models\User\Mediator;
use App\Models\User\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $user = new User();
        $user->name = "Admin";
        $user->email = "admin@arabulucusistemi.com";
        $user->password = bcrypt(123456);
        $user->role_id = RoleOptions::ADMIN;
        $user->is_active = true;
        $user->borndate = "01/01/1999";
        $user->gender = "erkek";
        $user->save();

        $user = new User();
        $user->name = "Ramazan Yüceloğlu";
        $user->email = "sembolbu@yandex.com";
        $user->password = bcrypt(123456);
        $user->role_id = RoleOptions::MEDIATOR;
        $user->is_active = true;
        $user->borndate = "01/01/1999";
        $user->gender = "erkek";
        $user->end = "01-01-2025";
        $user->save();

        $mediator = new Mediator();
        $mediator->user_id = $user->id;
        $mediator->registration_no = time();
        $mediator->save();

        $user = new User();
        $user->name = "Demo Kullanıcı";
        $user->email = "arbsyscomtr@gmail.com";
        $user->password = bcrypt("demouser123456");
        $user->role_id = RoleOptions::MEDIATOR;
        $user->is_active = true;
        $user->borndate = "01/01/2000";
        $user->gender = "erkek";
        $user->end = "01-01-2025";
        $user->save();

        $mediator = new Mediator();
        $mediator->user_id = $user->id;
        $mediator->registration_no = time();
        $mediator->save();
    }
}
