<?php

require_once 'Core/Controller.php';

class BooksController extends Controller
{
    public function add()
    {
        $view = View::make('addbook', 'books');
        $view->with('namepage', 'libros');
        return $view;
    }

    public function remove($id)
    {
        $view = View::make('removebook', 'books');
        $view->with('namepage', 'libros');
        return $view;
    }

    public function edit($id)
    {
        $view = View::make('editbook', 'books');
        $view->with('namepage', 'libros');
        return $view;
    }
}

?>