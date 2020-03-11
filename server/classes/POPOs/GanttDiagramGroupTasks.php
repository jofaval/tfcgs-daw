<?php

class GanttDiagramGroupTasks
 implements CRUD {
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
	private $status;

	//Foreign Keys
	private $gantt_diagram_group_task_creator FOREIGN KEY (creator_id) REFERENCES users (id;
	private $gantt_diagram_group_task_parent FOREIGN KEY (gantt_diagram_group_id) REFERENCES gantt_diagram_groups (id;
	private $gantt_diagram_group_task_status FOREIGN KEY (status) REFERENCES gantt_diagram_status (id;


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
		"gantt_diagram_group_task_creator FOREIGN KEY (creator_id) REFERENCES users (id" => $this->$gantt_diagram_group_task_creator FOREIGN KEY (creator_id) REFERENCES users (id,
		"gantt_diagram_group_task_parent FOREIGN KEY (gantt_diagram_group_id) REFERENCES gantt_diagram_groups (id" => $this->$gantt_diagram_group_task_parent FOREIGN KEY (gantt_diagram_group_id) REFERENCES gantt_diagram_groups (id,
		"gantt_diagram_group_task_status FOREIGN KEY (status) REFERENCES gantt_diagram_status (id" => $this->$gantt_diagram_group_task_status FOREIGN KEY (status) REFERENCES gantt_diagram_status (id,
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
		"gantt_diagram_group_task_creator FOREIGN KEY (creator_id) REFERENCES users (id" => $this->$gantt_diagram_group_task_creator FOREIGN KEY (creator_id) REFERENCES users (id,
		"gantt_diagram_group_task_parent FOREIGN KEY (gantt_diagram_group_id) REFERENCES gantt_diagram_groups (id" => $this->$gantt_diagram_group_task_parent FOREIGN KEY (gantt_diagram_group_id) REFERENCES gantt_diagram_groups (id,
		"gantt_diagram_group_task_status FOREIGN KEY (status) REFERENCES gantt_diagram_status (id" => $this->$gantt_diagram_group_task_status FOREIGN KEY (status) REFERENCES gantt_diagram_status (id,
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
		$this->$gantt_diagram_group_task_creator FOREIGN KEY (creator_id) REFERENCES users (id = Utils::getCleanedData("ganttDiagramGroupTaskCreatorForeignKey(creatorId)ReferencesUsers(id");
		$this->$gantt_diagram_group_task_parent FOREIGN KEY (gantt_diagram_group_id) REFERENCES gantt_diagram_groups (id = Utils::getCleanedData("ganttDiagramGroupTaskParentForeignKey(ganttDiagramGroupId)ReferencesGanttDiagramGroups(id");
		$this->$gantt_diagram_group_task_status FOREIGN KEY (status) REFERENCES gantt_diagram_status (id = Utils::getCleanedData("ganttDiagramGroupTaskStatusForeignKey(status)ReferencesGanttDiagramStatus(id");
        }

        public function parse()
        {
            return json_encode([
		"ganttDiagramGroupId" => $this->$gantt_diagram_group_id,
		"creatorId" => $this->$creator_id,
		"title" => $this->$title,
		"creationDate" => $this->$creation_date,
		"startDate" => $this->$start_date,
		"endDate" => $this->$end_date,
		"status" => $this->$status,
		"ganttDiagramGroupTaskCreatorForeignKey(creatorId)ReferencesUsers(id" => $this->$gantt_diagram_group_task_creator FOREIGN KEY (creator_id) REFERENCES users (id,
		"ganttDiagramGroupTaskParentForeignKey(ganttDiagramGroupId)ReferencesGanttDiagramGroups(id" => $this->$gantt_diagram_group_task_parent FOREIGN KEY (gantt_diagram_group_id) REFERENCES gantt_diagram_groups (id,
		"ganttDiagramGroupTaskStatusForeignKey(status)ReferencesGanttDiagramStatus(id" => $this->$gantt_diagram_group_task_status FOREIGN KEY (status) REFERENCES gantt_diagram_status (id,
            ]);
        }
} 


