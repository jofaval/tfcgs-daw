<?php

class TaskLists implements CRUD 
{
	private $table = "task_lists";

	//Primary Keys
	private $id;

	//Table Keys
	private $project_id;
	private $title;
	private $creation_date;

	//Foreign Keys
	private $creator_id;

	public function create()
	{
		$sqlUtils = new SQLUtils(Model::getInstance());

		$params = [
			"id" => $this->$id,
			"project_id" => $this->$project_id,
			"title" => $this->$title,
			"creation_date" => $this->$creation_date,
			"creator_id" => $this->$creator_id,
		];

		return $sqlUtils->insert($params);
	}

	public function update()
	{
		$sqlUtils = new SQLUtils(Model::getInstance());

		$toModify = [
			"project_id" => $this->$project_id,
			"title" => $this->$title,
			"creation_date" => $this->$creation_date,
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
		$this->$project_id = Utils::getCleanedData("projectId");
		$this->$title = Utils::getCleanedData("title");
		$this->$creation_date = Utils::getCleanedData("creationDate");
		$this->$creator_id = Utils::getCleanedData("creatorId");
	}


	public function parse()
	{
		return json_encode([
			"id" => $this->$id,
			"projectId" => $this->$project_id,
			"title" => $this->$title,
			"creationDate" => $this->$creation_date,
			"creatorId" => $this->$creator_id,
		]);
	}
} 


