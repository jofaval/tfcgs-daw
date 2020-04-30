<?php

class DashboardItemComments implements CRUD
{
    private $table = "dashboard_item_comments";

    //Primary Keys
    private $id_dashboard_item;
    private $id_creator;
    private $creation_date;

    //Table Keys
    private $comment;
    private $enabled;

    //Foreign Keys

    public function __construct()
    {
        $this->fill();
    }

    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $currentTime = DateUtils::getCurrentDateTime();
        $params = [
            "id_dashboard_item" => $this->id_dashboard_item,
            "id_creator" => "16",
            "creation_date" => $currentTime,
            "comment" => $this->comment,
            "enabled" => "1",
        ];

        $result = $sqlUtils->insert($this->table, $params);

        return $result;
        if ($result) {
            $params = [
                "id_dashboard_item" => $id_dashboard_item,
                "creation_date" => $currentTime,
            ];
            $array = $sqlUtils->query($this->table, $params)[0];

            return [
                "id_dashboard_item" => $array["id_dashboard_item"],
                "creation_date" => $array["creation_date"],
                "comment" => $array["comment"],
            ];
        }

        return false;
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "comment" => $this->comment,
            "enabled" => $this->enabled,
        ];

        $identificationParams = [
            "id_dashboard_item" => $this->id_dashboard_item,
            "id_creator" => $this->id_creator,
            "creation_date" => $this->creation_date,
        ];

        return $sqlUtils->update($this->$table, $toModify, $identificationParams);
    }

    public function delete()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id_dashboard_item" => $this->id_dashboard_item,
            "id_creator" => $this->id_creator,
            "creation_date" => $this->creation_date,
        ];

        return $sqlUtils->delete($this->$table, $params);
    }

    public function query()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id_dashboard_item" => $this->id_dashboard_item,
            "id_creator" => $this->id_creator,
            "creation_date" => $this->creation_date,
        ];

        return $sqlUtils->query($this->$table, $params);
    }

    public function enable()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $identificationParams = [
            "id_dashboard_item" => $this->id_dashboard_item,
            "id_creator" => $this->id_creator,
            "creation_date" => $this->creation_date,
        ];

        return $sqlUtils->enable($this->$table, Utils::getCleanedData("enable"), $identificationParams);
    }

    public function fill()
    {
        $this->id_dashboard_item = Utils::getCleanedData("id_dashboard_item");
        $this->id_creator = Sessions::getInstance()->getSession("userId");
        $this->creation_date = Utils::getCleanedData("creation_date");
        $this->comment = Utils::getCleanedData("comment");
        $this->enabled = Utils::getCleanedData("enabled");
    }

    public function parse()
    {
        return json_encode([
            "id_dashboard_item" => $this->id_dashboard_item,
            "id_creator" => $this->id_creator,
            "creation_date" => $this->creation_date,
            "comment" => $this->comment,
            "enabled" => $this->enabled,
        ]);
    }
}