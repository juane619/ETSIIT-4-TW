<?php

require_once 'Core/Controller.php';
require_once 'Core/Auth.php';
require_once ROOT_PATH.'models/Incidencia.php';

class IncidenciasController extends Controller
{
    public function makeValoration()
    {
        // connect to db
        // Database info
        $database_info = include ROOT_PATH.'/config/database.php';
        Database::init($database_info);

        if(isset($_GET['valoracion'])) {
            if($_GET['valoracion'] == 'positive') { //valoracion positiva
                if($_SESSION['user_type'] == 2) { //valoraciones positivas usuarios visitantes
                    //logg('Realizando valoracion positiva usuario visitante..');

                    // Gestion de cookies
                    if (!isset($_COOKIE['alreadyValorated'])) {
                        if(is_numeric($_GET['id'])) {
                            setcookie('alreadyValorated', serialize([$_GET['id']]));
                            //logg("Cookie no establecida.. permitimos valoracion: ");
                        
                            $user = new User(['id' => 6]);
                            $response = $user->makePositiveValoration($_GET['id']);
                            if($response == false) {
                                return 'error';
                            }

                            $incidencia = new Incidencia(['id'=>$_GET['id']]);
                            return $incidencia->getNumValoracionesPositivas();
                        } else{
                            $errors[] = 'Ha ocurrido un error al valorar la incidencia..';
                        }
                    }else{ //cookie establecida
                        $arrayCookie = unserialize($_COOKIE['alreadyValorated']);

                        $search= array_search(strval($_GET['id']), $arrayCookie);

                        if($search === false) { //si no se ha valorado la incidencia actual
                            $arrayCookie = unserialize($_COOKIE['alreadyValorated']);
                            array_push($arrayCookie, $_GET['id']);

                            setcookie('alreadyValorated', serialize($arrayCookie));

                            $user = new User(['id' => 6]);
                            $response = $user->makePositiveValoration($_GET['id']);
                            if($response == false) {
                                return 'error';
                            }

                            $incidencia = new Incidencia(['id'=>$_GET['id']]);
                            return $incidencia->getNumValoracionesPositivas();
                        }else{ // valoracion ya realizada para incidencia actual
                            //logg("Cookie ya establecida.. NO permitimos valoracion: ");
    
                            return 'error';
                        }
                    }  
                }else{ // valoraciones positivas usuarios registrados
                    //logg('Realizando valoracion positiva usuario registrado..');
                    if(is_numeric($_GET['id'])) {
                        $response = $_SESSION['user']->makePositiveValoration($_GET['id']);
                        
                        if($response == false) {
                            return 'error';
                        }
                        $incidencia = new Incidencia(['id'=>$_GET['id']]);
                        return $incidencia->getNumValoracionesPositivas();
                    } else{
                        $errors[] = 'Ha ocurrido un error al valorar la incidencia..';
                        return 'ERROR';
                    }
                }
            }else{ //valoracion negativa
                if($_SESSION['user_type'] == 2) {//valoraciones negativas usuarios visitantes
                    //logg('Realizando valoracion negativa usuario visitante..');

                    // Gestion de cookies
                    if (!isset($_COOKIE['alreadyValorated'])) {
                        if(is_numeric($_GET['id'])) {
                            setcookie('alreadyValorated', serialize([$_GET['id']]));
                            //logg("Cookie no establecida.. permitimos valoracion: ");
                        
                            $user = new User(['id' => 6]);
                            $response = $user->makeNegativeValoration($_GET['id']);
                            if($response == false) {
                                return 'error';
                            }

                            $incidencia = new Incidencia(['id'=>$_GET['id']]);
                            return $incidencia->getNumValoracionesNegativas();
                        } else{
                            $errors[] = 'Ha ocurrido un error al valorar la incidencia..';
                        }
                    }else{ //cookie establecida
                        $arrayCookie = unserialize($_COOKIE['alreadyValorated']);

                        $search= array_search(strval($_GET['id']), $arrayCookie);

                        if($search === false) { //si no se ha valorado la incidencia actual
                            $arrayCookie = unserialize($_COOKIE['alreadyValorated']);
                            array_push($arrayCookie, $_GET['id']);

                            setcookie('alreadyValorated', serialize($arrayCookie));

                            $user = new User(['id' => 6]);
                            $response = $user->makeNegativeValoration($_GET['id']);
                            if($response == false) {
                                return 'error';
                            }

                            $incidencia = new Incidencia(['id'=>$_GET['id']]);
                            return $incidencia->getNumValoracionesNegativas();
                        }else{ // valoracion ya realizada para incidencia actual
                            //logg("Cookie ya establecida.. NO permitimos valoracion: ");
    
                            return 'error';
                        }
                    }
                }else{ //valoraciones negativas usuarios registrados
                    //logg('Realizando valoracion negativa usuario registrado..');
                    if(is_numeric($_GET['id'])) {
                        $response = $_SESSION['user']->makeNegativeValoration($_GET['id']);
                        if($response == false) {
                            return 'error';
                        }

                        $incidencia = new Incidencia(['id'=>$_GET['id']]);
                        return $incidencia->getNumValoracionesNegativas();
                    } else{
                        $errors[] = 'Ha ocurrido un error al valorar la incidencia..';
                    }
                }
            }
        }
    }

