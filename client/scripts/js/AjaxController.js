class AjaxController {
	static request(requestLocation, requestType = "POST", params = {}, success = AjaxController.defaultAjaxSuccessAction, error = AjaxController.defaultAjaxErrorAction, async = true) {
		$.ajax({
			url: 'index.php?ctl=' + requestLocation,
			data: params,
			type: requestType,
			async: async,
			success: success,
			error: error,
		});
	}

	//When AJAX is succesful
	static defaultAjaxSuccessAction(data) {
	}

	//When AJAX has some errors
	static defaultAjaxErrorAction(data) {
		sendNotification("Ha surgido un error al realizar la operación", true);
	}

	//Generic request for AJAX
	static genericAjaxRequest(requestName, params, success, error = null) {
		if (error == null) {
			error = function (data) {
				sendNotification("Couldn't execute operation succesfully", true);
			};
		}

		AjaxController.request(requestName, "POST", params, success, error);
	}

	static createClients(id, first_name, second_name, email)
	{
		AjaxController.genericAjaxRequest("createClients", {
			"id": id,
			"first_name": first_name,
			"second_name": second_name,
			"email": email,
		}, success);
	}

	static updateClients(id, first_name, second_name, email)
	{
		AjaxController.genericAjaxRequest("updateClients", {
			"id": id,
			"first_name": first_name,
			"second_name": second_name,
			"email": email,
		}, success);
	}

	static queryClients(id)
	{
		AjaxController.genericAjaxRequest("queryClients", {
			"id": id,
		}, success);
	}

	static deleteClients(id)
	{
		AjaxController.genericAjaxRequest("deleteClients", {
			"id": id,
		}, success);
	}

	static createCollaborators(project_id, collaborator_id, starting_date, level)
	{
		AjaxController.genericAjaxRequest("createCollaborators", {
			"project_id": project_id,
			"collaborator_id": collaborator_id,
			"starting_date": starting_date,
			"level": level,
		}, success);
	}

	static updateCollaborators(project_id, collaborator_id, starting_date, level)
	{
		AjaxController.genericAjaxRequest("updateCollaborators", {
			"project_id": project_id,
			"collaborator_id": collaborator_id,
			"starting_date": starting_date,
			"level": level,
		}, success);
	}

	static queryCollaborators(project_id, collaborator_id, starting_date)
	{
		AjaxController.genericAjaxRequest("queryCollaborators", {
			"project_id": project_id,
			"collaborator_id": collaborator_id,
			"starting_date": starting_date,
		}, success);
	}

	static deleteCollaborators(project_id, collaborator_id, starting_date)
	{
		AjaxController.genericAjaxRequest("deleteCollaborators", {
			"project_id": project_id,
			"collaborator_id": collaborator_id,
			"starting_date": starting_date,
		}, success);
	}

	static createGanttDiagramGroupTaskAssignation(gantt_diagram_group_task_id, assigned_user_id, assignation_date)
	{
		AjaxController.genericAjaxRequest("createGanttDiagramGroupTaskAssignation", {
			"gantt_diagram_group_task_id": gantt_diagram_group_task_id,
			"assigned_user_id": assigned_user_id,
			"assignation_date": assignation_date,
		}, success);
	}

	static updateGanttDiagramGroupTaskAssignation(gantt_diagram_group_task_id, assigned_user_id, assignation_date)
	{
		AjaxController.genericAjaxRequest("updateGanttDiagramGroupTaskAssignation", {
			"gantt_diagram_group_task_id": gantt_diagram_group_task_id,
			"assigned_user_id": assigned_user_id,
			"assignation_date": assignation_date,
		}, success);
	}

	static queryGanttDiagramGroupTaskAssignation(gantt_diagram_group_task_id, assigned_user_id, assignation_date)
	{
		AjaxController.genericAjaxRequest("queryGanttDiagramGroupTaskAssignation", {
			"gantt_diagram_group_task_id": gantt_diagram_group_task_id,
			"assigned_user_id": assigned_user_id,
			"assignation_date": assignation_date,
		}, success);
	}

	static deleteGanttDiagramGroupTaskAssignation(gantt_diagram_group_task_id, assigned_user_id, assignation_date)
	{
		AjaxController.genericAjaxRequest("deleteGanttDiagramGroupTaskAssignation", {
			"gantt_diagram_group_task_id": gantt_diagram_group_task_id,
			"assigned_user_id": assigned_user_id,
			"assignation_date": assignation_date,
		}, success);
	}

	static createGanttDiagramGroupTasks(id, gantt_diagram_group_id, creator_id, title, creation_date, start_date, end_date, status)
	{
		AjaxController.genericAjaxRequest("createGanttDiagramGroupTasks", {
			"id": id,
			"gantt_diagram_group_id": gantt_diagram_group_id,
			"creator_id": creator_id,
			"title": title,
			"creation_date": creation_date,
			"start_date": start_date,
			"end_date": end_date,
			"status": status,
		}, success);
	}

	static updateGanttDiagramGroupTasks(id, gantt_diagram_group_id, creator_id, title, creation_date, start_date, end_date, status)
	{
		AjaxController.genericAjaxRequest("updateGanttDiagramGroupTasks", {
			"id": id,
			"gantt_diagram_group_id": gantt_diagram_group_id,
			"creator_id": creator_id,
			"title": title,
			"creation_date": creation_date,
			"start_date": start_date,
			"end_date": end_date,
			"status": status,
		}, success);
	}

	static queryGanttDiagramGroupTasks(id)
	{
		AjaxController.genericAjaxRequest("queryGanttDiagramGroupTasks", {
			"id": id,
		}, success);
	}

	static deleteGanttDiagramGroupTasks(id)
	{
		AjaxController.genericAjaxRequest("deleteGanttDiagramGroupTasks", {
			"id": id,
		}, success);
	}

	static createGanttDiagramGroups(id, creator_id, title, creation_date, gantt_diagram_id)
	{
		AjaxController.genericAjaxRequest("createGanttDiagramGroups", {
			"id": id,
			"creator_id": creator_id,
			"title": title,
			"creation_date": creation_date,
			"gantt_diagram_id": gantt_diagram_id,
		}, success);
	}

	static updateGanttDiagramGroups(id, creator_id, title, creation_date, gantt_diagram_id)
	{
		AjaxController.genericAjaxRequest("updateGanttDiagramGroups", {
			"id": id,
			"creator_id": creator_id,
			"title": title,
			"creation_date": creation_date,
			"gantt_diagram_id": gantt_diagram_id,
		}, success);
	}

	static queryGanttDiagramGroups(id)
	{
		AjaxController.genericAjaxRequest("queryGanttDiagramGroups", {
			"id": id,
		}, success);
	}

	static deleteGanttDiagramGroups(id)
	{
		AjaxController.genericAjaxRequest("deleteGanttDiagramGroups", {
			"id": id,
		}, success);
	}

	static createGanttDiagramStatus(id, title, description)
	{
		AjaxController.genericAjaxRequest("createGanttDiagramStatus", {
			"id": id,
			"title": title,
			"description": description,
		}, success);
	}

	static updateGanttDiagramStatus(id, title, description)
	{
		AjaxController.genericAjaxRequest("updateGanttDiagramStatus", {
			"id": id,
			"title": title,
			"description": description,
		}, success);
	}

	static queryGanttDiagramStatus(id)
	{
		AjaxController.genericAjaxRequest("queryGanttDiagramStatus", {
			"id": id,
		}, success);
	}

	static deleteGanttDiagramStatus(id)
	{
		AjaxController.genericAjaxRequest("deleteGanttDiagramStatus", {
			"id": id,
		}, success);
	}

	static createGanttDiagrams(id, creator_id, title, creation_date, project_id)
	{
		AjaxController.genericAjaxRequest("createGanttDiagrams", {
			"id": id,
			"creator_id": creator_id,
			"title": title,
			"creation_date": creation_date,
			"project_id": project_id,
		}, success);
	}

	static updateGanttDiagrams(id, creator_id, title, creation_date, project_id)
	{
		AjaxController.genericAjaxRequest("updateGanttDiagrams", {
			"id": id,
			"creator_id": creator_id,
			"title": title,
			"creation_date": creation_date,
			"project_id": project_id,
		}, success);
	}

	static queryGanttDiagrams(id)
	{
		AjaxController.genericAjaxRequest("queryGanttDiagrams", {
			"id": id,
		}, success);
	}

	static deleteGanttDiagrams(id)
	{
		AjaxController.genericAjaxRequest("deleteGanttDiagrams", {
			"id": id,
		}, success);
	}

	static createGlobalLevel(level, title, description)
	{
		AjaxController.genericAjaxRequest("createGlobalLevel", {
			"level": level,
			"title": title,
			"description": description,
		}, success);
	}

	static updateGlobalLevel(level, title, description)
	{
		AjaxController.genericAjaxRequest("updateGlobalLevel", {
			"level": level,
			"title": title,
			"description": description,
		}, success);
	}

	static queryGlobalLevel(level)
	{
		AjaxController.genericAjaxRequest("queryGlobalLevel", {
			"level": level,
		}, success);
	}

	static deleteGlobalLevel(level)
	{
		AjaxController.genericAjaxRequest("deleteGlobalLevel", {
			"level": level,
		}, success);
	}

	static createPermissions(level, title, description)
	{
		AjaxController.genericAjaxRequest("createPermissions", {
			"level": level,
			"title": title,
			"description": description,
		}, success);
	}

	static updatePermissions(level, title, description)
	{
		AjaxController.genericAjaxRequest("updatePermissions", {
			"level": level,
			"title": title,
			"description": description,
		}, success);
	}

	static queryPermissions(level)
	{
		AjaxController.genericAjaxRequest("queryPermissions", {
			"level": level,
		}, success);
	}

	static deletePermissions(level)
	{
		AjaxController.genericAjaxRequest("deletePermissions", {
			"level": level,
		}, success);
	}

	static createProjectDiary(day, project_id, creator_id, content, creation_date)
	{
		AjaxController.genericAjaxRequest("createProjectDiary", {
			"day": day,
			"project_id": project_id,
			"creator_id": creator_id,
			"content": content,
			"creation_date": creation_date,
		}, success);
	}

	static updateProjectDiary(day, project_id, creator_id, content, creation_date)
	{
		AjaxController.genericAjaxRequest("updateProjectDiary", {
			"day": day,
			"project_id": project_id,
			"creator_id": creator_id,
			"content": content,
			"creation_date": creation_date,
		}, success);
	}

	static queryProjectDiary(day, project_id)
	{
		AjaxController.genericAjaxRequest("queryProjectDiary", {
			"day": day,
			"project_id": project_id,
		}, success);
	}

	static deleteProjectDiary(day, project_id)
	{
		AjaxController.genericAjaxRequest("deleteProjectDiary", {
			"day": day,
			"project_id": project_id,
		}, success);
	}

	static createProjects(id, title, description, creator_id)
	{
		AjaxController.genericAjaxRequest("createProjects", {
			"id": id,
			"title": title,
			"description": description,
			"creator_id": creator_id,
		}, success);
	}

	static updateProjects(id, title, description, creator_id)
	{
		AjaxController.genericAjaxRequest("updateProjects", {
			"id": id,
			"title": title,
			"description": description,
			"creator_id": creator_id,
		}, success);
	}

	static queryProjects(id)
	{
		AjaxController.genericAjaxRequest("queryProjects", {
			"id": id,
		}, success);
	}

	static deleteProjects(id)
	{
		AjaxController.genericAjaxRequest("deleteProjects", {
			"id": id,
		}, success);
	}

	static createTaskListItemListItems(id, task_item_list_id, title, order, description, creation_date, creator_id)
	{
		AjaxController.genericAjaxRequest("createTaskListItemListItems", {
			"id": id,
			"task_item_list_id": task_item_list_id,
			"title": title,
			"order": order,
			"description": description,
			"creation_date": creation_date,
			"creator_id": creator_id,
		}, success);
	}

	static updateTaskListItemListItems(id, task_item_list_id, title, order, description, creation_date, creator_id)
	{
		AjaxController.genericAjaxRequest("updateTaskListItemListItems", {
			"id": id,
			"task_item_list_id": task_item_list_id,
			"title": title,
			"order": order,
			"description": description,
			"creation_date": creation_date,
			"creator_id": creator_id,
		}, success);
	}

	static queryTaskListItemListItems(id)
	{
		AjaxController.genericAjaxRequest("queryTaskListItemListItems", {
			"id": id,
		}, success);
	}

	static deleteTaskListItemListItems(id)
	{
		AjaxController.genericAjaxRequest("deleteTaskListItemListItems", {
			"id": id,
		}, success);
	}

	static createTaskListItemLists(id, task_list_id, creator_id, title, description, creation_date, order_criteria)
	{
		AjaxController.genericAjaxRequest("createTaskListItemLists", {
			"id": id,
			"task_list_id": task_list_id,
			"creator_id": creator_id,
			"title": title,
			"description": description,
			"creation_date": creation_date,
			"order_criteria": order_criteria,
		}, success);
	}

	static updateTaskListItemLists(id, task_list_id, creator_id, title, description, creation_date, order_criteria)
	{
		AjaxController.genericAjaxRequest("updateTaskListItemLists", {
			"id": id,
			"task_list_id": task_list_id,
			"creator_id": creator_id,
			"title": title,
			"description": description,
			"creation_date": creation_date,
			"order_criteria": order_criteria,
		}, success);
	}

	static queryTaskListItemLists(id)
	{
		AjaxController.genericAjaxRequest("queryTaskListItemLists", {
			"id": id,
		}, success);
	}

	static deleteTaskListItemLists(id)
	{
		AjaxController.genericAjaxRequest("deleteTaskListItemLists", {
			"id": id,
		}, success);
	}

	static createTaskLists(id, project_id, title, creation_date, creator_id)
	{
		AjaxController.genericAjaxRequest("createTaskLists", {
			"id": id,
			"project_id": project_id,
			"title": title,
			"creation_date": creation_date,
			"creator_id": creator_id,
		}, success);
	}

	static updateTaskLists(id, project_id, title, creation_date, creator_id)
	{
		AjaxController.genericAjaxRequest("updateTaskLists", {
			"id": id,
			"project_id": project_id,
			"title": title,
			"creation_date": creation_date,
			"creator_id": creator_id,
		}, success);
	}

	static queryTaskLists(id)
	{
		AjaxController.genericAjaxRequest("queryTaskLists", {
			"id": id,
		}, success);
	}

	static deleteTaskLists(id)
	{
		AjaxController.genericAjaxRequest("deleteTaskLists", {
			"id": id,
		}, success);
	}

	static createTaskListsOrderCriteria(id, title)
	{
		AjaxController.genericAjaxRequest("createTaskListsOrderCriteria", {
			"id": id,
			"title": title,
		}, success);
	}

	static updateTaskListsOrderCriteria(id, title)
	{
		AjaxController.genericAjaxRequest("updateTaskListsOrderCriteria", {
			"id": id,
			"title": title,
		}, success);
	}

	static queryTaskListsOrderCriteria(id)
	{
		AjaxController.genericAjaxRequest("queryTaskListsOrderCriteria", {
			"id": id,
		}, success);
	}

	static deleteTaskListsOrderCriteria(id)
	{
		AjaxController.genericAjaxRequest("deleteTaskListsOrderCriteria", {
			"id": id,
		}, success);
	}

	static createUsers(id, username, password, level)
	{
		AjaxController.genericAjaxRequest("createUsers", {
			"id": id,
			"username": username,
			"password": password,
			"level": level,
		}, success);
	}

	static updateUsers(id, username, password, level)
	{
		AjaxController.genericAjaxRequest("updateUsers", {
			"id": id,
			"username": username,
			"password": password,
			"level": level,
		}, success);
	}

	static queryUsers(id)
	{
		AjaxController.genericAjaxRequest("queryUsers", {
			"id": id,
		}, success);
	}

	static deleteUsers(id)
	{
		AjaxController.genericAjaxRequest("deleteUsers", {
			"id": id,
		}, success);
	}
}