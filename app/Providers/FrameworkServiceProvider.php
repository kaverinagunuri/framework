<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\helper;

class FrameworkServiceProvider extends ServiceProvider {

    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind('Email', function() {
            return new \App\Helpers\helper;
        });
    }

    public function provides() {
        return ['App\Helpers\helper'];
    }

}
