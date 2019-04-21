<?php
/**
 *  Common functions authentication module
 */


if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

 /**
  * Boton y formulario de login
  * 
  * @return null
  */

function htmlLogin($error)
{
    echo <<< HTML
<button class="my-button" onclick="document.getElementById('head_login').style.display='block'"
            style="width:auto;">Login</button>
HTML;
    if($error == "invalid") {
        echo "<div id='head_login' class='modal' style='display:block;'>";
    }else{
        echo "<div id='head_login' class='modal'>";
    }
    echo <<< HTML
    
        <form class="modal-content animate" action="#" method="POST">
            <div class="imgcontainer">
                <span onclick="document.getElementById('head_login').style.display='none'" class="close"
                    title="Close Modal">&times;</span>
                <img src="../img/bohemia.jpeg" alt="Avatar" class="avatar">
            </div>

            <div class="container">
HTML;
    if($error == "invalid") {
        echo "<p class='form-invalid'>Datos incorrectos</p>";
    }
    echo <<< HTML
                <label for="username"><b>Nombre de usuario</b></label>
                <input type="text" placeholder="Nombre de usuario" name="username" required>

                <label for="passwd"><b>Contraseña</b></label>
                <input type="password" placeholder="Contraseña" name="passwd" required>

                <button type="submit">Login</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Recordar
                </label>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('head_login').style.display='none'"
                    class="cancelbtn">Cancelar</button>
                <!-- <span class="psw"><a href="#">Olvidaste la contraseña?</a></span> -->
                <span class="psw"><a href="#">No tienes cuenta?</a></span>
            </div>
        </form>
    </div>
HTML;
}

/**
 * Formulario de registro
 * 
 * @return null
 */

function htmlRegister()
{
    echo <<< HTML
    <form class="modal-content animate" action="/index.php" method="POST">
        <div class="container">
            <label for="username"><b>Nombre de usuario</b></label>
            <input type="text" placeholder="Nombre de usuario" name="username" required>

            <label for="passwd"><b>Contraseña</b></label>
            <input type="password" placeholder="Contraseña" name="passwd" required>

            <button type="submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Recordar
            </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('head_login').style.display='none'"
                class="cancelbtn">Cancelar</button>
            <span class="psw"><a href="#">Olvidaste la contraseña?</a></span>
            <span class="psw"><a href="#">No tienes cuenta?</a></span>
        </div>
    </form>
</div>
HTML;
}

/**
 * Renderizado de la parte del usuario
 * 
 * @return null
 */
function htmlWelcome()
{
    echo <<< HTML
<div id="welcome" class="container">
    <p>Bienvenido Juan Emilio (juanE)</p>
    <form action="#" method="POST">
        <input class="my-button" type="submit" name="logout" value="Logout">
    </form>
</div>
HTML;
}

/**
 * Destroy session
 */
function acabarSesion() 
{
    // La sesión debe estar iniciada
    if (session_status()==PHP_SESSION_NONE) {
        session_start();
    }
    // Borrar variables de sesión
    //$_SESSION = array();
    session_unset();
    // Destruir sesión
    session_destroy();
}

?>