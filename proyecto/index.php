<?php


// web settings
require_once 'app/config/global.php';
require_once 'Core/Session.php';
require_once 'Core/Database.php';
require_once 'Core/Controller.php';
require_once 'Core/Model.php';

require_once ROOT_PATH.'models/User.php';

// manage sessions
Session::init();

// Routing
require 'Core/Router.php';
require 'Core/Route.php';


// start routing
//logg('-----'.$_SERVER['REQUEST_URI']);
$router = new Router($_SERVER['REQUEST_URI']);

require ROOT_PATH.'/config/routes.php';

$router->run();


?>

