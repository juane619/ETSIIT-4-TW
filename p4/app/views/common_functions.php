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
    case 'index': 
        echo "Librería de JuanE";
        break;
    case 'catalogo': 
        echo "Librería de JuanE - Catálogo";
        break;
    case 'busquedas': 
        echo "Librería de JuanE - Búsquedas";
        break;
    case 'tiendas': 
        echo "Librería de JuanE - Tiendas";
        break;
    case 'libros': 
        echo "Librería de JuanE - Libros";
        break;
    }
    echo <<< HTML
    </title>
    <meta charset="UTF-8">
    <meta name="author" content="JuanE García">
    <base href="">
HTML;
    echo '<link rel="stylesheet" title="adaptable" href="'.STATIC_PATH.'css/styles.css" />';
    echo '<meta name="viewport" content="width=device-width"> <!-- Para diseño adaptable -->';
}



/**
 * Mark link as active in nav menu.
 * 
 * @param string $activo the string to mark link active
 * 
 * @return null
 */
function HTMLnav($namepage) 
{
    $current = 0;
    $link = '';

    if($namepage === "index") {
        $current = 0;
    }else if($namepage === "catalogo") {
        $current = 1;
    }else if($namepage === "busquedas") {
        $current = 2;
    }
    else if($namepage === "tiendas") {
        $current = 3;
    }
    else if($namepage === "libros") {
        $current = 4;
    }

    echo "<ul>";
    $items = ["Inicio", "Catalogo", "Busquedas", "Tiendas"];
    foreach ($items as $k => $v) {
        error_log($k." ".$v);
        echo "<li".($k==$current?" class='activo' ":"").">"."<a href='".(strtolower($v)=="inicio"?" /index":'/'.strtolower($v))."'>".$v."</a></li>";
    }

    if(isset($_SESSION['user'])) {
        
        echo "<li class=".($current == 4 ? "'activo dropdown'":"dropdown").'>';
        echo <<< HTML
            <a href="javascript:void(0)">Gestión de libros</a>
            <div class="dropdown-content">
            <a href="/books/add">Añadir libros</a>
            <a href="/books/remove/{id}">Eliminar libros</a>
            <a href="/books/edit/{id}">Editar libros</a>
            </div>
        </li>
HTML;
    }
    echo "</ul>";
}

/**
 * Aside section
 *
 * @return null
 */
function HTMLaside() 
{
    echo <<< HTML
    <article>
        <h3>Mas vendidos</h3>
        <ul>
            <li>El quijote</li>
            <li>Ulises</li>
            <li>Arguiñano cocina</li>
        </ul>
    </article>
    <article>
        <h3>Mas populares</h3>
        <ul>
            <li>Charles Dickens</li>
            <li>Julio Verne</li>
            <li>Edgar Allan Poe</li>
        </ul>
    </article>
HTML;
}


    
?>