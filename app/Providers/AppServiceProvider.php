<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\CarRepository;
use App\Repositories\Contracts\CarRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Registration of CarRepository
        $this->app->bind(CarRepositoryInterface::class, CarRepository::class);
    }
}
