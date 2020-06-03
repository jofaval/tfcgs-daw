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

        if (count($sqlUtils->query($this->table, [
            "id_dashboard_item" => $this->id_dashboard_item,
            "assigned_by" => $this->assigned_by,
            "assigned_to" => $this->assigned_to,
        ])) > 0) {
            return false;
        }

        $creationTime = DateUtils::getCurrentDateTime();
        $params = [
            "id_dashboard_item" => $this->id_dashboard_item,
            "assigned_by" => $this->assigned_by,
            "finished" => "0",
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "creation_date" => $creationTime,
            "assigned_to" => $this->assigned_to,
        ];

        $result = $sqlUtils->insert($this->table, $params);

        return $result;

        if ($result) {
            return $sqlUtils->query($this->table, [
                "id_dashboard_item" => $this->id_dashboard_item,
                "assigned_by" => $this->assigned_by,
                "assigned_to" => $this->assigned_to,
            ]);
        }

        return $result;
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "finished" => $this->finished != "false",
        ];

        $identificationParams = [
            "id" => $this->id,
        ];

        if (Utils::exists("id_dashboard_item")) {
            $toModify = [
                "start_date" => $this->start_date,
                "end_date" => $this->end_date,
            ];

            $identificationParams = [
                "id_dashboard_item" => $this->id_dashboard_item,
                "assigned_to" => $this->assigned_to,
            ];
        }

        return $sqlUtils->update($this->table, $toModify, $identificationParams);
    }

    public function delete()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id_dashboard_item" => $this->id_dashboard_item,
            "assigned_to" => $this->assigned_to,
        ];

        return $sqlUtils->delete($this->table, $params);
    }

    public function query()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id_dashboard_item" => $this->id_dashboard_item,
            "assigned_to" => $this->assigned_to,
        ];

        $result = $sqlUtils->query($this->table, $params);

        if ($result !== false) {
            return [
                "id" => $result[0]["id"],
                "start_date" => $result[0]["start_date"],
                "end_date" => $result[0]["end_date"],
            ];
        }

        return $result;
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
        $this->id_dashboard_item = Utils::getCleanedData("id_dashboard_item");
        $this->assigned_by = Sessions::getInstance()->getSession("userId");
        $this->start_date = Utils::getCleanedData("start_date");
        $this->end_date = Utils::getCleanedData("end_date");
        $this->creation_date = Utils::getCleanedData("creation_date");
        $this->assigned_to = Utils::getCleanedData("assigned_to");
        $this->finished = Utils::getCleanedData("finished");
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
            "finished" => $this->finished,
        ]);
    }
}