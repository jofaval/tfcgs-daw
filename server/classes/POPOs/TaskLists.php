<?php

class TaskLists
 implements CRUD {
	private $table = "task_lists";
        
	//Primary Keys
	private $id;

	//Table Keys
	private $project_id;
	private $creator_id;
	private $title;
	private $creation_date;

	//Foreign Keys
	private $project_parent_task FOREIGN KEY (project_id) REFERENCES projects (id;
	private $task_creator FOREIGN KEY (creator_id) REFERENCES users (id;


        public function create()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"id" => $this->$id,
		"project_id" => $this->$project_id,
		"creator_id" => $this->$creator_id,
		"title" => $this->$title,
		"creation_date" => $this->$creation_date,
		"project_parent_task FOREIGN KEY (project_id) REFERENCES projects (id" => $this->$project_parent_task FOREIGN KEY (project_id) REFERENCES projects (id,
		"task_creator FOREIGN KEY (creator_id) REFERENCES users (id" => $this->$task_creator FOREIGN KEY (creator_id) REFERENCES users (id,
            ];

            return $sqlUtils->insert($params);
        }

        public function update()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $toModify = [
		"project_id" => $this->$project_id,
		"creator_id" => $this->$creator_id,
		"title" => $this->$title,
		"creation_date" => $this->$creation_date,
		"project_parent_task FOREIGN KEY (project_id) REFERENCES projects (id" => $this->$project_parent_task FOREIGN KEY (project_id) REFERENCES projects (id,
		"task_creator FOREIGN KEY (creator_id) REFERENCES users (id" => $this->$task_creator FOREIGN KEY (creator_id) REFERENCES users (id,
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
		$this->$project_id = Utils::getCleanedData("projectId");
		$this->$creator_id = Utils::getCleanedData("creatorId");
		$this->$title = Utils::getCleanedData("title");
		$this->$creation_date = Utils::getCleanedData("creationDate");
		$this->$project_parent_task FOREIGN KEY (project_id) REFERENCES projects (id = Utils::getCleanedData("projectParentTaskForeignKey(projectId)ReferencesProjects(id");
		$this->$task_creator FOREIGN KEY (creator_id) REFERENCES users (id = Utils::getCleanedData("taskCreatorForeignKey(creatorId)ReferencesUsers(id");
        }

        public function parse()
        {
            return json_encode([
		"projectId" => $this->$project_id,
		"creatorId" => $this->$creator_id,
		"title" => $this->$title,
		"creationDate" => $this->$creation_date,
		"projectParentTaskForeignKey(projectId)ReferencesProjects(id" => $this->$project_parent_task FOREIGN KEY (project_id) REFERENCES projects (id,
		"taskCreatorForeignKey(creatorId)ReferencesUsers(id" => $this->$task_creator FOREIGN KEY (creator_id) REFERENCES users (id,
            ]);
        }
} 


