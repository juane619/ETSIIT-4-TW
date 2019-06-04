<?php

require_once 'Core/Controller.php';
require_once 'Core/Auth.php';
require_once ROOT_PATH.'models/User.php';

class ManagementController extends Controller
{
    public function manageUsers()
    {
        if (!Auth::check()) {
            $view = View::make('index');
            $view->with('namepage', 'index');
            $view->with('needauth', true);
            return $view;
        }else if(Auth::user_type() == 1) {
            $view = View::make('index');
            $view->with('namepage', 'index');
            
            $view->with('needPrivileges', true);

            return $view;
        }

        $view = View::make('manage_users', 'management/users');
        $view->with('namepage', 'users');

        $database_info = include ROOT_PATH.'/config/database.php';
        Database::init($database_info);

        $users = User::all();

        $view->with('users', $users);

        if(isset($errors)) {
            $view->with('errors', $errors);
        }
        if(isset($info)) {
            $view->with('info', $info);
        }
        
        return $view;
    }

    public function addUser()
    {
        
        $view = View::make('adduser', 'management/users');
        $view->with('namepage', 'users');

        $info = $errors = [];
        
        // validate data if are sent
        if(isset($_REQUEST['submit'])) {
            $data['username'] = parseInput($_POST['username']);
            $data['password'] =  parseInput($_POST['password']);
            $data['password_confirm'] = parseInput($_POST['password_confirm']);
            $data['nombre'] = parseInput($_POST['nombre']);
            $data['apellidos'] = parseInput($_POST['apellidos']);
            $data['email'] = parseInput($_POST['email']);
            $data['direccion'] = parseInput($_POST['direccion']);
            $data['telefono'] = parseInput($_POST['telefono']);

            if($_SESSION['user_type'] == 0) {
                $data['tipo'] = parseInput($_POST['tipo']);
                $data['estado'] = parseInput($_POST['estado']);
            }

            //var_dump($data);
            
            $errors = $this->validate($data);

            $isValid = msgCount($errors) == 0;

            if($isValid) {
                $user = new User($data);

                $database_info = include ROOT_PATH.'/config/database.php';
                Database::init($database_info);

                $errors = $user->save();

                if(msgCount($errors)) {
                    //logg("ERROR INSERTING DATA..");
                    
                }
                else{
                    //logg("OK INSERTING DATA..");
                    $info[] = "Usuario registrado correctamente";
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

    public function editUser($id=null)
    {
        if (!Auth::check()) {
            $view = View::make('index');
            $view->with('namepage', 'index');
            $view->with('needauth', true);
            return $view;
        }else if(Auth::user_type() == 1) {
            if($id != $_SESSION['user']->getId()) {
                $view = View::make('index');
                $view->with('namepage', 'index');
            
                $view->with('needPrivileges', true);

                return $view;
            }
        }else{
            if($id == 6) {
                $view = View::make('index');
                $view->with('namepage', 'index');
            
                $view->with('needPrivileges', true);

                return $view;
            }
        }

        $info = [];
        $errors = [];

        $view = View::make('edituser', 'management/users');
        $view->with('namepage', 'users');

        $database_info = include ROOT_PATH.'/config/database.php';
        Database::init($database_info);

        //logg('Editing.. '.$id);
            
        $user = User::findById($id);

        $view->with('user', $user);
        
        if(isset($_REQUEST['submit'])) {
            $data['nombre'] = parseInput($_POST['nombre']);
            $data['apellidos'] = parseInput($_POST['apellidos']);
            $data['email'] = parseInput($_POST['email']);
            $data['direccion'] = parseInput($_POST['direccion']);
            $data['telefono'] = parseInput($_POST['telefono']);

            if($_SESSION['user_type'] == 0) {
                $data['tipo'] = parseInput($_POST['tipo']);
                $data['estado'] = parseInput($_POST['estado']);
            }

            if(!empty(parseInput($_POST['password']))) {
                $data['password'] =  parseInput($_POST['password']);
            }
            
            $errors = $this->validateEditing($data);

            $isValid = msgCount($errors) == 0;

            if($isValid) {
                $database_info = include ROOT_PATH.'/config/database.php';
                Database::init($database_info);

                $errors = User::edit($id, $data);

                if(msgCount($errors)) {
                    //logg("ERROR INSERTING DATA..");
                    
                }
                else{
                    //logg("OK INSERTING DATA..");
                    $info[] = "Usuario editado correctamente";
                    $view->with('user', null);
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

    public function removeUser()
    {
        if (Auth::user_type() != 0) {
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
            $idUser = $_POST['id'];
        }

        $response = User::delete($idUser);

        logg('ERROOOOR: '.$response);

        if($response === false) {
            return 'error';
        }

        return 'good';
    }

    public function manageLog()
    {
        if (!Auth::check()) {
            $view = View::make('index');
            $view->with('namepage', 'index');
            $view->with('needauth', true);
            return $view;
        }else if(Auth::user_type() == 1) {
            $view = View::make('index');
            $view->with('namepage', 'index');
            
            $view->with('needPrivileges', true);

            return $view;
        }

        $view = View::make('manage_log', 'management');
        $view->with('namepage', 'log');

        $info = $errors = [];

        return $view;
    }

    public function manageBBDD()
    {
        if (!Auth::check()) {
            $view = View::make('index');
            $view->with('namepage', 'index');
            $view->with('needauth', true);
            return $view;
        }else if(Auth::user_type() == 1) {
            $view = View::make('index');
            $view->with('namepage', 'index');
            
            $view->with('needPrivileges', true);

            return $view;
        }

        $view = View::make('manage_bbdd', 'management');
        $view->with('namepage', 'bbdd');

        $info = $errors = [];

        return $view;
    }

    private function validate($data)
    {
        $errors = [];

        if(!empty($data['username']) && !empty($data['password_confirm']) && !empty($data['email'])) {
            if (!preg_match("/^[a-zA-Z ]*$/", $data['nombre'])) {
                $errors[] = 'El nombre solo puede contener letras y espacios en blanco..'; 
            }

            if (!preg_match("/^[a-zA-Z ]*$/", $data['apellidos'])) {
                $errors[] = 'Los apellidos solo puede contener letras y espacios en blanco..'; 
            }

            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Formato inválido de email.."; 
            }

            if(!preg_match("/^[9|6|7][0-9]{8}$/", $data['telefono'])) {
                $errors[] = "Formato inválido de teléfono..";
            }

            if($data['password'] !== $data['password_confirm']) {
                $errors[] = "Las contraseñas no coinciden..";
            }
        }else{
            $errors[] = 'Los campos username, password y email no pueden estar vacios';
        }

        return $errors;
    }

    private function validateEditing($data)
    {
        $errors = [];

        if(!empty($data['email'])) {
            if (!preg_match("/^[a-zA-Z ]*$/", $data['nombre'])) {
                $errors[] = 'El nombre solo puede contener letras y espacios en blanco..'; 
            }

            if (!preg_match("/^[a-zA-Z ]*$/", $data['apellidos'])) {
                $errors[] = 'Los apellidos solo pueden contener letras y espacios en blanco..'; 
            }

            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Formato inválido de email.."; 
            }

            if(!preg_match("/^[9|6|7][0-9]{8}$/", $data['telefono'])) {
                $errors[] = "Formato inválido de teléfono..";
            }
        }else{
            $errors[] = 'El email no puede estar vacio';
        }

        return $errors;
    }
        
}

?>