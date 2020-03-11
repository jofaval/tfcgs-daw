<?php

class TaskListItemListItems
 implements CRUD {
	private $table = "task_list_item_list_items";
        
	//Primary Keys
	private $id;

	//Table Keys
	private $task_item_list_id;
	private $creator_id;
	private $title;
	private $order;
	private $description;
	private $creation_date;

	//Foreign Keys
	private $task_item_list_parent FOREIGN KEY (task_item_list_id) REFERENCES task_list_item_lists (id;
	private $task_list_item_creator FOREIGN KEY (creator_id) REFERENCES users (id;


        public function create()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"id" => $this->$id,
		"task_item_list_id" => $this->$task_item_list_id,
		"creator_id" => $this->$creator_id,
		"title" => $this->$title,
		"order" => $this->$order,
		"description" => $this->$description,
		"creation_date" => $this->$creation_date,
		"task_item_list_parent FOREIGN KEY (task_item_list_id) REFERENCES task_list_item_lists (id" => $this->$task_item_list_parent FOREIGN KEY (task_item_list_id) REFERENCES task_list_item_lists (id,
		"task_list_item_creator FOREIGN KEY (creator_id) REFERENCES users (id" => $this->$task_list_item_creator FOREIGN KEY (creator_id) REFERENCES users (id,
            ];

            return $sqlUtils->insert($params);
        }

        public function update()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $toModify = [
		"task_item_list_id" => $this->$task_item_list_id,
		"creator_id" => $this->$creator_id,
		"title" => $this->$title,
		"order" => $this->$order,
		"description" => $this->$description,
		"creation_date" => $this->$creation_date,
		"task_item_list_parent FOREIGN KEY (task_item_list_id) REFERENCES task_list_item_lists (id" => $this->$task_item_list_parent FOREIGN KEY (task_item_list_id) REFERENCES task_list_item_lists (id,
		"task_list_item_creator FOREIGN KEY (creator_id) REFERENCES users (id" => $this->$task_list_item_creator FOREIGN KEY (creator_id) REFERENCES users (id,
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
		$this->$task_item_list_id = Utils::getCleanedData("taskItemListId");
		$this->$creator_id = Utils::getCleanedData("creatorId");
		$this->$title = Utils::getCleanedData("title");
		$this->$order = Utils::getCleanedData("order");
		$this->$description = Utils::getCleanedData("description");
		$this->$creation_date = Utils::getCleanedData("creationDate");
		$this->$task_item_list_parent FOREIGN KEY (task_item_list_id) REFERENCES task_list_item_lists (id = Utils::getCleanedData("taskItemListParentForeignKey(taskItemListId)ReferencesTaskListItemLists(id");
		$this->$task_list_item_creator FOREIGN KEY (creator_id) REFERENCES users (id = Utils::getCleanedData("taskListItemCreatorForeignKey(creatorId)ReferencesUsers(id");
        }

        public function parse()
        {
            return json_encode([
		"taskItemListId" => $this->$task_item_list_id,
		"creatorId" => $this->$creator_id,
		"title" => $this->$title,
		"order" => $this->$order,
		"description" => $this->$description,
		"creationDate" => $this->$creation_date,
		"taskItemListParentForeignKey(taskItemListId)ReferencesTaskListItemLists(id" => $this->$task_item_list_parent FOREIGN KEY (task_item_list_id) REFERENCES task_list_item_lists (id,
		"taskListItemCreatorForeignKey(creatorId)ReferencesUsers(id" => $this->$task_list_item_creator FOREIGN KEY (creator_id) REFERENCES users (id,
            ]);
        }
} 


