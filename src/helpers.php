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