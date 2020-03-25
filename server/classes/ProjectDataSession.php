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
        $projectDataFromSession->$creator_id = "";
        $projectDataFromSession->$creator_username = "";
    }

    public $id;
    public $title;
    public $description;
    public $collaboration_level;

    public $creation_date;
    public $creator_id;
    public $creator_username;
}