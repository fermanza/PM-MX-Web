<?php

class IndustriesController extends BaseController {

    public function index($language_id=1) {
        $industries = Industry::where('active', '=', 1)
                ->where('language_id', "=", $language_id)
                ->orderBy('language_id', 'asc')
                ->orderBy('name', 'asc')
                ->get();
        return View::make('admin.industries.index')
                        ->with('section', 'Control de Industrias')
                        ->with('industries', $industries);
    }

    public function create() {
        return View::make('admin.industries.form')
                        ->with('section', 'Nueva Industria')
                        ->with('action', 'save-create')
                        ->with('languages', Language::all())
                        ->with('industry', new Industry);
    }

    public function save_create() {
        $validator = Validator::make(
            Input::all(), array(
                'name' => 'required',
                'bg_color' => 'required',
                'txt_color' => 'required',
                'img' => 'required',
                'language_id' => 'required',
            )
        );
        
        if ($validator->fails()) {
            return Redirect::to('/admin/industry/create')->withInput()->withErrors($validator);
        }

        $industry = new Industry;

        $industry->name = Input::get('name');
        $industry->bg_color = Input::get('bg_color');
        $industry->txt_color = Input::get('txt_color');
        $file = Input::file('img');
        $industry->img = time() . "." . substr($file->getClientOriginalName(), -3);
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $destinationPath = getcwd() . "\\img\\industries\\";
        } else {
            $destinationPath = getcwd() . "/img/industries/";
        }
        Input::file('img')->move($destinationPath, $industry->img);
        $industry->language_id = Input::get('language_id');
        
        $industry->active = 1;

        $industry->save();
        Version::upgradeVersion();

        return Redirect::to('/admin/listindustry')->with('message', array(
                    'type' => 'success',
                    'message' => 'Industria Creada'
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
                        ->with('languages', Language::all())
                        ->with('industry', $industry);
    }

    public function save_update() {

        $validator = Validator::make(
            Input::all(), array(
                'id' => 'required',
                'name' => 'required',
                'img' => 'required'
            )
        );

        if ($validator->fails()) {
            return Redirect::to('/admin/industries/update/' . Input::get('id'))->withInput()->withErrors($validator);
        }

        $industry = Industry::find(Input::get('id'));
        
        $industry->name = Input::get('name');
        $industry->bg_color = Input::get('bg_color');
        $industry->txt_color = Input::get('txt_color');
        $industry->img = $industry->img;
        if (Input::file('img')!="") {
            $file = Input::file('img');
            $industry->img = time() . "." . substr($file->getClientOriginalName(), -3);
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $destinationPath = getcwd() . "\\img\\industries\\";
            } else {
                $destinationPath = getcwd() . "/img/industries/";
            }
            Input::file('img')->move($destinationPath, $industry->img);
        }

        $industry->save();
        Version::upgradeVersion();
        
        return Redirect::to('/admin/listindustry')->with('message', array(
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
        Version::upgradeVersion();
        
        return Redirect::to('/admin/listindustry')->with('message', array(
                    'type' => 'success',
                    'message' => 'Industria Eliminada.'
        ));
    }

}