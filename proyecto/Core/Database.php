<?php

require_once 'Core/Helpers.php';

class Database
{
    static $db;

    static function init($database_info)
    {
        if (isset($database_info['db']) && $database_info['db'] 
            && isset($database_info['host']) && $database_info['host'] 
            && isset($database_info['port']) && $database_info['port'] 
            && isset($database_info['user']) && $database_info['user']
        ) {
            try{
                // EL ERROR ES QUE LOS BD SERVERS PUEDEN ESTAR CONFIGURADOS PARA QUE SE CONECTEN A ELLOS DESDE HOST FIABLES, HAY QUE ESPECIFICAR LOCALHOST COMO HOST Y ESTANDO ALOJADO EN EL PROPIO SERVER
                //logg("Probando a conectar..: ". 'mysql:host='.$database_info['host'].';dbname='.$database_info['db'].' user: ' . $database_info['user'].' pass: '. $database_info['pass']);
                if (!self::$db) {
                    self::$db = new PDO(
                        'mysql:host='.$database_info['host'].';dbname='.$database_info['db'], $database_info['user'], $database_info['pass'],
                        array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC)
                    );
                    self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                //logg('DB connected..'.rand());
            }catch (PDOException $e) {
                logg('Connection failed: ' . $e->getMessage());
                exit;
            }
        }
    }
    static function query($query, $params = null, $fetch = true)
    {
        //logg("Query: ".$query);
        //logg(' params '.var_dump($params));
        try{
            $response = self::$db->prepare($query);
            $info = $response->execute($params);

            if($info == false) {
                //logg('ERROR DB: '.self::$db->errorInfo());
            }

            if ($fetch) {
                //logg("Fetching..");
                return $response->fetchAll();
            }
            return $info;
        }
        catch(PDOException $e){
            die("Query failed: " . $e->getMessage());
        }
    }
    
    static function lastInsertId($name = null)
    {
        return self::$db->lastInsertId($name);
    }
}

?>