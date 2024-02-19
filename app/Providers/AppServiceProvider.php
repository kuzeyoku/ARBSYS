<?php

namespace App\Providers;

use App\Models\Notification\Notification;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
        setLocale(LC_TIME, config('app.locale'));

        view()->composer(
            [
                '*'
            ],
            function ($view) {
                $notifications = Notification::where('user_id', auth()->id())->get();
                $view->with('notifications', $notifications);

                $demands = \App\Models\User\User::whereChangeRequest(true)->count();
                $view->with("demands", $demands);
            }
        );
    }
}
