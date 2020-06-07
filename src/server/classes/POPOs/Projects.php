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
    public $id_creator;

    public function __construct()
    {
        $this->fill();
    }

    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $creationDate = DateUtils::getCurrentDateTime();
        $params = [
            "title" => $this->title,
            //"description" => $this->description,
            "id_creator" => $this->id_creator,
            //"creation_date" => $creationDate,
            //"enabled" => 1,
        ];

        $result = $sqlUtils->query(Projects::$table, $params);
        //return [Projects::$table, $params];

        if ($result !== false && $result !== null && count($result) == 0) {
            $params["description"] = $this->description;
            $params["creation_date"] = $creationDate;
            $sqlUtils->insert(Projects::$table, $params);
            $queryResult = $sqlUtils->query(Projects::$table, $params)[0];

            mkdir(SystemPaths::CLIENT_SCRIPTS_PATH . "/projects/" . $queryResult["id"]);

            $randomImage = SystemPaths::CLIENT_SCRIPTS_PATH . "/projects/templates/bg-" . rand(1, 6) . ".png";
            $finalPath = SystemPaths::CLIENT_SCRIPTS_PATH . "/projects/" . $queryResult["id"] . "/bg.png";

            FileUtils::copy($randomImage, $finalPath);

            $randomImage = SystemPaths::CLIENT_SCRIPTS_PATH . "/projects/templates/profile-" . rand(1, 6) . ".png";
            $finalPath = SystemPaths::CLIENT_SCRIPTS_PATH . "/projects/" . $queryResult["id"] . "/profile.png";

            FileUtils::copy($randomImage, $finalPath);

            return [0 => $queryResult];
        }

        return false;
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "title" => $this->title,
            "description" => $this->description,
            "id_creator" => $this->id_creator,
        ];

        $identificationParams = [
            "id" => $this->id,
        ];

        return $sqlUtils->update(Projects::$table, $toModify, $identificationParams);
    }

    public function delete()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->id,
        ];

        return $sqlUtils->delete(Projects::$table, $params);
    }

    public function query()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id" => $this->id,
        ];

        return $sqlUtils->query(Projects::$table, $params);
    }

    public function enable()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $identificationParams = [
            "id" => $this->id,
        ];

        return $sqlUtils->enable(Projects::$table, Utils::getCleanedData("enable"), $identificationParams);
    }

    public function fill()
    {
        $this->id = Utils::getCleanedData("id");
        $this->title = Utils::getCleanedData("title");
        $this->description = Utils::getCleanedData("description");
        $this->id_creator = Sessions::getInstance()->getSession("userId");
    }

    public function parse()
    {
        return json_encode([
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "creatorId" => $this->id_creator,
        ]);
    }
}