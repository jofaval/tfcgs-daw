<?php

class Sessions
{

    public static $instance = null;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Sessions();
            self::$instance->initSession();
        }

        return self::$instance;
    }

    public function __construct()
    {

    }

    private function initSession()
    {
        session_start();
        if (!$this->doesSessionExist("access")) {
            $this->initializeValues();
        }
        $this->regenerateSession();
    }

    public function isUserAgentTheSame()
    {
        if ($this->doesSessionExist("userAgent")) {
            return $_SERVER["HTTP_USER_AGENT"] == $this->getSession("userAgent");
        }

        return true;
    }

    private function regenerateSession()
    {
        if ($this->doesSessionExist("clicks")) {
            $this->setSession("clicks", $this->getSession("clicks") - 1);
        } else {
            $this->setSession("clicks", 10);
        }

        if ($this->getSession("clicks") <= 0) {
            session_regenerate_id(true);
            $this->setSession("clicks", 10);
        }
    }

    public function initializeValues()
    {
        $this->ifNotExistSetSession("access", 0);
        $this->ifNotExistSetSession("clicks", 10);
        $this->ifNotExistSetSession("userImg", "default.png");
    }

    public function ifNotExistSetSession($name, $value)
    {
        if (!$this->doesSessionExist($name)) {
            $this->setSession($name, $value);
        }
    }

    public function getSessionID()
    {
        return session_id();
    }

    public function getSession($name)
    {
        if ($this->doesSessionExist($name)) {
            return $_SESSION[$name];
        }

        return "";
    }

    public function setSession($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function deleteSession($name = '')
    {
        if (!empty($name)) {
            unset($_SESSION[$name]);
        } else {
            unset($_SESSION);
            session_unset();
            session_destroy();
            session_abort();
        }
    }

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