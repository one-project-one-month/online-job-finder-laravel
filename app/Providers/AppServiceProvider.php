<?php

namespace App\Providers;

use App\Models\Review\Review;
use App\Policies\ReviewPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Policies\SocialMedia\SocialMediaPolicy;
use App\Repositories\Locations\LocationRepository;
use App\Repositories\Locations\LocationRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
    }

    public function boot()
    {
        Gate::define('update', [SocialMediaPolicy::class, 'update']);
        Gate::define('delete', [SocialMediaPolicy::class, 'delete']);

        Gate::policy(Review::class, ReviewPolicy::class);
    }
}

