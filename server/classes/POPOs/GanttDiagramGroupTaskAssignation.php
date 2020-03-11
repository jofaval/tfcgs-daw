<?php

class GanttDiagramGroupTaskAssignation
 implements CRUD {
	private $table = "gantt_diagram_group_task_assignation";
        
	//Primary Keys
	private $gantt_diagram_group_task_id,assigned_user_id,assignation_date;

	//Table Keys
	private $gantt_diagram_group_task_id;
	private $assigned_user_id;
	private $assignation_date;

	//Foreign Keys
	private $gantt_diagram_group_task_assigned FOREIGN KEY (gantt_diagram_group_task_id) REFERENCES gantt_diagram_group_tasks (id;
	private $gantt_diagram_group_task_assigned_to FOREIGN KEY (assigned_user_id) REFERENCES users (id;


        public function create()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"gantt_diagram_group_task_id,assigned_user_id,assignation_date" => $this->$gantt_diagram_group_task_id,assigned_user_id,assignation_date,
		"gantt_diagram_group_task_id" => $this->$gantt_diagram_group_task_id,
		"assigned_user_id" => $this->$assigned_user_id,
		"assignation_date" => $this->$assignation_date,
		"gantt_diagram_group_task_assigned FOREIGN KEY (gantt_diagram_group_task_id) REFERENCES gantt_diagram_group_tasks (id" => $this->$gantt_diagram_group_task_assigned FOREIGN KEY (gantt_diagram_group_task_id) REFERENCES gantt_diagram_group_tasks (id,
		"gantt_diagram_group_task_assigned_to FOREIGN KEY (assigned_user_id) REFERENCES users (id" => $this->$gantt_diagram_group_task_assigned_to FOREIGN KEY (assigned_user_id) REFERENCES users (id,
            ];

            return $sqlUtils->insert($params);
        }

        public function update()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $toModify = [
		"gantt_diagram_group_task_id" => $this->$gantt_diagram_group_task_id,
		"assigned_user_id" => $this->$assigned_user_id,
		"assignation_date" => $this->$assignation_date,
		"gantt_diagram_group_task_assigned FOREIGN KEY (gantt_diagram_group_task_id) REFERENCES gantt_diagram_group_tasks (id" => $this->$gantt_diagram_group_task_assigned FOREIGN KEY (gantt_diagram_group_task_id) REFERENCES gantt_diagram_group_tasks (id,
		"gantt_diagram_group_task_assigned_to FOREIGN KEY (assigned_user_id) REFERENCES users (id" => $this->$gantt_diagram_group_task_assigned_to FOREIGN KEY (assigned_user_id) REFERENCES users (id,
            ];

            $identificationParams = [
		"gantt_diagram_group_task_id,assigned_user_id,assignation_date" => $this->$gantt_diagram_group_task_id,assigned_user_id,assignation_date,
            ];

            return $sqlUtils->update($this->$table, $toModify, $identificationParams);
        }

        public function delete()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"gantt_diagram_group_task_id,assigned_user_id,assignation_date" => $this->$gantt_diagram_group_task_id,assigned_user_id,assignation_date,
            ];

            return $sqlUtils->delete($this->$table, $params);
        }

        public function query()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"gantt_diagram_group_task_id,assigned_user_id,assignation_date" => $this->$gantt_diagram_group_task_id,assigned_user_id,assignation_date,
            ];

            return $sqlUtils->query($this->$table, $params);
        }

        public function fill()
        {
		$this->$gantt_diagram_group_task_id,assigned_user_id,assignation_date = Utils::getCleanedData("ganttDiagramGroupTaskId,assignedUserId,assignationDate");
		$this->$gantt_diagram_group_task_id = Utils::getCleanedData("ganttDiagramGroupTaskId");
		$this->$assigned_user_id = Utils::getCleanedData("assignedUserId");
		$this->$assignation_date = Utils::getCleanedData("assignationDate");
		$this->$gantt_diagram_group_task_assigned FOREIGN KEY (gantt_diagram_group_task_id) REFERENCES gantt_diagram_group_tasks (id = Utils::getCleanedData("ganttDiagramGroupTaskAssignedForeignKey(ganttDiagramGroupTaskId)ReferencesGanttDiagramGroupTasks(id");
		$this->$gantt_diagram_group_task_assigned_to FOREIGN KEY (assigned_user_id) REFERENCES users (id = Utils::getCleanedData("ganttDiagramGroupTaskAssignedToForeignKey(assignedUserId)ReferencesUsers(id");
        }

        public function parse()
        {
            return json_encode([
		"ganttDiagramGroupTaskId" => $this->$gantt_diagram_group_task_id,
		"assignedUserId" => $this->$assigned_user_id,
		"assignationDate" => $this->$assignation_date,
		"ganttDiagramGroupTaskAssignedForeignKey(ganttDiagramGroupTaskId)ReferencesGanttDiagramGroupTasks(id" => $this->$gantt_diagram_group_task_assigned FOREIGN KEY (gantt_diagram_group_task_id) REFERENCES gantt_diagram_group_tasks (id,
		"ganttDiagramGroupTaskAssignedToForeignKey(assignedUserId)ReferencesUsers(id" => $this->$gantt_diagram_group_task_assigned_to FOREIGN KEY (assigned_user_id) REFERENCES users (id,
            ]);
        }
} 


