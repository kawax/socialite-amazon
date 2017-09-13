<?php

namespace Revolution\Socialite\Amazon;

use Laravel\Socialite\SocialiteServiceProvider;
use Laravel\Socialite\Contracts\Factory;

class AmazonServiceProvider extends SocialiteServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $socialite = $this->app->make(Factory::class);

        $socialite->extend('amazon', function ($app) use ($socialite) {
            $config = $this->app['config']['services.amazon'];

            return $socialite->buildProvider(AmazonProvider::class, $config);
        });
    }
}
