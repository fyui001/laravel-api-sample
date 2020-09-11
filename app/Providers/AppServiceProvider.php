<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services;
use App\Services\Interfaces;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Application services
     *
     * @var array
     */
    protected $applicationServices = [
        Interfaces\UserServiceInterface::class => Services\UserService::class,
        Interfaces\PhotoServiceInterface::class => Services\PhotoService::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->applicationServices as $interface => $service) {
            $this->app->bind($interface, $service);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
