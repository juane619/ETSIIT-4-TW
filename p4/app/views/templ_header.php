<?php
require 'authentication.php';
require 'Core/Auth.php';
?>

<div id="head_izq">
    <img src="<?php echo STATIC_PATH; ?>img/logo-libro.png" alt="El lector de libros" />
</div>

<div id="head_der">
    <h1>El lector de Libros</h1>
    <h3>Contando historias desde hace 100 años</h3>
</div>

<div id="head_login2">
    <?php
    $error = "";
    // Comprobar estado previo
    if (Auth::check() && !isset($_POST['logout'])) {
        // ¿está autenticado?
        $accion = "yaidentificado";
    }else if (isset($_POST['username']) && isset($_POST['passwd']) ) {
        // Se han recibido datos del formulario de login: validar login
        $username = $_POST['username'];
        $password = $_POST['passwd'];

        if ($username=="juane" && $password=="prueba") {
            Auth::login($username, $password); // Autenticación correcta
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