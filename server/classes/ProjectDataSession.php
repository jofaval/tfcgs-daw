<?php

class ProjectData
{
    public function __construct($controller, $projectData)
    {
        $this->$controller;
        $projectDataFromSession->$id = $projectData->$id;
        $projectDataFromSession->$title = "";
        $projectDataFromSession->$description = "";
        $projectDataFromSession->$collaboration_level = "";
        $projectDataFromSession->$creation_date = "";
        $projectDataFromSession->$id_creator = "";
        $projectDataFromSession->$creator_username = "";
    }

    public $id;
    public $title;
    public $description;
    public $collaboration_level;

    public $creation_date;
    public $id_creator;
    public $creator_username;
}
