<?php
if(!empty($incidence)) {
    echo  '<form action="'.$incidence->getId().'" method="post" onsubmit="return confirm(\'Sseguro de la edición de la incidencia?\');">';
        echo '<div class="row">';
        echo '<div class="col-15">';
            echo '<label for="titulo">Estado de la incidencia</label>';
        echo '</div>';
        echo '<div class="col-75">';
            echo '<input type="radio" name="estado" id="pendiente" value="1" ' . ($incidence->getEstado() == 1 ?"checked ":"") . ($_SESSION['user']->getTipo() != 0 ?"disabled":"") .'/>';
            echo '<label for="pendiente">Pendiente</label>';

            echo '<input type="radio" name="estado" id="comprobada" value="2" ' . ($incidence->getEstado() == 2 ?"checked ":"") . ($_SESSION['user']->getTipo() != 0 ?"disabled":"") .'/>';
            echo '<label for="comprobada">Comprobada</label>';

            echo '<input type="radio" name="estado" id="tramitada" value="3" ' . ($incidence->getEstado() == 3 ?"checked ":"") . ($_SESSION['user']->getTipo() != 0 ?"disabled":"") .'/>';
            echo '<label for="tramitada">Tramitada</label>';

            echo '<input type="radio" name="estado" id="irresoluble" value="4" ' . ($incidence->getEstado() == 4 ?"checked ":"") . ($_SESSION['user']->getTipo() != 0 ?"disabled":"") .'/>';
            echo '<label for="irresoluble">Irresoluble</label>';

            echo '<input type="radio" name="estado" id="resuelta" value="5" ' . ($incidence->getEstado() == 5 ?"checked ":"") . ($_SESSION['user']->getTipo() != 0 ?"disabled":"") .'/>';
            echo '<label for="resuelta">Resuelta</label>';
        echo '</div>';
        echo '</div>';
        echo '<div class="row">';
            echo '<div class="col-15">';
                echo '<label for="titulo">Titulo de la incidencia</label>';
            echo '</div>';
            echo '<div class="col-75">';
                echo '<input type="text" id="titulo" name="titulo" placeholder="Titulo.." value="'.$incidence->getTitulo().'">';
            echo '</div>';
        echo '</div>';
        echo <<< HTML
        <div class="row">
            <div class="col-15">
                <label for="descripcion">Descripción de la incidencia</label>
            </div>
            <div class="col-75">
HTML;
        echo '<input type="text" id="descripcion" name="descripcion" placeholder="Descripcion.." value="'.$incidence->getDescripcion().'">';
        echo <<< HTML
            </div>
        </div>
        <div class="row">
            <div class="col-15">
                <label for="lugar">Lugar</label>
            </div>
            <div class="col-75">
HTML;
        echo '<input type="text" id="lugar" name="lugar" placeholder="Lugar.." value="'.$incidence->getLugar().'">';
        echo <<< HTML
            </div>
        </div>
        <div class="row">
            <div class="col-15">
                <label for="tags">Tags</label>
            </div>
            <div class="col-75">
HTML;
            echo '<input type="text" id="tags" name="tags" placeholder="Tags.." value="'.$incidence->getTags().'">';
            echo <<< HTML
            </div>
        </div>
HTML;
        echo '<input class="my-button" type="submit" name="submit" value="Editar incidencia">';
    echo '</form>';

}


?>