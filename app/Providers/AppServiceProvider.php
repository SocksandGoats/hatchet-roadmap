<?php

namespace App\Providers;

use App\Oauth\DeKnotProvider;
use Illuminate\Support\Facades\Blade;
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
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->isAdmin();
        });

        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'deknot',
            function ($app) use ($socialite) {
                $config = $app['config']['services.deknot'];

                return $socialite->buildProvider(DeKnotProvider::class, $config);
            }
        );
    }
}
