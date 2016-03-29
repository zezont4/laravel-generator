<?php
namespace Zezont4\LaravelGenerator;

use Illuminate\Support\ServiceProvider;

class LaravelGeneratorServiceProvider extends ServiceProvider
{

    public function boot()
    {

        $this->loadViewsFrom(realpath(__DIR__ . '/resources/views'), 'package_views');

        $this->app->router->group(['namespace' => 'Zezont4\LaravelGenerator\Controllers'], function ($router) {
            require __DIR__ . '/routes.php';
        });

        $this->publishes([
            __DIR__ . '/publish/assets' => public_path('zezont4/laravel_generator'),
        ], 'assets');

        $this->publishes([
            __DIR__ . '/publish/components' => resource_path('views/zezont4/components'),
        ], 'components');

        $this->publishes([
            __DIR__ . '/publish/templates' => public_path('zezont4/laravel_generator/templates'),
        ], 'templates');

        $this->publishes([
            __DIR__ . '/publish/Traits/FlashMessageAfterSaving.html' => app_path('Traits/FlashMessageAfterSaving.php'),
        ], 'traits');

        $this->publishes([
            __DIR__ . '/publish/Traits/SearchFormHelper.html' => app_path('Traits/SearchFormHelper.php'),
        ], 'traits');
    }


    public function register()
    {
        $this->app->bind('LaravelGenerator', function ($app) {
            return new LaravelGenerator($app);
        });
    }

}