<?php

class SQLUtils
{
    public $model;

    public function __construct($paramModel)
    {
        $this->$model = $paramModel;
    }

    public function query($table, $values = "*", $params = [])
    {
        # code...
    }

    public function update($table, $toModify, $identificationParams = [])
    {
        #code
    }

    public function delete($table, $identificationParams = [])
    {
        # code...
    }

    public function enable($table, $enable = true, $identificationParams = [])
    {
        # code...
    }

    public function insert($table, $params = [])
    {
        $queryString = "INSERT INTO $table ";

        $paramKeyNames = [];
        foreach ($params as $key => $value) {
            $paramKeyNames = $key;
        }

        $queryString .= "(" . $paramKeyNames . join(", ") . ")";
        $queryString .= "VALUES (:" . $paramKeyNames . join(", :") . ")";

        $queryAction = $this->$model->$conexion->prepare($queryString);

        foreach ($params as $key => $value) {
            $queryAction->bindValue(":$key", $value, PDO::PARAM_STR);
        }

        return $queryString->execute();
    }
}