<?php

class DashboardListOrderCriteria implements CRUD
{
    private $table = "dashboard_list_order_criteria";

    //Primary Keys
    private $id;

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
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "enabled" => $this->enabled,
        ];

        return $sqlUtils->insert($this->table, $params);
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
        $this->enabled = Utils::getCleanedData("enabled");
    }

    public function parse()
    {
        return json_encode([
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "enabled" => $this->enabled,
        ]);
    }
}
