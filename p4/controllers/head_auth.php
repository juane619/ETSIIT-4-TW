<?php
/**
 * Authentication controller file
 */

require_once "views/common_functions.php";

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Comprobar estado previo
if (isset($_SESSION['usuario'])) {
    // ¿está autenticado?
    $accion = "yaidentificado";
}else if (isset($_POST['username']) && isset($_POST['passwd']) ) {
    // Se han recibido datos del formulario de login: validar login
    if ($_POST['username']=="juane" && $_POST['passwd']=="prueba") {
        $_SESSION['usuario'] = $_POST['username']; // Autenticación correcta
        $_SESSION['nombre'] = "JuanE, ({$_POST['usuario']})";
        $accion = "welcome";
    } else {
        $accion = "errorautenticacion";
    }
    // Los datos no son válidos
} else {
    $accion = "formulario"; // Acceso directo a la página de login
}

switch ($accion) {
case "yaidentificado":
    echo "<h1>Usted ya está autenticado {$_SESSION['nombre']}</h1>";
    break;
case "errorautenticacion":
    header("url=index.php?p=0");
    break;
case "formulario":
    include '../views/templ_header.php';
    break;
case "welcome":
    header("url=index.php/?p=0");
    break;
default:
    echo "default";
}


?>