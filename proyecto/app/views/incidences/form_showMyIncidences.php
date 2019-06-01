<?php
    require_once VIEWS_PATH.'functions/functions_incidences.php';

    echo '<div class="catalogo-incidencias">';

if(!isset($incidencias) || empty($incidencias)) {
    msgInfo('No hay incidencias añadidas actualmente..');
} else{
    showIncidences($incidencias);

    echo '</div>';
    
}

?>