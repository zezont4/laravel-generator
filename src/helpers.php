<?php

if (!function_exists('myTrans')) {
	function myTrans($field_name)
	{
		$trans1 = trans('validation.attributes.' . $field_name);
		if (str_contains($trans1, '.')) {
			return ucwords(str_replace("_", " ", $field_name));
		}

		return $trans1;
	}
}

if (!function_exists('arrayValue')) {
	function arrayValue($array, $selected_value)
	{
		if (is_array($array)) {
			if (array_key_exists($selected_value,$array)) {
				return $array[$selected_value];
			}
		}
	}
}

if (!function_exists('yse_no')) {
	function yes_no($value = null)
	{
		$yes_no = [
			1 => 'نعم',
			0 => 'لا',
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
			if ($field['is_selected']) {
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
				$number = str_contains(strtolower($field['data_type']), 'int') ? '|numeric' : '';
				$unique = $field['key'] == 'UNI' ? '|unique:' . session('table_name') . ',' . $field['name'] . ',\'.@$this->route()->id.\',' . session('primary_key') : '';
				$my_date_format = str_contains(strtolower($field['name']), 'date') ? '|date_format:"\'.config("zlg.date_format","Y/m/d").\'"' : '';
				$required_fields .= "'" . $field['name'] . "'   =>  'required{$number}{$unique}{$my_date_format}',\n\t\t";
			}
		}

		return $required_fields;
	}
}

if (!function_exists('casts_array')) {
	function casts_array()
	{
		$casts_array = '';
		foreach (session('fields_array') as $field) {
			if ($field['is_selected']) {
				$field_type = str_contains(strtolower($field['data_type']), 'char') ? 'string' : 'integer';
				$casts_array .= "'" . $field['name'] . "'   =>  '$field_type',\n\t\t";
			}
		}

		return $casts_array;
	}
}

