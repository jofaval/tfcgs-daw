<?php

class GanttDiagrams implements CRUD 
{
    private $table = "gantt_diagrams";

    //Primary Keys
    private $id_project;
    private $title;

    //Table Keys
    private $id_creator;
    private $creation_date;

    //Foreign Keys

public function __construct()
                    {
                    $this->fill();
                    }
    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id_project" => $this->id_project,
            "title" => $this->title,
            "id_creator" => $this->id_creator,
            "creation_date" => $this->creation_date,
        ];

        return $sqlUtils->insert($params);
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "id_creator" => $this->id_creator,
            "creation_date" => $this->creation_date,
        ];

        $identificationParams = [
            "id_project" => $this->id_project,
            "title" => $this->title,
        ];

        return $sqlUtils->update($this->$table, $toModify, $identificationParams);
    }

    public function delete()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id_project" => $this->id_project,
            "title" => $this->title,
        ];

        return $sqlUtils->delete($this->$table, $params);
    }

    public function query()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id_project" => $this->id_project,
            "title" => $this->title,
        ];

        return $sqlUtils->query($this->$table, $params);
    }

    public function enable()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $identificationParams = [
            "id_project" => $this->id_project,
            "title" => $this->title,
        ];

        return $sqlUtils->enable($this->$table, Utils::getCleanedData("enable"), $identificationParams);
    }


    public function fill()
    {
        $this->id_project = Utils::getCleanedData("idProject");
        $this->title = Utils::getCleanedData("title");
        $this->id_creator = Utils::getCleanedData("idCreator");
        $this->creation_date = Utils::getCleanedData("creationDate");
    }


    public function parse()
    {
        return json_encode([
            "idProject" => $this->id_project,
            "title" => $this->title,
            "idCreator" => $this->id_creator,
            "creationDate" => $this->creation_date,
        ]);
    }
} 