    public function insertComment()
    {
        // connect to db
        // Database info
        $database_info = include ROOT_PATH.'/config/database.php';
        Database::init($database_info);
        
        if(isset($_POST['id'])) {
            $idIncidence = $_POST['id'];
        }
        if(isset($_POST['comment'])) {
            $commentIncidence = $_POST['comment'];
        }

        if(strlen(trim($commentIncidence)) == 0) {
            //logg('Comentario vacio..');
            return json_encode("vacio");
        }else if(strlen(trim($commentIncidence)) > 299) {
            //logg('Comentario vacio..');
            return json_encode("largo");
        }

        $idUser = 6;
        if($_SESSION['user_type'] != 2) {
            $idUser = $_SESSION['user']->getId();
        }

        $data = [
            'incidencia' => $idIncidence,
            'usuario' => $idUser,
            'comentario' => $commentIncidence
        ];

        $comment = new Comentario($data);
        $response = $comment->save();

        if($response === false) {
            return false;
        }

        //var_dump($response);
        $data['id'] = $response->getId();
        $data['hora'] = $response->getHora();
        $data['usuario'] = (string) $data['usuario'];

        return json_encode($data);
    }

    public function removeComment()
    {
        if (Auth::user_type() == 2) {
            $view = View::make('index');
            $view->with('namepage', 'index');
            $view->with('needauth', true);
            return $view;
        }
        // connect to db
        // Database info
        $database_info = include ROOT_PATH.'/config/database.php';
        Database::init($database_info);
        
        if(isset($_POST['id'])) {
            $idComment = $_POST['id'];
        }

        $response = Comentario::delete($idComment);

        //logg($response);

        if($response === false) {
            return 'error';
        }

        return 'good';
    }

    public function showIncidences()
    {
        $view = View::make('incidences', 'incidences');
        $view->with('namepage', 'show');

        // connect to db
        // Database info
        $database_info = include ROOT_PATH.'/config/database.php';
        Database::init($database_info);

        $incidencias = Incidencia::all();

        $view->with('incidencias', $incidencias);

        if(isset($errors)) {
            $view->with('errors', $errors);
        }
        if(isset($info)) {
            $view->with('info', $info);
        }
        
        return $view;
    }

