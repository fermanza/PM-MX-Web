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
Route::get('/admin/listindustry', array('before' => 'auth', 'uses' => 'IndustriesController@index'));
Route::get('/admin/listindustry/{num}', array('before' => 'auth', 'uses' => 'IndustriesController@index'));
Route::get('/admin/industry/create', array('before' => 'auth', 'uses' => 'IndustriesController@create'));
Route::post('/admin/industry/save-create', array('before' => 'auth', 'uses' => 'IndustriesController@save_create'));
Route::get('/admin/industry/update/{num}', array('before' => 'auth', 'uses' => 'IndustriesController@update'));
Route::post('/admin/industry/save-update', array('before' => 'auth', 'uses' => 'IndustriesController@save_update'));
Route::get('/admin/industry/details/{num}', array('before' => 'auth', 'uses' => 'IndustriesController@details'));
Route::get('/admin/industry/delete/{num}', array('before' => 'auth', 'uses' => 'IndustriesController@delete'));
Route::post('/admin/industry/delete', array('before' => 'auth', 'uses' => 'IndustriesController@delete_industry'));

Route::get('/admin/argument', array('before' => 'auth', 'uses' => 'ArgumentsController@index'));
Route::get('/admin/listargument', array('before' => 'auth', 'uses' => 'ArgumentsController@index'));
Route::get('/admin/listargument/{num}', array('before' => 'auth', 'uses' => 'ArgumentsController@index'));
Route::get('/admin/argument/create', array('before' => 'auth', 'uses' => 'ArgumentsController@create'));
Route::post('/admin/argument/save-create', array('before' => 'auth', 'uses' => 'ArgumentsController@save_create'));
Route::get('/admin/argument/update/{num}', array('before' => 'auth', 'uses' => 'ArgumentsController@update'));
Route::post('/admin/argument/save-update', array('before' => 'auth', 'uses' => 'ArgumentsController@save_update'));
Route::get('/admin/argument/details/{num}', array('before' => 'auth', 'uses' => 'ArgumentsController@details'));
Route::get('/admin/argument/delete/{num}', array('before' => 'auth', 'uses' => 'ArgumentsController@delete'));
Route::post('/admin/argument/delete', array('before' => 'auth', 'uses' => 'ArgumentsController@delete_argument'));

Route::get('/show/{num}', 'ShowController@showContent');
Route::get('/showIcons/{num}', 'ShowController@showIcons');

//Webservices

