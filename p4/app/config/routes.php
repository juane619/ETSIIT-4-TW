<?php


require 'Core/View.php';

require ROOT_PATH.'controllers/'.'MainController.php';
require ROOT_PATH.'controllers/'.'BooksController.php';


/**
 * Routes of our web
 */

$router->add(
    '/', 'MainController::index'
);

$router->add(
    '/index', 'MainController::index'
);

$router->add(
    '/catalogo', 'MainController::catalogo'
);

$router->add(
    '/busquedas', 'MainController::busquedas'
);

$router->add(
    '/tiendas', 'MainController::tiendas'
);

// Gestion de libros
$router->add(
    '/books/add', 'BooksController::add'
);

$router->add(
    '/books/remove/:id', 'BooksController::remove'
);

$router->add(
    '/books/edit/:id', 'BooksController::edit'
);


?>