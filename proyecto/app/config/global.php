<?php
/**
 * Global constraints file
 */
define('ENVIRONMENT', 'PRODUCTION'); // CAN BE 'DEVELOPMENT' OR 'PRODUCTION'

if(ENVIRONMENT === 'DEVELOPMENT') {
    define('ROOT_ROUTE', '/proyecto/');
} else if(ENVIRONMENT === 'PRODUCTION') {
    define('ROOT_ROUTE', '/~juane6191819/proyecto/');
}

define("DEFAULT_CONTROLLER", "mainController");
define("ACCION_DEFECTO", "index");
define('ROOT_PATH', dirname(__DIR__).'/');
define('VIEWS_PATH', ROOT_PATH.'views/');
define('STATIC_PATH', ROOT_ROUTE.'static/');



?>
