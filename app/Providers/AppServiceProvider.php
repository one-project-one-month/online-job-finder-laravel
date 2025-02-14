<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Locations\LocationRepositoryInterface;
use App\Repositories\Locations\LocationRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
    }

    public function boot()
    {
        //
    }
}

