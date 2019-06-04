<?php
/**
 * Funciones útiles
 */
/**
 * Muestra un error 404 indicando que la página no fue encontrada.
 */
function error_404()
{
    $view = View::make('404');
    die($view->execute());
}
function encrypt($password)
{
    return sha1($password);
}

function logg($toprint)
{
    print("<br>-->LOG: ".$toprint."<br>");
}

function print_a($arrayy)
{
    foreach($arrayy as $key => $value) {
        echo "key: $key is at $value<br>";
    }
}

function msgCount($msg) 
{
    if (is_array($msg)) {
        if (count($msg)==0) {
            return 0;
        } else {
            return msgCount($msg[0])+
                    msgCount(array_slice($msg, 1));
        } 
    } else if (!is_bool($msg)) {
        return 1;
    } else {
        return 0;
    }
}

function msgError($msg,$tipo='msg-error')
{
    
    echo "<div class='$tipo'>";
    echo "<p>ERRORES ENCONTRADOS:<p>";
    _msgErrorR($msg);
    echo '</div>';
}

function msgInfo($msg,$tipo='msg-info')
{
    echo "<div class='$tipo'>";
    _msgErrorR($msg);
    echo '</div>';
}

function _msgErrorR($msg) 
{
    if (is_array($msg)) {
        foreach ($msg as $v) {
            _msgErrorR($v);
        } 
    } else {
        echo "<p>- $msg</p>";
    }
}

/**
 * Formulario modal comentario
 * 
 * @return null
 */

function htmlModalForm($error)
{
    echo <<< HTML
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <form role="form">
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input type="text" class="form-control" id="inputName" placeholder="Enter your name"/>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="Enter your email"/>
                        </div>
                        <div class="form-group">
                            <label for="inputMessage">Message</label>
                            <textarea class="form-control" id="inputMessage" placeholder="Enter your message"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="my-button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>$(function() { $('#modal_falla').modal('show'); });</script>
HTML;
}

function parseInput($input)
{
    if(isset($input)){
        return trim(strip_tags($input));
    }
}

?>