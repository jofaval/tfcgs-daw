<?php

class Projects
 implements CRUD {
	private $table = "projects";
        
	//Primary Keys
	private $id;

	//Table Keys
	private $creator_id;
	private $title;
	private $description;

	//Foreign Keys
	private $project_creator FOREIGN KEY (creator_id) REFERENCES users (id;


        public function create()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"id" => $this->$id,
		"creator_id" => $this->$creator_id,
		"title" => $this->$title,
		"description" => $this->$description,
		"project_creator FOREIGN KEY (creator_id) REFERENCES users (id" => $this->$project_creator FOREIGN KEY (creator_id) REFERENCES users (id,
            ];

            return $sqlUtils->insert($params);
        }

        public function update()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $toModify = [
		"creator_id" => $this->$creator_id,
		"title" => $this->$title,
		"description" => $this->$description,
		"project_creator FOREIGN KEY (creator_id) REFERENCES users (id" => $this->$project_creator FOREIGN KEY (creator_id) REFERENCES users (id,
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
		$this->$creator_id = Utils::getCleanedData("creatorId");
		$this->$title = Utils::getCleanedData("title");
		$this->$description = Utils::getCleanedData("description");
		$this->$project_creator FOREIGN KEY (creator_id) REFERENCES users (id = Utils::getCleanedData("projectCreatorForeignKey(creatorId)ReferencesUsers(id");
        }

        public function parse()
        {
            return json_encode([
		"creatorId" => $this->$creator_id,
		"title" => $this->$title,
		"description" => $this->$description,
		"projectCreatorForeignKey(creatorId)ReferencesUsers(id" => $this->$project_creator FOREIGN KEY (creator_id) REFERENCES users (id,
            ]);
        }
} 


