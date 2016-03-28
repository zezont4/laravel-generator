<?php
if (!function_exists('selected_fields')) {
    function selected_fields()
    {
        $selected_fields = [];
        foreach (session('fields_array') as $field) {
            if ($field['is_selected']) {
                array_push($selected_fields, $field['name']);
            }
        }

        return "'" . implode("',\n\t\t'", $selected_fields) . "'";
    }
}

if (!function_exists('required_fields')) {
    function required_fields()
    {
        $required_fields = '';
        foreach (session('fields_array') as $field) {
            if ($field['is_required']) {
                $required_fields .= "'" . $field['name'] . "'   =>  'required',\n\t\t";
            }
        }

        return $required_fields;
    }
}

if (!function_exists('convertVariables')) {
    function convertVariables($path)
    {
        $content = file_get_contents('http://' . $_SERVER['HTTP_HOST'] . "/zezont4/laravel_generator/templates/{$path}");
        $prefix = '<code>';
        $suffix = '</code>';
        $replace_with = [
                $prefix . 'lower_case_model_name' . $suffix => strtolower(session('model_name')),
                $prefix . 'model_name' . $suffix            => session('model_name'),
                $prefix . 'table_name' . $suffix            => session('table_name'),
                $prefix . 'selected_fields' . $suffix       => selected_fields(),
                $prefix . 'required_fields' . $suffix       => required_fields()
        ];
        $result = $content;
        foreach ($replace_with as $key => $value) {
            $result = str_replace($key, $value, $result);
        }

        return $result;
    }
}

?>
@extends('package_views::layouts.master')
@section('title','صفحة إنشاء الأكواد - Code Generation')
@section('header')
    <link rel = "stylesheet" href = "{{asset('zezont4/laravel_generator/css/prism.css')}}">
    <style>
        pre {
            direction: ltr;
            max-height: 350px;
        }
    </style>
@stop
@section('content')
    <form method = "get" action = "/laravel_generator/make_pages">
        {{ csrf_field() }}

        {{\Form::mtText('model_name','اسم المودل - Model Name',$model_name)}}

        {{\Form::mtText('table_label','عنوان الجدول - Table label',$table_label)}}

        {{\Form::mtButton('تطبيق - Apply','red lighten-2 left')}}

    </form>

    @include('package_views::layouts.code',[
    'id'=>'Routes',
    'language'=>'php',
    'description'=>'Copy to "app\Http\Routes.php".',
    'url'=>'Routes.html'])

    @include('package_views::layouts.code',[
    'id'=>'RouteServiceProvider',
    'language'=>'php',
    'description'=>'copy to app/Providers/RouteServiceProvider.php inside boot method.',
    'url'=>'RouteServiceProvider.html'])

    @include('package_views::layouts.code',[
        'id'=>'Artisan',
        'language'=>'bash',
        'description'=>'run with Mac OS Termenal Or Windows Command prompt "cmd".',
        'url'=>'artisan.html'])

    @include('package_views::layouts.code',[
        'id'=>'sql',
        'language'=>'sql',
        'description'=>'if you need timestamps then run this in mysql.',
        'url'=>'sql.html'])

    @include('package_views::layouts.code',[
        'id'=>'model',
        'language'=>'php',
        'description'=>"Copy to (app\\Models\\{$model_name}.php)",
        'url'=>'model.html'])

    <?php

    file_put_contents(base_path()."/app/Models/{$model_name}.php", convertVariables('model.html'));
    ?>

    @include('package_views::layouts.code',[
        'id'=>'request',
        'language'=>'php',
        'description'=>"Copy to (app\\Http\\Requests\\{$model_name}Request.php)",
        'url'=>'request.html'])

    @include('package_views::layouts.code',[
        'id'=>'controller',
        'language'=>'php',
        'description'=>"Copy to (app\\Http\\Controller\\{$model_name}Controller.php)",
        'url'=>'controller.html'])

    {{--@include('package_views::generator.pages.routs')--}}
    {{--@include('package_views::generator.pages.artisan')--}}
    {{--@include('package_views::generator.pages.sql')--}}
    {{--@include('package_views::generator.pages.model')--}}

@stop

@section('footer')
    <script src = "{{asset('zezont4/laravel_generator/js/prism.js')}}"></script>
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
