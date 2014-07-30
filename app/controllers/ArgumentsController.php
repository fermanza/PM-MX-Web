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
        return View::make('admin.arguments.form')
                        ->with('section', 'Nuevo Argumento')
                        ->with('action', 'save-create')
                        ->with('argument', new Argument);
    }

    public function save_create() {

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
                        ->with('argument', $argument);
    }

    public function save_update() {

        $validator = Validator::make(
                        Input::all(), array(
                    'name' => 'required',
                    'patern_name' => 'required',
                    'matern_name' => 'required',
                    'email' => 'required|email',
                    'password' => 'required|confirmed'
                        )
        );

        if ($validator->fails()) {
            return Redirect::to('/admin/industries/update/' . Input::get('id'))->withInput()->withErrors($validator);
        }

        $user = User::find(Input::get('id'));

        $user->name = Input::get('name');
        $user->patern_name = Input::get('patern_name');
        $user->matern_name = Input::get('matern_name');
        $user->email = Input::get('email');

        if (Input::get('password'))
            $user->password = Hash::make(Input::get('password'));

        $user->active = 1;

        $user->save();

        return Redirect::to('/admin/industries')->with('message', array(
                    'type' => 'success',
                    'message' => 'Usuario modificado.'
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
        Argument::where('active', '=', 1)
                ->where('industry_id', '=', Input::get('id'))
                ->delete();
        
        return Redirect::to('/admin/argument')->with('message', array(
                    'type' => 'success',
                    'message' => 'Industria eliminada.'
        ));
    }

    public function profile() {
        return View::make('admin.industries.profile')
                        ->with('section', 'Perfil')
                        ->with('user', Auth::user());
    }

    public function save_profile() {

        $validator = Validator::make(
                        Input::all(), array(
                    'name' => 'required',
                    'patern_name' => 'required',
                    'matern_name' => 'required',
                    'email' => 'required|email',
                    'password' => 'confirmed'
                        )
        );

        if ($validator->fails()) {
            return Redirect::to('/admin/profile')->withInput()->withErrors($validator);
        }

        $user = Auth::user();

        $user->name = Input::get('name');
        $user->patern_name = Input::get('patern_name');
        $user->matern_name = Input::get('matern_name');
        $user->email = Input::get('email');

        if (Input::get('password'))
            $user->password = Hash::make(Input::get('password'));

        $user->active = 1;

        $user->save();

        return Redirect::to('/admin/profile')->with('message', array(
                    'type' => 'success',
                    'message' => 'Perfil actualizado.'
        ));
    }

}