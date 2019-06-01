<?php
require_once 'Core/Model.php';
require_once 'Core/Helpers.php';
require_once 'Comentario.php';

class Incidencia extends Model
{
    private $titulo;
    private $descripcion;
    private $lugar;
    private $tags;
    private $fotos;
    private $fecha;
    private $estado;
    private $usuario;
    private $comentarios;
    static $table="incidencias";

    public function __construct($data, $exists = false)
    {
        $this->titulo = '';
        $this->descripcion = '';
        $this->lugar = '';
        $this->tags = '';
        $this->fotos = null;
        $this->fecha = null;
        $this->estado = 1;
        $this->usuario = 6;
        $this->comentarios = [];

        parent::__construct($data, $exists);
        
        if (isset($data['titulo'])) {
            $this->titulo = $data['titulo'];
        }
        if (isset($data['descripcion'])) {
            $this->descripcion = $data['descripcion'];
        }
        if (isset($data['lugar'])) {
            $this->lugar = $data['lugar'];
        }
        if (isset($data['tags'])) {
            $this->tags = $data['tags'];
        }
        if (isset($data['fotos'])) {
            $this->fotos = $data['fotos'];
        }
        if (isset($data['fecha'])) {
            $this->fecha = $data['fecha'];
        }
        if (isset($data['estado'])) {
            $this->estado = $data['estado'];
        }
        if (isset($data['usuario'])) {
            $this->usuario = $data['usuario'];
        }

        
    }

    public function addComentario($comentario)
    {
        if($comentario!=null) {
            array_push($this->comentarios, $comentario);
        }
    }

    public function removeComentario($idComentario)
    {
        
    }

    public function getNumValoracionesPositivas()
    {
        $query="select sum(valoracion_pos) from valoraciones where incidencia=".$this->id." LIMIT 1;";

        $response = Database::query($query);
        
        if(array_values($response[0])[0] == null) {
            return 0;
        }
        return array_values($response[0])[0];
    }

    public function getNumValoracionesNegativas()
    {
        $query="select sum(valoracion_neg) from valoraciones where incidencia=".$this->id." LIMIT 1;";

        $response = Database::query($query);
        if(array_values($response[0])[0] == null) {
            return 0;
        }
        return array_values($response[0])[0];
    }


    public function save()
    {
        $errors = [];

        $datos = [
            'titulo' => $this->titulo,
            'descripcion'=> $this->descripcion,
            'lugar'=> $this->lugar,
            'tags'=> $this->tags,
            'usuario'=> $this->usuario
        ];
            
        $query="INSERT INTO ".self::$table. " (titulo,descripcion,lugar,tags,usuario)
                VALUES (:titulo, :descripcion, :lugar, :tags, :usuario);";

        $response = Database::query($query, $datos, false);

        if($response == false) {
            $errors[] = "Ha ocurrido un error insertando la nueva incidencia (duplicada?)";
        }

        return $errors;
    }

    public function remove()
    {
        $response = Incidencia::delete($this->id);

        return $response;
    }


    public function editIncidencia($data)
    {
        $response = Incidencia::edit($this->id, $data);

        return $response;
    }
    
    

    /**
     * Finds incidencia by tag
     *
     * @param  string $tag
     * @return static|null
     */
    public static function findByTag($tag)
    {
        $incidencias = Incidencia::where(['tags' => $tag]);
        return $incidencias;
    }

       

    /**
     * START GETTERS AND SETTERS 
     */

     /**
      * {@inheritdoc}
      */
    public function getComentarios()
    {
        $query="select * from comentarios where incidencia=".$this->id.";";

        $response = Database::query($query);

        if($response == false) {
            return null;
        }

        foreach ($response as $val) {
            $comentarios[] = new Comentario($val);
        }
        
        return $comentarios;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * {@inheritdoc}
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * {@inheritdoc}
     */
    public function getTags()
    {
        return $this->tags;
    }
    /**
     * {@inheritdoc}
     */
    public function getFotos()
    {
        return $this->fotos;
    }
    

    /**
     * {@inheritdoc}
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * {@inheritdoc}
     */
    public function getEstado()
    {
        $query="select estado+0 from ".self::$table." where id=".$this->id." LIMIT 1;";

        $response = Database::query($query);

        if($response == false) {
            return null;
        }

        $estado = array_values($response[0])[0];
        
        return $estado;
    }

    /**
     * {@inheritdoc}
     */
    public function getEstadoName()
    {
        $query="select estado from ".self::$table." where id=".$this->id." LIMIT 1;";

        $response = Database::query($query);

        if($response == false) {
            return null;
        }

        $estado = array_values($response[0])[0];
        
        return $estado;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsuario()
    {
        return User::findById($this->usuario);
    }
}


?>