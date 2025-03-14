<?php
namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class SwaggerUiServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $developer_mails = explode(',', Config::get('developer.developer_mails'));

        Gate::define('viewSwaggerUI', function ($user = null) use ($developer_mails) {
            return in_array(optional($user)->email, $developer_mails);
        });
    }
}
