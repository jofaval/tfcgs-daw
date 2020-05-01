<?php

class Dashboards implements CRUD
{
    public static $table = "dashboards";

    //Primary Keys
    public $id;

    //Table Keys
    public $title;
    public $description;

    //Foreign Keys
    public $id_creator;

    public function __construct()
    {
        $this->fill();
    }

    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "title" => $this->title,
            "id_creator" => $this->id_creator,
            "id_project" => $this->id_project,
        ];

        $params["id_creator"] = 16;

        $result = $sqlUtils->query(Dashboards::$table, $params);

        if (count($result) == 0) {
            $params["description"] = $this->description;

            $params["creation_date"] = DateUtils::getCurrentDateTime();
            $result = $sqlUtils->insert(Dashboards::$table, $params);
            return $sqlUtils->query(Dashboards::$table, $params);
        }

        return false;
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "title" => $this->title,
            "description" => $this->description,
            "id_creator" => $this->id_creator,
        ];

        $identificationParams = [
            "id" => $this->id,
        ];

        return $sqlUtils->update(Dashboards::$table, $toModify, $identificationParams);
    }

    public function delete()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "title" => $this->title,
            "id_project" => $this->id_project,
        ];

        return $sqlUtils->delete(Dashboards::$table, $params);
    }

    public function query()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "title" => $this->title,
            "id_project" => $this->id_project,
        ];

        return $sqlUtils->query(Dashboards::$table, $params);
    }

    public function enable()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $identificationParams = [
            "title" => $this->title,
            "id_project" => $this->id_project,
        ];

        return $sqlUtils->enable(Dashboards::$table, Utils::getCleanedData("enable"), $identificationParams);
    }

    public function fill()
    {
        $this->id = Utils::getCleanedData("id");
        $this->title = Utils::getCleanedData("title");
        $this->description = Utils::getCleanedData("description");
        $this->id_creator = Sessions::getInstance()->getSession("userId");
        $this->id_project = Utils::getCleanedData("id_project");
    }

    public function parse()
    {
        return json_encode([
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "creatorId" => $this->id_creator,
        ]);
    }
}