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
    echo '<title>';

    switch ($page) {
    case 0: 
        echo "Home";
        break;
    case 1: 
        echo "Ver incidencias";
        break;
    case 2: 
        echo "Nueva incidencia";
        break;
    case 3: 
        echo "Mis incidencias";
        break;
    case 4: 
        echo "Gestión de usuarios";
        break;
    case 5: 
        echo "Ver log";
        break;
    case 6: 
        echo "Gestión de BBDD";
        break;
    }
    echo <<< HTML
    </title>
    <meta charset="UTF-8">
    <meta name="author" content="JuanE García">
    <base href="">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
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
    $currentLink = getActiveLink($namepage);

    echo "<ul>";

    //logg('user type: '.$_SESSION['user_type']);

    // Create the nav depending on type of user 
    if($_SESSION['user_type'] == 2) { // Visitantes
        //logg('Visitante en la pagina..');
        $items = ["Home", "Ver incidencias"];
    }else if($_SESSION['user_type'] == 1) { // Colaboradores
        //logg('Colaborador en la pagina..');
        $items = ["Home", "Ver incidencias", "Nueva incidencia", "Mis incidencias"];
    }else if($_SESSION['user_type'] == 0) { // Administradores
        //logg('Administrador en la pagina..');
        $items = ["Home", "Ver incidencias", "Nueva incidencia", "Mis incidencias", "Gestión de usuarios", "Ver log", "Gestión de BBDD"];
    }else{
        $items = ["Home", "Ver incidencias"];
    }

    foreach ($items as $k => $v) {
        echo "<li".($k==$currentLink?" class='activo' ":"").">"."<a href='".ROOT_ROUTE.getPartOfURL($k)."'>".$v."</a></li>";
    }

    echo "</ul>";
}

// Return the id that represents the active link
function getActiveLink($namepage)
{
    switch ($namepage) {
    case 'home': 
        return 0;
            break;
    case 'index': 
        return 0;
                break;
    case 'show': 
        return 1;
            break;
    case 'add': 
        return 2;
            break;
    case 'myincidences': 
        return 3;
            break;
    case 'users': 
        return 4;
            break;
    case 'log': 
        return 5;
            break;
    case 'bbdd': 
        return 6;
            break;
    default:
        return 0;
    }
}

// Return the end part of url depending of item id of nav menu
function getPartOfURL($item)
{
    switch ($item) {
    case 0: 
        return 'home';
        break;
    case 1: 
        return 'incidences/show';
        break;
    case 2: 
        return 'incidences/add';
        break;
    case 3: 
        return 'incidences/my-incidences';
        break;
    case 4: 
        return 'management/users';
        break;
    case 5: 
        return 'management/log';
        break;
    case 6: 
        return 'management/bbdd';
        break;
    default:
        return 'home';
    }
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
        <h3>Los que mas opinan</h3>
        <ul>
            <li>Charles Dickens</li>
            <li>Julio Verne</li>
            <li>Edgar Allan Poe</li>
        </ul>
    </article>
HTML;
}


    
?>