<?php
/**
 * Common books render functions file
 */

/**
 * Render add books form
 */
function HTMLaddBook()
{
    echo <<< HTML
    <form action="" method="post">
        <div class="row">
            <div class="col-10">
                <label for="autor">Autor</label>
            </div>
            <div class="col-75">
                <input type="text" id="autor" name="autor" placeholder="Autor..">
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="titulo">Título</label>
            </div>
            <div class="col-75">
                <input type="text" id="titulo" name="titulo" placeholder="Titulo..">
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="isbn">ISBN</label>
            </div>
            <div class="col-75">
                <input type="text" id="isbn" name="isbn" placeholder="ISBN..">
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label>Precio</label>
            </div>
            <div class="col-75">
                   <input type="number" name="price">
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="genre">Género</label>
            </div>
            <div class="col-75">
                <select id="genre" name="genre">
                    <option selected="">- elije el género -</option>
                    <option value="bel">- Bélico -</option>
                    <option value="ave">- Aventuras -</option>
                    <option value="rom">- Romance -</option>
                    <option value="fan">- Fantástico -</option>
                    <option value="ter">- Terror -</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label>Tapa</label>
            </div>
            <div class="col-75">
                <div class="encuads">
                    <label><input type="radio" name="encuad" value="td">Tapa dura</label>
                    <label><input type="radio" name="encuad" value="tb">Tapa blanda</label>
                    <label><input type="radio" name="encuad" value="cq" checked="">Cualquiera</label>
                </div>
            </div>
        </div>
        <input class="my-button" type="submit" value="Añadir libro">
    </form>
HTML;
}
?>