<?php
class AjaxController
{
    public function genericAjaxReturn($functionName, $requiredParams = [], $mainController = "POPOController")
    {
        header('Content-Type: application/json');

        try {
            if (!empty($requiredParams)) {
                $this->throwIfExceptionIfDoesntExist($requiredParams);
            }
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

    //Function to bookmarkProject
    public function bookmarkProject()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project"], "Controller");
    }

    //Function to getProjectDetails
    public function getProjectDetails()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"], "Controller");
    }

    //Function to getDashboardsOfProject
    public function getDashboardsOfProject()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project"], "Controller");
    }

    //Function to getProjectsOfUser
    public function getProjectsOfUser()
    {
        $this->genericAjaxReturn(__FUNCTION__, [], "Controller");
    }

    //Function to createClients
    public function createClients()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id", "first_name", "second_name", "email"]);
    }

    //Function to updateClients
    public function updateClients()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id", "first_name", "second_name", "email"]);
    }

    //Function to queryClients
    public function queryClients()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to deleteClients
    public function deleteClients()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to createCollaborators
    public function createCollaborators()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["project_id", "collaborator_id", "starting_date", "level"]);
    }

    //Function to updateCollaborators
    public function updateCollaborators()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["project_id", "collaborator_id", "starting_date", "level"]);
    }

    //Function to queryCollaborators
    public function queryCollaborators()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["project_id", "collaborator_id", "starting_date"]);
    }

    //Function to deleteCollaborators
    public function deleteCollaborators()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["project_id", "collaborator_id", "starting_date"]);
    }

    //Function to createGlobalLevel
    public function createGlobalLevel()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["level", "title", "description"]);
    }

    //Function to updateGlobalLevel
    public function updateGlobalLevel()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["level", "title", "description"]);
    }

    //Function to queryGlobalLevel
    public function queryGlobalLevel()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["level"]);
    }

    //Function to deleteGlobalLevel
    public function deleteGlobalLevel()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["level"]);
    }

    //Function to createPermissions
    public function createPermissions()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["level", "title", "description"]);
    }

    //Function to updatePermissions
    public function updatePermissions()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["level", "title", "description"]);
    }

    //Function to queryPermissions
    public function queryPermissions()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["level"]);
    }

    //Function to deletePermissions
    public function deletePermissions()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["level"]);
    }

    //Function to createProjectDiary
    public function createProjectDiary()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["day", "project_id", "id_creator", "content", "creation_date"]);
    }

    //Function to updateProjectDiary
    public function updateProjectDiary()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["day", "project_id", "id_creator", "content", "creation_date"]);
    }

    //Function to queryProjectDiary
    public function queryProjectDiary()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["day", "project_id"]);
    }

    //Function to deleteProjectDiary
    public function deleteProjectDiary()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["day", "project_id"]);
    }

    //Function to createProjects
    public function createProjects()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["title", "description"]);
    }

    //Function to updateProjects
    public function updateProjects()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id", "title", "description", "id_creator"]);
    }

    //Function to queryProjects
    public function queryProjects()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to deleteProjects
    public function deleteProjects()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to createTaskListItemListItems
    public function createTaskListItemListItems()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id", "task_item_list_id", "title", "order", "description", "creation_date", "id_creator"]);
    }

    //Function to updateTaskListItemListItems
    public function updateTaskListItemListItems()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id", "task_item_list_id", "title", "order", "description", "creation_date", "id_creator"]);
    }

    //Function to queryTaskListItemListItems
    public function queryTaskListItemListItems()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to deleteTaskListItemListItems
    public function deleteTaskListItemListItems()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to createTaskListItemLists
    public function createTaskListItemLists()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id", "task_list_id", "id_creator", "title", "description", "creation_date", "order_criteria"]);
    }

    //Function to updateTaskListItemLists
    public function updateTaskListItemLists()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id", "task_list_id", "id_creator", "title", "description", "creation_date", "order_criteria"]);
    }

    //Function to queryTaskListItemLists
    public function queryTaskListItemLists()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to deleteTaskListItemLists
    public function deleteTaskListItemLists()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to createTaskLists
    public function createTaskLists()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id", "project_id", "title", "creation_date", "id_creator"]);
    }

    //Function to updateTaskLists
    public function updateTaskLists()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id", "project_id", "title", "creation_date", "id_creator"]);
    }

    //Function to queryTaskLists
    public function queryTaskLists()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to deleteTaskLists
    public function deleteTaskLists()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to createTaskListsOrderCriteria
    public function createTaskListsOrderCriteria()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id", "title"]);
    }

    //Function to updateTaskListsOrderCriteria
    public function updateTaskListsOrderCriteria()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id", "title"]);
    }

    //Function to queryTaskListsOrderCriteria
    public function queryTaskListsOrderCriteria()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to deleteTaskListsOrderCriteria
    public function deleteTaskListsOrderCriteria()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to createUsers
    public function createUsers()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id", "username", "password", "level"]);
    }

    //Function to updateUsers
    public function updateUsers()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id", "username", "password", "level"]);
    }

    //Function to queryUsers
    public function queryUsers()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to deleteUsers
    public function deleteUsers()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }
}