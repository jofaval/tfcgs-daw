<?php

class Collaborators
 implements CRUD {
	private $table = "collaborators";
        
	//Primary Keys
	private $project_id;
	private $collaborator_id;
	private $starting_date;

	//Table Keys

	//Foreign Keys
	private $level;


        public function create()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"project_id" => $this->$project_id,
		"collaborator_id" => $this->$collaborator_id,
		"starting_date" => $this->$starting_date,
		"level" => $this->$level,
            ];

            return $sqlUtils->insert($params);
        }

        public function update()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $toModify = [
		"level" => $this->$level,
            ];

            $identificationParams = [
		"project_id" => $this->$project_id,
		"collaborator_id" => $this->$collaborator_id,
		"starting_date" => $this->$starting_date,
            ];

            return $sqlUtils->update($this->$table, $toModify, $identificationParams);
        }

        public function delete()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"project_id" => $this->$project_id,
		"collaborator_id" => $this->$collaborator_id,
		"starting_date" => $this->$starting_date,
            ];

            return $sqlUtils->delete($this->$table, $params);
        }

        public function query()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"project_id" => $this->$project_id,
		"collaborator_id" => $this->$collaborator_id,
		"starting_date" => $this->$starting_date,
            ];

            return $sqlUtils->query($this->$table, $params);
        }

        public function fill()
        {
		$this->$project_id = Utils::getCleanedData("projectId");
		$this->$collaborator_id = Utils::getCleanedData("collaboratorId");
		$this->$starting_date = Utils::getCleanedData("startingDate");
		$this->$level = Utils::getCleanedData("level");
        }

        public function parse()
        {
            return json_encode([
		"level" => $this->$level,
            ]);
        }
} 


