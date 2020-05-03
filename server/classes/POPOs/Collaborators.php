<?php

class Collaborators implements CRUD
{
    private $table = "collaborators";

    //Primary Keys
    private $id_project;
    private $id_collaborator;
    private $starting_date;

    //Table Keys

    //Foreign Keys
    private $level;

    public function __construct()
    {
        $this->fill();
    }

    public function create()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());
        $controller = new Controller();

        $params = [
            "id_project" => $this->id_project,
            "id_collaborator" => $this->id_collaborator,
            "level" => '1',
            "enabled" => '1',
        ];

        $params["starting_date"] = DateUtils::getCurrentDateTime();

        $result = $sqlUtils->insert($this->table, $params);

        if ($result) {
            $params = [
                "id_project" => $this->id_project,
                "id_collaborator" => $this->id_collaborator,
            ];

            return $sqlUtils->complexQuery("SELECT CONCAT(clients.name, ' ', clients.surname) as 'collaboratorName', users.username as 'collaboratorUsername',
            collaborators.starting_date as 'collaborationStartingDate', permissions.title as 'collaborationRole', permissions.description as 'collaborationRoleDescription'
            FROM `collaborators` LEFT JOIN `permissions` on (collaborators.level = permissions.level)
                LEFT JOIN `clients` on (collaborators.id_collaborator = clients.id)
                LEFT JOIN `users` on (clients.id = users.id_client)
                WHERE collaborators.id_project = :id_project and collaborators.id_collaborator = :id_collaborator", $params)[0];
        }

        return $result;
    }

    public function update()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $toModify = [
            "level" => $this->level,
        ];

        $identificationParams = [
            "id_project" => $this->id_project,
            "id_collaborator" => $this->id_collaborator,
            "starting_date" => $this->starting_date,
        ];

        return $sqlUtils->update($this->table, $toModify, $identificationParams);
    }

    public function delete()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id_project" => $this->id_project,
            "id_collaborator" => $this->id_collaborator,
            "starting_date" => $this->starting_date,
        ];

        return $sqlUtils->delete($this->table, $params);
    }

    public function query()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $params = [
            "id_project" => $this->id_project,
            "id_collaborator" => $this->id_collaborator,
            "starting_date" => $this->starting_date,
        ];

        return $sqlUtils->query($this->table, $params);
    }

    public function enable()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $identificationParams = [
            "id_project" => $this->id_project,
            "id_collaborator" => $this->id_collaborator,
            "starting_date" => $this->starting_date,
        ];

        return $sqlUtils->enable($this->table, Utils::getCleanedData("enable"), $identificationParams);
    }

    public function fill()
    {
        $this->id_project = Utils::getCleanedData("id_project");
        $this->id_collaborator = Utils::getCleanedData("id_collaborator");
        $this->starting_date = Utils::getCleanedData("startingDate");
        $this->level = Utils::getCleanedData("level");
    }

    public function parse()
    {
        return json_encode([
            "id_project" => $this->id_project,
            "id_collaborator" => $this->id_collaborator,
            "startingDate" => $this->starting_date,
            "level" => $this->level,
        ]);
    }
}