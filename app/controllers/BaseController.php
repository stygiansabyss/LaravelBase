<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class BaseController extends MenuController {

    protected $input;

    protected $redirect;

    public function __construct()
    {
        parent::__construct();

        $this->input    = App::make('Illuminate\Http\Request');
        $this->redirect = App::make('Illuminate\Routing\Redirector');
    }
}