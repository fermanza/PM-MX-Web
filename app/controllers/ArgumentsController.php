<?php

class ArgumentsController extends BaseController {

    public function index($language_id = 1) {
        $arguments = Argument::where('active', '=', 1)
                ->where('language_id', '=', $language_id)
                ->orderBy('language_id', 'asc')
                ->orderBy('industry_id', 'asc')
                ->orderBy('name', 'asc')
                ->get();
        return View::make('admin.arguments.index')
                        ->with('section', 'Control de Argumentos')
                        ->with('arguments', $arguments);
    }

    public function create() {
        $industries = Industry::all();
        
        return View::make('admin.arguments.form')
                        ->with('section', 'Nuevo Argumento')
                        ->with('action', 'save-create')
                        ->with('industries', $industries)
                        ->with('languages', Language::all())
                        ->with('argument', new Argument);
    }

    public function save_create() {

        $validator = Validator::make(
            Input::all(), array(
                'industry_id' => 'required',
                'name' => 'required',
                'source' => 'required',
                'img' => 'required',
                'language_id' => 'required',
            )
        );
        if ($validator->fails()) {
            return Redirect::to('/admin/industries/create')->withInput()->withErrors($validator);
        }
        $argument = new Argument;
        
        $argument->industry_id = Input::get('industry_id');
        $argument->name = Input::get('name');
        $argument->source = Input::get('source');
        
        $file = Input::file('img');
        $argument->img = time().".".substr($file->getClientOriginalName(), -3);
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $destinationPath = getcwd()."\\img\\arguments\\";
        } else {
            $destinationPath = getcwd()."/img/arguments/";
        }
        Input::file('img')->move($destinationPath, $argument->img);
        
        $argument->language_id = Input::get('language_id');
        $argument->layout = Input::get('layout');

        $argument->active = 1;

        $argument->save();
        Version::upgradeVersion();

        return Redirect::to('/admin/listargument')->with('message', array(
                'type' => 'success',
                'message' => 'Argumento Creado.'
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
                'source' => 'required',
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
        $argument->source = Input::get('source');
        
        $argument->img = $argument->img;
        if (Input::file('img')!="") {
            $file = Input::file('img');
            $argument->img = time() . "." . substr($file->getClientOriginalName(), -3);
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $destinationPath = getcwd() . "\\img\\arguments\\";
            } else {
                $destinationPath = getcwd() . "/img/arguments/";
            }
            Input::file('img')->move($destinationPath, $argument->img);
        }
        
        $argument->language_id = Input::get('language_id');
        $argument->layout = Input::get('layout');

        $argument->active = 1;

        $argument->save();
        Version::upgradeVersion();

        return Redirect::to('/admin/listargument')->with('message', array(
                'type' => 'success',
                'message' => 'Argumento Modificado.'
        ));
    }

    public function details($id) {
        $argument = Argument::find($id);
        $industry = Industry::find($argument->industry_id);
        $argument->language = Language::where("id", "=", $argument->language_id)->first();
        return View::make('admin.arguments.view')
                        ->with('section', 'Eliminar Argumento')
                        ->with('argument', $argument)
                        ->with('industry', $industry);
    }

    public function delete($id) {
        $argument = Argument::find($id);
        $industry = Industry::find($argument->industry_id);
        $argument->language = Language::where("id", "=", $argument->language_id)->first();
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
        Version::upgradeVersion();

        return Redirect::to('/admin/listargument')->with('message', array(
                    'type' => 'success',
                    'message' => 'Argumento Eliminada.'
        ));
    }

}