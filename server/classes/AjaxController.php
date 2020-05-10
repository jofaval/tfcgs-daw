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

                if (is_null($result)) {
                    $result = false;
                }

                echo json_encode($result);
            } else {
                $this->returnError();
            }
        } catch (Throwable $th) {
            if (Config::$developmentMode !== 0) {
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
    }

    public function returnError($message = "")
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

    //Function to updateOrderInDashboardList
    public function searchUsers()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["username"], "Controller");
    }

    //Function to updateOrderInDashboardList
    public function updateOrderInDashboardList()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_dashboard_list", "order"], "Controller");
    }

    //Function to getProjectCollaborationRoles
    public function getProjectCollaborationRoles()
    {
        $this->genericAjaxReturn(__FUNCTION__, [], "Controller");
    }

    //Function to getAssignedDashboardItems
    public function getAssignedDashboardItems()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project"], "Controller");
    }

    //Function to getCommentsOfDashboardItem
    public function getCommentsOfDashboardItem()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_dashboard_item"], "Controller");
    }

    //Function to getListsOfDashboard
    public function getListsOfDashboard()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "dashboard"], "Controller");
    }

    //Function to bookmarkProject
    public function bookmarkProject()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project"], "Controller");
    }

    //Function to doesUsernameExists
    public function doesUsernameExists()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["username"], "Controller");
    }

    //Function to doesEmailExists
    public function doesEmailExists()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["email"], "Controller");
    }

    //Function to bookmarkDashboard
    public function bookmarkDashboard()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "title"], "Controller");
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

    //Function to getCollaboratorsOfProject
    public function getCollaboratorsOfProject()
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

    //Function to createDashboards
    public function createDashboards()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "title"]);
    }

    //Function to updateDashboards
    public function updateDashboards()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "title"]);
    }

    //Function to queryDashboards
    public function queryDashboards()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "title"]);
    }

    //Function to deleteDashboards
    public function deleteDashboards()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "title"]);
    }

    //Function to createCollaborators
    public function createCollaborators()
    {
        $controller = new Controller();
        $_REQUEST["id_collaborator"] = $controller->getClientIdFromUsername($_REQUEST["username"]);
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "username"]);
    }

    //Function to updateCollaborators
    public function updateCollaborators()
    {
        $controller = new Controller();
        $_REQUEST["id_collaborator"] = $controller->getClientIdFromUsername($_REQUEST["username"]);
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "username", "level"]);
    }

    //Function to queryCollaborators
    public function queryCollaborators()
    {
        $controller = new Controller();
        $_REQUEST["id_collaborator"] = $controller->getClientIdFromUsername($_REQUEST["username"]);
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "username"]);
    }

    //Function to deleteCollaborators
    public function deleteCollaborators()
    {
        $controller = new Controller();
        $_REQUEST["id_collaborator"] = $controller->getClientIdFromUsername($_REQUEST["username"]);
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "username"]);
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
        $this->genericAjaxReturn(__FUNCTION__, ["day", "id_project", "content"]);
    }

    //Function to updateProjectDiary
    public function updateProjectDiary()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["day", "id_project", "content"]);
    }

    //Function to queryProjectDiary
    public function queryProjectDiary()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["day", "id_project"]);
    }

    //Function to deleteProjectDiary
    public function deleteProjectDiary()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["day", "id_project"]);
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
        $this->genericAjaxReturn(__FUNCTION__, ["id", "id_project", "title", "creation_date", "id_creator"]);
    }

    //Function to updateTaskLists
    public function updateTaskLists()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id", "id_project", "title", "creation_date", "id_creator"]);
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

    //Function to createBookmarked
    public function createBookmarked()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project"]);
    }

    //Function to updateBookmarked
    public function updateBookmarked()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project"]);
    }

    //Function to queryBookmarked
    public function queryBookmarked()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project"]);
    }

    //Function to deleteBookmarked
    public function deleteBookmarked()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project"]);
    }

    //Function to createBookmarkedDashboards
    public function createBookmarkedDashboards()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "title"]);
    }

    //Function to updateBookmarkedDashboards
    public function updateBookmarkedDashboards()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "title"]);
    }

    //Function to queryBookmarkedDashboards
    public function queryBookmarkedDashboards()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "title"]);
    }

    //Function to deleteBookmarkedDashboards
    public function deleteBookmarkedDashboards()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "title"]);
    }

    //Function to createDashboardItem
    public function createDashboardItem()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["title", "id_dashboard_list"]);
    }

    //Function to updateDashboardItem
    public function updateDashboardItem()
    {
        $requiredParams = ["id", "id_dashboard_list", "order"];
        if (Utils::exists("title")) {
            $requiredParams = ["id", "title", "description"];
        }
        $this->genericAjaxReturn(__FUNCTION__, $requiredParams);
    }

    //Function to queryDashboardItem
    public function queryDashboardItem()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to deleteDashboardItem
    public function deleteDashboardItem()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to disableDashboardItem
    public function disableDashboardItem()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to createDashboardList
    public function createDashboardList()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "dashboard_title", "title"]);
    }

    //Function to updateDashboardList
    public function updateDashboardList()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "dashboard_title", "title"]);
    }

    //Function to queryDashboardList
    public function queryDashboardList()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "dashboard_title", "title"]);
    }

    //Function to deleteDashboardList
    public function deleteDashboardList()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to createDashboardListOrderCriteria
    public function createDashboardListOrderCriteria()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["level"]);
    }

    //Function to updateDashboardListOrderCriteria
    public function updateDashboardListOrderCriteria()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["level"]);
    }

    //Function to queryDashboardListOrderCriteria
    public function queryDashboardListOrderCriteria()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["level"]);
    }

    //Function to deleteDashboardListOrderCriteria
    public function deleteDashboardListOrderCriteria()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["level"]);
    }

    //Function to createRoles
    public function createRoles()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["level"]);
    }

    //Function to updateRoles
    public function updateRoles()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["level"]);
    }

    //Function to queryRoles
    public function queryRoles()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["level"]);
    }

    //Function to deleteRoles
    public function deleteRoles()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["level"]);
    }

    //Function to createDashboardItemComments
    public function createDashboardItemComments()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_dashboard_item", "comment"]);
    }

    //Function to updateDashboardItemComments
    public function updateDashboardItemComments()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id", "comment"]);
    }

    //Function to queryDashboardItemComments
    public function queryDashboardItemComments()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to deleteDashboardItemComments
    public function deleteDashboardItemComments()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to createProjectDiaryModification
    public function createProjectDiaryModification()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "day"]);
    }

    //Function to updateProjectDiaryModification
    public function updateProjectDiaryModification()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "day"]);
    }

    //Function to queryProjectDiaryModification
    public function queryProjectDiaryModification()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "day"]);
    }

    //Function to deleteProjectDiaryModification
    public function deleteProjectDiaryModification()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id_project", "day"]);
    }

    //Function to createDashboardsItemAssignation
    public function createDashboardsItemAssignation()
    {
        $controller = new Controller();
        $_REQUEST["assigned_to"] = $controller->getClientIdFromUsername($_REQUEST["assigned_to"]);
        $this->genericAjaxReturn(__FUNCTION__, ["id_dashboard_item", "start_date", "end_date", "assigned_to"]);
    }

    //Function to updateDashboardsItemAssignation
    public function updateDashboardsItemAssignation()
    {
        $controller = new Controller();
        $_REQUEST["assigned_to"] = $controller->getClientIdFromUsername($_REQUEST["assigned_to"]);
        $this->genericAjaxReturn(__FUNCTION__, ["id", "finished"]);
    }

    //Function to queryDashboardsItemAssignation
    public function queryDashboardsItemAssignation()
    {
        $controller = new Controller();
        $_REQUEST["assigned_to"] = $controller->getClientIdFromUsername($_REQUEST["assigned_to"]);
        $this->genericAjaxReturn(__FUNCTION__, ["id"]);
    }

    //Function to deleteDashboardsItemAssignation
    public function deleteDashboardsItemAssignation()
    {
        $controller = new Controller();
        $_REQUEST["assigned_to"] = $controller->getClientIdFromUsername($_REQUEST["assigned_to"]);
        $this->genericAjaxReturn(__FUNCTION__, ["id_dashboard_item", "assigned_to"]);
    }

    //Function to getDashboardItemDetails

    public function getDashboardItemDetails()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["id"], "Controller");
    }

}