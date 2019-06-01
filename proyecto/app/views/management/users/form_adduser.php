<?php
    echo '<div class="manage-section">';

    echo <<< HTML
    <form action="" method="post" id="adduser-form">
        <div class="row">
            <div class="col-10">
                <label for="username">Username: (*)</label>
            </div>
            <div class="col-75">
                <input type="text" id="username" name="username" placeholder="Username..">
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="password">Contraseña: (*)</label>
            </div>
            <div class="col-75">
                <input type="password" id="password" name="password" placeholder="Contraseña..">
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="password_confirm">Repita su contraseña: (*)</label>
            </div>
            <div class="col-75">
                <input type="password" id="password_confirm" name="password_confirm" placeholder="Contraseña..">
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="email">Email: (*)</label>
            </div>
            <div class="col-75">
                <input type="email" id="email" name="email" placeholder="Email..">
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="nombre">Nombre: </label>
            </div>
            <div class="col-75">
                <input type="text" id="nombre" name="nombre" placeholder="Nombre..">
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="apellidos">Apellidos: </label>
            </div>
            <div class="col-75">
                <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos..">
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="email">Direccion:</label>
            </div>
            <div class="col-75">
                <input type="text" id="direccion" name="direccion" placeholder="Direccion..">
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="telefono">Telefono: </label>
            </div>
            <div class="col-75">
                <input type="number" id="telefono" name="telefono" placeholder="Telefono..">
            </div>
        </div>
        <!--Foto -->
        <div class="row">
            <div class="col-10">
                <label>Foto</label>
            </div>
            <div class="col-75">
                   <input type="file" name="foto">
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
                    <option value="1">Colaborador</option>
                    <option value="0">Administrador</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="estado">Estado: </label>
            </div>
            <div class="col-75">
                <select name="estado">
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>
        </div>
HTML;
}
echo <<< HTML
        <input class="my-button" type="submit" name="submit" value="Registrar usuario">
    </form>
HTML;
    

    echo '</div>';
    


?>