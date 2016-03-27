<?php
namespace Zezont4\LaravelGenerator\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class LaravelGeneratorController extends Controller
{


    public function showTables()
    {
        $field_name_for_table_name = 'Tables_in_' . env('DB_DATABASE');

        $tables = DB::select('SHOW FULL TABLES where Table_type="BASE TABLE"');

        $views = DB::select('SHOW FULL TABLES where Table_type="VIEW"');

        return view('package_views::generator.show_tables', compact('tables', 'views', 'field_name_for_table_name'));
    }


    public function showFields($table)
    {
        session(['table_name' => $table]);

        $fields = DB::select("SHOW FULL COLUMNS FROM {$table}");

        return view('package_views::generator.show_fields', compact('fields'));
    }


    public function postToSession(Request $request)
    {
//        dd($request->all());
        session(['fields' => $request->all()]);

        return redirect()->to('/laravel_generator/make_pages');
    }


    public function makePages(Request $request)
    {
        $table_name = $request->has('table_name') ? $request->table_name : session('table_name');
        $primary_key = '';
        $model_name = $request->has('model_name') ? $request->model_name : ucfirst($table_name);
        $table_label = $request->has('table_label') ? $request->table_label : ucfirst($table_name);

        $fields_array = [];
        if (session()->has('fields')) {
            foreach (session('fields')['field_name'] as $key => $field) {

                if (session('fields')['key'][$key] == 'PRI') {
                    $primary_key = $field;
                }

                $label = session('fields')['field_comment'][$key];

                array_push($fields_array, [
                    'name'        => $field,
                    'label'       => $label ? $label : ucwords(str_replace("_", " ", $field)),
                    'type'        => session('fields')['input_type'][$key],
                    'is_selected' => in_array($field, session('fields')['select']),
                    'is_required' => in_array($field, session('fields')['required']),
                ]);
            }
        }

        return view('package_views::generator.make_pages', compact('fields_array', 'table_name', 'primary_key', 'model_name', 'table_label'));
    }


}