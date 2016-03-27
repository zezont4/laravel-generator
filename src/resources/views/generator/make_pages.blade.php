@extends('package_views::layouts.master')
@section('title','صفحة إنشاء الأكواد - Code Generation')
@section('header')
    <form method="post" action="/laravel_generator/make_pages">
        {{ csrf_field() }}
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="table_name" id="table_name" value="{{old('table_name')}}">
                <label for="table_name">اسم الجدول - Table Name</label>
            </div>
        </div>
    </form>
@stop