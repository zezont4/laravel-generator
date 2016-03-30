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

        $this->loadZezont4Components();

        $this->loadZezont4BladeDirectives();
    }


    public function register()
    {
        $this->app->bind('LaravelGenerator', function ($app) {
            return new LaravelGenerator($app);
        });
    }


    public function loadZezont4Components()
    {
        \Form::component('mtText', 'zezont4.components.form.text', ['name', 'label', 'value' => null, 'attributes' => []]);
        \Form::component('mtTel', 'zezont4.components.form.tel', ['name', 'label', 'value' => null, 'attributes' => []]);
        \Form::component('mtPassword', 'zezont4.components.form.password', ['name', 'label', 'attributes' => []]);

        \Form::component('mtRadio', 'zezont4.components.form.radio', ['name', 'label', 'value' => null, 'values', 'attributes' => []]);
        \Form::component('mtCheck', 'zezont4.components.form.check', ['name', 'label', 'value' => null, 'values', 'attributes' => []]);
        \Form::component('mtSelect', 'zezont4.components.form.select', ['name', 'label', 'value' => null, 'values', 'attributes' => []]);

        \Form::component('mtButton', 'zezont4.components.form.button', ['label', 'class' => 'waves-light btn']);

        \Form::component('mtStatic', 'zezont4.components.form.static', ['label', 'value']);
    }

    public function loadZezont4BladeDirectives()
    {
        \Blade::directive('hasRole', function ($role_slug) {
            return "<?php if (auth()->check()) :
				if (auth()->user()->hasRole{$role_slug}) : ?>";
        });

        \Blade::directive('endhasRole', function () {
            return "<?php endif; endif; ?>";
        });
    }

}

