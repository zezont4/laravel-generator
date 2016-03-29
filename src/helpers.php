<?php

if (!function_exists('yse_no')) {
    function yes_no($value = null)
    {
        $yes_no = [
            0 => 'لا',
            1 => 'نعم',
        ];

        if ($value) {
            return $yes_no[$value];
        }

        return $yes_no;
    }
}
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
            $prefix . 'primary_key' . $suffix           => session('primary_key'),
            $prefix . 'selected_fields' . $suffix       => selected_fields(),
            $prefix . 'required_fields' . $suffix       => required_fields(),
        ];
        $result = $content;
        foreach ($replace_with as $key => $value) {
            $result = str_replace($key, $value, $result);
        }

        return $result;
    }
}

if (!function_exists('generateMaterializeShowPage')) {
    function generateMaterializeShowPage(Array $fields, $model_name, $page_title)
    {
        $htmlCode = "
@extends('layouts.master')

@section('title',' " . $page_title . " / عرض ')

@section('content')

";
        $lower_model_name = strtolower($model_name);

        foreach ($fields as $field) {
            if ($field['is_selected']) {
                $type = $field['type'];
                if ($type == 'select' || $type == 'radio' || $type == 'checkbox') {

                    $htmlCode .= "{{ \\Form::mtStatic('{$field["label"]}', yes_no(\$$lower_model_name->{$field['name']})  ) }}\n\n\t";

                } else {

                    $htmlCode .= "{{ \\Form::mtStatic('{$field["label"]}', \$$lower_model_name->{$field['name']}  ) }}\n\n\t";

                }

            }
        }
        $htmlCode .= "
    <div class='section'>
        <a class='waves-effect waves-light btn left red lighten-2' href='{{route('{$lower_model_name}.edit',$" . $lower_model_name . "->id)}}'>تعديل</a>
    </div>

@stop";
        return $htmlCode;

    }
}

if (!function_exists('generateMaterializeFormPage')) {
    function generateMaterializeFormPage(Array $fields, $model_name, $page_title)
    {
        $htmlCode = "";
        $lower_model_name = strtolower($model_name);
        foreach ($fields as $field) {
            if ($field['is_selected']) {
                $type = $field['type'];
                if ($type == 'text') {

                    $htmlCode .= "{{ \\Form::mtText('{$field["name"]}','{$field["label"]}' ) }}\n\n";

                } elseif ($type == 'password') {

                    $htmlCode .= "{{ \\Form::mtPassword('{$field["name"]}','{$field["label"]}' ) }}\n\n";

                } elseif ($type == 'select') {

                    $htmlCode .= "{{ \\Form::mtSelect('{$field["name"]}','{$field["label"]}',null,yes_no() ) }}\n\n";

                } elseif ($type == 'radio') {

                    $htmlCode .= "{{ \\Form::mtRadio('{$field["name"]}','{$field["label"]}',null,yes_no() ) }}\n\n";

                } elseif ($type == 'checkbox') {

                    $htmlCode .= "{{ \\Form::mtCheck('{$field["name"]}','{$field["label"]}',null,yes_no() ) }}\n\n";

                }
            }
        }
        $htmlCode .= "
<div class='section'>
     {{ \\Form::mtButton(\$btnLabel, 'left red lighten-2') }}
</div>";

        return $htmlCode;
    }
}


if (!function_exists('generateMaterializeCreatePage')) {
    function generateMaterializeCreatePage($model_name, $page_title)
    {
        $lower_model_name = strtolower($model_name);
        $htmlCode = "
@extends('layouts.master')

@section('title',' " . $page_title . " / جديد')

@section('content')

    {{ \\Form::open(['route' => '" . $lower_model_name . ".store']) }}

    @include('" . $lower_model_name . "._form',['btnLabel' => 'إضافة','formType' => 'create'])

    {{ \\Form::close() }}

@stop";
        return $htmlCode;

    }
}

if (!function_exists('generateMaterializeEditPage')) {
    function generateMaterializeEditPage($model_name, $page_title,$primary_key)
    {
        $lower_model_name = strtolower($model_name);

        $htmlCode = "
@extends('layouts.master')

@section('title',' " . $page_title . " / تعديل')

@section('content')

    {!! \\Form::model($" . $lower_model_name . ", ['route' => ['" . $lower_model_name . ".update', $" . $lower_model_name . "->".$primary_key."], 'method' => 'put']) !!}

    @include('" . $lower_model_name . "._form',['btnLabel' => 'تحديث','formType' => 'update'])

    {!! \\Form::close() !!}

    @if($" . $lower_model_name . "->trashed())

         <p class='left red-text lighten-2 mid-size-font'>هذا السجل محذوف</p>

        {{ \\Form::open(['route' => ['" . $lower_model_name . ".restore', \$" . $lower_model_name . "->".$primary_key."]]) }}
        {{ \\Form::mtButton('استعادة', 'left btn-flat waves-green green-text') }}
        {{ \\Form::close() }}
    @else
        {{ \\Form::open(['route' => ['" . $lower_model_name . ".destroy', \$" . $lower_model_name . "->".$primary_key."], 'method' => 'delete']) }}
        {{ \\Form::mtButton('حذف', 'left btn-flat waves-red red-text') }}
        {{ \\Form::close() }}
    @endif

@stop";
        return $htmlCode;
    }
}
