<?php

class Permissions
 implements CRUD {
	private $table = "permissions";
        
	//Primary Keys
	private $level;

	//Table Keys
	private $title;
	private $description;

	//Foreign Keys


        public function create()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"level" => $this->$level,
		"title" => $this->$title,
		"description" => $this->$description,
            ];

            return $sqlUtils->insert($params);
        }

        public function update()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $toModify = [
		"title" => $this->$title,
		"description" => $this->$description,
            ];

            $identificationParams = [
		"level" => $this->$level,
            ];

            return $sqlUtils->update($this->$table, $toModify, $identificationParams);
        }

        public function delete()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"level" => $this->$level,
            ];

            return $sqlUtils->delete($this->$table, $params);
        }

        public function query()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"level" => $this->$level,
            ];

            return $sqlUtils->query($this->$table, $params);
        }

        public function fill()
        {
		$this->$level = Utils::getCleanedData("level");
		$this->$title = Utils::getCleanedData("title");
		$this->$description = Utils::getCleanedData("description");
        }

        public function parse()
        {
            return json_encode([
		"title" => $this->$title,
		"description" => $this->$description,
            ]);
        }
} 


