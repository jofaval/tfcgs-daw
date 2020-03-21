<?php

class Projects implements CRUD
{
    public static $table = "projects";

    //Primary Keys
    public $id;

    //Table Keys
    public $title;
    public $description;

    //Foreign Keys
    public $creator_id;

    public function __construct()
    {
        $this->fill();
    }

    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "title" => $this->title,
            "description" => $this->description,
            "creator_id" => $this->creator_id,
        ];

        return $sqlUtils->insert(Projects::$table, $params);
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "title" => $this->title,
            "description" => $this->description,
            "creator_id" => $this->creator_id,
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
        $this->title = Utils::getCleanedData("title");
        $this->description = Utils::getCleanedData("description");
        $this->creator_id = Sessions::getInstance()->getSession("userId");

        var_dump($this);
    }

    public function parse()
    {
        return json_encode([
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "creatorId" => $this->creator_id,
        ]);
    }
}