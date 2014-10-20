<?php

class UserController extends BaseController {

    public function index($language_id = 1) {
        $users = User::all();
        return View::make('admin.users.index')
                        ->with('section', 'Control de Usuarios')
                        ->with('users', $users);
    }

    public function create() {
        return View::make('admin.users.form')
                        ->with('section', 'Nuevo Usuario')
                        ->with('action', 'save-create')
                        ->with('user', new User);
    }

    public function save_create() {

        $validator = Validator::make(
            Input::all(), array(
                'email' => 'required',
                'password' => 'required'
            )
        );
        if ($validator->fails()) {
            return Redirect::to('/admin/user/create')->withInput()->withErrors($validator);
        }
        $user = new User;
        
        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));
        
        $user->save();

        return Redirect::to('/admin/user')->with('message', array(
                'type' => 'success',
                'message' => 'Usuario Creado.'
        ));
    }

    public function update($id) {
        $user = User::where('id', '=', $id)
                ->first();
        
        return View::make('admin.users.form')
                        ->with('section', 'Modificar Usuario')
                        ->with('action', 'save-update')
                        ->with('user', $user);
    }

    public function save_update() {
        
        $validator = Validator::make(
            Input::all(), array(
                'email' => 'required',
            )
        );

        if ($validator->fails()) {
            return Redirect::to('/admin/user/update/' . Input::get('id'))->withInput()->withErrors($validator);
        }
        
        $user = User::find(Input::get('id'));
        
        $user->email = Input::get('email');
        if(Input::get('password')!=""){
            $user->password = Hash::make(Input::get('password'));
        }
        
        $user->save();
        
        return Redirect::to('/admin/user')->with('message', array(
                'type' => 'success',
                'message' => 'Usuario Modificado.'
        ));
    }

    public function delete($id) {
        $user = User::find($id);
        return View::make('admin.users.delete')
                        ->with('section', 'Eliminar Usuario')
                        ->with('user', $user);
    }

    public function delete_user() {
        
        $user = User::find(Input::get('id'));
        $user->delete();
        
        return Redirect::to('/admin/user')->with('message', array(
                    'type' => 'success',
                    'message' => 'Usuario Eliminado.'
        ));
    }

}