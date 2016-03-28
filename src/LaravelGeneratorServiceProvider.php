<?php
namespace Zezont4\LaravelGenerator;

use Illuminate\Support\ServiceProvider;

class LaravelGeneratorServiceProvider extends ServiceProvider
{

    public function boot()
    {

        $this->loadViewsFrom(realpath(__DIR__ . '/resources/views'), 'package_views');

        $this->app->router->group(['namespace' => 'Zezont4\LaravelGenerator\Http\Controllers'], function ($router) {
            require __DIR__ . '/Http/routes.php';
        });

        $this->publishes([
            __DIR__ . '/resources/assets' => public_path('zezont4/laravel_generator'),
        ], 'assets');

        $this->publishes([
            __DIR__ . '/resources/views/components' => resource_path('views/zezont4/components'),
        ], 'components');

        $this->publishes([
            __DIR__ . '/resources/templates' => public_path('zezont4/laravel_generator/templates'),
        ], 'templates');

        $this->publishes([
            __DIR__ . '/Traits/FlashMessageAfterSaving.html' => app_path('Traits/FlashMessageAfterSaving.php'),
        ], 'traits');

        $this->publishes([
            __DIR__ . '/Traits/SearchFormHelper.html' => app_path('Traits/SearchFormHelper.php'),
        ], 'traits');
    }


    public function register()
    {
        $this->app->bind('LaravelGenerator', function ($app) {
            return new LaravelGenerator($app);
        });
    }

}