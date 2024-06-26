<?php

namespace Revolution\Socialite\Amazon;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class AmazonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the service provider.
     */
    public function boot(): void
    {
        Socialite::extend('amazon', function ($app) {
            $config = $app['config']['services.amazon'];

            return Socialite::buildProvider(AmazonProvider::class, $config);
        });
    }
}
