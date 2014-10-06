<?php

class ArgumentsController extends BaseController {

    public function index() {
        $arguments = Argument::where('active', '=', 1)
                ->get();
        return View::make('admin.arguments.index')
                        ->with('section', 'Control de Argumentos')
                        ->with('arguments', $arguments);
    }

    public function create() {
        $industries = Industry::get();
        
        return View::make('admin.arguments.form')
                        ->with('section', 'Nuevo Argumento')
                        ->with('action', 'save-create')
                        ->with('industries', $industries)
                         ->with('languages', Language::all())
                        ->with('argument', new Argument);
    }

    public function save_create() {
        
        //id
        //name
        //industry_id
        //argumet_image

        $validator = Validator::make(
                    Input::all(), array(
                    'name' => 'required',
                    'patern_name' => 'required',
                    'matern_name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|confirmed',
                    'user_type' => 'required'
                        )
        );

        if ($validator->fails()) {
            return Redirect::to('/admin/industries/create')->withInput()->withErrors($validator);
        }

        $user = new User;

        $user->name = Input::get('name');
        $user->patern_name = Input::get('patern_name');
        $user->matern_name = Input::get('matern_name');
        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));
        $user->active = 1;
        $user->user_type = Input::get('user_type');

        $user->save();

        return Redirect::to('/admin/industries')->with('message', array(
                    'type' => 'success',
                    'message' => 'Usuario creado.'
        ));
    }

    public function update($id) {
        $argument = Argument::where('active', '=', 1)
                ->where('id', '=', $id)
                ->first();
        
        $argument->industry = Industry::find($argument->industry_id);
        return View::make('admin.arguments.form')
                        ->with('section', 'Modificar Argumento')
                        ->with('action', 'save-update')
                        ->with('argument', $argument)
                        ->with('languages', Language::all())
                        ->with('industries', Industry::all());
    }

    public function save_update() {
        
        $validator = Validator::make(
                Input::all(), array(
                'id' => 'required',
                'industry_id' => 'required',
                'name' => 'required',
                'language_id' => 'required',
                )
        );

        if ($validator->fails()) {
            return Redirect::to('/admin/industry/update/' . Input::get('id'))->withInput()->withErrors($validator);
        }

        $argument = Argument::find(Input::get('id'));

        $argument->industry_id = Input::get('industry_id');
        $argument->name = Input::get('name');
        //$argument->source = Input::get('source');
        
        if(!empty(Input::get('url_image'))){
            $argument->url_image = Input::get('url_image');
        } 
        $argument->language_id = Input::get('language_id');
        $argument->layout = Input::get('layout');

        $argument->active = 1;

        $argument->save();

        return Redirect::to('/admin/industry')->with('message', array(
                'type' => 'success',
                'message' => 'Argumento Modificado.'
        ));
    }

    public function details($id) {
        $argument = Argument::find($id);
        $industry = Industry::find($argument->industry_id);
        return View::make('admin.arguments.view')
                        ->with('section', 'Eliminar Argumento')
                        ->with('argument', $argument)
                        ->with('industry', $industry);
    }

    public function delete($id) {
        $argument = Argument::find($id);
        $industry = Industry::find($argument->industry_id);
        return View::make('admin.arguments.delete')
                        ->with('section', 'Eliminar Argumento')
                        ->with('argument', $argument)
                        ->with('industry', $industry);
    }

    public function delete_argument() {
        
        $argument = Argument::find(Input::get('id'));
            
        $argument->active = 0;
        $argument->save();

        $number_arguments = Argument::where('industry_id', Input::get('industry_id'))->where('active', '=', 1)->count();

        if($number_arguments == 0){
            $industry = Industry::find(Input::get('industry_id'));
            $industry->delete();
        }

        return Redirect::to('/admin/argument')->with('message', array(
                    'type' => 'success',
                    'message' => 'Industria eliminada.'
        ));
    }

}