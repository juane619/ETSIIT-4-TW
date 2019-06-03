<?php
/**
 * Modelo base del cual extenderán los demás modelos.
 */

require_once 'Core/Database.php';
require_once 'Core/Helpers.php';


class Model
{
    static $table;
    protected $exists;
    protected $id;
    
    public function __construct($data, $exists = false)
    {
        if (isset($data['id'])) {
            $this->id = (int) $data['id'];
        }
        $this->exists = $exists;
    }

    public function getId()
    {
        return $this->id;
    }
    public function is_exist()
    {
        return $this->exists;
    }
    /**
     * Comprueba si el modelo es válido. Este método se sobreescribe en todos
     * los modelos y se añade la validación manualmente.
     *
     * @return boolean true si la validación es incorrecta. false en caso contrario.
     */
    public function is_valid()
    {
        return true;
    }
    /**
     * Guarda o actualiza el modelo en la base de datos.
     */
    public function save()
    {
        // Las consultas de guardado se ejecutan en el método heredado.
        if ($this->exists) {
            //
        } else {
            // Se recoge el id de la nueva fila insertada.
            $this->id = Database::lastInsertId();
            // Se indica que el objeto existe en la DB.
            $this->exists = true;
        }
    }
    // Métodos estáticos
    /**
     * Obtiene modelos según la información enviada.
     *
     * @param  array $where     Los atributos de la condición where. El array debe ser de clave -
     *                          valor.
     * @param  int   $take_from Desde qué fila va a devolver. Si no se da este valor, se devuelven
     *                          todos.
     * @param  int   $take      Cuántas va a recoger. Si no se da este valor, $take_from se toma
     *                          como $take.
     * @return mixed El objeto o el array de objetos devueltos.
     */
    static function where($where = [], $take_from = null, $take = null)
    {
        // Uso de static:: -> http://www.php.net/manual/es/language.oop5.late-static-bindings.php
        // static:: llama al método o variable estática de la clase desde la que se llama.
        // Si se hace User::where(), static::$table será el valor que tiene en
        // la clase User.
        $sql = 'SELECT * FROM ' . static::$table;
        $attributes = [];
        $one = false;
        // Se construye la sentencia SQL a partir de $where.
        if (count($where) > 0) {
            $sql .= ' WHERE';
            foreach ($where as $key => $value) {
                if($key == 'password') {
                    $sql .= sprintf(' %s = AES_ENCRYPT(?, "juane") AND', $key);
                }else{
                    $sql .= sprintf(' %s = ? AND', $key);
                }
                $attributes[] = $value;
            }
            $sql = substr($sql, 0, -4);
        }
        // Se incluye LIMIT si se han pasado $take_from y $take.
        if (is_int($take_from)) {
            if (!is_int($take)) {
                if ($take_from == 1) {
                    $one = true;
                }
                $take = $take_from;
                $take_from = 0;
            }
            $sql .= sprintf(' LIMIT %s,%s', $take_from, $take);
        }
        $sql .= ';';

        //logg('SQL EN WHERE: ' . $sql);
        // Se ejecuta la consulta
        $result = Database::query($sql, $attributes); // return Array de tantas filas como resultados obtenga

        // Se obtiene el nombre de la clase desde la que se llamó el método
        // para poder crear los objetos con la clase correcta.
        $classname = get_called_class();
        // Si no se obtienen resultados, se devuelve false.
        if (count($result) == 0) {
            //logg("No devuelve nada..");
            return null;
            // Si se pide un resultado, se devuelve el objeto.
        } elseif ($one) {
            //logg("Se devuelve una objecto solo");
            $object = new $classname($result[0], true);
            return $object; 
            // Si se obtienen varios objetos, se devuelve un array de objetos.
        } else {
            //logg("Se devuelve una coleccion");
            $collection = [];
            foreach ($result as $val) {
                //print_a($val);
                $collection[] = new $classname($val, true);
            }
            return $collection;
        }
    }

