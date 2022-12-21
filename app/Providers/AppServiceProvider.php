<?php

namespace App\Providers;

use App\Services\HttpClient;
use App\Services\WarehouseService;
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
        $this->app->when(WarehouseService::class)
            ->needs(HttpClient::class)
            ->give(fn () => new HttpClient(config('services.warehouse.url')));
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
