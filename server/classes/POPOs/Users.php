<?php

class Users
 implements CRUD {
	private $table = "users";
        
	//Primary Keys
	private $id;

	//Table Keys
	private $username;
	private $password;
	private $level;

	//Foreign Keys
	private $client_information FOREIGN KEY (id) REFERENCES clients (id;
	private $client_level FOREIGN KEY (level) REFERENCES global_level (level;


        public function create()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"id" => $this->$id,
		"username" => $this->$username,
		"password" => $this->$password,
		"level" => $this->$level,
		"client_information FOREIGN KEY (id) REFERENCES clients (id" => $this->$client_information FOREIGN KEY (id) REFERENCES clients (id,
		"client_level FOREIGN KEY (level) REFERENCES global_level (level" => $this->$client_level FOREIGN KEY (level) REFERENCES global_level (level,
            ];

            return $sqlUtils->insert($params);
        }

        public function update()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $toModify = [
		"username" => $this->$username,
		"password" => $this->$password,
		"level" => $this->$level,
		"client_information FOREIGN KEY (id) REFERENCES clients (id" => $this->$client_information FOREIGN KEY (id) REFERENCES clients (id,
		"client_level FOREIGN KEY (level) REFERENCES global_level (level" => $this->$client_level FOREIGN KEY (level) REFERENCES global_level (level,
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
		$this->$username = Utils::getCleanedData("username");
		$this->$password = Utils::getCleanedData("password");
		$this->$level = Utils::getCleanedData("level");
		$this->$client_information FOREIGN KEY (id) REFERENCES clients (id = Utils::getCleanedData("clientInformationForeignKey(id)ReferencesClients(id");
		$this->$client_level FOREIGN KEY (level) REFERENCES global_level (level = Utils::getCleanedData("clientLevelForeignKey(level)ReferencesGlobalLevel(level");
        }

        public function parse()
        {
            return json_encode([
		"username" => $this->$username,
		"password" => $this->$password,
		"level" => $this->$level,
		"clientInformationForeignKey(id)ReferencesClients(id" => $this->$client_information FOREIGN KEY (id) REFERENCES clients (id,
		"clientLevelForeignKey(level)ReferencesGlobalLevel(level" => $this->$client_level FOREIGN KEY (level) REFERENCES global_level (level,
            ]);
        }
} 


