# Laravel 5 Generator
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
### Requirements
    PHP >= 5.5.9
    Laravel >=5.2
    Auto Loaded : [laravelcollective/html package for form & html](https://laravelcollective.com/docs/5.2/html)

## HOW IT WORKS ?

#### Select your MySql table then Laravel Generator will generate :
-Model
-Controller
-Request
-Forms (index,search,show,edit,create) using Materialize Css

#### It's a little bit smart , So it will do the following:
-Field comment in database will be the Label , if not exists thin the field name.
-If the field does not allow Null then it will be required in the request.
-If type of field is TINYINT(1) then the Input will be Radio (Optional).

#### For security , It only work if *APP_ENV=local* in .env file.

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

3. Publish assets and components files.
``` bash
    php artisan vendor:publish --force
```

4. Visit (http://your_host_name/*laravel_generator*)

## Credits

- [Abdulaziz Tayyer][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/zezont4/laravel-generator.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/zezont4/laravel-generator.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/zezont4/laravel-generator
[link-downloads]: https://packagist.org/packages/zezont4/laravel-generator
[link-author]: https://github.com/zezont4
[link-contributors]: ../../contributors
