<?php

class Model extends PDO
{
    public $conexion;
    public static $instance = null;

    public function __construct()
    {
        $this->conexion = new PDO('mysql:host=' . Config::$mvc_bd_hostname . ';dbname=' . Config::$mvc_bd_nombre . '', Config::$mvc_bd_usuario, Config::$mvc_bd_clave);
        // Realiza el enlace con la BD en utf-8
        $this->conexion->exec("set names utf8");
        $this->conexion->exec("SET auto_commit = 0");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Model();
            self::$instance->conexion = new PDO('mysql:host=' . Config::$mvc_bd_hostname . ';dbname=' . Config::$mvc_bd_nombre . '', Config::$mvc_bd_usuario, Config::$mvc_bd_clave);
            // Realiza el enlace con la BD en utf-8
            self::$instance->conexion->exec("set names utf8");
            self::$instance->conexion->exec("SET auto_commit = 0");
            self::$instance->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }

    public function query($queryString, $params = [])
    {
        $result = $this->conexion->prepare($queryString);

        $result->execute($params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cudOperation($insertString, $params = [])
    {
        $result = $this->conexion->prepare($insertString);

        return $result->execute($params);
    }

    public function disable($entityType, $params, $enabled)
    {
        $queryString = "UPDATE FROM $entityType SET enabled=:enabled WHERE ";

        $keys = [];
        foreach ($params as $key => $value) {
            $keys = "$key=:$key";
        }
        $queryString .= $keys . join(" and ");

        $params["enabled"] = $enabled;
        return $this->cudOperation($queryString, $params);
    }

    public function signin($username, $password)
    {
        $params = ["username" => $username];
        $signin = $this->query("SELECT password FROM users WHERE username=:username", $params);
        if ($signin[0]["password"] == Cryptography::blowfishCrypt($password, $username)) {
            return $signin;
        }
        return false;
    }

    public function signup($firstName, $secondName, $email, $username, $password)
    {

        $params = [
            "email" => $email,
        ];

        //echo "Empieza la transaccion";
        //$this->$conexion->beginTransaction();
        try {
            $queryString = 'SELECT *
                        FROM `clients`
                            WHERE `email`=:email';
            $emails = $this->query($queryString, $params);

            //echo "<pre>";
            //var_dump($emails);
            //echo "</pre>";
            if (count($emails) != 1) {
                $params["first_name"] = $firstName;
                $params["second_name"] = $secondName;

                $clientQueryString = 'INSERT Into `clients` (`first_name`, `second_name`, `email`)
                Values (:first_name, :second_name, :email)';
                $client = $this->cudOperation($clientQueryString, $params);

                $queryString = 'SELECT `id`
                FROM `clients`
                    WHERE `email`=:email';
                $clientId = $this->query($queryString, ["email" => $email])[0]["id"];

                $params = [
                    "username" => $username,
                    "password" => Cryptography::blowfishCrypt($password, $username),
                    "id" => $clientId,
                ];

                $userQueryString = 'INSERT Into `users` (`id`, `username`, `password`, `level`)
                Values (:id, :username, :password, 1)';
                $user = $this->cudOperation($userQueryString, $params);

                //echo "Tiene exito";
                //$this->$conexion->commit();
                return $client && $user;
            }

            //echo "Ya existe ese cliente";
            //$this->$conexion->rollBack();
        } catch (\Throwable $th) {
            //echo "<pre>";
            //var_dump($th);
            //echo "</pre>";
            //echo "Ha surgido un error";
            //$this->$conexion->rollBack();
        }

        return false;
    }

    public function getEventsFromMonth()
    {
        $params = [
            "month" => Utils::getCleanedData("month"),
            "year" => Utils::getCleanedData("year"),
        ];

        return $this->query("SELECT * FROM events WHERE MONTH(selectedDay)=:month and YEAR(selectedDay)=:year", $params);
    }

    public function test()
    {
        $params = [
            "orderId" => 1,
        ];

        return $this->query("SELECT * FROM `schedules` WHERE orderId=:orderId", $params);
    }
}