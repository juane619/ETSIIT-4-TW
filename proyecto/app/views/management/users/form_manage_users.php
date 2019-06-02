<div class="manage-section">
    
    <section class="management-actions">
        <h5>Acciones a realizar</h5>
        <ul>
            <li><a href="users/add">Añadir nuevo usuario</a></li>
        </ul>
    </section>
    <section class="catalogo-usuarios">
        <h5>Listado de usuarios</h5>
    <?php

    if(!isset($users) || empty($users)) {
        msgInfo('No hay usuarios añadidos actualmente..');
    } else { 
        foreach($users as &$user){
            if($user->getId() != 6 && $user->getId() != $_SESSION['user']->getId()) {
                echo '<article class="user-entry" id="user_'.$user->getId().'">';
                echo '<div id="user-foto">';        echo '</div>';
                echo '<div class="attributes-user">';
                    echo '<div class="user-atribute"><label>Usuario: </label><span> '.$user->getUsername().'</span></div>';
                    echo '<div class="user-atribute"><label>Email: </label><span> '.$user->getEmail().'</span></div>';
                    echo '<div class="user-atribute"><label>Direccion: </label><span> '.$user->getDireccion().'</span></div>';
                    echo '<div class="user-atribute"><label>Teléfono: </label><span> '.$user->getTelefono().'</span></div>';
                    echo '<div class="user-atribute"><label>Estado: </label><span> '.$user->getEstado().'</span></div>';
                    echo '<div class="user-atribute"><label>Rol: </label><spanp> '.$user->getTipoDescription().'</span></div>';
                echo '</div>';

                echo '<div class="botones-users">'.PHP_EOL;
        
                if($_SESSION['user_type'] == 0) {
                    echo '<a class="edit_button btn-incidences icon-edit" href="users/edit/'.$user->getId().'" ></a>'.PHP_EOL;
                    echo '<a class="remove_button btn-incidences icon-remove" href="javascript:;" onclick="removeUser('.$user->getId().');return false;"></a>'.PHP_EOL;
                }
                echo '</div>'.PHP_EOL;

                echo '</article>';
            }
        }
    }

    ?>
</section>
</div>
    