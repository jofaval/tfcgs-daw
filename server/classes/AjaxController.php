<?php
class AjaxController
{
	public function genericAjaxReturn($functionName, $requiredParams = [])
	{
		try {
			if (!empty($requiredParams)) {
				$this->throwIfExceptionIfDoesntExist($requiredParams);
			}
			$mainController = "Controller";
			if (method_exists($mainController, $functionName)) {
				$result = call_user_func([new $mainController, $functionName]);
				echo json_encode($result);
			} else {
				$this->returnError();
			}
		} catch (Throwable $th) {
			if (Config::$developmentMode) {
				$this->returnError($th->getMessage());
			} else {
				$this->returnError();
			}
		}
	}

	public function throwIfExceptionIfDoesntExist($elems)
	{
		foreach ($elems as $elem) {
			if (!isset($_REQUEST[$elem])) {
				throw new Error("$elem doesn't exist");
			}
		}
	}public function returnError($message = "")
	{
		$object = [
				"error" => true,
		];
		if ($message != "") {
			$object["message"] = $message;
		}
		$json = json_encode($object);
		echo $json;
		exit;
	}

	public function createClients()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, first_name, second_name, email"]);
	}

	public function updateClients()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, first_name, second_name, email"]);
	}

	public function queryClients()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function deleteClients()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function createCollaborators()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["project_id, collaborator_id, starting_date, level"]);
	}

	public function updateCollaborators()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["project_id, collaborator_id, starting_date, level"]);
	}

	public function queryCollaborators()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["project_id, collaborator_id, starting_date"]);
	}

	public function deleteCollaborators()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["project_id, collaborator_id, starting_date"]);
	}

	public function createGanttDiagramGroupTaskAssignation()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["gantt_diagram_group_task_id, assigned_user_id, assignation_date"]);
	}

	public function updateGanttDiagramGroupTaskAssignation()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["gantt_diagram_group_task_id, assigned_user_id, assignation_date"]);
	}

	public function queryGanttDiagramGroupTaskAssignation()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["gantt_diagram_group_task_id, assigned_user_id, assignation_date"]);
	}

	public function deleteGanttDiagramGroupTaskAssignation()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["gantt_diagram_group_task_id, assigned_user_id, assignation_date"]);
	}

	public function createGanttDiagramGroupTasks()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, gantt_diagram_group_id, creator_id, title, creation_date, start_date, end_date, status"]);
	}

	public function updateGanttDiagramGroupTasks()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, gantt_diagram_group_id, creator_id, title, creation_date, start_date, end_date, status"]);
	}

	public function queryGanttDiagramGroupTasks()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function deleteGanttDiagramGroupTasks()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function createGanttDiagramGroups()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, creator_id, title, creation_date, gantt_diagram_id"]);
	}

	public function updateGanttDiagramGroups()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, creator_id, title, creation_date, gantt_diagram_id"]);
	}

	public function queryGanttDiagramGroups()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function deleteGanttDiagramGroups()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function createGanttDiagramStatus()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, title, description"]);
	}

	public function updateGanttDiagramStatus()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, title, description"]);
	}

	public function queryGanttDiagramStatus()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function deleteGanttDiagramStatus()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function createGanttDiagrams()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, creator_id, title, creation_date, project_id"]);
	}

	public function updateGanttDiagrams()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, creator_id, title, creation_date, project_id"]);
	}

	public function queryGanttDiagrams()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function deleteGanttDiagrams()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function createGlobalLevel()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["level, title, description"]);
	}

	public function updateGlobalLevel()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["level, title, description"]);
	}

	public function queryGlobalLevel()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["level"]);
	}

	public function deleteGlobalLevel()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["level"]);
	}

	public function createPermissions()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["level, title, description"]);
	}

	public function updatePermissions()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["level, title, description"]);
	}

	public function queryPermissions()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["level"]);
	}

	public function deletePermissions()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["level"]);
	}

	public function createProjectDiary()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["day, project_id, creator_id, content, creation_date"]);
	}

	public function updateProjectDiary()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["day, project_id, creator_id, content, creation_date"]);
	}

	public function queryProjectDiary()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["day, project_id"]);
	}

	public function deleteProjectDiary()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["day, project_id"]);
	}

	public function createProjects()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, title, description, creator_id"]);
	}

	public function updateProjects()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, title, description, creator_id"]);
	}

	public function queryProjects()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function deleteProjects()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function createTaskListItemListItems()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, task_item_list_id, title, order, description, creation_date, creator_id"]);
	}

	public function updateTaskListItemListItems()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, task_item_list_id, title, order, description, creation_date, creator_id"]);
	}

	public function queryTaskListItemListItems()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function deleteTaskListItemListItems()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function createTaskListItemLists()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, task_list_id, creator_id, title, description, creation_date, order_criteria"]);
	}

	public function updateTaskListItemLists()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, task_list_id, creator_id, title, description, creation_date, order_criteria"]);
	}

	public function queryTaskListItemLists()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function deleteTaskListItemLists()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function createTaskLists()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, project_id, title, creation_date, creator_id"]);
	}

	public function updateTaskLists()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, project_id, title, creation_date, creator_id"]);
	}

	public function queryTaskLists()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function deleteTaskLists()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function createTaskListsOrderCriteria()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, title"]);
	}

	public function updateTaskListsOrderCriteria()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, title"]);
	}

	public function queryTaskListsOrderCriteria()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function deleteTaskListsOrderCriteria()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function createUsers()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, username, password, level"]);
	}

	public function updateUsers()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id, username, password, level"]);
	}

	public function queryUsers()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}

	public function deleteUsers()
	{
		$this->genericAjaxReturn(__FUNCTION__, ["id"]);
	}
}