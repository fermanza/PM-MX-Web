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
                        ->with('section', 'Nueva Industria')
                        ->with('action', 'save-create')
                        ->with('industry', new Industry);
    }

    public function save_create() {

        $validator = Validator::make(
                        Input::all(), array(
                    'name' => 'required',
                    )
        );

        if ($validator->fails()) {
            return Redirect::to('/admin/industry/create')->withInput()->withErrors($validator);
        }

        $industry = new Industry;

        $industry->name = Input::get('name');
        $industry->bg_color = Input::get('bg_color');
        $industry->txt_color = Input::get('txt_color');
        
        $industry->active = 1;
        

        $industry->save();

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
                'id' => 'required',
                'name' => 'required',
            )
        );

        if ($validator->fails()) {
            return Redirect::to('/admin/industries/update/' . Input::get('id'))->withInput()->withErrors($validator);
        }

        $industry = Industry::find(Input::get('id'));

        $industry->name = Input::get('name');
        $industry->bg_color = Input::get('bg_color');
        $industry->txt_color = Input::get('txt_color');
        //$industry->url_image = Input::get('url_image');

        $industry->save();
        
        return Redirect::to('/admin/industry')->with('message', array(
                    'type' => 'success',
                    'message' => 'Industria Modificada.'
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

}