Route::post('/ws-content/json/ws-industries_by_language_id', function() {
    $data = Input::get('data');
    $data_decoded = json_decode($data);

    $app_name = $data_decoded->app_name;
    $language_id = $data_decoded->language_id;

    if ($app_name == "Mexico360") {
        $industries = Industry::select("id", "name", "bg_color", "txt_color", "language_id", "img")
                ->where('language_id', '=', $language_id)
                ->get();

        if ( count($industries) > 0 ) {
            foreach($industries as $industry){
                $industry->url_img = URL::to('img/ios/'.$industry->img);
            }
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
        $languages = Language::select("id", "name", "source", "url_image")
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

Route::post('/ws-content/json/ws-arguments_by_argument_id', function() {
    $data = Input::get('data');
    $data_decoded = json_decode($data);

    $app_name = $data_decoded->app_name;
    $args_json = $data_decoded->arguments;
    
    if ($app_name == "Mexico360") {
        $arguments = array();
        foreach($args_json as $arg){
            $argument = Argument::select("id", "industry_id", "name")
                ->where('id', '=', $arg->id)
                ->first();
            $industry = Industry::select("bg_color")
                ->where('id', '=', $argument->industry_id)
                ->first();
            $argument->bg_color = $industry->bg_color;
            array_push($arguments, $argument);
        }

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
    return Hash::make('mexico360');
});

Route::get('/arg_update_img', function() {
//    for($i=1; $i <= 20; $i++){
//        $arguments = Argument::
//                where("industry_id", "=", $i)
//                ->where('language_id', '=', 1)
//                ->get();
//        $j = 1;
//        foreach($arguments as $argument){
//            if($i < 10){ $aux = 0; }
//            else{ $aux = ""; }
//            
//            if($j < 10){ $aux2 = 0; }
//            else{ $aux2 = ""; }
//            $argument -> img = $aux.$argument->industry_id."_".$aux2.$j.".png";
//            $argument ->save();
//            $j++;
//        }
//    }
});
Route::get('/arg_update_layout', function() {
    $colors = Industry::select("bg_color")
        ->distinct("bg_color")
        ->get();
    
    foreach($colors as $color){
        $industries = Industry::where('bg_color', '=', $color->bg_color)
                ->orderBy('id', 'asc')
                ->get();
        $arguments_esp = Argument::where("industry_id", "=", $industries[0]->id)->get();
        
        $arguments_eng = Argument::where("industry_id", "=", $industries[1]->id)->get();
        
        $i=0;
        foreach($arguments_esp as $arg){
            $arguments_eng[$i]->layout = $arg->layout;
            $arguments_eng[$i]->img = $arg->img;
            $arguments_eng[$i]->save();
            $i++;
        }
    }
});

Route::post('/ws-content/json/ws-get_all_ind_arg_by_language_id', function() {
    $data = Input::get('data');
    $data_decoded = json_decode($data);

    $app_name = $data_decoded->app_name;
    $language_id = $data_decoded->language_id;

    if ($app_name == "Mexico360") {
        $industries = Industry::select("id", "name", "bg_color", "txt_color", "img", "language_id")
                ->where('language_id', '=', $language_id)
                ->get();
        $arguments = array();
        foreach($industries as $industry){
            $arguments = Argument::select("id", "industry_id", "name", "source", "img", "layout", "language_id")
                ->where('industry_id', '=', $industry->id)
                ->get();
            foreach($arguments as $argument){
                $pattern = "<b>";
                $replacement = "";
                $argument->unformatted = str_replace($pattern, $replacement, $argument->name);
                $pattern = "</b>";
                $replacement = "";
                $argument->unformatted = str_replace($pattern, $replacement, $argument->unformatted);
                
                $pattern = "<b>";
                $txt_color = $industry->txt_color;
                $replacement = "<b style='font-family: MyriadPro-BoldSemiCn; color: $txt_color; font-weight:bold;'>";
                
                $argument->name = str_replace($pattern, $replacement, $argument->name);
                
                $open_span = "<div style='font-family: MyriadPro-SemiCn; color: #FFFFFF; font-size: 17px;'>";
                $close_span = "</div>";
                $argument->name = $open_span.$argument->name.$close_span;
                
//                $open_span = "<span style='font-family: MyriadPro-SemiCn; color: $txt_color; font-size: 17px; text-align: center; font-size: 12px'>";
//                $close_span = "</span>";
//                $argument->source = $open_span.$argument->source.$close_span;
            }
            $industry->arguments = $arguments;
        }
        $version = 1;
        if ( count($industries) > 0 ) {
            $version = Version::first();
            $ws_industries = array(
                'version' => $version->version,
                'industries' => $industries,
            );
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

Route::get('/ws-content/json/ws-get_images/{num}', function($argument_id) {

    $argument = Argument::select("img")->where("id", "=", $argument_id)->first();
    echo URL::to('/img/arguments/'.$argument->img);
});

Route::post('/ws-content/json/ws-get_version', function() {
    $data = Input::get('data');
    $data_decoded = json_decode($data);
    $app_name = $data_decoded->app_name;

    if ($app_name == "Mexico360") {
        $version = Version::first();
    
        if ( isset($version->version) ) {
            return array(
                'version' => $version->version
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

Route::get('/renameFilesiOS', function() {
    
//    die;
//    for($i = 1; $i<=20; $i++){
//        if($i<10){ $industry = "0".$i; }
//        else{ $industry = $i; }
//        for($j = 1; $j<=70; $j++){
//            if($j<10){ $argument = "0".$j; }
//            else{ $argument = $j; }
//            
//            $filename = getcwd().'\\img\\ios\\'.$industry.'_'.$argument.'_@2x.png';
//            $filename2 = getcwd().'\\img\\ios\\'.$industry.'_'.$argument.'@2x.png';
//            if (file_exists($filename2)) {
////                rename(($filename), ($filename2));
//                if(file_exists(getcwd().'\\img\\ios\\'.$industry.'_'.$argument.'_568h@2x.png')){
//                    unlink(getcwd().'\\img\\ios\\'.$industry.'_'.$argument.'_568h@2x.png');
//                }
//            }
////            unlink(getcwd().'\\img\\ios\\'.$industry.'_'.$argument.'_568h@2x.png');
//        }
//    }
    for($i = 1; $i<=20; $i++){
        if($i<10){ $industry = "0".$i; }
        else{ $industry = $i; }
        $filename = getcwd().'\\img\\ios\\ic_'.$industry.'_@2x.png';
        $filename2 = getcwd().'\\img\\ios\\ic_'.$industry.'@2x.png';
        if (file_exists($filename)) {
            rename(($filename), ($filename2));
        }
        unlink(getcwd().'\\img\\ios\\'.$industry.'_'.$argument.'_568h@2x.png');
    }
});

Route::get('/renameFilesAndroid', function() {
    for($i = 1; $i<=20; $i++){
        if($i<10){ $industry = "0".$i; }
        else{ $industry = $i; }
        for($j = 1; $j<=70; $j++){
            if($j<10){ $argument = "0".$j; }
            else{ $argument = $j; }
            
            $filename = getcwd().'\\img\\android\\'.$industry.'_'.$argument.'.png';
            $filename2 = getcwd().'\\img\\android\\'.$industry.'_'.$argument.'_@2x.png';
            $filename3 = getcwd().'\\img\\android\\'.$industry.'_'.$argument.'_568h@2x.png';
            $filename4 = getcwd().'\\img\\android\\arg_'.$industry.'_'.$argument.'.png';
            
            if (file_exists($filename)) {
                unlink($filename);
            }
            if (file_exists($filename2)) {
                unlink($filename2);
            }
            if (file_exists($filename3)) {
                rename(($filename3), ($filename4));
            }
        }
    }
    for($i = 1; $i<=20; $i++){
        if($i<10){ $industry = "0".$i; }
        else{ $industry = $i; }
        $filename = getcwd().'\\img\\android\\ic_'.$industry.'.png';
        $filename2 = getcwd().'\\img\\android\\ic_'.$industry.'@2x.png';
        if (file_exists($filename)) {
            unlink($filename);
            rename(($filename2), ($filename));
        }
    }
});

Route::get('/quitArgPreffix', function() {
    for($i = 1; $i<=20; $i++){
        if($i<10){ $industry = "0".$i; }
        else{ $industry = $i; }
        for($j = 1; $j<=70; $j++){
            if($j<10){ $argument = "0".$j; }
            else{ $argument = $j; }
            
            $filename = getcwd().'\\img\\arguments\\arg_'.$industry.'_'.$argument.'.png';
            $filename2 = str_replace("arg_", "", $filename);
            if (file_exists($filename)) {
                rename(($filename), ($filename2));
            }
        }
    }
});

App::missing(function($exception){
    return Response::view('errors.missing', 
            array('subtitle' => 'Página no encontrada', 
                'message' => 'Página no encontrada'), 404);
});