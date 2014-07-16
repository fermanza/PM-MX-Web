<?php

class HomeController extends BaseController {

    public function showWelcome() {
        return View::make('hello');
    }

    public function index() {
        return View::make('admin.home.index')
                        ->with('section', 'Inicio');
    }

}
