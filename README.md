# Laravel 5 Generator
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
### Requirements
    PHP >= 5.5.9
    Laravel >=5.2
    Auto Loaded : [laravelcollective/html package for form & html](https://laravelcollective.com/docs/5.2/html)

## HOW IT WORKS ?

#### Select your MySql table then Laravel Generator will generate :
-Model.
-Controller.
-Request.
-Forms (index "with filters and sorting",search,show,edit,create) using Materialize Css.
-Auto generated Routs and language array.


#### It's a little bit smart , So it will do the following:
-Field comment in database will be the Label , if not exists thin the field name.
-If type of field is TINYINT(1) then the Input type will be Radio (Optional).
-If the field does not allow Null then it will be required in the request.
-if field is set to be unique in database the a **unique** validation will be set.
-if type of field is int the a **numeric** validation will be set.

#### You can configure the models path and messages and buttons labels by changing them in (config/zlg.php) file.

#### You can customize fields template by changing them in (resources/views/zezont4/components/form).

#### For security , It only works if *APP_ENV=local* in .env file.

## Installation

1.  Run
``` bash
    composer require zezont4/LaravelGenerator
```
2.  Add service provider & Aliases to **/config/app.php** file.
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
3.  Publish assets and components files.
``` bash
    php artisan vendor:publish --force
```
4.  Visit (http://your_host_name/*laravel_generator*)
5.  Copy layouts files from **resources/views/copy_to_layouts** to **resources/views/layouts**.
6.  Copy assets  files from **public/copy_to_public**           to **public root**.


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
