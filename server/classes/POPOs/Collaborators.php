<?php

class Collaborators implements CRUD
{
    private $table = "collaborators";

    //Primary Keys
    private $id_project;
    private $collaborator_id;
    private $starting_date;

    //Table Keys

    //Foreign Keys
    private $level;

    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id_project" => $this->$id_project,
            "collaborator_id" => $this->$collaborator_id,
            "starting_date" => $this->$starting_date,
            "level" => $this->$level,
        ];

        return $sqlUtils->insert($params);
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "level" => $this->$level,
        ];

        $identificationParams = [
            "id_project" => $this->$id_project,
            "collaborator_id" => $this->$collaborator_id,
            "starting_date" => $this->$starting_date,
        ];

        return $sqlUtils->update($this->$table, $toModify, $identificationParams);
    }

    public function delete()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id_project" => $this->$id_project,
            "collaborator_id" => $this->$collaborator_id,
            "starting_date" => $this->$starting_date,
        ];

        return $sqlUtils->delete($this->$table, $params);
    }

    public function query()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id_project" => $this->$id_project,
            "collaborator_id" => $this->$collaborator_id,
            "starting_date" => $this->$starting_date,
        ];

        return $sqlUtils->query($this->$table, $params);
    }

    public function enable()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $identificationParams = [
            "id_project" => $this->$id_project,
            "collaborator_id" => $this->$collaborator_id,
            "starting_date" => $this->$starting_date,
        ];

        return $sqlUtils->enable($this->$table, Utils::getCleanedData("enable"), $identificationParams);
    }

    public function fill()
    {
        $this->$id_project = Utils::getCleanedData("projectId");
        $this->$collaborator_id = Utils::getCleanedData("collaboratorId");
        $this->$starting_date = Utils::getCleanedData("startingDate");
        $this->$level = Utils::getCleanedData("level");
    }

    public function parse()
    {
        return json_encode([
            "projectId" => $this->$id_project,
            "collaboratorId" => $this->$collaborator_id,
            "startingDate" => $this->$starting_date,
            "level" => $this->$level,
        ]);
    }
}