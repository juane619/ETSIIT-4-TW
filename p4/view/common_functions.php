<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Common functions
 *
 * PHP version 7
 */

$tags = [
    'PAGE_TITLE' => 'Librería de JuanE'
    /* 'CATALOGO_TITLE' => 'Catálogo',
    'BUSQUEDAS_TITLE' => 'Búsquedas',
    'TIENDAS_TITLE' => 'Tiendas',
    'PEDIDOS_TITLE' => 'Pedidos' */
];

/**
 * Start index.
 * 
 * @param string $titulo the string to quote
 * 
 * @return null
 */
function HTMLinicio($titulo) 
{
    echo <<< HTML
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="pag_estilo.css">
<title>$titulo</title>
</head>
<body>
HTML;
}

/**
 * Mark link as active in nav menu.
 * 
 * @param string $activo the string to mark link active
 * 
 * @return null
 */
function HTMLnav($activo) 
{
    echo <<< HTML
    <nav>
    <ul>
HTML;
    $items = ["Inicio", "Catálogo", "Búsquedas", "Tiendas", "Pedidos"];
    foreach ($items as $k => $v) {
        echo "<li".($k==$activo?" class='activo'":"").">"."<a href='index.php?p=".($k)."'>".$v."</a></li>";
    }
    echo <<< HTML
    </ul>
    </nav>
HTML;
}


/**
 * Search and replace the special vars (##ALGO##)
 * 
 * @param string $activo the string to mark link active
 * 
 * @return null
 */
function expandir($fich, $tags) 
{
    if ($f=fopen($fich, 'r')) {
        $plantilla = fread($f, filesize($fich));
        fclose($f);
        foreach ($tags as $k => $v) {
            $plantilla = str_replace("##{$k}##", $v, $plantilla);
        }
    } else {
        $plantilla = '';
    }
    return $plantilla;
}
    
?>