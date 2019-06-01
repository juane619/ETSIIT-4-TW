<?php


require 'Core/View.php';

require ROOT_PATH.'controllers/'.'MainController.php';
require ROOT_PATH.'controllers/'.'IncidenciasController.php';
require ROOT_PATH.'controllers/'.'ManagementController.php';


/**
 * Routes of our web
 */

 // Controllers
$mainController = new MainController();
$incidenciasController = new IncidenciasController();
$managementController = new ManagementController();

$router->add(
    ROOT_ROUTE, $mainController, 'index'
);

$router->add(
    ROOT_ROUTE.'home', $mainController, 'index'
);

// Incidences routes
$router->add(
    ROOT_ROUTE.'incidences/show', $incidenciasController, 'showIncidences'
);

$router->add(
    ROOT_ROUTE.'incidences/add', $incidenciasController, 'addIncidence'
);

$router->add(
    ROOT_ROUTE.'incidences/my-incidences', $incidenciasController, 'showMyIncidences'
);

$router->add(
    ROOT_ROUTE.'incidences/make-val', $incidenciasController, 'makeValoration'
);

$router->add(
    ROOT_ROUTE.'incidences/insert-comment', $incidenciasController, 'insertComment'
);

$router->add(
    ROOT_ROUTE.'incidences/remove-comment', $incidenciasController, 'removeComment'
);

$router->add(
    ROOT_ROUTE.'incidences/remove-incidence', $incidenciasController, 'removeIncidence'
);

$router->add(
    ROOT_ROUTE.'incidences/edit/:id', $incidenciasController, 'editIncidence'
);

// Management routes
$router->add(
    ROOT_ROUTE.'management/users', $managementController, 'manageUsers'
);

$router->add(
    ROOT_ROUTE.'management/users/add', $managementController, 'addUser'
);

$router->add(
    ROOT_ROUTE.'management/users/remove', $managementController, 'removeUser'
);

$router->add(
    ROOT_ROUTE.'management/users/edit/:id', $managementController, 'editUser'
);

$router->add(
    ROOT_ROUTE.'management/log', $managementController, 'manageLog'
);

$router->add(
    ROOT_ROUTE.'management/bbdd', $managementController, 'manageBBDD'
);


/* $router->add(
    ROOT_ROUTE.'incidencias/remove/:id', $incidenciasController, 'remove'
); */


?>