    public function addIncidence()
    {
        if (Auth::user_type() == 2) {
            $view = View::make('index');
            $view->with('namepage', 'index');
            $view->with('needauth', true);
            return $view;
        }
        
        $view = View::make('addincidence', 'incidences');
        $view->with('namepage', 'add');

        $info = $errors = [];
        
        // validate data if are sent
        if(isset($_REQUEST['submit'])) {
            $data['titulo'] = parseInput($_POST['titulo']);
            $data['descripcion'] =  parseInput($_POST['descripcion']);
            $data['lugar'] = parseInput($_POST['lugar']);
            $data['tags'] = parseInput($_POST['tags']);
            $data['usuario'] = $_SESSION['user']->getId();
            
            $errors = $this->validate($data);

            $isValid = msgCount($errors) == 0;

            if($isValid) {
                
                $incidence = new Incidencia($data);

                $database_info = include ROOT_PATH.'/config/database.php';
                Database::init($database_info);

                $errors = $incidence->save();

                if(msgCount($errors)) {
                    //logg("ERROR INSERTING DATA..");
                    
                }
                else{
                    //logg("OK INSERTING DATA..");
                    $info[] = "Incidencia insertada correctamente";
                }
                //logg(implode($bookData));
            }else{
                // show form errors
                $errors[] = "Los datos introducidos no son válidos.";
            }

            if(isset($errors)) {
                $view->with('errors', $errors);
            }
            if(isset($info)) {
                $view->with('info', $info);
            }
        }

        return $view;
    }

    public function showMyIncidences()
    {
        if (Auth::user_type() == 2) {
            $view = View::make('index');
            $view->with('namepage', 'index');
            $view->with('needauth', true);
            return $view;
        }

        $view = View::make('myincidences', 'incidences');
        $view->with('namepage', 'myincidences');

        // connect to db
        // Database info
        $database_info = include ROOT_PATH.'/config/database.php';
        Database::init($database_info);

        $incidencias = Incidencia::where(['usuario' => $_SESSION['user']->getId()]);
        $view->with('incidencias', $incidencias);

        return $view;
    }

    public function removeIncidence()
    {
        if (Auth::user_type() == 2) {
            $view = View::make('index');
            $view->with('namepage', 'index');
            $view->with('needauth', true);
            return $view;
        }
        // connect to db
        // Database info
        $database_info = include ROOT_PATH.'/config/database.php';
        Database::init($database_info);
        
        if(isset($_POST['id'])) {
            $idIncidence = $_POST['id'];
        }

        $response = Incidencia::delete($idIncidence);

        if($response === false) {
            return 'error';
        }

        return 'good';
    }

    public function editIncidence($id=null)
    {
        if (Auth::user_type() == 2) {
            $view = View::make('index');
            $view->with('namepage', 'index');
            $view->with('needauth', true);
            return $view;
        }

        $info = [];
        $errors = [];

        $view = View::make('editincidence', 'incidences');

        $database_info = include ROOT_PATH.'/config/database.php';
        Database::init($database_info);

        
        //logg('Editing.. '.$id);
            
        $incidence = Incidencia::findById($id);

        $view->with('incidence', $incidence);
        
        if(isset($_REQUEST['submit'])) {
            $data['titulo'] = parseInput($_POST['titulo']);
            $data['descripcion'] =  parseInput($_POST['descripcion']);
            $data['lugar'] = parseInput($_POST['lugar']);
            $data['tags'] = parseInput($_POST['tags']);

            if($_SESSION['user_type'] == 0) {
                $data['estado'] = parseInput($_POST['estado']);
            }
            
            $errors = $this->validate($data);

            $isValid = msgCount($errors) == 0;

            if($isValid) {
                $database_info = include ROOT_PATH.'/config/database.php';
                Database::init($database_info);

                $errors = Incidencia::edit($id, $data);

                if(msgCount($errors)) {
                    //logg("ERROR INSERTING DATA..");
                    
                }
                else{
                    //logg("OK INSERTING DATA..");
                    $info[] = "Incidencia editada correctamente";
                    $view->with('incidence', null);
                }
            }else{
                // show form errors
                $errors[] = "Los datos introducidos no son válidos.";
            }
        }

        if(isset($errors)) {
            $view->with('errors', $errors);
        }
        if(isset($info)) {
            $view->with('info', $info);
        }
        
        
        return $view;
    }


    private function validate($data)
    {
        $errors = [];

        if(!empty($data['titulo']) && !empty($data['descripcion']) && !empty($data['lugar'])) {
            
        }else{
            $errors[] = 'Los campos titulo, descripcion y lugar no pueden estar vacios';
        }

        return $errors;
    }
}

?>