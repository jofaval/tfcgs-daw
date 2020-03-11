<?php

class TaskListItemLists
 implements CRUD {
	private $table = "task_list_item_lists";
        
	//Primary Keys
	private $id;

	//Table Keys
	private $task_list_id;
	private $creator_id;
	private $title;
	private $description;
	private $creation_date;
	private $order_criteria;

	//Foreign Keys
	private $task_list_creator FOREIGN KEY (creator_id) REFERENCES users (id;
	private $task_list_parent FOREIGN KEY (task_list_id) REFERENCES task_lists (id;
	private $task_lists_order_criteria FOREIGN KEY (order_criteria) REFERENCES task_lists_order_criteria (id;


        public function create()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"id" => $this->$id,
		"task_list_id" => $this->$task_list_id,
		"creator_id" => $this->$creator_id,
		"title" => $this->$title,
		"description" => $this->$description,
		"creation_date" => $this->$creation_date,
		"order_criteria" => $this->$order_criteria,
		"task_list_creator FOREIGN KEY (creator_id) REFERENCES users (id" => $this->$task_list_creator FOREIGN KEY (creator_id) REFERENCES users (id,
		"task_list_parent FOREIGN KEY (task_list_id) REFERENCES task_lists (id" => $this->$task_list_parent FOREIGN KEY (task_list_id) REFERENCES task_lists (id,
		"task_lists_order_criteria FOREIGN KEY (order_criteria) REFERENCES task_lists_order_criteria (id" => $this->$task_lists_order_criteria FOREIGN KEY (order_criteria) REFERENCES task_lists_order_criteria (id,
            ];

            return $sqlUtils->insert($params);
        }

        public function update()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $toModify = [
		"task_list_id" => $this->$task_list_id,
		"creator_id" => $this->$creator_id,
		"title" => $this->$title,
		"description" => $this->$description,
		"creation_date" => $this->$creation_date,
		"order_criteria" => $this->$order_criteria,
		"task_list_creator FOREIGN KEY (creator_id) REFERENCES users (id" => $this->$task_list_creator FOREIGN KEY (creator_id) REFERENCES users (id,
		"task_list_parent FOREIGN KEY (task_list_id) REFERENCES task_lists (id" => $this->$task_list_parent FOREIGN KEY (task_list_id) REFERENCES task_lists (id,
		"task_lists_order_criteria FOREIGN KEY (order_criteria) REFERENCES task_lists_order_criteria (id" => $this->$task_lists_order_criteria FOREIGN KEY (order_criteria) REFERENCES task_lists_order_criteria (id,
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
		$this->$task_list_id = Utils::getCleanedData("taskListId");
		$this->$creator_id = Utils::getCleanedData("creatorId");
		$this->$title = Utils::getCleanedData("title");
		$this->$description = Utils::getCleanedData("description");
		$this->$creation_date = Utils::getCleanedData("creationDate");
		$this->$order_criteria = Utils::getCleanedData("orderCriteria");
		$this->$task_list_creator FOREIGN KEY (creator_id) REFERENCES users (id = Utils::getCleanedData("taskListCreatorForeignKey(creatorId)ReferencesUsers(id");
		$this->$task_list_parent FOREIGN KEY (task_list_id) REFERENCES task_lists (id = Utils::getCleanedData("taskListParentForeignKey(taskListId)ReferencesTaskLists(id");
		$this->$task_lists_order_criteria FOREIGN KEY (order_criteria) REFERENCES task_lists_order_criteria (id = Utils::getCleanedData("taskListsOrderCriteriaForeignKey(orderCriteria)ReferencesTaskListsOrderCriteria(id");
        }

        public function parse()
        {
            return json_encode([
		"taskListId" => $this->$task_list_id,
		"creatorId" => $this->$creator_id,
		"title" => $this->$title,
		"description" => $this->$description,
		"creationDate" => $this->$creation_date,
		"orderCriteria" => $this->$order_criteria,
		"taskListCreatorForeignKey(creatorId)ReferencesUsers(id" => $this->$task_list_creator FOREIGN KEY (creator_id) REFERENCES users (id,
		"taskListParentForeignKey(taskListId)ReferencesTaskLists(id" => $this->$task_list_parent FOREIGN KEY (task_list_id) REFERENCES task_lists (id,
		"taskListsOrderCriteriaForeignKey(orderCriteria)ReferencesTaskListsOrderCriteria(id" => $this->$task_lists_order_criteria FOREIGN KEY (order_criteria) REFERENCES task_lists_order_criteria (id,
            ]);
        }
} 


