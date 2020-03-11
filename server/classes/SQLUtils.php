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

    public function complexQuery($queryString, $params = [])
    {
        $queryAction = $this->$model->$conexion->prepare($queryString);

        foreach ($params as $key => $value) {
            $queryAction->bindValue(":$key", $value, PDO::PARAM_STR);
        }

        if ($queryAction->execute()) {
            return $queryAction->fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function update($table, $toModify, $identificationParams = [])
    {
        $queryString = "UPDATE $table SET ";

        $paramKeyNames = [];
        foreach ($toModify as $key => $value) {
            $paramKeyNames = ":$key=$key";
        }

        $queryString .= $paramKeyNames . join(", ");
        if (count($identificationParams) > 0) {
            $queryString .= "WHERE ";
            foreach ($identificationParams as $key => $value) {
                $queryString .= ":$key=$key";
            }
        }

        $queryAction = $this->$model->$conexion->prepare($queryString);

        foreach ($toModify as $key => $value) {
            $queryAction->bindValue(":$key", $value, PDO::PARAM_STR);
        }

        foreach ($identificationParams as $key => $value) {
            $queryAction->bindValue(":$key", $value, PDO::PARAM_STR);
        }

        return $queryString->execute();
    }

    public function delete($table, $identificationParams = [])
    {
        # code...
    }

    public function enable($table, $enable = true, $identificationParams = [])
    {
        return update($table, ["enabled" => $enable], $identificationParams);
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