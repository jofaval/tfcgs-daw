<?php

//Ruta de error
$map['error'] = array('controller' => 'Controller', 'action' => 'error', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de access
$map['access'] = array('controller' => 'Controller', 'action' => 'access', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de notsigned
$map['notsigned'] = array('controller' => 'Controller', 'action' => 'notsigned', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de notuseragent
$map['notuseragent'] = array('controller' => 'Controller', 'action' => 'notuseragent', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de projects
$map['projects'] = array('controller' => 'Controller', 'action' => 'projects', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de project
$map['project'] = array('controller' => 'Controller', 'action' => 'project', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de 404
$map['404'] = array('controller' => 'Controller', 'action' => 'error404', 'access' => Config::$ACCESS_LEVEL_GUEST);

//Ruta de getProjectsOfUser
$map['getProjectsOfUser'] = array('controller' => 'AjaxController', 'action' => 'getProjectsOfUser', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de getProjectDetails
$map['getProjectDetails'] = array('controller' => 'AjaxController', 'action' => 'getProjectDetails', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de getDashboardsOfProject
$map['getDashboardsOfProject'] = array('controller' => 'AjaxController', 'action' => 'getDashboardsOfProject', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de getCollaboratorsOfProject
$map['getCollaboratorsOfProject'] = array('controller' => 'AjaxController', 'action' => 'getCollaboratorsOfProject', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de bookmarkProject
$map['bookmarkProject'] = array('controller' => 'AjaxController', 'action' => 'bookmarkProject', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de bookmarkDashboard
$map['bookmarkDashboard'] = array('controller' => 'AjaxController', 'action' => 'bookmarkDashboard', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de doesUsernameExists
$map['doesUsernameExists'] = array('controller' => 'AjaxController', 'action' => 'doesUsernameExists', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de doesEmailExists
$map['doesEmailExists'] = array('controller' => 'AjaxController', 'action' => 'doesEmailExists', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de getListsOfDashboard
$map['getListsOfDashboard'] = array('controller' => 'AjaxController', 'action' => 'getListsOfDashboard', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de getCommentsOfDashboardItem
$map['getCommentsOfDashboardItem'] = array('controller' => 'AjaxController', 'action' => 'getCommentsOfDashboardItem', 'access' => Config::$ACCESS_LEVEL_GUEST);

//Ruta de createDashboards
$map['createDashboards'] = array('controller' => 'AjaxController', 'action' => 'createDashboards', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateDashboards
$map['updateDashboards'] = array('controller' => 'AjaxController', 'action' => 'updateDashboards', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryDashboards
$map['queryDashboards'] = array('controller' => 'AjaxController', 'action' => 'queryDashboards', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteDashboards
$map['deleteDashboards'] = array('controller' => 'AjaxController', 'action' => 'deleteDashboards', 'access' => Config::$ACCESS_LEVEL_GUEST);

//Ruta de createDashboardItemComments
$map['createDashboardItemComments'] = array('controller' => 'AjaxController', 'action' => 'createDashboardItemComments', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateDashboardItemComments
$map['updateDashboardItemComments'] = array('controller' => 'AjaxController', 'action' => 'updateDashboardItemComments', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryDashboardItemComments
$map['queryDashboardItemComments'] = array('controller' => 'AjaxController', 'action' => 'queryDashboardItemComments', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteDashboardItemComments
$map['deleteDashboardItemComments'] = array('controller' => 'AjaxController', 'action' => 'deleteDashboardItemComments', 'access' => Config::$ACCESS_LEVEL_GUEST);

//Ruta de signin
$map['signin'] = array('controller' => 'Controller', 'action' => 'signin', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de signup
$map['signup'] = array('controller' => 'Controller', 'action' => 'signup', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de signout
$map['signout'] = array('controller' => 'Controller', 'action' => 'signout', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de signinFunctionality
$map['signinFunctionality'] = array('controller' => 'Controller', 'action' => 'signinFunctionality', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de getEventsFromMonth
$map['getEventsFromMonth'] = array('controller' => 'Controller', 'action' => 'getEventsFromMonth', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de test
$map['test'] = array('controller' => 'Controller', 'action' => 'test', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de createClients
$map['createClients'] = array('controller' => 'AjaxController', 'action' => 'createClients', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateClients
$map['updateClients'] = array('controller' => 'AjaxController', 'action' => 'updateClients', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryClients
$map['queryClients'] = array('controller' => 'AjaxController', 'action' => 'queryClients', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteClients
$map['deleteClients'] = array('controller' => 'AjaxController', 'action' => 'deleteClients', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de createCollaborators
$map['createCollaborators'] = array('controller' => 'AjaxController', 'action' => 'createCollaborators', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateCollaborators
$map['updateCollaborators'] = array('controller' => 'AjaxController', 'action' => 'updateCollaborators', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryCollaborators
$map['queryCollaborators'] = array('controller' => 'AjaxController', 'action' => 'queryCollaborators', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteCollaborators
$map['deleteCollaborators'] = array('controller' => 'AjaxController', 'action' => 'deleteCollaborators', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de createGlobalLevel
$map['createGlobalLevel'] = array('controller' => 'AjaxController', 'action' => 'createGlobalLevel', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateGlobalLevel
$map['updateGlobalLevel'] = array('controller' => 'AjaxController', 'action' => 'updateGlobalLevel', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryGlobalLevel
$map['queryGlobalLevel'] = array('controller' => 'AjaxController', 'action' => 'queryGlobalLevel', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteGlobalLevel
$map['deleteGlobalLevel'] = array('controller' => 'AjaxController', 'action' => 'deleteGlobalLevel', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de createPermissions
$map['createPermissions'] = array('controller' => 'AjaxController', 'action' => 'createPermissions', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updatePermissions
$map['updatePermissions'] = array('controller' => 'AjaxController', 'action' => 'updatePermissions', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryPermissions
$map['queryPermissions'] = array('controller' => 'AjaxController', 'action' => 'queryPermissions', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deletePermissions
$map['deletePermissions'] = array('controller' => 'AjaxController', 'action' => 'deletePermissions', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de createProjectDiary
$map['createProjectDiary'] = array('controller' => 'AjaxController', 'action' => 'createProjectDiary', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateProjectDiary
$map['updateProjectDiary'] = array('controller' => 'AjaxController', 'action' => 'updateProjectDiary', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryProjectDiary
$map['queryProjectDiary'] = array('controller' => 'AjaxController', 'action' => 'queryProjectDiary', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteProjectDiary
$map['deleteProjectDiary'] = array('controller' => 'AjaxController', 'action' => 'deleteProjectDiary', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de createProjects
$map['createProjects'] = array('controller' => 'AjaxController', 'action' => 'createProjects', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateProjects
$map['updateProjects'] = array('controller' => 'AjaxController', 'action' => 'updateProjects', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryProjects
$map['queryProjects'] = array('controller' => 'AjaxController', 'action' => 'queryProjects', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteProjects
$map['deleteProjects'] = array('controller' => 'AjaxController', 'action' => 'deleteProjects', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de createTaskListItemListItems
$map['createTaskListItemListItems'] = array('controller' => 'AjaxController', 'action' => 'createTaskListItemListItems', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateTaskListItemListItems
$map['updateTaskListItemListItems'] = array('controller' => 'AjaxController', 'action' => 'updateTaskListItemListItems', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryTaskListItemListItems
$map['queryTaskListItemListItems'] = array('controller' => 'AjaxController', 'action' => 'queryTaskListItemListItems', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteTaskListItemListItems
$map['deleteTaskListItemListItems'] = array('controller' => 'AjaxController', 'action' => 'deleteTaskListItemListItems', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de createTaskListItemLists
$map['createTaskListItemLists'] = array('controller' => 'AjaxController', 'action' => 'createTaskListItemLists', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateTaskListItemLists
$map['updateTaskListItemLists'] = array('controller' => 'AjaxController', 'action' => 'updateTaskListItemLists', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryTaskListItemLists
$map['queryTaskListItemLists'] = array('controller' => 'AjaxController', 'action' => 'queryTaskListItemLists', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteTaskListItemLists
$map['deleteTaskListItemLists'] = array('controller' => 'AjaxController', 'action' => 'deleteTaskListItemLists', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de createTaskLists
$map['createTaskLists'] = array('controller' => 'AjaxController', 'action' => 'createTaskLists', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateTaskLists
$map['updateTaskLists'] = array('controller' => 'AjaxController', 'action' => 'updateTaskLists', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryTaskLists
$map['queryTaskLists'] = array('controller' => 'AjaxController', 'action' => 'queryTaskLists', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteTaskLists
$map['deleteTaskLists'] = array('controller' => 'AjaxController', 'action' => 'deleteTaskLists', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de createTaskListsOrderCriteria
$map['createTaskListsOrderCriteria'] = array('controller' => 'AjaxController', 'action' => 'createTaskListsOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateTaskListsOrderCriteria
$map['updateTaskListsOrderCriteria'] = array('controller' => 'AjaxController', 'action' => 'updateTaskListsOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryTaskListsOrderCriteria
$map['queryTaskListsOrderCriteria'] = array('controller' => 'AjaxController', 'action' => 'queryTaskListsOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteTaskListsOrderCriteria
$map['deleteTaskListsOrderCriteria'] = array('controller' => 'AjaxController', 'action' => 'deleteTaskListsOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de createUsers
$map['createUsers'] = array('controller' => 'AjaxController', 'action' => 'createUsers', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateUsers
$map['updateUsers'] = array('controller' => 'AjaxController', 'action' => 'updateUsers', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryUsers
$map['queryUsers'] = array('controller' => 'AjaxController', 'action' => 'queryUsers', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteUsers
$map['deleteUsers'] = array('controller' => 'AjaxController', 'action' => 'deleteUsers', 'access' => Config::$ACCESS_LEVEL_GUEST);

//Ruta de createBookmarked
$map['createBookmarked'] = array('controller' => 'AjaxController', 'action' => 'createBookmarked', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateBookmarked
$map['updateBookmarked'] = array('controller' => 'AjaxController', 'action' => 'updateBookmarked', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryBookmarked
$map['queryBookmarked'] = array('controller' => 'AjaxController', 'action' => 'queryBookmarked', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteBookmarked
$map['deleteBookmarked'] = array('controller' => 'AjaxController', 'action' => 'deleteBookmarked', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de createBookmarkedDashboards
$map['createBookmarkedDashboards'] = array('controller' => 'AjaxController', 'action' => 'createBookmarkedDashboards', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateBookmarkedDashboards
$map['updateBookmarkedDashboards'] = array('controller' => 'AjaxController', 'action' => 'updateBookmarkedDashboards', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryBookmarkedDashboards
$map['queryBookmarkedDashboards'] = array('controller' => 'AjaxController', 'action' => 'queryBookmarkedDashboards', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteBookmarkedDashboards
$map['deleteBookmarkedDashboards'] = array('controller' => 'AjaxController', 'action' => 'deleteBookmarkedDashboards', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de createDashboardItem
$map['createDashboardItem'] = array('controller' => 'AjaxController', 'action' => 'createDashboardItem', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateDashboardItem
$map['updateDashboardItem'] = array('controller' => 'AjaxController', 'action' => 'updateDashboardItem', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryDashboardItem
$map['queryDashboardItem'] = array('controller' => 'AjaxController', 'action' => 'queryDashboardItem', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteDashboardItem
$map['deleteDashboardItem'] = array('controller' => 'AjaxController', 'action' => 'deleteDashboardItem', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de disableDashboardItem
$map['disableDashboardItem'] = array('controller' => 'AjaxController', 'action' => 'disableDashboardItem', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de createDashboardList
$map['createDashboardList'] = array('controller' => 'AjaxController', 'action' => 'createDashboardList', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateDashboardList
$map['updateDashboardList'] = array('controller' => 'AjaxController', 'action' => 'updateDashboardList', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryDashboardList
$map['queryDashboardList'] = array('controller' => 'AjaxController', 'action' => 'queryDashboardList', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteDashboardList
$map['deleteDashboardList'] = array('controller' => 'AjaxController', 'action' => 'deleteDashboardList', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de createDashboardListOrderCriteria
$map['createDashboardListOrderCriteria'] = array('controller' => 'AjaxController', 'action' => 'createDashboardListOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateDashboardListOrderCriteria
$map['updateDashboardListOrderCriteria'] = array('controller' => 'AjaxController', 'action' => 'updateDashboardListOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryDashboardListOrderCriteria
$map['queryDashboardListOrderCriteria'] = array('controller' => 'AjaxController', 'action' => 'queryDashboardListOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteDashboardListOrderCriteria
$map['deleteDashboardListOrderCriteria'] = array('controller' => 'AjaxController', 'action' => 'deleteDashboardListOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de createRoles
$map['createRoles'] = array('controller' => 'AjaxController', 'action' => 'createRoles', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateRoles
$map['updateRoles'] = array('controller' => 'AjaxController', 'action' => 'updateRoles', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryRoles
$map['queryRoles'] = array('controller' => 'AjaxController', 'action' => 'queryRoles', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteRoles
$map['deleteRoles'] = array('controller' => 'AjaxController', 'action' => 'deleteRoles', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de getProjectCollaborationRoles
$map['getProjectCollaborationRoles'] = array('controller' => 'AjaxController', 'action' => 'getProjectCollaborationRoles', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de createProjectDiaryModification
$map['createProjectDiaryModification'] = array('controller' => 'AjaxController', 'action' => 'createProjectDiaryModification', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de updateProjectDiaryModification
$map['updateProjectDiaryModification'] = array('controller' => 'AjaxController', 'action' => 'updateProjectDiaryModification', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de queryProjectDiaryModification
$map['queryProjectDiaryModification'] = array('controller' => 'AjaxController', 'action' => 'queryProjectDiaryModification', 'access' => Config::$ACCESS_LEVEL_GUEST);
//Ruta de deleteProjectDiaryModification
$map['deleteProjectDiaryModification'] = array('controller' => 'AjaxController', 'action' => 'deleteProjectDiaryModification', 'access' => Config::$ACCESS_LEVEL_GUEST);
//profile
$map['profile'] = array('controller' => 'Controller', 'action' => 'profile', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['createDashboardsItemAssignation'] = array('controller' => 'AjaxController', 'action' => 'createDashboardsItemAssignation', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['updateDashboardsItemAssignation'] = array('controller' => 'AjaxController', 'action' => 'updateDashboardsItemAssignation', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['queryDashboardsItemAssignation'] = array('controller' => 'AjaxController', 'action' => 'queryDashboardsItemAssignation', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['deleteDashboardsItemAssignation'] = array('controller' => 'AjaxController', 'action' => 'deleteDashboardsItemAssignation', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['getAssignedDashboardItems'] = array('controller' => 'AjaxController', 'action' => 'getAssignedDashboardItems', 'access' => Config::$ACCESS_LEVEL_GUEST);
//updateOrderInDashboardList
$map['updateOrderInDashboardList'] = array('controller' => 'AjaxController', 'action' => 'updateOrderInDashboardList', 'access' => Config::$ACCESS_LEVEL_GUEST);
//searchUsers
$map['searchUsers'] = array('controller' => 'AjaxController', 'action' => 'searchUsers', 'access' => Config::$ACCESS_LEVEL_GUEST);
//getDashboardItemDetails
$map['getDashboardItemDetails'] = array('controller' => 'AjaxController', 'action' => 'getDashboardItemDetails', 'access' => Config::$ACCESS_LEVEL_GUEST);
//about
$map['about'] = array('controller' => 'Controller', 'action' => 'about', 'access' => Config::$ACCESS_LEVEL_GUEST);
//maintenance
$map['maintenance'] = array('controller' => 'Controller', 'action' => 'maintenance', 'access' => Config::$ACCESS_LEVEL_GUEST);
//admin
$map['admin'] = array('controller' => 'Controller', 'action' => 'admin', 'access' => Config::$ACCESS_LEVEL_GUEST);
//getDataFromTable
$map['getDataFromTable'] = array('controller' => 'Controller', 'action' => 'getDataFromTable', 'access' => Config::$ACCESS_LEVEL_GUEST);
//profileNotFound
$map['profileNotFound'] = array('controller' => 'Controller', 'action' => 'profileNotFound', 'access' => Config::$ACCESS_LEVEL_GUEST);