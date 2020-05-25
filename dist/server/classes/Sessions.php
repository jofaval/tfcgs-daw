<?php

class Sessions
{

    public static $instance = null;

    //Devuelve la instancia del singleton
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Sessions();
            self::$instance->initSession();
        }

        return self::$instance;
    }

    //Se ejecuta cuando se instancia
    public function __construct()
    {

    }

    //Al instanciarse a través del singleton se ejecuta
    private function initSession()
    {
        session_start();
        if (!$this->doesSessionExist("access")) {
            $this->initializeValues();
        }
        $this->regenerateSession();
    }

    //Comprueba si el navegador de la sesión y del cliente es el mismo
    public function isUserAgentTheSame()
    {
        if ($this->doesSessionExist("userAgent")) {
            return $_SERVER["HTTP_USER_AGENT"] == $this->getSession("userAgent");
        }

        return true;
    }

    //Regenera el id de sesión
    private function regenerateSession()
    {

        if ($this->doesSessionExist("clicks")) {
            $this->setSession("clicks", $this->getSession("clicks") - 1);
        } else {
            $this->setSession("clicks", 0);
        }

        if ($this->getSession("clicks") <= 0) {
            if ($this->doesSessionExist("time")) {
                $currentTimeStamp = time();
                if (($this->getSession("time") - $currentTimeStamp) < 0) {
                    $this->deleteSession();
                    $this->initializeValues();
                    header("Location: " . Config::$EXECUTION_HOME_PATH . "signout/");
                }
            }
            session_regenerate_id(true);
            $this->setSession("time", time() + Config::$inactivityTime);
            $this->setSession("clicks", 10);
        }
    }

    //Inicializa los valores de sesión si no tienen valor
    public function initializeValues()
    {
        $this->ifNotExistSetSession("access", 0);
        $this->ifNotExistSetSession("clicks", 10);
        $this->ifNotExistSetSession("userImg", "default.png");
        $this->ifNotExistSetSession("time", "default.png");
    }

    //Si no existe la sesión se crea con el valor que se indica
    public function ifNotExistSetSession($name, $value)
    {
        if (!$this->doesSessionExist($name)) {
            $this->setSession($name, $value);
        }
    }

    //Devuelve el ID de sesión
    public function getSessionID()
    {
        return session_id();
    }

    //Devuelve una entrada de la sesión si existe
    public function getSession($name)
    {
        if ($this->doesSessionExist($name)) {
            return $_SESSION[$name];
        }

        return "";
    }

    //Inserta un valor a una entrada de la sesión
    public function setSession($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    //Borra una sesión
    public function deleteSession($name = '')
    {
        if (!empty($name)) {
            unset($_SESSION[$name]);
        } else {
            $this->setSession("access", 0);
            $this->deleteSession("username");
            $this->deleteSession("userId");
            $this->deleteSession("userAgent");
            unset($_SESSION);
            session_unset();
            session_destroy();
            session_abort();
        }
    }

    //Comprueba si existe la sesión que se crea cuando un usuario se loguea
    public function isUserLogged()
    {
        return $this->doesSessionExist("username");
    }

    //Comprueba si la sesion existe
    public function doesSessionExist($name)
    {
        return isset($_SESSION[$name]);
    }

    public function insertData($name, array $value)
    {
        if (is_array($_SESSION[$name])) {
            array_push($_SESSION[$name], $value);
        } else {
            $this->setSession($name, $value);
        }
    }
}
