<?php

class GanttDiagramTaskAssignation implements CRUD
{
    private $table = "gantt_diagram_task_assignation";

    //Primary Keys
    private $id;
    private $assigned_user_id;
    private $assignation_date;

    //Table Keys

    //Foreign Keys

    public function __construct()
    {

        $this->fill();

    }
    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->id,
            "assigned_user_id" => $this->assigned_user_id,
            "assignation_date" => $this->assignation_date,
        ];

        return $sqlUtils->insert($this->table, $params);
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
        ];

        $identificationParams = [
            "id" => $this->id,
            "assigned_user_id" => $this->assigned_user_id,
            "assignation_date" => $this->assignation_date,
        ];

        return $sqlUtils->update($this->$table, $toModify, $identificationParams);
    }

    public function delete()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->id,
            "assigned_user_id" => $this->assigned_user_id,
            "assignation_date" => $this->assignation_date,
        ];

        return $sqlUtils->delete($this->$table, $params);
    }

    public function query()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->id,
            "assigned_user_id" => $this->assigned_user_id,
            "assignation_date" => $this->assignation_date,
        ];

        return $sqlUtils->query($this->$table, $params);
    }

    public function enable()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $identificationParams = [
            "id" => $this->id,
            "assigned_user_id" => $this->assigned_user_id,
            "assignation_date" => $this->assignation_date,
        ];

        return $sqlUtils->enable($this->$table, Utils::getCleanedData("enable"), $identificationParams);
    }

    public function fill()
    {
        $this->id = Utils::getCleanedData("id");
        $this->assigned_user_id = Utils::getCleanedData("assignedUserId");
        $this->assignation_date = Utils::getCleanedData("assignationDate");
    }

    public function parse()
    {
        return json_encode([
            "id" => $this->id,
            "assignedUserId" => $this->assigned_user_id,
            "assignationDate" => $this->assignation_date,
        ]);
    }
}