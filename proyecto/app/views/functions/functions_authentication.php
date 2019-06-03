<?php


/**
 *  Common functions authentication module
 */




 /**
  * Boton y formulario de login
  * 
  * @return null
  */

function htmlLogin($error)
{
    echo <<< HTML
    <button id="login-button" class="my-button" data-toggle="modal" data-target="#login-modal"
            style="width:auto;">Login</button>
        
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <button class="my-button" type="button" class="close" 
                    data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Login
                    </h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="imgcontainer">
HTML;
                            echo '<img src="'.STATIC_PATH.'img/user-icon.png" alt="Avatar">';
    echo <<< HTML
                        </div>

                        <div class="form-group">
HTML;
    if($error == "invalid") {
        echo "<p class='form-invalid'>Datos incorrectos</p>";
    }else if($error == "needauth") {
        echo "<p class='form-invalid'>Se necesita autenticación para acceder a esta página</p>";
    }
                            echo <<< HTML
                            <label for="username"><b>Nombre de usuario</b></label>
                            <input type="text" placeholder="Nombre de usuario" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="passwd"><b>Contraseña</b></label>
                            <input type="password" placeholder="Contraseña" name="passwd" required>
                        </div>
                        <button type="submit" class="my-button">Login</button>
                        <label>
                            <input type="checkbox" checked="checked" name="remember"> Recordar
                        </label>

                        <div class="container">
HTML;
                            echo '<span class="psw"><a href="'.ROOT_ROUTE.'management/users/add">No tienes cuenta?</a></span>';
                            echo <<< HTML
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
HTML;
    if($error == "invalid" || $error == "needauth") {
        echo '<script> $(function() { $("#login-modal").modal("show"); })</script>';
    }
}

/**
 * Formulario de registro
 * 
 * @return null
 */

function htmlModalError($error)
{
    echo <<< HTML
    <div class="modal fade" id="modal_falla" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
HTML;
                    echo '<h4 class="modal-title">'.$error.'</h4>';
    echo <<< HTML
                </div>
                <div class="modal-footer">
                    <button type="button" class="my-button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>$(function() { $('#modal_falla').modal('show'); });</script>
HTML;
}



/**
 * Renderizado de la parte del usuario
 * 
 * @return null
 */
function htmlWelcome()
{
    echo '<div id="welcome" class="container">';
    echo '<p>Bienvenido '.$_SESSION['user']->getNombre().' (<a href="'.ROOT_ROUTE.'management/users/edit/'.$_SESSION['user']->getId().'">'.$_SESSION['user']->getUsername().')</a></p>';
    echo '<form action="'.ROOT_ROUTE.'" method="POST">';
        echo '<input class="my-button" type="submit" name="logout" value="Logout">';
    echo '</form>';
    echo '</div>';
}

/**
 * Destroy session
 */
function acabarSesion() 
{
    // La sesión debe estar iniciada
    if (Session::getStatus==PHP_SESSION_NONE) {
        Session::init();
    }
    
    Session::close();
}

?>