<?php

$map['error'] = array('controller' => 'Controller', 'action' => 'error', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['access'] = array('controller' => 'Controller', 'action' => 'access', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['notsigned'] = array('controller' => 'Controller', 'action' => 'notsigned', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['notuseragent'] = array('controller' => 'Controller', 'action' => 'notuseragent', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['projects'] = array('controller' => 'Controller', 'action' => 'projects', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['project'] = array('controller' => 'Controller', 'action' => 'project', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['404'] = array('controller' => 'Controller', 'action' => 'error404', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['getProjectsOfUser'] = array('controller' => 'AjaxController', 'action' => 'getProjectsOfUser', 'access' => Config::$ACCESS_LEVEL_GUEST);
$map['bookmarkProject'] = array('controller' => 'AjaxController', 'action' => 'bookmarkProject', 'access' => Config::$ACCESS_LEVEL_GUEST);

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