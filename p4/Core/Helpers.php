<?php
/**
 * Funciones útiles
 */
/**
 * Muestra un error 404 indicando que la página no fue encontrada.
 */
function error_404()
{
    $view = View::make('404');
    die($view->execute());
}
function encrypt($password)
{
    return sha1($password);
}

?>