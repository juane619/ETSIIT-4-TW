<?php

/**
 * Route file
 */

class Route
{

    protected $uri;
    protected $class;
    protected $method;
    // protected $uriPattern;

    /* Advanced regex: nosotros añadimos una ruta con un parametro de nombre X.
                    con el mecanismo de sustitucion que aplicamos,  conseguimos capturar en la URL
                    la parte del valor de dicho parametro y le damos una etiqueta a dicho valor, en este caso
                    queremos que la etiqueta a dicho valor sea el nombre del parametro (X)

                    Problema: algunos servidores tienen la funcion preg_replace desactivada (vulnerabilidades), por lo que esta automatizacion
                    no funciona con dicha funcion. Para solucionarlo debemos usar preg_replace_callback y no usar las constantes definidas
                    PARAMETER_PATTERN y PARAMETER_REPLACEMENT.
    */
    const PARAMETER_PATTERN = '/:([^\/]+)/';
    const PARAMETER_REPLACEMENT = '(?<id>[^/]+)';
    protected $parameters;

    public function __construct($uri, $class, $method)
    {
        $this->uri = $uri;
        //logg('Creating route..: '.$uri);
        $this->class = $class;
        $this->method = $method;
    }

    public function getUriPattern()
    {
        //$uriPattern = preg_replace(self::PARAMETER_PATTERN, self::PARAMETER_REPLACEMENT, $this->uri);
        //logg("<br><br>pattern antes: ".$this->uri);
        $uriPattern = preg_replace_callback(
            '/:([^\/]+)/',
            function ($m) {
                return "(?<$m[1]>[^/]+)"; 
            },
            $this->uri
        );
        //logg("pattern despues: ".$uriPattern);
        $uriPattern = str_replace('/', '\/', $uriPattern);
        $uriPattern = '/^' . $uriPattern . '\/*$/s';
        return $uriPattern;
    }

    public function getParameterNames()
    {
        
        preg_match_all(self::PARAMETER_PATTERN, $this->uri, $parameterNames);
        //logg(implode($parameterNames[1]));
        return array_flip($parameterNames[1]);
    }

    public function resolveParameters($matches)
    {
        $this->parameters = array_intersect_key($matches, $this->getParameterNames());
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function checkIfMatch($requestUri)
    {
        $uriPattern = $this->getUriPattern();
        //logg('Checking request/route..');
        //logg('Request uri: ' . $requestUri);
        //logg('Pattern uri: ' . $uriPattern);
        
        if (preg_match($uriPattern, $requestUri, $matches)) {
            $this->resolveParameters($matches);
            return true;
        }
        //logg('No match..');
        return false;
    }

    public function execute()
    {
        $class = $this->class;
        $method = $this->method;

        $parameters = $this->getParameters();
        //logg("closure: " . $closure);
        return call_user_func_array(array($class, $method), $parameters);
    }

}

