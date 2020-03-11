<?php

class ProjectDiary
 implements CRUD {
	private $table = "project_diary";
        
	//Primary Keys
	private $day,project_id;

	//Table Keys
	private $day;
	private $project_id;
	private $creator_id;
	private $content;
	private $creation_date;

	//Foreign Keys
	private $diary_creator FOREIGN KEY (creator_id) REFERENCES users (id;
	private $diary_project_parent FOREIGN KEY (project_id) REFERENCES projects (id;


        public function create()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"day,project_id" => $this->$day,project_id,
		"day" => $this->$day,
		"project_id" => $this->$project_id,
		"creator_id" => $this->$creator_id,
		"content" => $this->$content,
		"creation_date" => $this->$creation_date,
		"diary_creator FOREIGN KEY (creator_id) REFERENCES users (id" => $this->$diary_creator FOREIGN KEY (creator_id) REFERENCES users (id,
		"diary_project_parent FOREIGN KEY (project_id) REFERENCES projects (id" => $this->$diary_project_parent FOREIGN KEY (project_id) REFERENCES projects (id,
            ];

            return $sqlUtils->insert($params);
        }

        public function update()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $toModify = [
		"day" => $this->$day,
		"project_id" => $this->$project_id,
		"creator_id" => $this->$creator_id,
		"content" => $this->$content,
		"creation_date" => $this->$creation_date,
		"diary_creator FOREIGN KEY (creator_id) REFERENCES users (id" => $this->$diary_creator FOREIGN KEY (creator_id) REFERENCES users (id,
		"diary_project_parent FOREIGN KEY (project_id) REFERENCES projects (id" => $this->$diary_project_parent FOREIGN KEY (project_id) REFERENCES projects (id,
            ];

            $identificationParams = [
		"day,project_id" => $this->$day,project_id,
            ];

            return $sqlUtils->update($this->$table, $toModify, $identificationParams);
        }

        public function delete()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"day,project_id" => $this->$day,project_id,
            ];

            return $sqlUtils->delete($this->$table, $params);
        }

        public function query()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"day,project_id" => $this->$day,project_id,
            ];

            return $sqlUtils->query($this->$table, $params);
        }

        public function fill()
        {
		$this->$day,project_id = Utils::getCleanedData("day,projectId");
		$this->$day = Utils::getCleanedData("day");
		$this->$project_id = Utils::getCleanedData("projectId");
		$this->$creator_id = Utils::getCleanedData("creatorId");
		$this->$content = Utils::getCleanedData("content");
		$this->$creation_date = Utils::getCleanedData("creationDate");
		$this->$diary_creator FOREIGN KEY (creator_id) REFERENCES users (id = Utils::getCleanedData("diaryCreatorForeignKey(creatorId)ReferencesUsers(id");
		$this->$diary_project_parent FOREIGN KEY (project_id) REFERENCES projects (id = Utils::getCleanedData("diaryProjectParentForeignKey(projectId)ReferencesProjects(id");
        }

        public function parse()
        {
            return json_encode([
		"day" => $this->$day,
		"projectId" => $this->$project_id,
		"creatorId" => $this->$creator_id,
		"content" => $this->$content,
		"creationDate" => $this->$creation_date,
		"diaryCreatorForeignKey(creatorId)ReferencesUsers(id" => $this->$diary_creator FOREIGN KEY (creator_id) REFERENCES users (id,
		"diaryProjectParentForeignKey(projectId)ReferencesProjects(id" => $this->$diary_project_parent FOREIGN KEY (project_id) REFERENCES projects (id,
            ]);
        }
} 


