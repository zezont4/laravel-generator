<?php
namespace Zezont4\LaravelGenerator;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class LaravelGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // use this if your package has views
        $this->loadViewsFrom(realpath(__DIR__.'/resources/views'), 'LaravelGenerator');

        // use this if your package has lang files
//        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'LaravelGenerator');

        // use this if your package has routes
        $this->setupRoutes($this->app->router);

        // use this if your package needs a config file
        // $this->publishes([
        //         __DIR__.'/config/config.php' => config_path('LaravelGenerator.php'),
        // ]);

        // use the vendor configuration file as fallback
        // $this->mergeConfigFrom(
        //     __DIR__.'/config/config.php', 'LaravelGenerator'
        // );
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Zezont4\LaravelGenerator\Http\Controllers'], function($router)
        {
            require __DIR__.'/Http/routes.php';
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerLaravelGenerator();

        // use this if your package has a config file
        // config([
        //         'config/LaravelGenerator.php',
        // ]);
    }

    private function registerLaravelGenerator()
    {
        $this->app->bind('LaravelGenerator',function($app){
            return new LaravelGenerator($app);
        });
    }
}