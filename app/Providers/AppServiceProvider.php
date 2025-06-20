<?php

namespace App\Providers;
use App\Models\Pendaftaran;
use App\Observers\PendaftaranObserver;
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
        Pendaftaran::observe(PendaftaranObserver::class);
    }
}
