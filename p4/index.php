<?php

require_once "config/global.php";
require_once "views/common_functions.php";
require_once "views/authentication.php";

if (!isset($_GET["p"])) {
    $_GET['p']=0;
} else if ($_GET["p"]<0 || $_GET["p"]>7) {
    $_GET['p']=0;
}

?>

<!--------- COMMON TEMPLATE SITE !-->
<!DOCTYPE html>
<html lang="es">

<!--------- HEAD SECTION !-->
<head>

<?php
// Renderiza head ya procesado segun pagina
head($_GET["p"]);
?>

</head>

<body>

<!--------- HEADER SECTION !-->
<header>

<?php
// Renderiza header
require 'views/header.php';
?>

</header>

<!--------- NAV SECTION !-->
<nav>

<?php
// Renderizamos el menu de navegacion procesado
HTMLnav($_GET["p"]);
?>

</nav>

<!--------- MAIN CONTENT SECTION !-->
<div id="contenido">
    <main id="content-izq" class="general-padding">

<?php
switch ($_GET['p']) {
case 0: 
    include ROOT_PATH.'/views/main_content/templ_index.html'; 
    break;
case 1: 
    include ROOT_PATH.'/views/main_content/templ_catalogo.html';
    break;
case 2: 
    include ROOT_PATH.'/views/main_content/templ_busqueda.html'; 
    break;
case 3: 
    include ROOT_PATH.'/views/main_content/templ_tiendas.html';
    break;
case 4: 
    include ROOT_PATH.'/views/main_content/templ_pedidos.html';
    break;
}
?>

    </main>


<!--------- ASIDE SECTION !-->
    <aside id="content-der" class="general-padding">

<?php
HTMLaside();
?>

    </aside>
</div>

<!--------- FOOTER SECTION !-->
<footer>

<?php
// Renderizamos el footer (por ahora comun)
require "views/templ_footer.html"
?>

</footer>
</body>

</html>