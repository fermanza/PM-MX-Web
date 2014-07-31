<?php

class ShowController extends BaseController {

    public function showContent($id) {
        
        $argument = Argument::find($id);
        
        if(isset($argument->id)){
            $argument->industry = Industry::where('active', '=', 1)
                    ->where('id', '=', $argument->industry_id)
                    ->first();

            return View::make('show.index')
                            ->with('section', 'Mostrar Argumento')
                            ->with('action', 'save-update')
                            ->with('argument', $argument);
        }
        else{
            return View::make('errors.missing', 
                    array('subtitle' => 'Página no encontrada', 
                        'message' => 'Página no encontrada'));
        }
    }
    
}
