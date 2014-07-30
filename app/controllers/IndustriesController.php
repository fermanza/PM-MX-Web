<?php

class IndustriesController extends BaseController {

    public function index() {
        $industries = Industry::where('active', '=', 1)
                ->get();
        return View::make('admin.industries.index')
                        ->with('section', 'Control de Industrias')
                        ->with('industries', $industries);
    }

    public function create() {
        return View::make('admin.industries.form')
                        ->with('section', 'Nuevo Usuario')
                        ->with('action', 'save-create')
                        ->with('industry', new Industry);
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
        $industry = Industry::find($id);
        $industry->arguments = Argument::where('active', '=', 1)
                ->where('industry_id', '=', $industry->id)
                ->get();
        
        return View::make('admin.industries.form')
                        ->with('section', 'Modificar Industria')
                        ->with('action', 'save-update')
                        ->with('industry', $industry);
    }

    public function save_update() {

        $validator = Validator::make(
            Input::all(), array(
                'name' => 'required',
            )
        );

        if ($validator->fails()) {
            return Redirect::to('/admin/industries/update/' . Input::get('id'))->withInput()->withErrors($validator);
        }

        $industry = Industry::find(Input::get('id'));

        $industry->name = Input::get('name');
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
        $industry = Industry::find($id);
        $industry->arguments = Argument::where('active', '=', 1)
                ->where('industry_id', '=', $industry->id)
                ->get();
        
        return View::make('admin.industries.view')
                        ->with('section', 'Eliminar Industria')
                        ->with('industry', $industry);
    }

    public function delete($id) {
        $industry = Industry::find($id);
        $industry->arguments = Argument::where('active', '=', 1)
                ->where('industry_id', '=', $industry->id)
                ->get();
        
        return View::make('admin.industries.delete')
                        ->with('section', 'Eliminar Industria')
                        ->with('industry', $industry);
    }
    
    public function delete_industry() {
        $industry = Industry::find(Input::get('id'));
        
        Argument::where('active', '=', 1)
                ->where('industry_id', '=', $industry->id)
                ->delete();
        
        $industry->delete();
        
        return Redirect::to('/admin/industry')->with('message', array(
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