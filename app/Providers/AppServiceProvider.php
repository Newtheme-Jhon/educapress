<?php

namespace App\Providers;

use App\Events\UserCreated;
use App\Listeners\UserCreatedListener;
use App\Models\User;
use App\Observers\Admin\UserObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
    }
}
