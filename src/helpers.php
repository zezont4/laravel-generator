<?php

if (!function_exists('yse_no')) {
    function yes_no($value = null)
    {
        $yes_no = [
            0 => 'لا',
            1 => 'نعم',
        ];

        if (!is_null($value)) {
            if ($value === 0 || $value === 1) {
                return $yes_no[$value];
            } elseif ($value !== 0 && $value !== 1) {
                return 'غير معروف';
            }
        } else {
            return $yes_no;
        }

    }
}
if (!function_exists('generateLanguagePage')) {
    function generateLanguagePage()
    {
        $required_fields = '';
        foreach (session('fields_array') as $field) {
            if ($field['is_selected'] && $field['is_required']) {
                $required_fields .= "'" . $field['name'] . "'   =>  '" . $field['label'] . "',\n\t\t";
            }
        }

        return $required_fields;
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
            if ($field['is_selected'] && $field['is_required']) {
                $required_fields .= "'" . $field['name'] . "'   =>  'required',\n\t\t";
            }
        }

        return $required_fields;
    }
}

if (!function_exists('convertTemplateVariables')) {
    function convertTemplateVariables($page_name)
    {
        $content = file_get_contents(base_path() . "/vendor/zezont4/laravel-generator/src/pages-template/{$page_name}");
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
    function generateMaterializeShowPage($model_name, $page_title, $primary_key)
    {
        $htmlCode = "
@extends('layouts.master')

@section('title',' " . $page_title . " / عرض ')

@section('content')

";
        $lower_model_name = strtolower($model_name);

        foreach (session('fields_array') as $field) {
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
        <a class='waves-effect waves-light btn left red lighten-2' href='{{route('{$lower_model_name}.edit',$" . $lower_model_name . "->" . $primary_key . ")}}'>تعديل</a>
    </div>

@stop";
        return $htmlCode;

    }
}

if (!function_exists('generateMaterializeFormPage')) {
    function generateMaterializeFormPage()
    {
        $htmlCode = "";
//        $lower_model_name = strtolower($model_name);
        foreach (session('fields_array') as $field) {
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
    function generateMaterializeEditPage($model_name, $page_title, $primary_key)
    {
        $lower_model_name = strtolower($model_name);

        $htmlCode = "
@extends('layouts.master')

@section('title',' " . $page_title . " / تعديل')

@section('content')

    {!! \\Form::model($" . $lower_model_name . ", ['route' => ['" . $lower_model_name . ".update', $" . $lower_model_name . "->" . $primary_key . "], 'method' => 'put']) !!}

    @include('" . $lower_model_name . "._form',['btnLabel' => 'تحديث','formType' => 'update'])

    {!! \\Form::close() !!}

    @if($" . $lower_model_name . "->trashed())

         <p class='left red-text lighten-2 mid-size-font'>هذا السجل محذوف</p>

        {{ \\Form::open(['route' => ['" . $lower_model_name . ".restore', \$" . $lower_model_name . "->" . $primary_key . "]]) }}
        {{ \\Form::mtButton('استعادة', 'left btn-flat waves-green green-text') }}
        {{ \\Form::close() }}
    @else
        {{ \\Form::open(['route' => ['" . $lower_model_name . ".destroy', \$" . $lower_model_name . "->" . $primary_key . "], 'method' => 'delete']) }}
        {{ \\Form::mtButton('حذف', 'left btn-flat waves-red red-text') }}
        {{ \\Form::close() }}
    @endif

@stop";
        return $htmlCode;
    }
}

if (!function_exists('generateMaterializeIndexPage')) {
    function generateMaterializeIndexPage($model_name, $page_title, $primary_key)
    {
        $lower_model_name = strtolower($model_name);
        $htmlCode = "
@extends('layouts.master')
@section('title','$page_title')
@section('content')
<a title='إضافة جديد' href='{{route(\"" . $lower_model_name . ".create\")}}' class='btn waves-effect waves-light  blue'>جديد<i class=\"material-icons left\">add</i></a>
<a title='بحث متقدم' href='{{route(\"" . $lower_model_name . ".search\")}}' class='btn waves-effect waves-light left blue'>بحث متقدم<i class=\"material-icons left\">search</i></a>
@if(count($" . $lower_model_name . "s))

 <table class='highlight responsive-table'>
    <thead>
        <tr>
";
        foreach (session('fields_array') as $field) {
            if ($field['is_selected']) {
                $htmlCode .= "\t\t<th><a href=\"{{route('" . $lower_model_name . ".index', \Request::except('sort') + ['sort' => '" . $field['name'] . "']  ) }}\">{$field['label']}</a></th>\n";
            }
        }
        $htmlCode .= "
        <th>&nbsp;</th>
        </tr>

        </thead>
        <tr class='hide-on-print-only'>
{{ Form::open(['route' => '" . $lower_model_name . ".index', 'method' => 'get']) }}
    ";

        foreach (session('fields_array') as $field) {
            if ($field['is_selected']) {
                if ($field['type'] == 'text') {
                    $htmlCode .= "\t\t<td>{{ \\Form::text('{$field['name']}',request('{$field["name"]}', \$default = null))}}</td>\n";
                } elseif ($field['type'] == 'radio' || $field['type'] == 'check') {
                    $htmlCode .= "\t\t<td>{{ \\Form::select('{$field['name']}',yes_no(),request('{$field["name"]}', \$default = null),['placeholder' => 'اختر..','class'=>'browser-default'])}}</td>\n";
                } elseif ($field['type'] != 'text') {
                    $htmlCode .= "\t\t<td>&nbsp;</td>\n";
                }
            }
        }

        $htmlCode .= "
        <td><input type='submit'  value='  بحث  ' class='btn no-padding blue' /></td>
        {{ Form::close() }}
        </tr>

        ";

        $htmlCode .= "@foreach($" . $lower_model_name . "s as $" . $lower_model_name . ")
    <tr>
   ";
        foreach (session('fields_array') as $field) {
            $type = $field['type'];
            if ($field['is_selected']) {
                if ($type == 'select' || $type == 'radio' || $type == 'checkbox') {
                    $htmlCode .= "\t\t<td>{{  yes_no($" . $lower_model_name . "->" . $field['name'] . ") }}</td>\n";
                } else {
                    $htmlCode .= "\t\t<td>{{ $" . $lower_model_name . "->" . $field['name'] . "  }}</td>\n";
                }
            }
        }
        $htmlCode .= "
    \t<td><a href=\"{{ route('" . $lower_model_name . ".edit',  ['id' => $" . $lower_model_name . "->" . $primary_key . "] ) }}\">تعديل</a></td>
    <tr>
    @endforeach
</table>
    <div class='section'>
        {!! $" . $lower_model_name . "s->appends(\Request::query())->render() !!}
    </div>

    @else
        <div class='center-align red-text lighten-2'>
            <h3>لا توجد نتائج </h3>
        </div>
@endif

@if($" . $lower_model_name . "s->currentPage()>=$" . $lower_model_name . "s->lastPage())
        @if(isset(\$trashed" . $lower_model_name . "s))
            @include('layouts.trashed',[
            'modelName' => '" . $lower_model_name . "',
            'trashed' => \$trashed" . $lower_model_name . "s,
             'data' => [
         ";
        foreach (session('fields_array') as $field) {
            if ($field['is_selected']) {
                $htmlCode .= "\t\t'{$field['label']}' => '{$field['name']}',\n";
            }
        }
        $htmlCode .= "]
        ])
@endif
@endif
@stop";

        return $htmlCode;
    }
}

if (!function_exists('generateMaterializeSearchPage')) {
    function generateMaterializeSearchPage($model_name, $page_title)
    {
        $lower_model_name = strtolower($model_name);

        $htmlCode = "
@extends('layouts.master')

@section('title','$page_title / بحث')

{{--@section('container_style','max-width: 602px;')--}}

@section('content')

    {{ Form::open(['route' => '" . $lower_model_name . ".index', 'method' => 'get']) }}

    @include('" . $lower_model_name . "._form',['btnLabel' => 'بحث','formType' => 'search'])

    {{ Form::close() }}

@stop";

        return $htmlCode;
    }
}