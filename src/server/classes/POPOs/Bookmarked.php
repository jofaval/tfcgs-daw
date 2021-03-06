<?php

class Bookmarked implements CRUD
{
    private $table = "bookmarked";

    //Primary Keys
    private $id_client;
    private $id_project;

    //Table Keys

    //Foreign Keys

    public function __construct()
    {
        $this->fill();
    }

    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id_client" => $this->id_client,
            "id_project" => $this->id_project,
        ];

        return $sqlUtils->insert($this->table, $params);
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
        ];

        $identificationParams = [
            "id_client" => $this->id_client,
            "id_project" => $this->id_project,
        ];

        return $sqlUtils->update($this->table, $toModify, $identificationParams);
    }

    public function delete()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id_client" => $this->id_client,
            "id_project" => $this->id_project,
        ];

        return $sqlUtils->delete($this->table, $params);
    }

    public function query()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id_client" => $this->id_client,
            "id_project" => $this->id_project,
        ];

        return $sqlUtils->query($this->table, $params);
    }

    public function enable()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $identificationParams = [
            "id_client" => $this->id_client,
            "id_project" => $this->id_project,
        ];

        return $sqlUtils->enable($this->table, Utils::getCleanedData("enable"), $identificationParams);
    }

    public function fill()
    {
        $this->id_client = Utils::getCleanedData("idClient");
        $this->id_project = Utils::getCleanedData("idProject");
    }

    public function parse()
    {
        return json_encode([
            "idClient" => $this->id_client,
            "idProject" => $this->id_project,
        ]);
    }
}
