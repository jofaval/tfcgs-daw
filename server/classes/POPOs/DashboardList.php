<?php

class DashboardList implements CRUD
{
    private $table = "dashboard_list";

    //Primary Keys
    private $id;

    //Table Keys
    private $id_creator;
    private $title;
    private $creation_date;
    private $order_criteria;
    private $enabled;

    //Foreign Keys
    private $id_project;
    private $dashboard_title;

    public function __construct()
    {

        $this->fill();

    }
    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id_project" => $this->id_project,
            "dashboard_title" => $this->dashboard_title,
            "id_creator" => "16",
            "title" => $this->title,
            "creation_date" => DateUtils::getCurrentDateTime(),
            "order_criteria" => "1",
            "enabled" => "1",
        ];

        $result = $sqlUtils->insert($this->table, $params);

        if ($result) {
            $params = [
                "id_project" => $this->id_project,
                "dashboard_title" => $this->dashboard_title,
                "creation_date" => DateUtils::getCurrentDateTime(),
                "title" => $this->title,
            ];
            return $sqlUtils->query($this->table, $params);
        }

        return false;
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "id_project" => $this->id_project,
            "dashboard_title" => $this->dashboard_title,
            "id_creator" => $this->id_creator,
            "title" => $this->title,
            "creation_date" => $this->creation_date,
            "order_criteria" => $this->order_criteria,
            "enabled" => $this->enabled,
            "id_project" => $this->id_project,
            "dashboard_title" => $this->$dashboard_title,
        ];

        $identificationParams = [
            "id" => $this->id,
        ];

        return $sqlUtils->update($this->table, $toModify, $identificationParams);
    }

    public function delete()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->id,
        ];

        return $sqlUtils->delete($this->table, $params);
    }

    public function query()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->id,
        ];

        return $sqlUtils->query($this->table, $params);
    }

    public function enable()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $identificationParams = [
            "id" => $this->id,
        ];

        return $sqlUtils->enable($this->table, Utils::getCleanedData("enable"), $identificationParams);
    }

    public function fill()
    {
        $this->id = Utils::getCleanedData("id");
        $this->id_project = Utils::getCleanedData("id_project");
        $this->dashboard_title = Utils::getCleanedData("dashboard_title");
        $this->id_creator = Sessions::getInstance()->getSession("userId");
        $this->title = Utils::getCleanedData("title");
        $this->creation_date = Utils::getCleanedData("creation_date");
        $this->order_criteria = Utils::getCleanedData("order_criteria");
        $this->enabled = Utils::getCleanedData("enabled");
    }

    public function parse()
    {
        return json_encode([
            "id" => $this->id,
            "idProject" => $this->id_project,
            "dashboardTitle" => $this->dashboard_title,
            "idCreator" => $this->id_creator,
            "title" => $this->title,
            "creationDate" => $this->creation_date,
            "orderCriteria" => $this->order_criteria,
            "enabled" => $this->enabled,
            "idProject" => $this->id_project,
            "dashboardTitle" => $this->$dashboard_title,
        ]);
    }
}