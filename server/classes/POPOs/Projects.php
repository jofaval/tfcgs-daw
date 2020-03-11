<?php

class Projects
 implements CRUD {
	private $table = "projects";
        
	//Primary Keys
	private $id;

	//Table Keys
	private $title;
	private $description;

	//Foreign Keys
	private $creator_id;


        public function create()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"id" => $this->$id,
		"title" => $this->$title,
		"description" => $this->$description,
		"creator_id" => $this->$creator_id,
            ];

            return $sqlUtils->insert($params);
        }

        public function update()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $toModify = [
		"title" => $this->$title,
		"description" => $this->$description,
		"creator_id" => $this->$creator_id,
            ];

            $identificationParams = [
		"id" => $this->$id,
            ];

            return $sqlUtils->update($this->$table, $toModify, $identificationParams);
        }

        public function delete()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"id" => $this->$id,
            ];

            return $sqlUtils->delete($this->$table, $params);
        }

        public function query()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"id" => $this->$id,
            ];

            return $sqlUtils->query($this->$table, $params);
        }

        public function fill()
        {
		$this->$id = Utils::getCleanedData("id");
		$this->$title = Utils::getCleanedData("title");
		$this->$description = Utils::getCleanedData("description");
		$this->$creator_id = Utils::getCleanedData("creatorId");
        }

        public function parse()
        {
            return json_encode([
		"title" => $this->$title,
		"description" => $this->$description,
		"creatorId" => $this->$creator_id,
            ]);
        }
} 


