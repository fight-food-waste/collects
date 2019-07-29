<?php

namespace App\Providers;

use App\Address;
use Illuminate\Support\ServiceProvider;
use App\Observers\AddressObserver;

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
        Address::observe(AddressObserver::class);
    }
}
