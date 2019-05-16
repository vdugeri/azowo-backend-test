<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SubscriptionsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            'App\Http\Repositories\Contracts\SubscriptionContract',
            'App\Http\Repositories\SubscriptionRepository'
        );
    }
}