if (!function_exists('convertTemplateVariables')) {
	function convertTemplateVariables($page_name)
	{
//		$content = file_get_contents(base_path("/vendor/zezont4/laravel-generator/src/pages-template/{$page_name}"));
		$content = file_get_contents(__DIR__ . "/pages-template/{$page_name}");
		$prefix = '<code>';
		$suffix = '</code>';
		$model_path = config('zlg.model_path', 'Models/') ? '\\' . rtrim(config('zlg.model_path', 'Models/'), '/') : '';
		$replace_with = [
			$prefix . 'lower_case_model_name' . $suffix => strtolower(session('model_name')),
			$prefix . 'model_name' . $suffix            => session('model_name'),
			$prefix . 'table_name' . $suffix            => session('table_name'),
			$prefix . 'primary_key' . $suffix           => session('primary_key'),
			$prefix . 'selected_fields' . $suffix       => selected_fields(),
			$prefix . 'required_fields' . $suffix       => required_fields(),
			$prefix . 'casts_array' . $suffix           => casts_array(),
			$prefix . 'model_path' . $suffix            => $model_path,
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
		$lower_model_name = strtolower($model_name);
		$htmlCode = "
@extends('layouts.master')

@section('parent','<a href=\"'.route(\"{$lower_model_name}.index\").'\" class=\"breadcrumb page-title\">$page_title</a>')
@section('title','" . config('zlg.title.show', 'show') . "')

@section('content')
	<div class='row'>
		<a href='{{route(\"" . $lower_model_name . ".create\")}}' class='btn waves-effect waves-light blue'>" . config('zlg.button.new', 'new') . "<i class=\"material-icons left\">add</i></a>
	</div>

	@if(count($" . $lower_model_name . "))
";

		foreach (session('fields_array') as $field) {
			if ($field['is_selected']) {
				$type = $field['type'];
				if ($type == 'select' || $type == 'radio' || $type == 'checkbox') {

					$htmlCode .= "{{ \\Form::mtStatic(MyTrans('{$field['name']}'), arrayValue(\$my_values['{$field['name']}'],\$$lower_model_name->{$field['name']})  ) }}\n\t";

				} else {

					$htmlCode .= "{{ \\Form::mtStatic(MyTrans('{$field['name']}'), \$$lower_model_name->{$field['name']}  ) }}\n\t";

				}

			}
		}
		$htmlCode .= "
		@endif

    <div class='section'>
        <a class='waves-effect waves-light btn left red lighten-2' href='{{route('{$lower_model_name}.edit',$" . $lower_model_name . "->" . $primary_key . ")}}'>" . config('zlg.button.edit', 'edit') . "</a>
    </div>

@stop";
		return $htmlCode;

	}
}

if (!function_exists('generateMaterializeFormPage')) {
	function generateMaterializeFormPage()
	{
		$htmlCode = "";
		foreach (session('fields_array') as $field) {
			if ($field['is_selected']) {
				$type = $field['type'];
//				$required = $field['is_required'] ? '["required"=>true]' : '[]';
				$required = $field['is_required'] ? '["is_required"=>true]' : '[]';

				if ($type == 'text') {

					$htmlCode .= "{{ \\Form::mtText('{$field["name"]}',MyTrans('{$field['name']}') ,request('{$field["name"]}',  null), $required) }}\n\n";

				} elseif ($type == 'date') {

					$htmlCode .= "{{ \\Form::mtDate('{$field["name"]}',MyTrans('{$field['name']}') ,request('{$field["name"]}',  null),$required) }}\n\n";

				} elseif ($type == 'password') {

					$htmlCode .= "{{ \\Form::mtPassword('{$field["name"]}',MyTrans('{$field['name']}',null),$required ) }}\n\n";

				} elseif ($type == 'select') {

					$htmlCode .= "{{ \\Form::mtSelect('{$field["name"]}',MyTrans('{$field['name']}'),request('{$field["name"]}',  null),\$my_values['yes_no'],$required ) }}\n\n";

				} elseif ($type == 'radio') {

					$htmlCode .= "{{ \\Form::mtRadio('{$field["name"]}',MyTrans('{$field['name']}'),request('{$field["name"]}',  null),\$my_values['yes_no'],$required ) }}\n\n";

				} elseif ($type == 'checkbox') {

					$htmlCode .= "{{ \\Form::mtCheck('{$field["name"]}',MyTrans('{$field['name']}'),request('{$field["name"]}',  null),\$my_values['yes_no'],$required ) }}\n\n";

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

@section('parent','<a href=\"'.route(\"{$lower_model_name}.index\").'\" class=\"breadcrumb page-title\">$page_title</a>')
@section('title','" . config('zlg.title.create', 'create') . "')

@section('content')

    {{ \\Form::open(['route' => '" . $lower_model_name . ".store']) }}

    @include('" . $lower_model_name . "._form',['btnLabel' => '" . config('zlg.button.save', 'save') . "','formType' => 'create'])

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

@section('parent','<a href=\"'.route(\"{$lower_model_name}.index\").'\" class=\"breadcrumb page-title\">$page_title</a>')
@section('title','" . config('zlg.title.edit', 'edit') . "')

@section('content')
	@if(count($" . $lower_model_name . "))
		@if($" . $lower_model_name . "->trashed())
			<div class='section'>
				<p class='red-text lighten-2 mid-size-font center-align'>هذا السجل محذوف</p>
			</div>
		@endif
		{{ \\Form::model($" . $lower_model_name . ", ['route' => ['" . $lower_model_name . ".update', $" . $lower_model_name . "->" . $primary_key . "], 'method' => 'put']) }}

		@include('" . $lower_model_name . "._form',['btnLabel' => '" . config('zlg.button.save', 'save') . "','formType' => 'update'])

		{{ \\Form::close() }}

		@if($" . $lower_model_name . "->trashed())
			{{ \\Form::open(['route' => ['" . $lower_model_name . ".restore', \$" . $lower_model_name . "->" . $primary_key . "]]) }}
			{{ \\Form::mtButton('" . config('zlg.button.restore', 'restore') . "', 'left btn-flat waves-green green-text') }}
			{{ \\Form::close() }}
		@else
			{{ \\Form::open(['route' => ['" . $lower_model_name . ".destroy', \$" . $lower_model_name . "->" . $primary_key . "], 'method' => 'delete']) }}
			{{ \\Form::mtButton('" . config('zlg.button.delete', 'delete') . "', 'left btn-flat waves-red red-text') }}
			{{ \\Form::close() }}
		@endif

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
<div class='row col s12'>
	<a href='{{route('{$lower_model_name}.create')}}' class='btn waves-effect waves-light blue'>" . config('zlg.button.new', 'new') . "<i class='material-icons left'>add</i></a>
	<a href='#search_modal' class='btn waves-effect waves-light left blue modal-trigger'>" . config('zlg.button.advanced_search', 'advanced search') . "<i class='material-icons left'>search</i></a>
</div>
@include('layouts._search',['model'=>'{$model_name}'])
@if(count($" . $lower_model_name . "s))
<?php \$arrow = config('zlg.sorting_arrow','<i class=\"material-icons right grey-text text-darken-1\">arrow_drop_up</i>');?>
 <table class='highlight responsive-table'>
    <thead>
        <tr>
";
		foreach (session('fields_array') as $field) {
			if ($field['is_selected']) {
				$htmlCode .= "\t\t@include('layouts._th',['model'=>'$lower_model_name','field'=> MyTrans('{$field['name']}')])\n";
			}
		}
		$htmlCode .= "
        <th>&nbsp;</th>
        </tr>

        </thead>
        ";

		$htmlCode .= "@foreach($" . $lower_model_name . "s as $" . $lower_model_name . ")
     <tr @if($" . $lower_model_name . "->trashed()) class='deleted' @endif >
   ";
		foreach (session('fields_array') as $field) {
			$type = $field['type'];
			if ($field['is_selected']) {
				if ($type == 'select' || $type == 'radio' || $type == 'checkbox') {
					$htmlCode .= "\t\t<td>{{ arrayValue(\$my_values['".$field['name']."'],$" . $lower_model_name . "->" . $field['name'] . ") }}</td>\n";
				} else {
					$htmlCode .= "\t\t<td>{{ $" . $lower_model_name . "->" . $field['name'] . "  }}</td>\n";
				}
			}
		}
		$htmlCode .= "
    \t<td><a title='" . config('zlg.button.edit', 'edit') . "' href=\"{{ route('" . $lower_model_name . ".edit',  ['id' => $" . $lower_model_name . "->" . $primary_key . "] ) }}\"><i class=\"material-icons\">edit</i></a></td>
    <tr>
    @endforeach
</table>
    <div class='section'>
        {{ $" . $lower_model_name . "s->appends(request()->query())->render() }}
    </div>

    @else
        <div class='center-align blue-text lighten-2'>
            <h4>" . config('zlg.message.no_results', 'No results found') . "</h4>
        </div>

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

@section('parent','<a href=\"'.route(\"{$lower_model_name}.index\").'\" class=\"breadcrumb page-title\">$page_title</a>')
@section('title','" . config('zlg.title.search' . 'Search') . "')

@section('content')

    {{ Form::open(['route' => '" . $lower_model_name . ".index', 'method' => 'get']) }}

    @include('" . $lower_model_name . "._form',['btnLabel' => '" . config('zlg.button.search', 'Search') . "','formType' => 'search'])

    {{ Form::close() }}

@stop";

		return $htmlCode;
	}
}

if (!function_exists('generateMaterializeEmbeddedSearchPage1')) {
	function generateMaterializeEmbeddedSearchPage1($model_name)
	{
		$lower_model_name = strtolower($model_name);

		$htmlCode = "
<?php \$add_container = true; ?>
@foreach(\\Illuminate\\Support\\Facades\\Input::all() as \$param => \$value)
    @if(\$value && in_array(\$param,(new \\App\\" . str_replace('/', '\\', config('zlg.model_path', 'Models/')) . $model_name . ")->searchableFields))
        @if(\$add_container)
            {!! '<div class=\"row col s12\">' !!}
            <h5 class='title-font grey-text darken-1'>عرض النتائج حسب التالي : </h5>
            <?php \$add_container = false; ?>
        @endif
        <div class='chip'><span class='title-font'>{{myTrans(\$param)}}</span> : {{\$value}}</div>

    @endif
@endforeach
@if(! \$add_container)
    {!! '</div>' !!}
@endif

<div id='search_modal' class='modal modal-fixed-footer'>
    <div class='modal-content'>
		<div class='section'>
			{{ Form::open(['route' => '" . $lower_model_name . ".index', 'method' => 'get']) }}

			@include('" . $lower_model_name . "._form',['btnLabel' => '" . config('zlg.button.search', 'Search') . "','formType' => 'search'])

			{{ Form::close() }}
		</div>
	</div>
</div>
";


		return $htmlCode;
	}
}