<?php

class GanttDiagramTasks implements CRUD 
{
    private $table = "gantt_diagram_tasks";

    //Primary Keys
    private $id;

    //Table Keys
    private $gantt_diagram_id_project;
    private $gantt_diagram_title;
    private $id_creator;
    private $title;
    private $progress;
    private $creation_date;
    private $start_date;
    private $end_date;
    private $parent;

    //Foreign Keys
    private $status;

public function __construct()
                    {
                    $this->fill();
                    }
    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->id,
            "gantt_diagram_id_project" => $this->gantt_diagram_id_project,
            "gantt_diagram_title" => $this->gantt_diagram_title,
            "id_creator" => $this->id_creator,
            "title" => $this->title,
            "progress" => $this->progress,
            "creation_date" => $this->creation_date,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "parent" => $this->parent,
            "status" => $this->status,
        ];

        return $sqlUtils->insert($params);
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "gantt_diagram_id_project" => $this->gantt_diagram_id_project,
            "gantt_diagram_title" => $this->gantt_diagram_title,
            "id_creator" => $this->id_creator,
            "title" => $this->title,
            "progress" => $this->progress,
            "creation_date" => $this->creation_date,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "parent" => $this->parent,
            "status" => $this->status,
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
        $this->gantt_diagram_id_project = Utils::getCleanedData("ganttDiagramIdProject");
        $this->gantt_diagram_title = Utils::getCleanedData("ganttDiagramTitle");
        $this->id_creator = Utils::getCleanedData("idCreator");
        $this->title = Utils::getCleanedData("title");
        $this->progress = Utils::getCleanedData("progress");
        $this->creation_date = Utils::getCleanedData("creationDate");
        $this->start_date = Utils::getCleanedData("startDate");
        $this->end_date = Utils::getCleanedData("endDate");
        $this->parent = Utils::getCleanedData("parent");
        $this->status = Utils::getCleanedData("status");
    }


    public function parse()
    {
        return json_encode([
            "id" => $this->id,
            "ganttDiagramIdProject" => $this->gantt_diagram_id_project,
            "ganttDiagramTitle" => $this->gantt_diagram_title,
            "idCreator" => $this->id_creator,
            "title" => $this->title,
            "progress" => $this->progress,
            "creationDate" => $this->creation_date,
            "startDate" => $this->start_date,
            "endDate" => $this->end_date,
            "parent" => $this->parent,
            "status" => $this->status,
        ]);
    }
} 


