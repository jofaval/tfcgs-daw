<?php

class DashboardItemComments implements CRUD
{
    private $table = "dashboard_item_comments";

    //Primary Keys
    private $id;

    //Table Keys
    private $id_dashboard_item;
    private $id_creator;
    private $creation_date;
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

        if ($result) {
            /* $params = [
            "id_dashboard_item" => $id_dashboard_item,
            "creation_date" => $currentTime,
            ];
            $array = $sqlUtils->query($this->table, $params)[0]; */

            return $sqlUtils->complexQuery("SELECT CONCAT(clients.name, ' ', clients.surname) as 'commentCreatorName', users.username as 'commentCreatorUsername',
                dashboard_item_comments.creation_date as 'commentDate', dashboard_item_comments.comment, dashboard_item_comments.id
                FROM `dashboard_item_comments` LEFT JOIN `clients` on (dashboard_item_comments.id_creator = clients.id)
                LEFT JOIN `users` on (clients.id = users.id_client)
                WHERE dashboard_item_comments.id_dashboard_item = :id_dashboard_item and dashboard_item_comments.creation_date = :creation_date",
                ["id_dashboard_item" => $this->id_dashboard_item, "creation_date" => $currentTime])[0];
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
        $this->id_dashboard_item = Utils::getCleanedData("id_dashboard_item");
        $this->id_creator = Sessions::getInstance()->getSession("userId");
        $this->creation_date = Utils::getCleanedData("creation_date");
        $this->comment = Utils::getCleanedData("comment");
        $this->enabled = Utils::getCleanedData("enabled");
    }

    public function parse()
    {
        return json_encode([
            "id" => $this->id,
            "id_dashboard_item" => $this->id_dashboard_item,
            "id_creator" => $this->id_creator,
            "creation_date" => $this->creation_date,
            "comment" => $this->comment,
            "enabled" => $this->enabled,
        ]);
    }
}