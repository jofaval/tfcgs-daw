<?php

/* class Task implements CRUD
{
private $table = "task_list_item_lists";
//Main
private $task_id; //id
private $title;
private $description;
private $creation_date;

//Foreign keys
private $creator_id;
private $task_list_id;
private $order_criteria;

public function __construct()
{
$this->fill();
}

public function create()
{
$sqlUtils = new SQLUtils(Model::getInstance());

$params = [
"title" => $this->$title,
"description" => $this->$description,
"creation_date" => $this->$creation_date,
"creator_id" => $this->$creator_id,
"task_list_id" => $this->$task_list_id,
"order_criteria" => $this->$order_criteria,
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
"taskId" => $this->$task_id,
];

return $sqlUtils->update($this->$table, $toModify, $identificationParams);
}

public function delete()
{
$sqlUtils = new SQLUtils(Model::getInstance());

$params = [
"taskId" => $this->$task_id,
];

return $sqlUtils->delete($this->$table, $params);
}

public function query()
{
$sqlUtils = new SQLUtils(Model::getInstance());

$params = [
"taskId" => $this->$task_id,
];

return $sqlUtils->query($this->$table, $params);
}

public function fill()
{
$this->$task_id = Utils::getCleanedData("taskId");
$this->$title = Utils::getCleanedData("title");
$this->$description = Utils::getCleanedData("description");
$this->$creation_date = Utils::getCleanedData("creationDate");

$this->$creator_id = Utils::getCleanedData("creatorId");
$this->$task_list_id = Utils::getCleanedData("taskListId");
$this->$order_criteria = Utils::getCleanedData("orderCriteria");
}

public function parse()
{
return json_encode([
"taskId" => $this->$task_id,
"title" => $this->$title,
"description" => $this->$description,
"creationDate" => $this->$creation_date,
"creatorId" => $this->$creator_id,
"taskListId" => $this->$task_list_id,
"orderCriteria" => $this->$order_criteria,
]);
}
} */