<?php

class TaskListItemLists implements CRUD
{
    private $table = "task_list_item_lists";

    //Primary Keys
    private $id;

    //Table Keys
    private $task_list_id;
    private $id_creator;
    private $title;
    private $description;
    private $creation_date;

    //Foreign Keys
    private $order_criteria;

    public function __construct()
    {
        $this->fill();
    }

    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->id,
            "task_list_id" => $this->task_list_id,
            "id_creator" => $this->id_creator,
            "title" => $this->title,
            "description" => $this->description,
            "creation_date" => $this->creation_date,
            "order_criteria" => $this->order_criteria,
        ];

        return $sqlUtils->insert($params);
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "task_list_id" => $this->task_list_id,
            "id_creator" => $this->id_creator,
            "title" => $this->title,
            "description" => $this->description,
            "creation_date" => $this->creation_date,
            "order_criteria" => $this->order_criteria,
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
        $this->task_list_id = Utils::getCleanedData("taskListId");
        $this->id_creator = Sessions::getInstance()->getSession("userId");
        $this->title = Utils::getCleanedData("title");
        $this->description = Utils::getCleanedData("description");
        $this->creation_date = Utils::getCleanedData("creationDate");
        $this->order_criteria = Utils::getCleanedData("orderCriteria");
    }

    public function parse()
    {
        return json_encode([
            "id" => $this->id,
            "taskListId" => $this->task_list_id,
            "creatorId" => $this->id_creator,
            "title" => $this->title,
            "description" => $this->description,
            "creationDate" => $this->creation_date,
            "orderCriteria" => $this->order_criteria,
        ]);
    }
}
