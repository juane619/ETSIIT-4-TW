<?php

require_once 'Core/Model.php';
require_once 'Core/Helpers.php';

class User extends Model
{
    private $username;
    private $password;
    private $nombre;
    private $apellidos;
    private $direccion;
    private $telefono;
    private $email;
    private $foto;
    private $tipo;
    private $estado;
    static $table="users";

    public function __construct($data, $exists = false)
    {
        $this->username = '';
        $this->password = '';
        $this->nombre = '';
        $this->apellidos = '';
        $this->direccion = '';
        $this->telefono = null;
        $this->email = '';
        $this->foto = null;
        $this->tipo = 1;
        $this->estado = 'activo';

        //print_a($data);
        parent::__construct($data, $exists);

        if (isset($data['username'])) {
            $this->username = $data['username'];
        }
        if (isset($data['password'])) {
            $this->password = $data['password'];
        }
        if (isset($data['nombre'])) {
            $this->nombre = $data['nombre'];
        }
        if (isset($data['apellidos'])) {
            $this->apellidos = $data['apellidos'];
        }
        if (isset($data['direccion'])) {
            $this->direccion = $data['direccion'];
        }
        if (isset($data['telefono'])) {
            $this->telefono = $data['telefono'];
        }
        if (isset($data['email'])) {
            $this->email = $data['email'];
        }
        if (isset($data['foto'])) {
            $this->foto = $data['foto'];
        }
        if (isset($data['tipo'])) {
            $this->tipo = $data['tipo'];
        }
        if (isset($data['estado'])) {
            $this->estado = $data['estado'];
        }
    }

    /**
     * Save a new user in the BD 
     */
    public function save()
    {
        $errors = [];

        $datos = [
            'username' => $this->username,
            'password'=> $this->password,
            'nombre'=> $this->nombre,
            'apellidos'=> $this->apellidos,
            'direccion'=> $this->direccion,
            'telefono'=> $this->telefono,
            'email'=> $this->email,
            'foto'=> $this->foto,
            'tipo'=> $this->tipo,
            'estado'=> $this->estado
        ];

        $exist = self::findBy('username', $this->username);

        if($exist) {
            $errors[] = "El username ya está en uso..";
            return $errors;
        }

        $exist = self::findBy('email', $this->email);

        if($exist) {
            $errors[] = "El email ya corresponde a otro usuario..";
            return $errors;
        }
  
        $query="INSERT INTO ".self::$table. " (username,password,nombre,apellidos,direccion,telefono,email,foto,tipo, estado)
                VALUES (:username, AES_ENCRYPT(:password, 'juane'), :nombre, :apellidos, :direccion, :telefono, :email, :foto, :tipo, :estado);";

        $response = Database::query($query, $datos, false);

        if($response == false) {
            $errors[] = "Ha ocurrido un error insertando el nuevo usuario (duplicado?)";
        }

        return $errors;
    }

    /**
     * Get positive valorations of an incidence
     */
    public function getPositiveValorations($idIncidence)
    {
        $query="select valoracion_pos from valoraciones where incidencia=".$idIncidence." and usuario=".$this->id." LIMIT 1;";

        $response = Database::query($query);
        if($response == NULL || $response == false) {
            return -1;
        }
        return array_values($response[0])[0];
    }

    /**
     * Get negative valorations of an incidence
     */
    public function getNegativeValorations($idIncidence)
    {
        $query="select valoracion_neg from valoraciones where incidencia=".$idIncidence." and usuario=".$this->id." LIMIT 1;";

        $response = Database::query($query);
        if($response == NULL || $response == false) {
            return -1;
        }
        return array_values($response[0])[0];
    }

    /**
     * Make a positive valoration of an incidence
     */
    public function makePositiveValoration($idIncidence)
    {
        if($this->id == 6) {
            $currentPositiveValorations = $this->getPositiveValorations($idIncidence);

            if($currentPositiveValorations==-1) {
                //logg("Ningun visitante NO habia valorado antes....");
                $query="INSERT INTO valoraciones (valoracion_pos,usuario,incidencia)
                VALUES (1, ".$this->id.", ".$idIncidence.");";
            }else{
                //logg("Algun visitante SI habia valorado antes....");
                $query="update valoraciones set valoracion_pos=".($currentPositiveValorations+1)." where usuario=6 and incidencia=".$idIncidence.";";
            }
        }else{
            $query="INSERT INTO valoraciones (valoracion_pos,usuario,incidencia)
            VALUES (1, ".$this->id.", ".$idIncidence.");";
        }
        $response = Database::query($query, null, false);

        return $response;
    }

    /**
     * Make a negative valoration of an incidence
     */
    public function makeNegativeValoration($idIncidence)
    {
        if($this->id == 6) {
            $currentNegativeValorations = $this->getNegativeValorations($idIncidence);

            if($currentNegativeValorations==-1) {
                //logg("Ningun visitante NO habia valorado antes....");
                $query="INSERT INTO valoraciones (valoracion_neg,usuario,incidencia)
                VALUES (1, ".$this->id.", ".$idIncidence.");";
            }else{
                //logg("Algun visitante SI habia valorado antes....");
                $query="update valoraciones set valoracion_neg=".($currentNegativeValorations+1)." where usuario=6 and incidencia=".$idIncidence.";";
            }
        }else{
            $query="INSERT INTO valoraciones (valoracion_neg,usuario,incidencia)
            VALUES (1, ".$this->id.", ".$idIncidence.");";
        }
        $response = Database::query($query, null, false);

        return $response;
    }



    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * {@inheritdoc}
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    
     /**
      * {@inheritdoc}
      */
    public function getApellidos()
    {
        return $this->apellidos;
    }

     /**
      * {@inheritdoc}
      */
    public function getDireccion()
    {
        return $this->direccion;
    }

     /**
      * {@inheritdoc}
      */
    public function gettelefono()
    {
        return $this->telefono;
    }

     /**
      * {@inheritdoc}
      */
    public function getEmail()
    {
        return $this->email;
    }

     /**
      * {@inheritdoc}
      */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * {@inheritdoc}
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * {@inheritdoc}
     */
    public function getTipoDescription()
    {
        if($this->tipo == 0) {
            return 'Administrador';
        }else if($this->tipo == 1) {
            return 'Colaborador';
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getEstado()
    {
        return $this->estado;
    }

    
}


?>