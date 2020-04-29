<?php

class Roles implements CRUD
{
    private $table = "roles";

    //Primary Keys
    private $level;

    //Table Keys
    private $title;
    private $description;
    private $enabled;

    //Foreign Keys

    public function __construct()
    {
        $this->fill();
    }

    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "level" => $this->level,
            "title" => $this->title,
            "description" => $this->description,
            "enabled" => $this->enabled,
        ];

        return $sqlUtils->insert($this->$table, $params);
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "title" => $this->title,
            "description" => $this->description,
            "enabled" => $this->enabled,
        ];

        $identificationParams = [
            "level" => $this->level,
        ];

        return $sqlUtils->update($this->$table, $toModify, $identificationParams);
    }

    public function delete()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "level" => $this->level,
        ];

        return $sqlUtils->delete($this->$table, $params);
    }

    public function query()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "level" => $this->level,
        ];

        return $sqlUtils->query($this->$table, $params);
    }

    public function enable()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $identificationParams = [
            "level" => $this->level,
        ];

        return $sqlUtils->enable($this->$table, Utils::getCleanedData("enable"), $identificationParams);
    }

    public function fill()
    {
        $this->level = Utils::getCleanedData("level");
        $this->title = Utils::getCleanedData("title");
        $this->description = Utils::getCleanedData("description");
        $this->enabled = Utils::getCleanedData("enabled");
    }

    public function parse()
    {
        return json_encode([
            "level" => $this->level,
            "title" => $this->title,
            "description" => $this->description,
            "enabled" => $this->enabled,
        ]);
    }
}