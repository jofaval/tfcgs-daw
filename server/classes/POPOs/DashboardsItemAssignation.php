<?php

class DashboardsItemAssignation implements CRUD
{
    private $table = "dashboards_item_assignation";

    //Primary Keys
    private $id;

    //Table Keys
    private $id_dashboard_item;
    private $assigned_by;
    private $start_date;
    private $end_date;
    private $creation_date;

    //Foreign Keys
    private $assigned_to;

    public function __construct()
    {
        $this->fill();
    }

    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $creationTime = DateUtils::getCurrentDateTime();
        $params = [
            "id_dashboard_item" => $this->id_dashboard_item,
            "assigned_by" => $this->assigned_by,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "creation_date" => $creationTime,
            "assigned_to" => $this->assigned_to,
        ];

        $result = $sqlUtils->insert($this->table, $params);

        if ($result) {
            return $sqlUtils->query($this->table, [
                "id_dashboard_item" => $this->id_dashboard_item,
                "assigned_by" => $this->assigned_by,
                "creation_date" => $creationTime,
                "assigned_to" => $this->assigned_to,
            ])[0];
        }

        return $result;
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "id_dashboard_item" => $this->id_dashboard_item,
            "assigned_by" => $this->assigned_by,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "creation_date" => $this->creation_date,
            "assigned_to" => $this->assigned_to,
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
        $this->id_dashboard_item = Utils::getCleanedData("id_dashboard_item");
        $this->assigned_by = Sessions::getInstance()->getSession("userId");
        $this->start_date = Utils::getCleanedData("start_date");
        $this->end_date = Utils::getCleanedData("end_date");
        $this->creation_date = Utils::getCleanedData("creation_date");
        $this->assigned_to = Utils::getCleanedData("assigned_to");
    }

    public function parse()
    {
        return json_encode([
            "id" => $this->id,
            "idDashboardItem" => $this->id_dashboard_item,
            "assignedBy" => $this->assigned_by,
            "startDate" => $this->start_date,
            "endDate" => $this->end_date,
            "creationDate" => $this->creation_date,
            "assignedTo" => $this->assigned_to,
        ]);
    }
}