<?php

class GanttDiagrams implements CRUD
{
    private $table = "gantt_diagrams";

    //Primary Keys
    private $id_project;
    private $title;
    private $description;

    //Table Keys
    private $id_creator;
    private $creation_date;

    //Foreign Keys

    public function __construct()
    {

        $this->fill();

    }
    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $creation_date = DateUtils::getCurrentDateTime();

        $params = [
            "id_project" => $this->id_project,
            "title" => $this->title,
            "id_creator" => $this->id_creator,
            "creation_date" => $creation_date,
            "description" => $this->description,
            "enabled" => true,
        ];

        $result = $sqlUtils->insert($this->table, $params);

        if ($result !== false) {
            $result = $sqlUtils->query($this->table, [
                "id_project" => $this->id_project,
                "title" => $this->title,
            ]);

            mkdir(SystemPaths::CLIENT_IMG_PATH . "/projects/" . $this->id_project . "/gantts/");
            mkdir(SystemPaths::CLIENT_IMG_PATH . "/projects/" . $this->id_project . "/gantts/" . $this->title);

            $randomImage = SystemPaths::CLIENT_IMG_PATH . "/projects/templates/bg-" . rand(1, 6) . ".png";
            $randomImage = SystemPaths::CLIENT_IMG_PATH . "/gantts/templates/bg-" . rand(1, 6) . ".png";
            $finalPath = SystemPaths::CLIENT_IMG_PATH . "/projects/" . $this->id_project . "/gantts/" . $this->title . "/bg.png";

            FileUtils::copy($randomImage, $finalPath);
        }

        return $result;
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "id_creator" => $this->id_creator,
            "creation_date" => $this->creation_date,
            "description" => $this->description,
        ];

        $identificationParams = [
            "id_project" => $this->id_project,
            "title" => $this->title,
        ];

        return $sqlUtils->update($this->$table, $toModify, $identificationParams);
    }

    public function delete()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id_project" => $this->id_project,
            "title" => $this->title,
            "description" => $this->description,
        ];

        return $sqlUtils->delete($this->$table, $params);
    }

    public function query()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id_project" => $this->id_project,
            "title" => $this->title,
            "description" => $this->description,
        ];

        return $sqlUtils->query($this->$table, $params);
    }

    public function enable()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $identificationParams = [
            "id_project" => $this->id_project,
            "title" => $this->title,
            "description" => $this->description,
        ];

        return $sqlUtils->enable($this->$table, Utils::getCleanedData("enable"), $identificationParams);
    }

    public function fill()
    {
        $this->id_project = Utils::getCleanedData("id_project");
        $this->title = Utils::getCleanedData("title");
        $this->description = Utils::getCleanedData("description");
        $this->id_creator = Sessions::getInstance()->getSession("userId");
        $this->creation_date = Utils::getCleanedData("creation_date");
    }

    public function parse()
    {
        return json_encode([
            "idProject" => $this->id_project,
            "title" => $this->title,
            "idCreator" => $this->id_creator,
            "creationDate" => $this->creation_date,
        ]);
    }
}