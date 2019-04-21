<?php
require_once 'authentication.php';
?>

<div id="head_izq">
    <img src="img/logo-libro.png" alt="El lector de libros" />
</div>

<div id="head_der">
    <h1>El lector de Libros</h1>
    <h3>Contando historias desde hace 100 años</h3>
</div>

<div id="head_login2">
    <?php
    $error = "";
    // Comprobar estado previo
    if (isset($_SESSION['usuario']) && !isset($_POST['logout'])) {
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
            $error = "invalid";
        }
        // Los datos no son válidos
    } else if (isset($_POST["logout"])) {
        $accion = "logout"; // Acceso directo a la página de login
    } else{
        $accion = "showform";
    }

    switch ($accion) {
    case "yaidentificado":
        htmlWelcome();
        break;
    case "errorautenticacion":
        htmlLogin($error);
        break;
    case "formulario":
        htmlLogin($error);
        break;
    case "welcome":
        htmlWelcome();
        break;
    case "logout":
        acabarSesion();
        htmlLogin($error);
        break;
    case "showform":
        htmlLogin($error);
        break;
    default:
    }
    ?>
</div>