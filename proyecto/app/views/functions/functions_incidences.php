<?php
/**
 * Common incidencias render functions file
 */


function htmlInfo($info)
{
    
    
        echo "<div id='head_login' class='modal' style='display:block;'>";
    
    echo <<< HTML
    
        <form class="modal-content animate" action="" method="POST">
            <div class="imgcontainer">
                <span onclick="document.getElementById('head_login').style.display='none'" class="close"
                    title="Close Modal">&times;</span>

            </div>

            <div class="container">
HTML;
    
        echo "<p class='form-invalid'>".$info."</p>";
    
    echo <<< HTML
                
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('head_login').style.display='none'"
                    class="cancelbtn">Aceptar</button>
                <!-- <span class="psw"><a href="#">Olvidaste la contraseña?</a></span> -->
            </div>
        </form>
    </div>
HTML;
}

/**
 * Render add incidencias form
 */
function HTMLaddIncidencia()
{
    
    echo <<< HTML
    <form action="" method="post" id="incidence-form">
        <div class="row">
            <div class="col-10">
                <label for="titulo">Titulo de la incidencia</label>
            </div>
            <div class="col-75">
                <input type="text" id="titulo" name="titulo" placeholder="Titulo..">
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="descripcion">Descripción de la incidencia</label>
            </div>
            <div class="col-75">
                <textarea id="descripcion" name="descripcion" placeholder="Descripcion.."></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="lugar">Lugar</label>
            </div>
            <div class="col-75">
                <input type="text" id="lugar" name="lugar" placeholder="Lugar..">
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="tags">Tags</label>
            </div>
            <div class="col-75">
                <input type="text" id="tags" name="tags" placeholder="TAGS..">
            </div>
        </div>
        <!--Foto -->
        <div class="row">
            <div class="col-10">
                <label>Fotos</label>
            </div>
            <div class="col-75">
                   <input type="file" name="foto">
            </div>
        </div>
        
       
        <input class="my-button" type="submit" name="submit" value="Añadir incidencia">
    </form>
HTML;
}

/**
 * Render edit incidencias form
 */
function HTMLeditIncidence($incidence)
{
    
    echo <<< HTML
    <form action="" method="post" id="incidence-form">
        <div class="row">
            <div class="col-10">
                <label for="titulo">Titulo de la incidencia</label>
            </div>
            <div class="col-75">
                <input type="text" id="titulo" name="titulo" placeholder="Titulo..">
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="descripcion">Descripción de la incidencia</label>
            </div>
            <div class="col-75">
                <textarea id="descripcion" name="descripcion" placeholder="Descripcion.."></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="lugar">Lugar</label>
            </div>
            <div class="col-75">
                <input type="text" id="lugar" name="lugar" placeholder="Lugar..">
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <label for="tags">Tags</label>
            </div>
            <div class="col-75">
                <input type="text" id="tags" name="tags" placeholder="Tags..">
            </div>
        </div>
        <!--Foto -->
        <div class="row">
            <div class="col-10">
                <label>Fotos</label>
            </div>
            <div class="col-75">
                   <input type="file" name="foto">
            </div>
        </div>
        
       
        <input class="my-button" type="submit" name="submit" value="Añadir incidencia">
    </form>
HTML;
}

function showIncidences($incidencias)
{
    foreach($incidencias as &$incidencia){
        echo '<article class="incidence-entry" id="incidence_'.$incidencia->getId().'">';
        echo '<h3 class="incidence-title">'.$incidencia->getTitulo().'</h3>';
        echo '<div class="incidence-atribute">Lugar: <span>'.$incidencia->getLugar().'</span></div>';
        echo '<div class="incidence-atribute">Fecha: <span>'.$incidencia->getFecha().'</span></div>';
        echo '<div class="incidence-atribute">Creado por: <span>'.$incidencia->getUsuario()->getUsername().'</span></div>';
        echo '<div class="incidence-atribute">Palabras clave: <span>'.$incidencia->getTags().'</span></div>';
        echo '<div class="incidence-atribute">Estado: <span>'.$incidencia->getEstadoName().'</span></div>';
        echo '<div class="incidence-atribute">Descripcion: <p>'.$incidencia->getDescripcion().'</p></div>';

        echo '<div id="incidence-fotos">';
            echo '<h6>FOTOS</h6>';
        echo '</div>';

        echo '<div id="incidence-comentarios'.$incidencia->getId().'">';
            echo '<h6>COMENTARIOS</h6>';

            echo '<div id="insert-comment'.$incidencia->getId().'" class="insert-comment">';
        
            echo '<textarea name="comment" placeholder="Inserta su comentario.."></textarea>';
            echo '<input type="submit" value="Insertar comentario" onclick="insertComment('.$incidencia->getId().');return false;">';
            
            echo '</div>';

        if(!empty($incidencia->getComentarios())) {
            $comentarios = $incidencia->getComentarios();
            foreach($comentarios as &$comentario){
                echo '<div class="incidence-comentario" id="comment_'.$comentario->getId().'">';

                echo '<div class="incidence-comment-attribute">Usuario: <span>'.$comentario->getUsuario()->getUsername().'</span></div>';
                echo '<div class="incidence-comment-attribute">Hora: <span>'.$comentario->getHora().'</span></div>';
                echo '<div class="incidence-comment-attribute">Comentario: <span>'.$comentario->getComentario().'</span></div>';

                if(isset($_SESSION['user']) && ($_SESSION['user']->getTipo() == 0 || $_SESSION['user']->getId() == $comentario->getUsuario()->getId()) && $_SESSION['user']->getId() != 6) {
                    echo '<a class="remove_button btn-incidences icon-remove" href="javascript:;" onclick="removeComment('.$comentario->getId().');return false;"></a>'.PHP_EOL;
                }

                echo '</div>';
            }
        }
            
        echo '</div>';

        echo '<div class="botones-incidencia">'.PHP_EOL;
            echo '<span id="positive_vals'.$incidencia->getId().'" class="aligner-item">'.$incidencia->getNumValoracionesPositivas().'</span><a class="btn-incidences icon-like" href="javascript:;" onclick="makeValoration('.$incidencia->getId().', \'positive\');return false;"></a>'.PHP_EOL;
            echo '<span id="negative_vals'.$incidencia->getId().'">'.$incidencia->getNumValoracionesNegativas().'</span><a class="btn-incidences icon-dislike" href="javascript:;" onclick="makeValoration('.$incidencia->getId().', \'negative\');return false;"></a>'.PHP_EOL;
            echo '<a id="comment_button" class="btn-incidences icon-comment" href="javascript:;" onclick="showCommentForm('.$incidencia->getId().');return false;"></a>'.PHP_EOL;
            
        if(isset($_SESSION['user']) && ($_SESSION['user']->getTipo() == 0 || $_SESSION['user']->getId() == $incidencia->getUsuario()->getId())) {
                echo '<a class="edit_button btn-incidences icon-edit" href="edit/'.$incidencia->getId().'" ></a>'.PHP_EOL;
                echo '<a class="remove_button btn-incidences icon-remove" href="javascript:;" onclick="removeIncidence('.$incidencia->getId().');return false;"></a>'.PHP_EOL;
        }
        echo '</div>'.PHP_EOL;

        echo '</article>';
    }
}
?>