<?php

require_once 'Core/Controller.php';
require_once ROOT_PATH.'models/Incidencia.php';



class MainController extends Controller
{
    public function index()
    {
        //logg("Lllamando a index..".rand());
        $view = View::make('index');
        $view->with('namepage', 'index');
        return $view;
    }
}

?>