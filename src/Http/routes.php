<?php
Route::group(['prefix' => 'laravel_generator', 'middleware' => ['web']], function () {
    Route::get('/', 'LaravelGeneratorController@showTables');
    Route::get('show_tables', 'LaravelGeneratorController@showTables');
    Route::get('{table}/show_fields', 'LaravelGeneratorController@showFields');
    Route::post('post_to_session', 'LaravelGeneratorController@postToSession');
    Route::get('make_pages', 'LaravelGeneratorController@makePages');
});