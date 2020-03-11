<?php

class GanttDiagramGroups
 implements CRUD {
	private $table = "gantt_diagram_groups";
        
	//Primary Keys
	private $id;

	//Table Keys
	private $gantt_diagram_id;
	private $creator_id;
	private $title;
	private $creation_date;

	//Foreign Keys
	private $gantt_diagram_group_creator FOREIGN KEY (creator_id) REFERENCES users (id;
	private $gantt_diagram_group_parent FOREIGN KEY (gantt_diagram_id) REFERENCES gantt_diagrams (id;


        public function create()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"id" => $this->$id,
		"gantt_diagram_id" => $this->$gantt_diagram_id,
		"creator_id" => $this->$creator_id,
		"title" => $this->$title,
		"creation_date" => $this->$creation_date,
		"gantt_diagram_group_creator FOREIGN KEY (creator_id) REFERENCES users (id" => $this->$gantt_diagram_group_creator FOREIGN KEY (creator_id) REFERENCES users (id,
		"gantt_diagram_group_parent FOREIGN KEY (gantt_diagram_id) REFERENCES gantt_diagrams (id" => $this->$gantt_diagram_group_parent FOREIGN KEY (gantt_diagram_id) REFERENCES gantt_diagrams (id,
            ];

            return $sqlUtils->insert($params);
        }

        public function update()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $toModify = [
		"gantt_diagram_id" => $this->$gantt_diagram_id,
		"creator_id" => $this->$creator_id,
		"title" => $this->$title,
		"creation_date" => $this->$creation_date,
		"gantt_diagram_group_creator FOREIGN KEY (creator_id) REFERENCES users (id" => $this->$gantt_diagram_group_creator FOREIGN KEY (creator_id) REFERENCES users (id,
		"gantt_diagram_group_parent FOREIGN KEY (gantt_diagram_id) REFERENCES gantt_diagrams (id" => $this->$gantt_diagram_group_parent FOREIGN KEY (gantt_diagram_id) REFERENCES gantt_diagrams (id,
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
		$this->$gantt_diagram_id = Utils::getCleanedData("ganttDiagramId");
		$this->$creator_id = Utils::getCleanedData("creatorId");
		$this->$title = Utils::getCleanedData("title");
		$this->$creation_date = Utils::getCleanedData("creationDate");
		$this->$gantt_diagram_group_creator FOREIGN KEY (creator_id) REFERENCES users (id = Utils::getCleanedData("ganttDiagramGroupCreatorForeignKey(creatorId)ReferencesUsers(id");
		$this->$gantt_diagram_group_parent FOREIGN KEY (gantt_diagram_id) REFERENCES gantt_diagrams (id = Utils::getCleanedData("ganttDiagramGroupParentForeignKey(ganttDiagramId)ReferencesGanttDiagrams(id");
        }

        public function parse()
        {
            return json_encode([
		"ganttDiagramId" => $this->$gantt_diagram_id,
		"creatorId" => $this->$creator_id,
		"title" => $this->$title,
		"creationDate" => $this->$creation_date,
		"ganttDiagramGroupCreatorForeignKey(creatorId)ReferencesUsers(id" => $this->$gantt_diagram_group_creator FOREIGN KEY (creator_id) REFERENCES users (id,
		"ganttDiagramGroupParentForeignKey(ganttDiagramId)ReferencesGanttDiagrams(id" => $this->$gantt_diagram_group_parent FOREIGN KEY (gantt_diagram_id) REFERENCES gantt_diagrams (id,
            ]);
        }
} 


