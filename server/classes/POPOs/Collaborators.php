<?php

class Collaborators
 implements CRUD {
	private $table = "collaborators";
        
	//Primary Keys
	private $project_id,collaborator_id,starting_date;

	//Table Keys
	private $project_id;
	private $collaborator_id;
	private $starting_date;
	private $level;

	//Foreign Keys
	private $project_collaborator FOREIGN KEY (collaborator_id) REFERENCES users (id;
	private $project_information FOREIGN KEY (project_id) REFERENCES projects (id;
	private $project_permission FOREIGN KEY (level) REFERENCES permissions (level;


        public function create()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"project_id,collaborator_id,starting_date" => $this->$project_id,collaborator_id,starting_date,
		"project_id" => $this->$project_id,
		"collaborator_id" => $this->$collaborator_id,
		"starting_date" => $this->$starting_date,
		"level" => $this->$level,
		"project_collaborator FOREIGN KEY (collaborator_id) REFERENCES users (id" => $this->$project_collaborator FOREIGN KEY (collaborator_id) REFERENCES users (id,
		"project_information FOREIGN KEY (project_id) REFERENCES projects (id" => $this->$project_information FOREIGN KEY (project_id) REFERENCES projects (id,
		"project_permission FOREIGN KEY (level) REFERENCES permissions (level" => $this->$project_permission FOREIGN KEY (level) REFERENCES permissions (level,
            ];

            return $sqlUtils->insert($params);
        }

        public function update()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $toModify = [
		"project_id" => $this->$project_id,
		"collaborator_id" => $this->$collaborator_id,
		"starting_date" => $this->$starting_date,
		"level" => $this->$level,
		"project_collaborator FOREIGN KEY (collaborator_id) REFERENCES users (id" => $this->$project_collaborator FOREIGN KEY (collaborator_id) REFERENCES users (id,
		"project_information FOREIGN KEY (project_id) REFERENCES projects (id" => $this->$project_information FOREIGN KEY (project_id) REFERENCES projects (id,
		"project_permission FOREIGN KEY (level) REFERENCES permissions (level" => $this->$project_permission FOREIGN KEY (level) REFERENCES permissions (level,
            ];

            $identificationParams = [
		"project_id,collaborator_id,starting_date" => $this->$project_id,collaborator_id,starting_date,
            ];

            return $sqlUtils->update($this->$table, $toModify, $identificationParams);
        }

        public function delete()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"project_id,collaborator_id,starting_date" => $this->$project_id,collaborator_id,starting_date,
            ];

            return $sqlUtils->delete($this->$table, $params);
        }

        public function query()
        {
            $sqlUtils = new SQLUtils(Model::getInstance());

            $params = [
		"project_id,collaborator_id,starting_date" => $this->$project_id,collaborator_id,starting_date,
            ];

            return $sqlUtils->query($this->$table, $params);
        }

        public function fill()
        {
		$this->$project_id,collaborator_id,starting_date = Utils::getCleanedData("projectId,collaboratorId,startingDate");
		$this->$project_id = Utils::getCleanedData("projectId");
		$this->$collaborator_id = Utils::getCleanedData("collaboratorId");
		$this->$starting_date = Utils::getCleanedData("startingDate");
		$this->$level = Utils::getCleanedData("level");
		$this->$project_collaborator FOREIGN KEY (collaborator_id) REFERENCES users (id = Utils::getCleanedData("projectCollaboratorForeignKey(collaboratorId)ReferencesUsers(id");
		$this->$project_information FOREIGN KEY (project_id) REFERENCES projects (id = Utils::getCleanedData("projectInformationForeignKey(projectId)ReferencesProjects(id");
		$this->$project_permission FOREIGN KEY (level) REFERENCES permissions (level = Utils::getCleanedData("projectPermissionForeignKey(level)ReferencesPermissions(level");
        }

        public function parse()
        {
            return json_encode([
		"projectId" => $this->$project_id,
		"collaboratorId" => $this->$collaborator_id,
		"startingDate" => $this->$starting_date,
		"level" => $this->$level,
		"projectCollaboratorForeignKey(collaboratorId)ReferencesUsers(id" => $this->$project_collaborator FOREIGN KEY (collaborator_id) REFERENCES users (id,
		"projectInformationForeignKey(projectId)ReferencesProjects(id" => $this->$project_information FOREIGN KEY (project_id) REFERENCES projects (id,
		"projectPermissionForeignKey(level)ReferencesPermissions(level" => $this->$project_permission FOREIGN KEY (level) REFERENCES permissions (level,
            ]);
        }
} 


