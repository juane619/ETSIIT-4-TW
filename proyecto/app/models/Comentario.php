<?php

require_once 'Core/Model.php';
require_once 'Core/Helpers.php';

class Comentario extends Model
{
    private $incidencia;
    private $usuario;
    private $comentario;
    private $hora;
    static $table="comentarios";

    public function __construct($data, $exists = false)
    {
        $this->incidencia = '';
        $this->usuario = '';
        $this->comentario = '';
        $this->hora = null;

        //print_a($data);
        parent::__construct($data, $exists);

        if (isset($data['incidencia'])) {
            $this->incidencia = $data['incidencia'];
        }
        if (isset($data['usuario'])) {
            $this->usuario = $data['usuario'];
        }
        if (isset($data['comentario'])) {
            $this->comentario = $data['comentario'];
        }
    }

    /**
     * Save a new user in the BD 
     */
    public function save()
    {
        $errors = [];

        $datos = [
            'incidencia' => $this->incidencia,
            'usuario'=> $this->usuario,
            'comentario'=> $this->comentario,
        ];
            
        $query="INSERT INTO ".self::$table. " (incidencia,usuario,comentario)
                VALUES (:incidencia, :usuario, :comentario);";

        $response = Database::query($query, $datos, false);
        
        if($response === false) {
            return $response;
        }

        $response = self::findById(Database::lastInsertId(self::$table));


        return $response;
    }

    

    /**
     * {@inheritdoc}
     */
    public function getIncidencia()
    {
        return $this->incidencia;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsuario()
    {
        return User::findById($this->usuario);
    }


    /**
     * {@inheritdoc}
     */
    public function getComentario()
    {
        return $this->comentario;
    }
    
     /**
      * {@inheritdoc}
      */
    public function getHora()
    {
        $query="select hora from ".self::$table." where id=".$this->id." LIMIT 1;";

        $response = Database::query($query);

        if($response == false) {
            return null;
        }

        $hora = array_values($response[0])[0];
        
        return $hora;
    }
   
}


?>