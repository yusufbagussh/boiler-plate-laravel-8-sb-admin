<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
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
        //Menggunakan template boostrap untuk halaman
        Paginator::useBootstrap();
        //Membuat aturan authorization superadmin yaitu id role bukan 1
        Gate::define('admin', function (User $user) {
            return $user->role === "admin";
        });
        Gate::define('superadmin', function (User $user) {
            return $user->role === "super admin";
        });
    }
}
