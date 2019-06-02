<?php
if(!empty($user)) {
    echo  '<form action="'.$user->getId().'" method="post" onsubmit="return confirm(\'Esta seguro que quiere editar el usuario? Los cambios serán irreversibles.\');">';
        
        echo '<div class="row">';
            echo '<div class="col-10">';
                echo '<label for="nombre">Nombre: </label>';
            echo '</div>';
            echo '<div class="col-75">';
                echo '<input type="text" id="nombre" name="nombre" placeholder="Nombre.." value="'.$user->getNombre().'">';
            echo '</div>';
        echo '</div>';
        echo <<< HTML
        <div class="row">
            <div class="col-10">
                <label for="apellidos">Apellidos: </label>
            </div>
            <div class="col-75">
HTML;
        echo '<input type="text" id="apellidos" name="apellidos" placeholder="Apellidos.." value="'.$user->getApellidos().'">';
        echo <<< HTML
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="email">Email: </label>
            </div>
            <div class="col-75">
HTML;
        echo '<input type="email" id="email" name="email" placeholder="Email.." value="'.$user->getEmail().'">';
        echo <<< HTML
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="password">New Password: </label>
            </div>
            <div class="col-75">
HTML;
        echo '<input type="text" id="password" name="password" placeholder="New password..">';
        echo <<< HTML
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="direccion">Dirección: </label>
            </div>
            <div class="col-75">
HTML;
            echo '<input type="text" id="direccion" name="direccion" placeholder="Dirección.." value="'.$user->getDireccion().'">';
            echo <<< HTML
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="telefono">Teléfono: </label>
            </div>
            <div class="col-75">
HTML;
            echo '<input type="text" id="telefono" name="telefono" placeholder="Teléfono.." value="'.$user->getTelefono().'">';
            echo <<< HTML
            </div>
        </div>
HTML;

    if($_SESSION['user_type'] == 0) {
        echo <<< HTML
            <div class="row">
            <div class="col-10">
                <label for="tipo">Tipo: </label>
            </div>
            <div class="col-75">
                <select name="tipo">
HTML;
                    echo '<option value="1" '. ($_SESSION['user']->getTipo() == 1 ?"selected":"") .'>Colaborador</option>';
                    echo '<option value="0" '. ($_SESSION['user']->getTipo() == 0 ?"selected":"") .'>Administrador</option>';
                echo <<< HTML
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="estado">Estado: </label>
            </div>
            <div class="col-75">
                <select name="estado">
HTML;
                    echo '<option value="activo" '. ($_SESSION['user']->getEstado() == 'activo' ?"selected":"") .'>Activo</option>';
                    echo '<option value="inactivo" '. ($_SESSION['user']->getEstado() == 'inactivo' ?"selected":"") .'>Inactivo</option>';
                echo <<< HTML
                </select>
            </div>
        </div>
HTML;
    }
    echo <<< HTML
        <input class="my-button" type="submit" name="submit" value="Modificar usuario">
    </form>
HTML;

}


?>