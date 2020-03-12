<?php

class GanttDiagramGroupTasks implements CRUD 
{
	private $table = "gantt_diagram_group_tasks";

	//Primary Keys
	private $id;

	//Table Keys
	private $gantt_diagram_group_id;
	private $creator_id;
	private $title;
	private $creation_date;
	private $start_date;
	private $end_date;

	//Foreign Keys
	private $status;

	public function create()
	{
		$sqlUtils = new SQLUtils(Model::getInstance());

		$params = [
			"id" => $this->$id,
			"gantt_diagram_group_id" => $this->$gantt_diagram_group_id,
			"creator_id" => $this->$creator_id,
			"title" => $this->$title,
			"creation_date" => $this->$creation_date,
			"start_date" => $this->$start_date,
			"end_date" => $this->$end_date,
			"status" => $this->$status,
		];

		return $sqlUtils->insert($params);
	}

	public function update()
	{
		$sqlUtils = new SQLUtils(Model::getInstance());

		$toModify = [
			"gantt_diagram_group_id" => $this->$gantt_diagram_group_id,
			"creator_id" => $this->$creator_id,
			"title" => $this->$title,
			"creation_date" => $this->$creation_date,
			"start_date" => $this->$start_date,
			"end_date" => $this->$end_date,
			"status" => $this->$status,
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
		$this->$gantt_diagram_group_id = Utils::getCleanedData("ganttDiagramGroupId");
		$this->$creator_id = Utils::getCleanedData("creatorId");
		$this->$title = Utils::getCleanedData("title");
		$this->$creation_date = Utils::getCleanedData("creationDate");
		$this->$start_date = Utils::getCleanedData("startDate");
		$this->$end_date = Utils::getCleanedData("endDate");
		$this->$status = Utils::getCleanedData("status");
	}


	public function fill()
	{
		return json_encode([
			"id" => $this->$id,
			"ganttDiagramGroupId" => $this->$gantt_diagram_group_id,
			"creatorId" => $this->$creator_id,
			"title" => $this->$title,
			"creationDate" => $this->$creation_date,
			"startDate" => $this->$start_date,
			"endDate" => $this->$end_date,
			"status" => $this->$status,
		]);
	}
} 


