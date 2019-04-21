<?php
/**
 * Template book management file
 */

require_once ROOT_PATH."/views/common_functions.php";
require_once ROOT_PATH."/views/manage_books/functions.php";

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
require_once ROOT_PATH.'/views/header.php';
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
HTMLaddBook(); 
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
require ROOT_PATH."/views/footer.php"
?>

</footer>
</body>

</html>