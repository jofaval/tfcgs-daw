<?php

class ProjectDiaryModification implements CRUD
{
    private $table = "project_diary_modification";

    //Primary Keys
    private $id_creator;
    private $modification_date;

    //Table Keys
    private $enabled;

    //Foreign Keys
    private $day;
    private $id_project;

    public function __construct()
    {
        $this->fill();
    }

    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $currentTime = DateUtils::getCurrentDateTime();
        $params = [
            "day" => $this->day,
            "id_project" => $this->id_project,
            "id_creator" => $this->id_creator,
            "modification_date" => $currentTime,
            "enabled" => "1",
        ];

        $result = $sqlUtils->insert($this->table, $params);
        if ($result) {
            //return $sqlUtils->query($this->table, $params)[0];
            return true;
        }

        return false;
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "enabled" => $this->enabled,
        ];

        $identificationParams = [
            "day" => $this->day,
            "id_project" => $this->id_project,
            "id_creator" => $this->id_creator,
            "modification_date" => $this->modification_date,
        ];

        return $sqlUtils->update($this->$table, $toModify, $identificationParams);
    }

    public function delete()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "day" => $this->day,
            "id_project" => $this->id_project,
            "id_creator" => $this->id_creator,
            "modification_date" => $this->modification_date,
        ];

        return $sqlUtils->delete($this->$table, $params);
    }

    public function query()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "day" => $this->day,
            "id_project" => $this->id_project,
            "id_creator" => $this->id_creator,
            "modification_date" => $this->modification_date,
        ];

        return $sqlUtils->query($this->$table, $params);
    }

    public function enable()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $identificationParams = [
            "day" => $this->day,
            "id_project" => $this->id_project,
            "id_creator" => $this->id_creator,
            "modification_date" => $this->modification_date,
        ];

        return $sqlUtils->enable($this->$table, Utils::getCleanedData("enable"), $identificationParams);
    }

    public function fill()
    {
        $this->day = Utils::getCleanedData("day");
        $this->id_project = Utils::getCleanedData("id_project");
        $this->id_creator = Sessions::getInstance()->getSession("userId");
        $this->modification_date = Utils::getCleanedData("modification_date");
        $this->enabled = Utils::getCleanedData("enabled");
        $this->day = Utils::getCleanedData("day");
        $this->id_project = Utils::getCleanedData("id_project");
    }

    public function parse()
    {
        return json_encode([
            "day" => $this->day,
            "idProject" => $this->id_project,
            "idCreator" => $this->id_creator,
            "modificationDate" => $this->modification_date,
            "enabled" => $this->enabled,
            "day" => $this->day,
            "idProject" => $this->id_project,
        ]);
    }
}