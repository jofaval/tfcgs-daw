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
                    $queryParams[] = "`$key`=:$key";
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
        } catch (PDOException $ex) {
            //return $ex;
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
                if (is_int($value)) {
                    $queryAction->bindValue(":$key", $value, PDO::PARAM_INT);
                } else {
                    $queryAction->bindValue(":$key", $value, PDO::PARAM_STR);
                }
            }

            $result = $queryAction->execute();
            if ($result && strpos(mb_strtolower($queryString), 'select') !== false) {
                $this->$model->commit();
                return $queryAction->fetchAll(PDO::FETCH_ASSOC);
            }

            $this->$model->commit();
            return $result;
        } catch (PDOException $ex) {
            //return $ex;
            $this->$model->rollback();
        }

        return false;
    }

    public function getLastRowFromTable($table, $fieldName)
    {
        try {
            $this->$model->beginTransaction();
            $queryString = "SELECT from $table ORDER BY $fieldName DESC LIMIT 1";

            $result = $this->complexQuery($queryString);

            $this->$model->commit();
            return $result;
        } catch (PDOException $ex) {
            //return $ex;
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
                $paramKeyNames[] = "`$key`=:$key";
            }
            $queryString .= join(", ", $paramKeyNames);

            if (count($identificationParams) > 0) {
                $queryString .= " WHERE ";
                $paramKeyNames = [];
                foreach ($identificationParams as $key => $value) {
                    $paramKeyNames[] .= "`$key`=:$key";
                }
                $queryString .= join(" and ", $paramKeyNames);
            }

            $queryAction = $this->$model->$conexion->prepare($queryString);

            foreach ($toModify as $key => $value) {
                $queryAction->bindValue(":$key", $value, PDO::PARAM_STR);
            }

            foreach ($identificationParams as $key => $value) {
                $queryAction->bindValue(":$key", $value, PDO::PARAM_STR);
            }

            $result = $queryAction->execute();
            $this->$model->commit();
            return $result;
        } catch (PDOException $ex) {
            //return $ex;
            $this->$model->rollback();
        }

        return false;
    }

    public function delete($table, $identificationParams = [])
    {
        try {
            $this->$model->beginTransaction();
            $queryString = "DELETE FROM $table";

            $queryParams = [];
            if (count($identificationParams) > 0) {
                $queryString .= " WHERE ";
                foreach ($identificationParams as $key => $value) {
                    $queryParams[] = "`$key`=:$key";
                }
                $queryString .= join(" and ", $queryParams);
            }

            $queryAction = $this->$model->$conexion->prepare($queryString);

            foreach ($identificationParams as $key => $value) {
                $queryAction->bindValue(":$key", $value, PDO::PARAM_STR);
            }

            $result = $queryAction->execute();
            $this->$model->commit();
            return $queryAction->rowCount() > 0;
        } catch (PDOException $ex) {
            //return $ex;
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
            //return $ex;
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
                $paramKeyNames[] = "$key";
            }

            $queryString .= "(`" . join("`, `", $paramKeyNames) . "`)";
            $queryString .= " VALUES (:" . join(", :", $paramKeyNames) . ")";

            $queryAction = $this->$model->$conexion->prepare($queryString);

            foreach ($params as $key => $value) {
                $queryAction->bindValue(":$key", $value, PDO::PARAM_STR);
            }

            $result = $queryAction->execute();

            /* if ($result) {
            return $this->$model->lastInsertId();
            } */

            $this->$model->commit();
            return $result;
        } catch (PDOException $ex) {
            return $ex;
            $this->$model->rollback();
        }

        return false;
    }
}