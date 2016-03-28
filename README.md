# Laravel Generator

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

# Laravel 5 Generator

### Requirements
    Laravel >=5.2
    PHP >= 5.5.9
    Auto Loaded : [laravelcollective/html package for form & html](https://laravelcollective.com/docs/5.2/html)

Generate the main classes that laravel use to work with database . Like model,controller,request,blade forms.

## Installation

1. Run
``` bash
    composer require zezont4/LaravelGenerator
```

2. Add service provider & Aliases to **/config/app.php** file.
``` php
    'providers' => [
        \\ Other Providers,
        Zezont4\LaravelGenerator\LaravelGeneratorServiceProvider::class,
        Collective\Html\HtmlServiceProvider::class,
    ],

    'aliases' => [
        \\ Other Aliases,
        'Form' => Collective\Html\FormFacade::class,
        'Html' => Collective\Html\HtmlFacade::class,
    ],
```

3. Add these Form components to  **/app/Providers/AppServiceProvider.php** file in **boot()** method .
``` php
        \Form::component('mtText', 'zezont4.components.form.text', ['name', 'label', 'value' => null, 'attributes' => []]);
        \Form::component('mtTel', 'zezont4.components.form.tel', ['name', 'label', 'value' => null, 'attributes' => []]);
        \Form::component('mtPassword', 'zezont4.components.form.password', ['name', 'label', 'attributes' => []]);

        \Form::component('mtRadio', 'zezont4.components.form.radio', ['name', 'label', 'value' => null, 'values', 'attributes' => []]);
        \Form::component('mtCheck', 'zezont4.components.form.check', ['name', 'label', 'value' => null, 'values', 'attributes' => []]);
        \Form::component('mtSelect', 'zezont4.components.form.select', ['name', 'label', 'value' => null, 'values', 'attributes' => []]);

        \Form::component('mtButton', 'zezont4.components.form.button', ['label', 'class' => 'waves-light btn']);

        \Form::component('mtStatic', 'zezont4.components.form.static', ['label', 'value']);
```

4. Publish assets and components files.
``` bash
    php artisan vendor:publish --force
```

5. Visit (http://your_host_name/**laravel_generator**)

## Credits

- [Abdulaziz Tayyer][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/zezont4/LaravelGenerator.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/zezont4/LaravelGenerator/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/zezont4/LaravelGenerator.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/zezont4/LaravelGenerator.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/zezont4/LaravelGenerator.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/zezont4/LaravelGenerator
[link-travis]: https://travis-ci.org/zezont4/LaravelGenerator
[link-scrutinizer]: https://scrutinizer-ci.com/g/zezont4/LaravelGenerator/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/zezont4/LaravelGenerator
[link-downloads]: https://packagist.org/packages/zezont4/LaravelGenerator
[link-author]: https://github.com/zezont4
[link-contributors]: ../../contributors
