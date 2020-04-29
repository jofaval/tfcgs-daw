<?php

class DashboardItem implements CRUD
{
    private $table = "dashboard_item";

    //Primary Keys
    private $id;

    //Table Keys
    private $id_creator;
    private $title;
    private $order;
    private $description;
    private $creation_date;
    private $enabled;

    //Foreign Keys
    private $id_dashboard_list;

    public function __construct()
    {
        $this->fill();
    }

    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->id,
            "id_creator" => $this->id_creator,
            "title" => $this->title,
            "order" => $this->order,
            "description" => $this->description,
            "creation_date" => $this->creation_date,
            "enabled" => $this->enabled,
            "id_dashboard_list" => $this->id_dashboard_list,
        ];

        return $sqlUtils->insert($this->$table, $params);
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "id_creator" => $this->id_creator,
            "title" => $this->title,
            "order" => $this->order,
            "description" => $this->description,
            "creation_date" => $this->creation_date,
            "enabled" => $this->enabled,
            "id_dashboard_list" => $this->id_dashboard_list,
        ];

        $identificationParams = [
            "id" => $this->id,
        ];

        return $sqlUtils->update($this->$table, $toModify, $identificationParams);
    }

    public function delete()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->id,
        ];

        return $sqlUtils->delete($this->$table, $params);
    }

    public function query()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->id,
        ];

        return $sqlUtils->query($this->$table, $params);
    }

    public function enable()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $identificationParams = [
            "id" => $this->id,
        ];

        return $sqlUtils->enable($this->$table, Utils::getCleanedData("enable"), $identificationParams);
    }

    public function fill()
    {
        $this->id = Utils::getCleanedData("id");
        $this->id_creator = Sessions::getInstance()->getSession("userId");
        $this->title = Utils::getCleanedData("title");
        $this->order = Utils::getCleanedData("order");
        $this->description = Utils::getCleanedData("description");
        $this->creation_date = Utils::getCleanedData("creationDate");
        $this->enabled = Utils::getCleanedData("enabled");
        $this->id_dashboard_list = Utils::getCleanedData("idDashboardList");
    }

    public function parse()
    {
        return json_encode([
            "id" => $this->id,
            "idCreator" => $this->id_creator,
            "title" => $this->title,
            "order" => $this->order,
            "description" => $this->description,
            "creationDate" => $this->creation_date,
            "enabled" => $this->enabled,
            "idDashboardList" => $this->id_dashboard_list,
        ]);
    }
}
