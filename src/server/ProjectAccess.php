<?php

$projectActionsMap = [];

//$projectActionsMap["example"] = array('access' => Config::$PROJECT_ACCESS_WORKER, 'requiredParams' => [], 'Controller' => 'POPOController');
$projectActionsMap["updateOrderInDashboardList"] = array('access' => Config::$PROJECT_ACCESS_ADMIN);

$projectActionsMap["getAssignedDashboardItems"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["getCommentsOfDashboardItem"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["getProjectDetails"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["getDashboardsOfProject"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["getGanttsOfProject"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["getCollaboratorsOfProject"] = array('access' => Config::$PROJECT_ACCESS_WORKER);

$projectActionsMap["getListsOfDashboard"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["bookmarkDashboard"] = array('access' => Config::$PROJECT_ACCESS_WORKER);

$projectActionsMap["createDashboards"] = array('access' => Config::$PROJECT_ACCESS_ADMIN);
$projectActionsMap["updateDashboards"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["queryDashboards"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["deleteDashboards"] = array('access' => Config::$PROJECT_ACCESS_ADMIN);

$projectActionsMap["createGantts"] = array('access' => Config::$PROJECT_ACCESS_ADMIN);
$projectActionsMap["updateGantts"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["queryGantts"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["deleteGantts"] = array('access' => Config::$PROJECT_ACCESS_ADMIN);

$projectActionsMap["createCollaborators"] = array('access' => Config::$PROJECT_ACCESS_MANAGER);
$projectActionsMap["updateCollaborators"] = array('access' => Config::$PROJECT_ACCESS_ADMIN);
$projectActionsMap["queryCollaborators"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["deleteCollaborators"] = array('access' => Config::$PROJECT_ACCESS_ADMIN);

$projectActionsMap["createProjectDiary"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["updateProjectDiary"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["queryProjectDiary"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["deleteProjectDiary"] = array('access' => Config::$PROJECT_ACCESS_WORKER);

$projectActionsMap["updateProjects"] = array('access' => Config::$PROJECT_ACCESS_CREATOR);
$projectActionsMap["deleteProjects"] = array('access' => Config::$PROJECT_ACCESS_CREATOR);

$projectActionsMap["createBookmarkedDashboards"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["updateBookmarkedDashboards"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["queryBookmarkedDashboards"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["deleteBookmarkedDashboards"] = array('access' => Config::$PROJECT_ACCESS_WORKER);

$projectActionsMap["createBookmarkedGantts"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["updateBookmarkedGantts"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["queryBookmarkedGantts"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["deleteBookmarkedGantts"] = array('access' => Config::$PROJECT_ACCESS_WORKER);

$projectActionsMap["createDashboardItem"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["queryDashboardItem"] = array('access' => Config::$PROJECT_ACCESS_MANAGER);
$projectActionsMap["deleteDashboardItem"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["disableDashboardItem"] = array('access' => Config::$PROJECT_ACCESS_MANAGER);

$projectActionsMap["createDashboardList"] = array('access' => Config::$PROJECT_ACCESS_MANAGER);
$projectActionsMap["updateDashboardList"] = array('access' => Config::$PROJECT_ACCESS_MANAGER);
$projectActionsMap["queryDashboardList"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["deleteDashboardList"] = array('access' => Config::$PROJECT_ACCESS_MANAGER);

$projectActionsMap["createDashboardItemComments"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["updateDashboardItemComments"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["queryDashboardItemComments"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["deleteDashboardItemComments"] = array('access' => Config::$PROJECT_ACCESS_WORKER);

$projectActionsMap["createProjectDiaryModification"] = array('access' => Config::$PROJECT_ACCESS_MANAGER);
$projectActionsMap["updateProjectDiaryModification"] = array('access' => Config::$PROJECT_ACCESS_MANAGER);
$projectActionsMap["queryProjectDiaryModification"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["deleteProjectDiaryModification"] = array('access' => Config::$PROJECT_ACCESS_MANAGER);

$projectActionsMap["createDashboardsItemAssignation"] = array('access' => Config::$PROJECT_ACCESS_MANAGER);
$projectActionsMap["updateDashboardsItemAssignation"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["queryDashboardsItemAssignation"] = array('access' => Config::$PROJECT_ACCESS_WORKER);
$projectActionsMap["deleteDashboardsItemAssignation"] = array('access' => Config::$PROJECT_ACCESS_MANAGER);

$projectActionsMap["getDashboardItemDetails"] = array('access' => Config::$PROJECT_ACCESS_WORKER);