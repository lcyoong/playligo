<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class FormErrorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        App::bind('formerror', function(){
        	return new \App\Playligo\FormError\ErrorBuilder;
        });
    }
}
