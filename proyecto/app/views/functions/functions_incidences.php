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

            <div class="container">
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
            <div class="col-15">
                <label for="titulo">Titulo de la incidencia</label>
            </div>
            <div class="col-75">
                <input type="text" id="titulo" name="titulo" placeholder="Titulo..">
            </div>
        </div>
        <div class="row">
            <div class="col-15">
                <label for="descripcion">Descripción de la incidencia</label>
            </div>
            <div class="col-75">
                <textarea id="descripcion" name="descripcion" placeholder="Descripcion.."></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-15">
                <label for="lugar">Lugar</label>
            </div>
            <div class="col-75">
                <input type="text" id="lugar" name="lugar" placeholder="Lugar..">
            </div>
        </div>
        <div class="row">
            <div class="col-15">
                <label for="tags">Tags</label>
            </div>
            <div class="col-75">
                <input type="text" id="tags" name="tags" placeholder="TAGS..">
            </div>
        </div>
        <!--Foto -->
        <div class="row">
            <div class="col-15">
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
            <div class="col-15">
                <label for="titulo">Titulo de la incidencia</label>
            </div>
            <div class="col-75">
                <input type="text" id="titulo" name="titulo" placeholder="Titulo..">
            </div>
        </div>
        <div class="row">
            <div class="col-15">
                <label for="descripcion">Descripción de la incidencia</label>
            </div>
            <div class="col-75">
                <textarea id="descripcion" name="descripcion" placeholder="Descripcion.."></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-15">
                <label for="lugar">Lugar</label>
            </div>
            <div class="col-75">
                <input type="text" id="lugar" name="lugar" placeholder="Lugar..">
            </div>
        </div>
        <div class="row">
            <div class="col-15">
                <label for="tags">Tags</label>
            </div>
            <div class="col-75">
                <input type="text" id="tags" name="tags" placeholder="Tags..">
            </div>
        </div>
        <!--Foto -->
        <div class="row">
            <div class="col-15">
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
        echo '<div class="incidence-atribute"><label>Lugar: </label><span> '.$incidencia->getLugar().'</span></div>';
        echo '<div class="incidence-atribute"><label>Fecha: </label><span> '.$incidencia->getFecha().'</span></div>';
        echo '<div class="incidence-atribute"><label>Creado por: </label><span> '.$incidencia->getUsuario()->getUsername().'</span></div>';
        echo '<div class="incidence-atribute"><label>Palabras clave: </label><span> '.$incidencia->getTags().'</span></div>';
        echo '<div class="incidence-atribute"><label>Estado: </label><span> '.$incidencia->getEstadoName().'</span></div>';
        echo '<div class="incidence-atribute incidence-description"><label>Descripcion: </label><p>'.$incidencia->getDescripcion().'</p></div>';

        echo '<div class="incidence-fotos" id="incidence-fotos_'.$incidencia->getId().'">';
            echo '<h6>FOTOS</h6>';
        echo '</div>';
        
        echo '<div class="incidence-comentarios">';
            echo '<h6>COMENTARIOS</h6>';
            echo '<a href="javascript:;" onclick="showCommentSection('.$incidencia->getId().'); return false;">Ver/ocultar comentarios</a>';
            
            echo '<div id="insert-comment'.$incidencia->getId().'" class="insert-comment">';
        
            echo '<textarea name="comment" placeholder="Inserta su comentario.."></textarea>';
            echo '<input type="submit" value="Insertar comentario" onclick="insertComment('.$incidencia->getId().');return false;">';
            
            echo '</div>';

            echo '<div id="incidence-comentarios'.$incidencia->getId().'">';
            
            

        if(!empty($incidencia->getComentarios())) {
            $comentarios = $incidencia->getComentarios();
            foreach($comentarios as &$comentario){
                echo '<div class="incidence-comentario" id="comment_'.$comentario->getId().'">';

                if(isset($_SESSION['user']) && ($_SESSION['user']->getTipo() == 0 || $_SESSION['user']->getId() == $comentario->getUsuario()->getId()) && $_SESSION['user']->getId() != 6) {
                    echo '<a class="remove_button btn-incidences icon-remove" href="javascript:;" onclick="removeComment('.$comentario->getId().');return false;"></a>'.PHP_EOL;
                }
                    echo '<div class="content-comment">';
                        echo '<div class="head-comment">';
                            echo '<div class="incidence-comment-attribute"><label>Usuario: </label><span> '.$comentario->getUsuario()->getUsername().'</span></div>';
                            echo '<div class="incidence-comment-attribute"><label>Hora: </label><span> '.$comentario->getHora().'</span></div>';
                        echo '</div>';
                        echo '<div class="body-comment">';
                            echo '<div class="incidence-comment-attribute"><p>'.$comentario->getComentario().'</p></div>';
                        echo '</div>';
                    echo '</div>';
                    

                echo '</div>';
            }
        }
            
        echo '</div>';
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