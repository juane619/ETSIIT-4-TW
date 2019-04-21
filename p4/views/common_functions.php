<?php

/**
 * Common render functions
 *
 * PHP version 7
 */


/**
 * Start index.
 * 
 * @param string $titulo the string to quote
 * 
 * @return null
 */
function head($page) 
{
    echo <<< HTML
    <title>
HTML;
    switch ($page) {
    case 0: 
        echo "Librería de JuanE";
        break;
    case 1: 
        echo "Librería de JuanE - Catálogo";
        break;
    case 2: 
        echo "Librería de JuanE - Búsquedas";
        break;
    case 3: 
        echo "Librería de JuanE - Tiendas";
        break;
    case 4: 
        echo "Librería de JuanE - Pedidos";
        break;
    }
    echo <<< HTML
    </title>
    <meta charset="UTF-8">
    <meta name="author" content="JuanE García">
    <base href="">
    <link rel="stylesheet" title="adaptable" href="css/styles.css" />
    <meta name="viewport" content="width=device-width"> <!-- Para diseño adaptable -->
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
    echo "<nav>";
    echo "<ul>";
    $items = ["Inicio", "Catálogo", "Búsquedas", "Tiendas", "Pedidos"];
    foreach ($items as $k => $v) {
        echo "<li".($k==$activo?" class='activo'":"").">"."<a href='index.php?p=".($k)."'>".$v."</a></li>";
    }

    if(isset($_SESSION['usuario'])) {
        echo <<< HTML
        <li class="dropdown">
            <a href="javascript:void(0)">Gestión de libros</a>
            <div class="dropdown-content">
            <a href="#">Añadir libros</a>
            <a href="#">Eliminar libros</a>
            <a href="#">Editar libros</a>
            </div>
        </li>
HTML;
    }
    echo "</ul>";
    echo "</nav>";
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