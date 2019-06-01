<?php

require 'common_functions.php';

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
require 'templ_header.php';
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

<?php
    require ROOT_PATH.'/views/main_content/templ_index.html';
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
require ROOT_PATH."views/footer.php"
?>

</footer>
</body>

</html>