<?php

namespace App\Playligo\FormError;

use Illuminate\Support\ServiceProvider;

class FormErrorServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    	$this->bind('formerror', 'App\Playligo\FormError\ErrorBuilder');
        // $this->registerErrorBuilder();
        // $this->app->alias('formerror', 'App\THouz\FormError\ErrorBuilder');
    }

    /**
     * Register the error builder instance.
     *
     * @return void
     */
    protected function registerErrorBuilder()
    {
        $this->app->singleton('formerror', function ($app) {
            return new ErrorBuilder($app['url'], $app['view']);
        });
    }

}
