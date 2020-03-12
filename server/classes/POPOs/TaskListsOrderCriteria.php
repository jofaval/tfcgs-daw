<?php

class TaskListsOrderCriteria implements CRUD 
{
	private $table = "task_lists_order_criteria";

	//Primary Keys
	private $id;

	//Table Keys
	private $title;

	//Foreign Keys

	public function create()
	{
		$sqlUtils = new SQLUtils(Model::getInstance());

		$params = [
			"id" => $this->$id,
			"title" => $this->$title,
		];

		return $sqlUtils->insert($params);
	}

	public function update()
	{
		$sqlUtils = new SQLUtils(Model::getInstance());

		$toModify = [
			"title" => $this->$title,
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
	}


	public function fill()
	{
		return json_encode([
			"id" => $this->$id,
			"title" => $this->$title,
		]);
	}
} 


