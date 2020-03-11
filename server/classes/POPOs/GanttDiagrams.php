<?php

class GanttDiagrams
 implements CRUD {
	private $table = "gantt_diagrams";
        
	//Primary Keys
	private $id;

	//Table Keys
	private $project_id;
	private $creator_id;
	private $title;
	private $creation_date;

	//Foreign Keys
	private $gantt_diagram_creator FOREIGN KEY (creator_id) REFERENCES users (id;
	private $project_parent_gantt FOREIGN KEY (project_id) REFERENCES projects (id;


        public function create()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"id" => $this->$id,
		"project_id" => $this->$project_id,
		"creator_id" => $this->$creator_id,
		"title" => $this->$title,
		"creation_date" => $this->$creation_date,
		"gantt_diagram_creator FOREIGN KEY (creator_id) REFERENCES users (id" => $this->$gantt_diagram_creator FOREIGN KEY (creator_id) REFERENCES users (id,
		"project_parent_gantt FOREIGN KEY (project_id) REFERENCES projects (id" => $this->$project_parent_gantt FOREIGN KEY (project_id) REFERENCES projects (id,
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
		"gantt_diagram_creator FOREIGN KEY (creator_id) REFERENCES users (id" => $this->$gantt_diagram_creator FOREIGN KEY (creator_id) REFERENCES users (id,
		"project_parent_gantt FOREIGN KEY (project_id) REFERENCES projects (id" => $this->$project_parent_gantt FOREIGN KEY (project_id) REFERENCES projects (id,
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
		$this->$gantt_diagram_creator FOREIGN KEY (creator_id) REFERENCES users (id = Utils::getCleanedData("ganttDiagramCreatorForeignKey(creatorId)ReferencesUsers(id");
		$this->$project_parent_gantt FOREIGN KEY (project_id) REFERENCES projects (id = Utils::getCleanedData("projectParentGanttForeignKey(projectId)ReferencesProjects(id");
        }

        public function parse()
        {
            return json_encode([
		"projectId" => $this->$project_id,
		"creatorId" => $this->$creator_id,
		"title" => $this->$title,
		"creationDate" => $this->$creation_date,
		"ganttDiagramCreatorForeignKey(creatorId)ReferencesUsers(id" => $this->$gantt_diagram_creator FOREIGN KEY (creator_id) REFERENCES users (id,
		"projectParentGanttForeignKey(projectId)ReferencesProjects(id" => $this->$project_parent_gantt FOREIGN KEY (project_id) REFERENCES projects (id,
            ]);
        }
} 


