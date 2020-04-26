<?php

class TaskLists implements CRUD
{
    private $table = "task_lists";

    //Primary Keys
    private $id;

    //Table Keys
    private $id_project;
    private $title;
    private $creation_date;

    //Foreign Keys
    private $id_creator;

    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->$id,
            "id_project" => $this->$id_project,
            "title" => $this->$title,
            "creation_date" => $this->$creation_date,
            "id_creator" => $this->$id_creator,
        ];

        return $sqlUtils->insert($params);
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "id_project" => $this->$id_project,
            "title" => $this->$title,
            "creation_date" => $this->$creation_date,
            "id_creator" => $this->$id_creator,
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

    public function enable()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $identificationParams = [
            "id" => $this->$id,
        ];

        return $sqlUtils->enable($this->$table, Utils::getCleanedData("enable"), $identificationParams);
    }

    public function fill()
    {
        $this->$id = Utils::getCleanedData("id");
        $this->$id_project = Utils::getCleanedData("projectId");
        $this->$title = Utils::getCleanedData("title");
        $this->$creation_date = Utils::getCleanedData("creationDate");
        $this->$id_creator = Sessions::getInstance()->getSession("userId");
    }

    public function parse()
    {
        return json_encode([
            "id" => $this->$id,
            "projectId" => $this->$id_project,
            "title" => $this->$title,
            "creationDate" => $this->$creation_date,
            "creatorId" => $this->$id_creator,
        ]);
    }
}
