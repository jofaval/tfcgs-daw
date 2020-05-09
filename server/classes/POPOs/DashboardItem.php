<?php

class DashboardItem implements CRUD
{
    private $table = "dashboard_item";

    //Primary Keys
    private $id;

    //Table Keys
    private $id_creator;
    private $title;
    private $order;
    private $description;
    private $creation_date;
    private $enabled;

    //Foreign Keys
    private $id_dashboard_list;

    public function __construct()
    {
        $this->fill();
    }

    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $currentTime = DateUtils::getCurrentDateTime();
        $id_dashboard_list = $this->id_dashboard_list;
        $params = [
            "id_creator" => Sessions::getInstance()->getSession("userId"),
            "title" => $this->title,
            "order" => Model::getInstance()->getOrderNumberOfList($id_dashboard_list),
            "description" => $this->description,
            "creation_date" => $currentTime,
            "enabled" => "1",
            "id_dashboard_list" => $this->id_dashboard_list,
        ];

        $result = $sqlUtils->insert($this->table, $params);

        if ($result) {
            $params = [
                "id_dashboard_list" => $this->id_dashboard_list,
                "creation_date" => $currentTime,
                "title" => $this->title,
            ];
            $array = $sqlUtils->query($this->table, $params)[0];

            return [
                "id" => $array["id"],
                "id_dashboard_list" => $array["id_dashboard_list"],
                "title" => $array["title"],
                "order" => $array["order"],
                "description" => $array["description"],
            ];
        }

        return false;
    }

    public function update()
    {
        $modelInstance = Model::getInstance();
        $sqlUtils = new SQLUtils($modelInstance);
        $moveForward = Utils::getCleanedData("moveForward") != 0;

        $id_dashboard_list = $this->id_dashboard_list;
        $order = $this->order;
        $toModify = [
            "order" => $order,
            "id_dashboard_list" => $id_dashboard_list,
        ];

        $identificationParams = [
            "id" => $this->id,
        ];
        $modelInstance->reorganizeOrderInDashboardList($id_dashboard_list);
        if (!$moveForward) {
            $modelInstance->updateOrderInDashboardList($id_dashboard_list, $order);
        } else {
            $toModify["order"] = $order + 1;
        }
        $oldDashboardListId = $this->query()[0]["id_dashboard_list"];

        $result = $sqlUtils->update($this->table, $toModify, $identificationParams);

        if ($result) {
            $modelInstance->reorganizeOrderInDashboardList($id_dashboard_list);

            if ($oldDashboardListId != $id_dashboard_list) {
                $modelInstance->reorganizeOrderInDashboardList($oldDashboardListId);
            }
        }

        return [
            "result" => $result,
            "moveForward" => $moveForward,
            "order" => $this->order,
            "id_dashboard_list" => $id_dashboard_list,
        ];

        return $result;
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
        $this->id_creator = Sessions::getInstance()->getSession("userId");
        $this->title = Utils::getCleanedData("title");
        $this->order = Utils::getCleanedData("order");
        $this->description = Utils::getCleanedData("description");
        $this->creation_date = Utils::getCleanedData("creation_date");
        $this->enabled = Utils::getCleanedData("enabled");
        $this->id_dashboard_list = Utils::getCleanedData("id_dashboard_list");
    }

    public function parse()
    {
        return json_encode([
            "id" => $this->id,
            "idCreator" => $this->id_creator,
            "title" => $this->title,
            "order" => $this->order,
            "description" => $this->description,
            "creationDate" => $this->creation_date,
            "enabled" => $this->enabled,
            "idDashboardList" => $this->id_dashboard_list,
        ]);
    }
}