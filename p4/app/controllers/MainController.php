<?php

require_once 'Core/Controller.php';

class MainController extends Controller
{
    public function index()
    {
        $view = View::make('index');
        $view->with('namepage', 'index');
        return $view;
    }

    public function catalogo()
    {
        $view = View::make('catalogo');
        $view->with('namepage', 'catalogo');
        return $view;
    }

    public function busquedas()
    {
        $view = View::make('busquedas');
        $view->with('namepage', 'busquedas');
        return $view;
    }

    public function tiendas()
    {
        $view = View::make('tiendas');
        $view->with('namepage', 'tiendas');
        return $view;
    }
}

?>