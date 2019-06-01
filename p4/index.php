<?php

require_once 'app/config/global.php';
require_once 'Core/Session.php';
require_once 'Core/Database.php';

// manage sessions
$session = new Session();
$session->init();

// Database
$database = include_once ROOT_PATH.'/config/database.php';

if (isset($database['db']) && $database['db'] 
    && isset($database['host']) && $database['host'] 
    && isset($database['port']) && $database['port'] 
    && isset($database['user']) && $database['user']
) {
    Database::init($database); // Inicia una conexión con la base de datos.
    //unset($database['db']); // Se eliminan los datos de la base de datos, por si acaso.
}

// Routing
require 'Core/Router.php';
require 'Core/Route.php';

// web settings
require "app/config/global.php";

// start routing
$router = new Router($_SERVER['REQUEST_URI']);

require ROOT_PATH.'/config/routes.php';

$router->run();


?>

