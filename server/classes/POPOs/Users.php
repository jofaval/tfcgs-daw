<?php

class Users implements CRUD 
{
	private $table = "users";

	//Primary Keys
	private $id;

	//Table Keys
	private $username;
	private $password;

	//Foreign Keys
	private $level;

	public function create()
	{
		$sqlUtils = new SQLUtils(Model::getInstance());

		$params = [
			"id" => $this->$id,
			"username" => $this->$username,
			"password" => $this->$password,
			"level" => $this->$level,
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

	public function enable()
	{
		$sqlUtils = new SQLUtils(Model::getInstance());

		$identificationParams = [
			"id" => $this->$id,
		];

		return $sqlUtils->enable($this->$table, Utils::getCleanedData("enable"), $identificationParams);
	}


	public function fill()
	{
		$this->$id = Utils::getCleanedData("id");
		$this->$username = Utils::getCleanedData("username");
		$this->$password = Utils::getCleanedData("password");
		$this->$level = Utils::getCleanedData("level");
	}


	public function parse()
	{
		return json_encode([
			"id" => $this->$id,
			"username" => $this->$username,
			"password" => $this->$password,
			"level" => $this->$level,
		]);
	}
} 


