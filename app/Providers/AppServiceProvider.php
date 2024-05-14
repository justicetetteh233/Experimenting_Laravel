<?php

namespace App\Providers;
use App\Models\User;
use App\Models\Position;
use Illuminate\Support\Facades\Gate;

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
    public function boot():void
    {
        Gate::define('update-user', function (User $loginUser) {
        return $loginUser->user_type === "electoralCommissioner";
        });

        Gate::define('Right-Manage-positions', function (User $loginUser) {
        return $loginUser->user_type === "electoralCommissioner";
        });
    }
}
