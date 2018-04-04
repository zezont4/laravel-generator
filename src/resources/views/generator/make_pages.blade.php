@extends('package_views::layouts.master')
@section('title','صفحة إنشاء الأكواد - Code Generation')
@section('header')
    <link rel="stylesheet" href="{{asset('zezont4/laravel_generator/css/prism.css')}}">
    <style>
        pre {
            direction: ltr;
            max-height: 350px;
        }
    </style>
@stop
@section('content')
    <form method="post" action="/laravel_generator/make_pages">
        {{ csrf_field() }}

        {{\Form::mtText('model_name','اسم المودل - Model Name',str_singular($model_name))}}

        {{\Form::mtText('table_label','عنوان الجدول - Table label',$table_label)}}

        {{\Form::mtButton('حفظ و إنشاء الصفحات - Apply and generate pages','red lighten-2 left')}}

    </form>

    @include('package_views::layouts.code',[
        'id'=>'routes_with_middleware',
        'language'=>'php',
        'description'=>'Copy to "app\Http\Routes.php".',
        'page_name'=>'routes.html'])

    @include('package_views::layouts.code',[
        'id'=>'routes_without_middleware',
        'language'=>'php',
        'description'=>'Copy to "app\Http\Routes.php".',
        'page_name'=>'routes_without_middleware.html'])

    @include('package_views::layouts.views_pages',['page'=>'language'])
    {{--@include('package_views::layouts.code',[
        'id'=>'RouteServiceProvider',
        'language'=>'php',
        'description'=>'copy to app/Providers/RouteServiceProvider.php inside boot method.',
        'page_name'=>'route_service_provider.html'])--}}

    {{-- @include('package_views::layouts.code',[
         'id'=>'Artisan',
         'language'=>'bash',
         'description'=>'run with Mac OS Terminal Or Windows Command prompt "cmd".',
         'page_name'=>'artisan.html'])--}}

    @include('package_views::layouts.code',[
        'id'=>'sql',
        'language'=>'sql',
        'description'=>'if you need timestamps then run this in mysql.',
        'page_name'=>'sql.html'])


    @if(!is_dir(app_path(config('zlg.model_path'))))
        <?php mkdir(app_path(config('zlg.model_path')));?>
    @endif

    @include('package_views::layouts.code',[
        'id'=>'model',
        'language'=>'php',
        'description'=>"Copy to (app\\".config('zlg.model_path')."{$model_name}.php)",
        'page_name'=>'model.html',
        'write_to_path'=>config('zlg.model_path')."{$model_name}" ])

    @include('package_views::layouts.code',[
        'id'=>'request',
        'language'=>'php',
        'description'=>"Copy to (app\\Http\\Requests\\{$model_name}Request.php)",
        'page_name'=>'request.html',
        'write_to_path'=>"Http/Requests/{$model_name}Request"])

    @include('package_views::layouts.code',[
        'id'=>'controller',
        'language'=>'php',
        'description'=>"Copy to (app\\Http\\Controller\\{$model_name}Controller.php)",
        'page_name'=>'controller.html',
        'write_to_path'=>"Http/Controllers/{$model_name}Controller"])




    @include('package_views::layouts.views_pages',['page'=>'_form'])

    @include('package_views::layouts.views_pages',['page'=>'show'])

    @include('package_views::layouts.views_pages',['page'=>'create'])
    @if(file_exists(base_path()."/resources/views/".strtolower($model_name)."/create.blade.php"))
        <a href="/{{strtolower($model_name)}}/create">Visit {{snake_case($model_name)}} create page</a>
    @endif

    @include('package_views::layouts.views_pages',['page'=>'edit'])

    @include('package_views::layouts.views_pages',['page'=>'index'])
    @if(file_exists(base_path()."/resources/views/".strtolower($model_name)."/index.blade.php"))
        <a href="/{{strtolower($model_name)}}s">Visit {{snake_case($model_name)}} index page</a>
    @endif

{{--    @include('package_views::layouts.views_pages',['page'=>'_search'])--}}

    @include('package_views::layouts.views_pages',['page'=>'search'])
    @if(file_exists(base_path()."/resources/views/".strtolower($model_name)."/search.blade.php"))
        <a href="/search/{{strtolower($model_name)}}">Visit {{snake_case($model_name)}} search page</a>
    @endif

@stop

@section('footer')
    <script src="{{asset('zezont4/laravel_generator/js/prism.js')}}"></script>
    <script>
        function selectElementContents(el) {
            if (window.getSelection && document.createRange) {
                // IE 9 and non-IE
                var range = document.createRange();
                range.selectNodeContents(el);
                var sel = window.getSelection();
                sel.removeAllRanges();
                sel.addRange(range);
            } else if (document.body.createTextRange) {
                // IE < 9
                var textRange = document.body.createTextRange();
                textRange.moveToElementText(el);
                textRange.select();
            }
        }
    </script>
@stop
