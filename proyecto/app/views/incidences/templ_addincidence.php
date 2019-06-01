<?php
/**
 * Template incidencias management file
 */

require VIEWS_PATH.'functions/functions_common.php';
require VIEWS_PATH.'functions/functions_incidences.php';

?>

<!--------- COMMON TEMPLATE SITE !-->
<!DOCTYPE html>
<html lang="es">

<!--------- HEAD SECTION !-->
<head>

<?php
// Renderiza head ya procesado segun pagina
head($namepage);
?>

</head>

<body>

<!--------- HEADER SECTION !-->
<header>

<?php
// Renderiza header
require VIEWS_PATH.'header.php';
?>

</header>

<!--------- NAV SECTION !-->
<nav>

<?php
// Renderizamos el menu de navegacion procesado
HTMLnav($namepage);
?>

</nav>

<!--------- MAIN CONTENT SECTION !-->
<div id="contenido">
    <main id="content-izq" class="general-padding">
    <h1 class="content-title general-padding">Añadir nueva incidencia</h1>
<?php

/* if(isset($info)){
    htmlInfo($info[0]);
} */

if (isset($errors) && msgCount($errors)>0) {
    msgError($errors);
} else if(isset($info) && msgCount($info)>0) {
    msgInfo($info);
}    

    HTMLaddIncidencia(); 
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
require VIEWS_PATH.'footer.php';
?>

</footer>
</body>

</html>