@extends('package_views::layouts.master')
@section('title','الحقول')
@section('content')
    <div style="direction: ltr">
        <h3 class = "header">الجداول</h3>
        @foreach($tables as $table)
            <h5><a href = "/laravel_generator/{{$table->$field_name_for_table_name}}/show_fields">{{$table->$field_name_for_table_name}}</a></h5>
        @endforeach

        <h3 class = "header">Views</h3>
        @foreach($views as $view)
            <h5>{{$view->$field_name_for_table_name}}</h5>
        @endforeach
    </div>
@stop