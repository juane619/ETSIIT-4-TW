<?php

require_once "views/common_functions.php";
require_once "views/authentication.php";

if (!isset($_GET["p"])) {
    $_GET['p']=0;
} else if ($_GET["p"]<0 || $_GET["p"]>7) {
    $_GET['p']=0;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
<?php

// Segun la pagina requerida a renderizar, elegiremos los modulos a cargar

// Renderiza head ya procesado segun pagina
head($_GET["p"]);

?>

</head>
<body>

<header>
<?php

// Renderiza header
require 'views/header.php';

?>
</header>

<?php

// Renderizamos el menu de navegacion procesado
HTMLnav($_GET["p"]);

// Renderizamos contenido principal segun pagina
switch ($_GET['p']) {
case 0: 
    include 'views/templ_index.html'; 
    break;
case 1: 
    include 'views/templ_catalogo.html';
    break;
case 2: 
    include 'views/templ_busqueda.html'; 
    break;
case 3: 
    include 'views/templ_tiendas.html';
    break;
case 4: 
    include 'views/templ_pedidos.html';
    break;
}

// Renderizamos el footer (por ahora comun)
require "views/templ_footer.html"

?>

</body>

</html>