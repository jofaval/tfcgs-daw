<?php

class TaskListItemListItems implements CRUD
{
    private $table = "task_list_item_list_items";

    //Primary Keys
    private $id;

    //Table Keys
    private $task_item_list_id;
    private $title;
    private $order;
    private $description;
    private $creation_date;

    //Foreign Keys
    private $id_creator;

    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->$id,
            "task_item_list_id" => $this->$task_item_list_id,
            "title" => $this->$title,
            "order" => $this->$order,
            "description" => $this->$description,
            "creation_date" => $this->$creation_date,
            "id_creator" => $this->$id_creator,
        ];

        return $sqlUtils->insert($params);
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "task_item_list_id" => $this->$task_item_list_id,
            "title" => $this->$title,
            "order" => $this->$order,
            "description" => $this->$description,
            "creation_date" => $this->$creation_date,
            "id_creator" => $this->$id_creator,
        ];

        $identificationParams = [
            "id" => $this->$id,
        ];

        return $sqlUtils->update($this->$table, $toModify, $identificationParams);
    }

    public function delete()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->$id,
        ];

        return $sqlUtils->delete($this->$table, $params);
    }

    public function query()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->$id,
        ];

        return $sqlUtils->query($this->$table, $params);
    }

    public function enable()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $identificationParams = [
            "id" => $this->$id,
        ];

        return $sqlUtils->enable($this->$table, Utils::getCleanedData("enable"), $identificationParams);
    }

    public function fill()
    {
        $this->$id = Utils::getCleanedData("id");
        $this->$task_item_list_id = Utils::getCleanedData("taskItemListId");
        $this->$title = Utils::getCleanedData("title");
        $this->$order = Utils::getCleanedData("order");
        $this->$description = Utils::getCleanedData("description");
        $this->$creation_date = Utils::getCleanedData("creationDate");
        $this->$id_creator = Sessions::getInstance()->getSession("userId");
    }

    public function parse()
    {
        return json_encode([
            "id" => $this->$id,
            "taskItemListId" => $this->$task_item_list_id,
            "title" => $this->$title,
            "order" => $this->$order,
            "description" => $this->$description,
            "creationDate" => $this->$creation_date,
            "creatorId" => $this->$id_creator,
        ]);
    }
}
