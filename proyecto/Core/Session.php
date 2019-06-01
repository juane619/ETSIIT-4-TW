<?php
/**
 * Clase básica para adminsitrar sesiones
 */
class Session
{
    /**
     * Inicializa la sesión
     */
    static public function init()
    {
        session_start();
    }
    /**
     * Agrega un elemento a la sesión
     *
     * @param string $key   la llave del array de
     *                      sesión
     * @param string $value el valor para el elemento de la sesión
     */
    static public function add($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    /**
     * Retorna un elemento a la sesión
     *
     * @param  string $key la llave del array de sesión
     * @return string el valor del array de sesión si tiene valor
     */
    static public function get($key)
    {
        return !empty($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
    /**
     * Retorna todos los valores del array de sesión
     *
     * @return el array de sesión completo
     */
    static public function getAll()
    {
        return $_SESSION;
    }
    /**
     * Remueve un elemento de la sesión
     *
     * @param string $key la llave del array de sesión
     */
    static public function remove($key)
    {
        if(!empty($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
    /**
     * Cierra la sesión eliminando los valores
     */
    static public function close()
    {
        // La sesión debe estar iniciada
        if (session_status()==PHP_SESSION_NONE)
            session_start();
        // Borrar variables de sesión
        //$_SESSION = array();
        session_unset();
        // Obtener parámetros de cookie de sesión
        $param = session_get_cookie_params();
        // Borrar cookie de sesión
        setcookie(session_name(), $_COOKIE[session_name()], time()-2592000,
        $param['path'], $param['domain'], $param['secure'], $param['httponly']);
        // Destruir sesión
        session_destroy();
    }
    /**
     * Retorna el estatus de la sesión
     *
     * @return string el estatus de la sesión
     */
    static public function getStatus()
    {
        return session_status();
    }
}