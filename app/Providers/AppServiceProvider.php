<?php

namespace App\Providers;

use App\Services\Curs\CBRSource;
use App\Services\Curs\CursSourceInterface;
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
        $this->app->bind(CursSourceInterface::class, function () {
            return new CBRSource();
        });
    }
}
