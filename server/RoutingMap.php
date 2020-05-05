<?php

$map['error'] = array('controller' => 'Controller', 'action' => 'error', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['access'] = array('controller' => 'Controller', 'action' => 'access', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['notsigned'] = array('controller' => 'Controller', 'action' => 'notsigned', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['notuseragent'] = array('controller' => 'Controller', 'action' => 'notuseragent', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['projects'] = array('controller' => 'Controller', 'action' => 'projects', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['project'] = array('controller' => 'Controller', 'action' => 'project', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['404'] = array('controller' => 'Controller', 'action' => 'error404', 'access' => Config::$ACCESS_LEVEL_GUEST);

$map['getProjectsOfUser'] = array('controller' => 'AjaxController', 'action' => 'getProjectsOfUser', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['getProjectDetails'] = array('controller' => 'AjaxController', 'action' => 'getProjectDetails', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['getDashboardsOfProject'] = array('controller' => 'AjaxController', 'action' => 'getDashboardsOfProject', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['getCollaboratorsOfProject'] = array('controller' => 'AjaxController', 'action' => 'getCollaboratorsOfProject', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['bookmarkProject'] = array('controller' => 'AjaxController', 'action' => 'bookmarkProject', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['bookmarkDashboard'] = array('controller' => 'AjaxController', 'action' => 'bookmarkDashboard', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['doesUsernameExists'] = array('controller' => 'AjaxController', 'action' => 'doesUsernameExists', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['doesEmailExists'] = array('controller' => 'AjaxController', 'action' => 'doesEmailExists', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['getListsOfDashboard'] = array('controller' => 'AjaxController', 'action' => 'getListsOfDashboard', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['getCommentsOfDashboardItem'] = array('controller' => 'AjaxController', 'action' => 'getCommentsOfDashboardItem', 'access' => Config::$ACCESS_LEVEL_GUEST);

$map['createDashboards'] = array('controller' => 'AjaxController', 'action' => 'createDashboards', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateDashboards'] = array('controller' => 'AjaxController', 'action' => 'updateDashboards', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryDashboards'] = array('controller' => 'AjaxController', 'action' => 'queryDashboards', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteDashboards'] = array('controller' => 'AjaxController', 'action' => 'deleteDashboards', 'access' => Config::$ACCESS_LEVEL_GUEST);

$map['createDashboardItemComments'] = array('controller' => 'AjaxController', 'action' => 'createDashboardItemComments', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateDashboardItemComments'] = array('controller' => 'AjaxController', 'action' => 'updateDashboardItemComments', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryDashboardItemComments'] = array('controller' => 'AjaxController', 'action' => 'queryDashboardItemComments', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteDashboardItemComments'] = array('controller' => 'AjaxController', 'action' => 'deleteDashboardItemComments', 'access' => Config::$ACCESS_LEVEL_GUEST);

$map['signin'] = array('controller' => 'Controller', 'action' => 'signin', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['signup'] = array('controller' => 'Controller', 'action' => 'signup', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['signout'] = array('controller' => 'Controller', 'action' => 'signout', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['signinFunctionality'] = array('controller' => 'Controller', 'action' => 'signinFunctionality', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['getEventsFromMonth'] = array('controller' => 'Controller', 'action' => 'getEventsFromMonth', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['test'] = array('controller' => 'Controller', 'action' => 'test', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['createClients'] = array('controller' => 'AjaxController', 'action' => 'createClients', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateClients'] = array('controller' => 'AjaxController', 'action' => 'updateClients', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryClients'] = array('controller' => 'AjaxController', 'action' => 'queryClients', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteClients'] = array('controller' => 'AjaxController', 'action' => 'deleteClients', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['createCollaborators'] = array('controller' => 'AjaxController', 'action' => 'createCollaborators', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateCollaborators'] = array('controller' => 'AjaxController', 'action' => 'updateCollaborators', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryCollaborators'] = array('controller' => 'AjaxController', 'action' => 'queryCollaborators', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteCollaborators'] = array('controller' => 'AjaxController', 'action' => 'deleteCollaborators', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['createGlobalLevel'] = array('controller' => 'AjaxController', 'action' => 'createGlobalLevel', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateGlobalLevel'] = array('controller' => 'AjaxController', 'action' => 'updateGlobalLevel', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryGlobalLevel'] = array('controller' => 'AjaxController', 'action' => 'queryGlobalLevel', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteGlobalLevel'] = array('controller' => 'AjaxController', 'action' => 'deleteGlobalLevel', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['createPermissions'] = array('controller' => 'AjaxController', 'action' => 'createPermissions', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updatePermissions'] = array('controller' => 'AjaxController', 'action' => 'updatePermissions', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryPermissions'] = array('controller' => 'AjaxController', 'action' => 'queryPermissions', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deletePermissions'] = array('controller' => 'AjaxController', 'action' => 'deletePermissions', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['createProjectDiary'] = array('controller' => 'AjaxController', 'action' => 'createProjectDiary', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateProjectDiary'] = array('controller' => 'AjaxController', 'action' => 'updateProjectDiary', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryProjectDiary'] = array('controller' => 'AjaxController', 'action' => 'queryProjectDiary', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteProjectDiary'] = array('controller' => 'AjaxController', 'action' => 'deleteProjectDiary', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['createProjects'] = array('controller' => 'AjaxController', 'action' => 'createProjects', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateProjects'] = array('controller' => 'AjaxController', 'action' => 'updateProjects', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryProjects'] = array('controller' => 'AjaxController', 'action' => 'queryProjects', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteProjects'] = array('controller' => 'AjaxController', 'action' => 'deleteProjects', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['createTaskListItemListItems'] = array('controller' => 'AjaxController', 'action' => 'createTaskListItemListItems', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateTaskListItemListItems'] = array('controller' => 'AjaxController', 'action' => 'updateTaskListItemListItems', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryTaskListItemListItems'] = array('controller' => 'AjaxController', 'action' => 'queryTaskListItemListItems', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteTaskListItemListItems'] = array('controller' => 'AjaxController', 'action' => 'deleteTaskListItemListItems', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['createTaskListItemLists'] = array('controller' => 'AjaxController', 'action' => 'createTaskListItemLists', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateTaskListItemLists'] = array('controller' => 'AjaxController', 'action' => 'updateTaskListItemLists', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryTaskListItemLists'] = array('controller' => 'AjaxController', 'action' => 'queryTaskListItemLists', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteTaskListItemLists'] = array('controller' => 'AjaxController', 'action' => 'deleteTaskListItemLists', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['createTaskLists'] = array('controller' => 'AjaxController', 'action' => 'createTaskLists', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateTaskLists'] = array('controller' => 'AjaxController', 'action' => 'updateTaskLists', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryTaskLists'] = array('controller' => 'AjaxController', 'action' => 'queryTaskLists', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteTaskLists'] = array('controller' => 'AjaxController', 'action' => 'deleteTaskLists', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['createTaskListsOrderCriteria'] = array('controller' => 'AjaxController', 'action' => 'createTaskListsOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateTaskListsOrderCriteria'] = array('controller' => 'AjaxController', 'action' => 'updateTaskListsOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryTaskListsOrderCriteria'] = array('controller' => 'AjaxController', 'action' => 'queryTaskListsOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteTaskListsOrderCriteria'] = array('controller' => 'AjaxController', 'action' => 'deleteTaskListsOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['createUsers'] = array('controller' => 'AjaxController', 'action' => 'createUsers', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateUsers'] = array('controller' => 'AjaxController', 'action' => 'updateUsers', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryUsers'] = array('controller' => 'AjaxController', 'action' => 'queryUsers', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteUsers'] = array('controller' => 'AjaxController', 'action' => 'deleteUsers', 'access' => Config::$ACCESS_LEVEL_GUEST);

$map['createBookmarked'] = array('controller' => 'AjaxController', 'action' => 'createBookmarked', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateBookmarked'] = array('controller' => 'AjaxController', 'action' => 'updateBookmarked', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryBookmarked'] = array('controller' => 'AjaxController', 'action' => 'queryBookmarked', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteBookmarked'] = array('controller' => 'AjaxController', 'action' => 'deleteBookmarked', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['createBookmarkedDashboards'] = array('controller' => 'AjaxController', 'action' => 'createBookmarkedDashboards', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateBookmarkedDashboards'] = array('controller' => 'AjaxController', 'action' => 'updateBookmarkedDashboards', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryBookmarkedDashboards'] = array('controller' => 'AjaxController', 'action' => 'queryBookmarkedDashboards', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteBookmarkedDashboards'] = array('controller' => 'AjaxController', 'action' => 'deleteBookmarkedDashboards', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['createDashboardItem'] = array('controller' => 'AjaxController', 'action' => 'createDashboardItem', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateDashboardItem'] = array('controller' => 'AjaxController', 'action' => 'updateDashboardItem', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryDashboardItem'] = array('controller' => 'AjaxController', 'action' => 'queryDashboardItem', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteDashboardItem'] = array('controller' => 'AjaxController', 'action' => 'deleteDashboardItem', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['createDashboardList'] = array('controller' => 'AjaxController', 'action' => 'createDashboardList', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateDashboardList'] = array('controller' => 'AjaxController', 'action' => 'updateDashboardList', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryDashboardList'] = array('controller' => 'AjaxController', 'action' => 'queryDashboardList', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteDashboardList'] = array('controller' => 'AjaxController', 'action' => 'deleteDashboardList', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['createDashboardListOrderCriteria'] = array('controller' => 'AjaxController', 'action' => 'createDashboardListOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateDashboardListOrderCriteria'] = array('controller' => 'AjaxController', 'action' => 'updateDashboardListOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryDashboardListOrderCriteria'] = array('controller' => 'AjaxController', 'action' => 'queryDashboardListOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteDashboardListOrderCriteria'] = array('controller' => 'AjaxController', 'action' => 'deleteDashboardListOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['createRoles'] = array('controller' => 'AjaxController', 'action' => 'createRoles', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateRoles'] = array('controller' => 'AjaxController', 'action' => 'updateRoles', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryRoles'] = array('controller' => 'AjaxController', 'action' => 'queryRoles', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteRoles'] = array('controller' => 'AjaxController', 'action' => 'deleteRoles', 'access' => Config::$ACCESS_LEVEL_GUEST);