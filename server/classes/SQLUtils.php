<?php

class SQLUtils
{
    public $model;

    public function __construct($paramModel)
    {
        $this->$model = $paramModel;
    }

    public function query($table, $params = [], $values = "*")
    {
        try {
            $this->$model->beginTransaction();
            $queryString = "SELECT $values FROM $table";

            $queryParams = [];
            if (count($params) > 0) {
                $queryString .= " WHERE ";
                foreach ($params as $key => $value) {
                    $queryParams[] = "$key=:$key";
                }
                $queryString .= join(" and ", $queryParams);
            }

            $queryAction = $this->$model->$conexion->prepare($queryString);

            foreach ($params as $key => $value) {
                $queryAction->bindValue(":$key", $value, PDO::PARAM_STR);
            }

            $queryAction->execute();
            $this->$model->commit();
            return $queryAction->fetchAll(PDO::FETCH_ASSOC);

            $this->$model->rollback();
        } catch (PDOException $ex) {
            return $ex;
            $this->$model->rollback();
        }

        return false;
    }

    public function complexQuery($queryString, $params = [])
    {
        try {
            $this->$model->beginTransaction();
            $queryAction = $this->$model->$conexion->prepare($queryString);

            foreach ($params as $key => $value) {
                $queryAction->bindValue(":$key", $value, PDO::PARAM_STR);
            }

            if ($queryAction->execute()) {
                return $queryAction->fetchAll(PDO::FETCH_ASSOC);
            }

            $this->$model->commit();
        } catch (PDOException $ex) {
            $this->$model->rollback();
        }

        return false;
    }

    public function update($table, $toModify, $identificationParams = [])
    {
        try {
            $this->$model->beginTransaction();
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

            $result = $queryString->execute();
            $this->$model->commit();
            return $result;
        } catch (PDOException $ex) {
            $this->$model->rollback();
        }

        return false;
    }

    public function delete($table, $identificationParams = [])
    {
        try {
            $this->$model->beginTransaction();
            $queryString = "DELETE FROM $table";

            if (count($identificationParams) > 0) {
                $queryString .= " WHERE ";
                foreach ($identificationParams as $key => $value) {
                    $queryString .= ":$key=$key";
                }
            }

            $queryAction = $this->$model->$conexion->prepare($queryString);

            foreach ($identificationParams as $key => $value) {
                $queryAction->bindValue(":$key", $value, PDO::PARAM_STR);
            }

            $result = $queryString->execute();
            $this->$model->commit();
            return $result;
        } catch (PDOException $ex) {
            $this->$model->rollback();
        }

        return false;
    }

    public function enable($table, $enable = true, $identificationParams = [])
    {
        try {
            $this->$model->beginTransaction();

            $result = update($table, ["enabled" => $enable], $identificationParams);
            $this->$model->commit();
            return $result;
        } catch (PDOException $ex) {
            $this->$model->rollback();
        }

        return false;
    }

    public function insert($table, $params = [])
    {
        try {
            $this->$model->beginTransaction();
            $queryString = "INSERT INTO $table ";

            $paramKeyNames = [];
            foreach ($params as $key => $value) {
                $paramKeyNames[] = $key;
            }

            $queryString .= "(" . join(", ", $paramKeyNames) . ")";
            $queryString .= " VALUES (:" . join(", :", $paramKeyNames) . ")";

            $queryAction = $this->$model->$conexion->prepare($queryString);

            foreach ($params as $key => $value) {
                $queryAction->bindValue(":$key", $value, PDO::PARAM_STR);
            }

            $result = $queryAction->execute();

            if ($result) {
                return $this->$model->lastInsertId();
            }

            $this->$model->commit();
            return $result;
        } catch (PDOException $ex) {
            $this->$model->rollback();
        }

        return false;
    }
}