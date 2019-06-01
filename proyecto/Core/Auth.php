<?php

/**
 * Clase básica para adminsitrar autenticacion de usuarios
 */

 require_once ROOT_PATH.'models/User.php';

class Auth
{
    /**
     * Comprueba si el cliente ha iniciado sesión.
     *
     * @return boolean true si ha iniciado sesión. false si no.
     */
    static function check()
    {
        if (isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    /**
     * Devuelve el tipo de usuario con sesion iniciada.
     *
     * @return mixed Tipo de usuario con sesion iniciada.
     */
    static function user_type()
    {
        if (isset($_SESSION['user_type'])) {
            return $_SESSION['user_type'];
        }

        return 2;
    }

    /**
     * Inicia sesión con los datos pasados por parámetro.
     *
     * @param  String $identity Nombre de usuario o email.
     * @param  String $password Contraseña sin encriptar.
     * @return boolean true si ha iniciado sesión. false si ha ocurrido algún error.
     */
    static function login($identity, $password)
    {
        try{
            if (filter_var($identity, FILTER_VALIDATE_EMAIL)) {
                $user = User::where(['email' => $identity, 'password' => $password], 1);
            } else{
                $user = User::where(['username' => $identity, 'password' => $password], 1);
            }
        }
        catch (Exception $e) { 
            echo $e->errorMessage(); 
        }
        if ($user) {
            $_SESSION['user'] = $user;
            $_SESSION['user_type'] = $user->getTipo();
            return true;
        }
        return false;
    }
    /**
     * Cierra la sesión del usuario.
     */
    static function logout()
    {
        Session::close();
        die(header('Location:'.ROOT_ROUTE));
    }
    /**
     * Crea un nuevo usuario
     *
     * @return mixed El modelo del usuario creado, o false si falló.
     */
    static function create($user_data)
    {
        $user_data['password'] = encrypt($user_data['password']);
        $user = User::create($user_data);
        return $user;
    }
    /**
     * Devuelve el usuario almacenado en la sesión. Si no existe, devuevle false.
     *
     * @return mixed El usuario almacenado en sesión o false si no existe.
     */
    static function user()
    {
        if (self::check()) {
            return Session::get('user');
        } else {
            return false;
        }
    }
}

?>