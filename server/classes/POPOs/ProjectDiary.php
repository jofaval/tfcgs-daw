<?php

class ProjectDiary implements CRUD 
{
	private $table = "project_diary";

	//Primary Keys
	private $day;
	private $project_id;

	//Table Keys
	private $creator_id;
	private $content;
	private $creation_date;

	//Foreign Keys

	public function create()
	{
		$sqlUtils = new SQLUtils(Model::getInstance());

		$params = [
			"day" => $this->$day,
			"project_id" => $this->$project_id,
			"creator_id" => $this->$creator_id,
			"content" => $this->$content,
			"creation_date" => $this->$creation_date,
		];

		return $sqlUtils->insert($params);
	}

	public function update()
	{
		$sqlUtils = new SQLUtils(Model::getInstance());

		$toModify = [
			"creator_id" => $this->$creator_id,
			"content" => $this->$content,
			"creation_date" => $this->$creation_date,
		];

		$identificationParams = [
			"day" => $this->$day,
			"project_id" => $this->$project_id,
		];

		return $sqlUtils->update($this->$table, $toModify, $identificationParams);
	}

	public function delete()
	{
		$sqlUtils = new SQLUtils(Model::getInstance());

		$params = [
			"day" => $this->$day,
			"project_id" => $this->$project_id,
		];

		return $sqlUtils->delete($this->$table, $params);
	}

	public function query()
	{
		$sqlUtils = new SQLUtils(Model::getInstance());

		$params = [
			"day" => $this->$day,
			"project_id" => $this->$project_id,
		];

		return $sqlUtils->query($this->$table, $params);
	}


	public function fill()
	{
		$this->$day = Utils::getCleanedData("day");
		$this->$project_id = Utils::getCleanedData("projectId");
		$this->$creator_id = Utils::getCleanedData("creatorId");
		$this->$content = Utils::getCleanedData("content");
		$this->$creation_date = Utils::getCleanedData("creationDate");
	}


	public function fill()
	{
		return json_encode([
			"day" => $this->$day,
			"projectId" => $this->$project_id,
			"creatorId" => $this->$creator_id,
			"content" => $this->$content,
			"creationDate" => $this->$creation_date,
		]);
	}
} 


