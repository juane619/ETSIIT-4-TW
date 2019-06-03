<?php
require_once VIEWS_PATH.'functions/functions_authentication.php';
require_once 'Core/Auth.php';
require_once 'Core/Helpers.php';
// Database info
$database_info = include_once ROOT_PATH.'/config/database.php';

?>

<div id="head_izq">
    <a href="<?php echo ROOT_ROUTE; ?>"><img src="<?php echo STATIC_PATH; ?>img/logo-incidencias.png" alt="Comunícate"  ></a>
</div>

<div id="head_der">
    <h1>Comunícate</h1>
    <h3>Compartir y comunicar para mejorar</h3>
</div>

<div id="head_login2">

    <?php
    echo 'USUARIO ADMINISTRADOR-> user: "juane" --- pass: "prueba"   ';
    $error = "";

    /**
* Tipos de usuarios
     * 0: admin
     * 1: colaborador
     * 2: visitante
     */
    if(!isset($_SESSION['user_type'])) {
        $_SESSION['user_type'] = 2; //Por defecto el tipo de usuario es visitante (2)
    }
    
    // Comprobar estado previo
    if (Auth::check() && !isset($_POST['logout'])) {
        // ¿está autenticado?
        $accion = "yaidentificado";
    }else if (isset($_POST['username']) && isset($_POST['passwd']) ) {
        // Se han recibido datos del formulario de login: validar login
        $username = parseInput($_POST['username']);
        $password = parseInput($_POST['passwd']);

        // connect to db
        Database::init($database_info);

        // Attempting login user
        if(Auth::login($username, $password)) { // Autenticación correcta
            $accion = "welcome";
        } else{
            $accion = "errorautenticacion";
            $error = "invalid";
        }
        // Los datos no son válidos
    } else if (isset($_POST["logout"])) {
        $accion = "logout"; // Acceso directo a la página de login
    } else{
        if(isset($needauth)) {
            $accion = "needauth";
        } else if(isset($needPrivileges)) {
            $accion = "needPrivileges";
        } else {
            $accion = "showform";
        }
    }

    switch ($accion) {
    case "yaidentificado":
        //logg("already login.. ");
        htmlWelcome();

        if(isset($needPrivileges)) {
            //logg("Showing modal.. ");
            htmlModalError("No tienes suficientes privilegios para acceder a esta página..");
        }
        break;
    case "errorautenticacion":
        //logg("ERROR AUTENTICATHION..");
        htmlLogin($error);
        break;
    case "welcome":
        //logg("welcome..");
        htmlWelcome();
        break;
    case "logout":
        //logg("logouting..");
        Auth::logout();
        htmlLogin($error);
        break;
    case "showform":
        //logg("showing form..");
        htmlLogin($error);
        break;
    case "needauth":
        //logg("need auth..");
        $error = "needauth";
        htmlLogin($error);
        break;
    default:
    }
    ?>
</div>