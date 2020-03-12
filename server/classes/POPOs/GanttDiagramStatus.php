<?php

class GanttDiagramStatus implements CRUD 
{
	private $table = "gantt_diagram_status";

	//Primary Keys
	private $id;

	//Table Keys
	private $title;
	private $description;

	//Foreign Keys

	public function create()
	{
		$sqlUtils = new SQLUtils(Model::getInstance());

		$params = [
			"id" => $this->$id,
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
		$this->$title = Utils::getCleanedData("title");
		$this->$description = Utils::getCleanedData("description");
	}


	public function parse()
	{
		return json_encode([
			"id" => $this->$id,
			"title" => $this->$title,
			"description" => $this->$description,
		]);
	}
} 


