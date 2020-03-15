<?php

$map = [
    'error' => array('controller' => 'Controller', 'action' => 'error', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'access' => array('controller' => 'Controller', 'action' => 'access', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'notsigned' => array('controller' => 'Controller', 'action' => 'notsigned', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'notuseragent' => array('controller' => 'Controller', 'action' => 'notuseragent', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'projects' => array('controller' => 'Controller', 'action' => 'projects', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'gantt' => array('controller' => 'Controller', 'action' => 'gantt', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'signin' => array('controller' => 'Controller', 'action' => 'signin', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'signinFunctionality' => array('controller' => 'Controller', 'action' => 'signinFunctionality', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'getEventsFromMonth' => array('controller' => 'Controller', 'action' => 'getEventsFromMonth', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'test' => array('controller' => 'Controller', 'action' => 'test', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'createClients' => array('controller' => 'AjaxController', 'action' => 'createClients', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'updateClients' => array('controller' => 'AjaxController', 'action' => 'updateClients', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'queryClients' => array('controller' => 'AjaxController', 'action' => 'queryClients', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'deleteClients' => array('controller' => 'AjaxController', 'action' => 'deleteClients', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'createCollaborators' => array('controller' => 'AjaxController', 'action' => 'createCollaborators', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'updateCollaborators' => array('controller' => 'AjaxController', 'action' => 'updateCollaborators', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'queryCollaborators' => array('controller' => 'AjaxController', 'action' => 'queryCollaborators', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'deleteCollaborators' => array('controller' => 'AjaxController', 'action' => 'deleteCollaborators', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'createGanttDiagramGroupTaskAssignation' => array('controller' => 'AjaxController', 'action' => 'createGanttDiagramGroupTaskAssignation', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'updateGanttDiagramGroupTaskAssignation' => array('controller' => 'AjaxController', 'action' => 'updateGanttDiagramGroupTaskAssignation', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'queryGanttDiagramGroupTaskAssignation' => array('controller' => 'AjaxController', 'action' => 'queryGanttDiagramGroupTaskAssignation', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'deleteGanttDiagramGroupTaskAssignation' => array('controller' => 'AjaxController', 'action' => 'deleteGanttDiagramGroupTaskAssignation', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'createGanttDiagramGroupTasks' => array('controller' => 'AjaxController', 'action' => 'createGanttDiagramGroupTasks', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'updateGanttDiagramGroupTasks' => array('controller' => 'AjaxController', 'action' => 'updateGanttDiagramGroupTasks', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'queryGanttDiagramGroupTasks' => array('controller' => 'AjaxController', 'action' => 'queryGanttDiagramGroupTasks', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'deleteGanttDiagramGroupTasks' => array('controller' => 'AjaxController', 'action' => 'deleteGanttDiagramGroupTasks', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'createGanttDiagramGroups' => array('controller' => 'AjaxController', 'action' => 'createGanttDiagramGroups', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'updateGanttDiagramGroups' => array('controller' => 'AjaxController', 'action' => 'updateGanttDiagramGroups', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'queryGanttDiagramGroups' => array('controller' => 'AjaxController', 'action' => 'queryGanttDiagramGroups', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'deleteGanttDiagramGroups' => array('controller' => 'AjaxController', 'action' => 'deleteGanttDiagramGroups', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'createGanttDiagramStatus' => array('controller' => 'AjaxController', 'action' => 'createGanttDiagramStatus', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'updateGanttDiagramStatus' => array('controller' => 'AjaxController', 'action' => 'updateGanttDiagramStatus', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'queryGanttDiagramStatus' => array('controller' => 'AjaxController', 'action' => 'queryGanttDiagramStatus', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'deleteGanttDiagramStatus' => array('controller' => 'AjaxController', 'action' => 'deleteGanttDiagramStatus', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'createGanttDiagrams' => array('controller' => 'AjaxController', 'action' => 'createGanttDiagrams', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'updateGanttDiagrams' => array('controller' => 'AjaxController', 'action' => 'updateGanttDiagrams', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'queryGanttDiagrams' => array('controller' => 'AjaxController', 'action' => 'queryGanttDiagrams', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'deleteGanttDiagrams' => array('controller' => 'AjaxController', 'action' => 'deleteGanttDiagrams', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'createGlobalLevel' => array('controller' => 'AjaxController', 'action' => 'createGlobalLevel', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'updateGlobalLevel' => array('controller' => 'AjaxController', 'action' => 'updateGlobalLevel', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'queryGlobalLevel' => array('controller' => 'AjaxController', 'action' => 'queryGlobalLevel', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'deleteGlobalLevel' => array('controller' => 'AjaxController', 'action' => 'deleteGlobalLevel', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'createPermissions' => array('controller' => 'AjaxController', 'action' => 'createPermissions', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'updatePermissions' => array('controller' => 'AjaxController', 'action' => 'updatePermissions', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'queryPermissions' => array('controller' => 'AjaxController', 'action' => 'queryPermissions', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'deletePermissions' => array('controller' => 'AjaxController', 'action' => 'deletePermissions', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'createProjectDiary' => array('controller' => 'AjaxController', 'action' => 'createProjectDiary', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'updateProjectDiary' => array('controller' => 'AjaxController', 'action' => 'updateProjectDiary', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'queryProjectDiary' => array('controller' => 'AjaxController', 'action' => 'queryProjectDiary', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'deleteProjectDiary' => array('controller' => 'AjaxController', 'action' => 'deleteProjectDiary', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'createProjects' => array('controller' => 'AjaxController', 'action' => 'createProjects', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'updateProjects' => array('controller' => 'AjaxController', 'action' => 'updateProjects', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'queryProjects' => array('controller' => 'AjaxController', 'action' => 'queryProjects', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'deleteProjects' => array('controller' => 'AjaxController', 'action' => 'deleteProjects', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'createTaskListItemListItems' => array('controller' => 'AjaxController', 'action' => 'createTaskListItemListItems', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'updateTaskListItemListItems' => array('controller' => 'AjaxController', 'action' => 'updateTaskListItemListItems', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'queryTaskListItemListItems' => array('controller' => 'AjaxController', 'action' => 'queryTaskListItemListItems', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'deleteTaskListItemListItems' => array('controller' => 'AjaxController', 'action' => 'deleteTaskListItemListItems', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'createTaskListItemLists' => array('controller' => 'AjaxController', 'action' => 'createTaskListItemLists', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'updateTaskListItemLists' => array('controller' => 'AjaxController', 'action' => 'updateTaskListItemLists', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'queryTaskListItemLists' => array('controller' => 'AjaxController', 'action' => 'queryTaskListItemLists', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'deleteTaskListItemLists' => array('controller' => 'AjaxController', 'action' => 'deleteTaskListItemLists', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'createTaskLists' => array('controller' => 'AjaxController', 'action' => 'createTaskLists', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'updateTaskLists' => array('controller' => 'AjaxController', 'action' => 'updateTaskLists', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'queryTaskLists' => array('controller' => 'AjaxController', 'action' => 'queryTaskLists', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'deleteTaskLists' => array('controller' => 'AjaxController', 'action' => 'deleteTaskLists', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'createTaskListsOrderCriteria' => array('controller' => 'AjaxController', 'action' => 'createTaskListsOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'updateTaskListsOrderCriteria' => array('controller' => 'AjaxController', 'action' => 'updateTaskListsOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'queryTaskListsOrderCriteria' => array('controller' => 'AjaxController', 'action' => 'queryTaskListsOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'deleteTaskListsOrderCriteria' => array('controller' => 'AjaxController', 'action' => 'deleteTaskListsOrderCriteria', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'createUsers' => array('controller' => 'AjaxController', 'action' => 'createUsers', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'updateUsers' => array('controller' => 'AjaxController', 'action' => 'updateUsers', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'queryUsers' => array('controller' => 'AjaxController', 'action' => 'queryUsers', 'access' => Config::$ACCESS_LEVEL_GUEST),
    'deleteUsers' => array('controller' => 'AjaxController', 'action' => 'deleteUsers', 'access' => Config::$ACCESS_LEVEL_GUEST),
];