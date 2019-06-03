<div class="search-filters">
    <h5>Criterios de búsqueda</h5>
    
    <form action="" method="POST">
    
        <div class="filters-section">
        <h6>Ordenar por:</h6>
            <div class="row">
                <input type="radio" name="ordenar" id="antiguedad" value="antiguedad"/>
                <label for="antiguedad">Antigüedad (primero las más cercanas)</label>
            </div>

            <div class="row">
                <input type="radio" name="ordenar" id="positivos" value="positivos"/>
                <label for="positivos">Número de positivos primero</label>
            </div>

            <div class="row">
                <input type="radio" name="ordenar" id="negativos" value="negativos"/>
                <label for="negativos">Número de negativos primero</label>
            </div>

            <div class="row">
                <input type="radio" name="ordenar" id="positivosnetos" value="positivosnetos"/>
                <label for="positivosnetos">Número de positivos netos primero</label>
            </div>
        </div>

        <div class="filters-section">
            <h6>Incidencias que contengan: </h6>
            <div class="row">
                <div class="col-15">
                    <label for="texto">Texto de búsqueda</label>
                </div>
                <div class="col-75">
                    <input type="text" id="texto" name="texto" placeholder="Texto de búsqueda.." value="">
                </div>
            </div>
            <div class="row">
                <div class="col-15">
                    <label for="lugar">Lugar</label>
                </div>
                <div class="col-75">
                    <input type="text" id="lugar" name="lugar" placeholder="Lugar.." value="">
                </div>
            </div>
        </div>

        <div class="filters-section">
            <h6>Estado:</h6>
            <div class="row">
                <input type="checkbox" name="state[]" id="pendiente" value="Pendiente de comprobacion"> <label for="pendiente">Pendiente</label>
                <input type="checkbox" name="state[]" id="comprobada" value="Comprobada"> <label for="comprobada">Comprobada</label>
                <input type="checkbox" name="state[]" id="tramitada" value="Tramitada"> <label for="tramitada">Tramitada</label>
                <input type="checkbox" name="state[]" id="irresoluble" value="Irresoluble"> <label for="irresoluble">Irresoluble</label>
                <input type="checkbox" name="state[]" id="resuelta" value="Resuelta"> <label for="resuelta">Resuelta</label>
            </div>
        </div>
        
        <input class="my-button filters-button" type="submit" name="submit" value="Filtrar">
    </form>

</div>

<?php
    require_once VIEWS_PATH.'functions/functions_incidences.php';



    echo '<div class="catalogo-incidencias">';

if(!isset($incidencias) || empty($incidencias)) {
    msgInfo('No hay incidencias añadidas actualmente..');
} else{
    echo '<h5>Incidencias encontradas</h5>';
    showIncidences($incidencias);

    echo '</div>';
    
}

?>