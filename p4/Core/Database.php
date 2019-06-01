<?php

class Database
{
    static $db;
    static function init($database)
    {
        try{
            // EL ERROR ES QUE LOS BD SERVERS PUEDEN ESTAR CONFIGURADOS PARA QUE SE CONECTEN A ELLOS DESDE HOST FIABLES, HAY QUE ESPECIFICAR LOCALHOST COMO HOST Y ESTANDO ALOJADO EN EL PROPIO SERVER
            echo("Probando a conectar..: ". 'mysql:host='.$database['host'].';dbname='.$database['db'].' user: ' . $database['user'].' pass: '. $database['pass']);
            self::$db = new PDO(
                'mysql:host='.$database['host'].';dbname='.$database['db'], $database['user'], $database['pass'],
                array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC)
            );
        }catch (PDOException $e) {
            echo('Connection failed: ' . $e->getMessage());
            exit;
        }
    }
    static function query($query, $params = null, $fetch = true)
    {
        $reponse = self::$db->prepare($query);
        $reponse->execute($params);
        if ($fetch) {
            return $reponse->fetchAll();
        }
        return $reponse;
    }
    static function lastInsertId($name = null)
    {
        return self::$db->lastInsertId($name);
    }
}

?>