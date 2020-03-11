<?php

class Clients implements CRUD
{
    private $table = "clients";

    //Primary Keys
    private $id;

    //Table Keys
    private $first_name;
    private $second_name;
    private $email;

    //Foreign Keys

    public function create()
    {

        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->$id,
            "first_name" => $this->$first_name,
            "second_name" => $this->$second_name,
            "email" => $this->$email,

        ];

        return $sqlUtils->insert($params);

    }

    public function update()
    {

        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "first_name" => $this->$first_name,
            "second_name" => $this->$second_name,
            "email" => $this->$email,

        ];

        $identificationParams = [
            "id" => $this->$id,

        ];

        return $sqlUtils->update($this->$table, $toModify, $identificationParams);

    }

    public function delete()
    {

        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->$id,

        ];

        return $sqlUtils->delete($this->$table, $params);

    }

    public function query()
    {

        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->$id,

        ];

        return $sqlUtils->query($this->$table, $params);

    }

    public function fill()
    {
        $this->$id = Utils::getCleanedData("id");
        $this->$first_name = Utils::getCleanedData("firstName");
        $this->$second_name = Utils::getCleanedData("secondName");
        $this->$email = Utils::getCleanedData("email");

    }

    public function parse()
    {

        return json_encode([
            "firstName" => $this->$first_name,
            "secondName" => $this->$second_name,
            "email" => $this->$email,

        ]);

    }
}