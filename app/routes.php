<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

Route::get('/', function() {
    return Redirect::to('/admin');
});

Route::get('/admin', function() {
    if (Auth::check()) {
        return Redirect::to('/admin/home');
    }
    else {
        return Redirect::to('/admin/login');
    }
});

Route::get('/admin/login', 'LoginController@index');
Route::post('/admin/logon', 'LoginController@logon');
Route::get('/admin/login/logout', 'LoginController@logout');

//Route::get('/admin/profile', array('before' => 'auth', 'uses' => 'UsersController@profile'));
//Route::post('/admin/save-profile', array('before' => 'auth', 'uses' => 'UsersController@save_profile'));

Route::get('/admin/home', array('before' => 'auth', 'uses' => 'HomeController@index'));

Route::get('/admin/industry', array('before' => 'auth', 'uses' => 'IndustriesController@index'));
Route::get('/admin/industry/create', array('before' => 'auth', 'uses' => 'IndustriesController@create'));
Route::post('/admin/industry/save-create', array('before' => 'auth', 'uses' => 'IndustriesController@save_create'));
Route::get('/admin/industry/update/{num}', array('before' => 'auth', 'uses' => 'IndustriesController@update'));
Route::post('/admin/industry/save-update', array('before' => 'auth', 'uses' => 'IndustriesController@save_update'));
Route::get('/admin/industry/details/{num}', array('before' => 'auth', 'uses' => 'IndustriesController@details'));
Route::get('/admin/industry/delete/{num}', array('before' => 'auth', 'uses' => 'IndustriesController@delete'));
Route::post('/admin/industry/delete', array('before' => 'auth', 'uses' => 'IndustriesController@delete_industry'));

Route::get('/admin/argument', array('before' => 'auth', 'uses' => 'ArgumentsController@index'));
Route::get('/admin/argument/create', array('before' => 'auth', 'uses' => 'ArgumentsController@create'));
Route::post('/admin/argument/save-create', array('before' => 'auth', 'uses' => 'ArgumentsController@save_create'));
Route::get('/admin/argument/update/{num}', array('before' => 'auth', 'uses' => 'ArgumentsController@update'));
Route::post('/admin/argument/save-update', array('before' => 'auth', 'uses' => 'ArgumentsController@save_update'));
Route::get('/admin/argument/details/{num}', array('before' => 'auth', 'uses' => 'ArgumentsController@details'));
Route::get('/admin/argument/delete/{num}', array('before' => 'auth', 'uses' => 'ArgumentsController@delete'));
Route::post('/admin/argument/delete', array('before' => 'auth', 'uses' => 'ArgumentsController@delete_argument'));

//Webservices

Route::post('/ws-content/json/ws-industries_by_language_id', function() {
    $data = Input::get('data');
    $data_decoded = json_decode($data);

    $app_name = $data_decoded->app_name;
    $language_id = $data_decoded->language_id;

    if ($app_name == "Mexico360") {
        $industries = Industry::select("id", "name", "bg_color", "txt_color")
                ->where('language_id', '=', $language_id)
                ->get();

        if ( count($industries) > 0 ) {
            $ws_industries = array(
                'code' => 1,
                'message' => 'Éxito',
                array('industries' => $industries)
            );
//            $ws_industries = utf8_encode($ws_industries);
            return $ws_industries;
        }
        else {
            return array(
                'code' => 2,
                'message' => 'Ocurrió un Error'
            );
        }
    }
    else {
        return array(
            'code' => 2,
            'message' => 'Ocurrió un Error'
        );
    }
});

Route::post('/ws-content/json/ws-all_languages', function() {
    $data = Input::get('data');
    $data_decoded = json_decode($data);

    $app_name = $data_decoded->app_name;

    if ($app_name == "Mexico360") {
        $languages = Language::select("id", "name")
                ->get();
        
        if ( count($languages) > 0 ) {
            return array(
                'code' => 1,
                'message' => 'Éxito',
                array('languages' => $languages)
            );
        }
        else {
            return array(
                'code' => 2,
                'message' => 'Ocurrió un Error'
            );
        }
    }
    else {
        return array(
            'code' => 2,
            'message' => 'Ocurrió un Error'
        );
    }
});

Route::post('/ws-content/json/ws-arguments_by_industry_id_and_language_id', function() {
    $data = Input::get('data');
    $data_decoded = json_decode($data);

    $app_name = $data_decoded->app_name;
    $industry_id = $data_decoded->industry_id;
    $language_id = $data_decoded->language_id;

    if ($app_name == "Mexico360") {
        $arguments = Argument::select("id", "industry_id", "name")
                ->where('industry_id', '=', $industry_id)
                ->where('language_id', '=', $language_id)
                ->get();

        if ( count($arguments) > 0 ) {
            return array(
                'code' => 1,
                'message' => 'Éxito',
                array('arguments' => $arguments)
            );
        }
        else {
            return array(
                'code' => 2,
                'message' => 'Ocurrió un Error'
            );
        }
    }
    else {
        return array(
            'code' => 2,
            'message' => 'Ocurrió un Error'
        );
    }
});

Route::get('/hash', function() {
    return Hash::make('asdfasdf');
});