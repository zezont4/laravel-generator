@extends('package_views::layouts.master')
@section('title','الجداول Tables')
@section('content')
    <div style="direction: ltr">
        <h4 class="header">الجداول</h4>
        <div class="collection">
            @foreach($tables as $table)
                <a class="collection-item"
                   href="/laravel_generator/{{$table->$field_name_for_table_name}}/show_fields">{{$table->$field_name_for_table_name}}</a>
            @endforeach
        </div>

        <h4 class="header">Views</h4>
        <div class="collection">
            @foreach($views as $view)
                <a class="collection-item"
                   href="/laravel_generator/{{$view->$field_name_for_table_name}}/show_fields">{{$view->$field_name_for_table_name}}</a>
            @endforeach
        </div>
    </div>
@stop