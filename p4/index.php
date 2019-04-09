<?php

require "view/common_functions.php";

if (!isset($_GET["p"])) {
    $_GET['p']=0;
} else if ($_GET["p"]<0 || $_GET["p"]>4) {
    $_GET['p']=0;
}

// Segun la pagina requerida a renderizar, elegiremos los modulos a cargar

// Elegimos modulo header a cargar
switch ($_GET['p']) {
case 0: 
    echo expandir("view/templ_head.html", ['PAGE_TITLE' => 'Librería de JuanE']); 
    break;
case 1: 
    echo expandir("view/templ_head.html", ['PAGE_TITLE' => 'Catálogo']);
    break;
case 2: 
    echo expandir("view/templ_head.html", ['PAGE_TITLE' => 'Búsquedas']);
    break;
case 3: 
    echo expandir("view/templ_head.html", ['PAGE_TITLE' => 'Librerías']);
    break;
case 4: 
    echo expandir("view/templ_head.html", ['PAGE_TITLE' => 'Pedidos']);
    break;
}



HTMLnav($_GET["p"]);

switch ($_GET['p']) {
case 0: 
    include 'view/templ_index.html'; 
    break;
/* case 1: 
    include 'view/templ_catalogo.html';
    break;
case 2: 
    include 'view/templ_busqueda.html'; 
    break;
case 3: 
    include 'view/templ_tiendas.html';
    break;
case 4: 
    include 'view/templ_pedidos.html';
    break; */
}

require "view/templ_footer.html"

?>