<?php

class ProjectDiary implements CRUD
{
    private $table = "project_diary";

    //Primary Keys
    private $day;
    private $id_project;

    //Table Keys
    private $id_creator;
    private $content;
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
            "day" => $this->day,
            "id_project" => $this->id_project,
            "content" => $this->content,
        ];
        $date = new DateTime();
        $params["creation_date"] = $date->format("Y-m-d H:i:s");
        $params["id_creator"] = "16";

        return $sqlUtils->insert($this->table, $params);
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "content" => $this->content,
        ];

        $identificationParams = [
            "day" => $this->day,
            "id_project" => $this->id_project,
        ];

        return $sqlUtils->update($this->table, $toModify, $identificationParams);
    }

    public function delete()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "day" => $this->day,
            "id_project" => $this->id_project,
        ];

        return $sqlUtils->delete($this->table, $params);
    }

    public function query()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "day" => $this->day,
            "id_project" => $this->id_project,
        ];

        return $sqlUtils->query($this->table, $params);
    }

    public function enable()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $identificationParams = [
            "day" => $this->day,
            "id_project" => $this->id_project,
        ];

        return $sqlUtils->enable($this->table, Utils::getCleanedData("enable"), $identificationParams);
    }

    public function fill()
    {
        $this->day = Utils::getCleanedData("day");
        $this->id_project = Utils::getCleanedData("id_project");
        $this->id_creator = Sessions::getInstance()->getSession("userId");
        $this->content = Utils::getCleanedData("content");
        $this->creation_date = Utils::getCleanedData("creationDate");
    }

    public function parse()
    {
        return json_encode([
            "day" => $this->day,
            "id_project" => $this->id_project,
            "creatorId" => $this->id_creator,
            "content" => $this->content,
            "creationDate" => $this->creation_date,
        ]);
    }
}