    /**
     * Obtiene modelos según la información enviada.
     *
     * @param  array $where     Los atributos de la condición where. El array debe ser de clave -
     *                          valor.
     * @param  int   $take_from Desde qué fila va a devolver. Si no se da este valor, se devuelven
     *                          todos.
     * @param  int   $take      Cuántas va a recoger. Si no se da este valor, $take_from se toma
     *                          como $take.
     * @return mixed El objeto o el array de objetos devueltos.
     */
    static function contains($contains = [], $take_from = null, $take = null)
    {
        // Uso de static:: -> http://www.php.net/manual/es/language.oop5.late-static-bindings.php
        // static:: llama al método o variable estática de la clase desde la que se llama.
        // Si se hace User::contains(), static::$table será el valor que tiene en
        // la clase User.
        $sql = 'SELECT * FROM ' . static::$table;
        $attributes = [];
        $one = false;
        // Se construye la sentencia SQL a partir de $contains.
        if (count($contains) > 0) {
            $sql .= ' WHERE';
            foreach ($contains as $key => $value) {
                $sql .= sprintf(' instr(%s, "%s") OR', $key, $value);
                //$attributes[] = $value;
            }
            $sql = substr($sql, 0, -3);
        }
        // Se incluye LIMIT si se han pasado $take_from y $take.
        if (is_int($take_from)) {
            if (!is_int($take)) {
                if ($take_from == 1) {
                    $one = true;
                }
                $take = $take_from;
                $take_from = 0;
            }
            $sql .= sprintf(' LIMIT %s,%s', $take_from, $take);
        }
        $sql .= ';';

        // Se ejecuta la consulta
        //logg("Query: ".$sql);
        $result = Database::query($sql, $attributes); // return Array de tantas filas como resultados obtenga

        // Se obtiene el nombre de la clase desde la que se llamó el método
        // para poder crear los objetos con la clase correcta.
        $classname = get_called_class();
        // Si no se obtienen resultados, se devuelve false.
        if (count($result) == 0) {
            //logg("No devuelve nada..");
            return false;
            // Si se pide un resultado, se devuelve el objeto.
        } elseif ($one) {
            //logg("Se devuelve una objecto solo");
            $user = new $classname($result[0], true);
            return $user; 
            // Si se obtienen varios objetos, se devuelve un array de objetos.
        } else {
            //logg("Se devuelve una coleccion");
            $collection = [];
            foreach ($result as $val) {
                //print_a($val);
                $collection[] = new $classname($val, true);
            }
            return $collection;
        }
    }

    /**
     * Elimina un registro o un conjunto de estos de BD
     */
    static function delete($id)
    {
        $sql = 'DELETE FROM ' . static::$table . ' WHERE id = ?;';
        $parameters[] = (int) $id; 

        $result = Database::query($sql, $parameters, false); // return Array de tantas filas como resultados obtenga

        return $result;
    }

    /**
     * Edita un registro de BD
     */
    static function edit($id, $data)
    {
        $sql = 'UPDATE ' . static::$table;

        if (count($data) > 0) {
            $sql .= ' SET';
            foreach ($data as $key => $value) {
                if($key == 'password') {
                    $sql .= sprintf(' %s = AES_ENCRYPT(?, "juane"),', $key);
                }else{
                    $sql .= sprintf(' %s = ?,', $key);
                }

                $parameters[] = $value;
            }
            $sql = substr($sql, 0, -1);
        }

        $sql .= ' WHERE id = '.$id.';';

        //logg('QUERY: '.$sql);

        $result = Database::query($sql, $parameters, false); // return Array de tantas filas como resultados obtenga

        return $result;
    }

    /**
     * Find by id
     *
     * @param  int $id
     * @return static|null
     */
    public static function findById($id)
    {

        $object = self::findOne(['id' => $id]);
        return $object;
        
    }

    /**
     * Finds incidencia by anything
     *
     * @param  string $anything
     * @return static|null
     */
    public static function findBy($property, $value)
    {
        $objects = null;
        
        if(!empty($property)) {
            $objects = self::where([$property => $value]);
        }
        
        return $objects;
    }

    /**
     * Busca tan solo un elemento en la base de datos.
     *
     * @param  array $where Los atributos de la condición where. El array debe ser de clave - valor.
     * @return Model El modelo encontrado.
     */
    static function findOne($where = [])
    {
        return self::where($where, 1);
    }
    /**
     * Devuelve todos los elementos.
     *
     * @return array Array de Modelos.
     */
    static function all()
    {
        return self::where();
    }
    /**
     * Crea un nuevo modelo con los datos pasados y lo almacena en la base de datos.
     *
     * @param  array $data Datos a pasar al constructor del modelo.
     * @return mixed El modelo creado, o false si ha ocurrido algún error al validar.
     */
    static function create($data)
    {
        $classname = get_called_class();
        $model = new $classname($data);
        if ($model->is_valid()) {
            $model->save();
            return $model;
        } else {
            return false;
        }
    }
}

?>