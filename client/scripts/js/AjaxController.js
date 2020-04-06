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
	static defaultAjaxSuccessAction(data) {}

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

	//Function to createClients
	static createClients(id, first_name, second_name, email) {
		AjaxController.genericAjaxRequest("createClients", {
			"id": id,
			"first_name": first_name,
			"second_name": second_name,
			"email": email,
		}, success);
	}

	//Function to updateClients
	static updateClients(id, first_name, second_name, email) {
		AjaxController.genericAjaxRequest("updateClients", {
			"id": id,
			"first_name": first_name,
			"second_name": second_name,
			"email": email,
		}, success);
	}

	//Function to queryClients
	static queryClients(id) {
		AjaxController.genericAjaxRequest("queryClients", {
			"id": id,
		}, success);
	}

	//Function to deleteClients
	static deleteClients(id) {
		AjaxController.genericAjaxRequest("deleteClients", {
			"id": id,
		}, success);
	}

	//Function to createCollaborators
	static createCollaborators(project_id, collaborator_id, starting_date, level) {
		AjaxController.genericAjaxRequest("createCollaborators", {
			"project_id": project_id,
			"collaborator_id": collaborator_id,
			"starting_date": starting_date,
			"level": level,
		}, success);
	}

	//Function to updateCollaborators
	static updateCollaborators(project_id, collaborator_id, starting_date, level) {
		AjaxController.genericAjaxRequest("updateCollaborators", {
			"project_id": project_id,
			"collaborator_id": collaborator_id,
			"starting_date": starting_date,
			"level": level,
		}, success);
	}

	//Function to queryCollaborators
	static queryCollaborators(project_id, collaborator_id, starting_date) {
		AjaxController.genericAjaxRequest("queryCollaborators", {
			"project_id": project_id,
			"collaborator_id": collaborator_id,
			"starting_date": starting_date,
		}, success);
	}

	//Function to deleteCollaborators
	static deleteCollaborators(project_id, collaborator_id, starting_date) {
		AjaxController.genericAjaxRequest("deleteCollaborators", {
			"project_id": project_id,
			"collaborator_id": collaborator_id,
			"starting_date": starting_date,
		}, success);
	}

	//Function to createGlobalLevel
	static createGlobalLevel(level, title, description) {
		AjaxController.genericAjaxRequest("createGlobalLevel", {
			"level": level,
			"title": title,
			"description": description,
		}, success);
	}

	//Function to updateGlobalLevel
	static updateGlobalLevel(level, title, description) {
		AjaxController.genericAjaxRequest("updateGlobalLevel", {
			"level": level,
			"title": title,
			"description": description,
		}, success);
	}

	//Function to queryGlobalLevel
	static queryGlobalLevel(level) {
		AjaxController.genericAjaxRequest("queryGlobalLevel", {
			"level": level,
		}, success);
	}

	//Function to deleteGlobalLevel
	static deleteGlobalLevel(level) {
		AjaxController.genericAjaxRequest("deleteGlobalLevel", {
			"level": level,
		}, success);
	}

	//Function to createPermissions
	static createPermissions(level, title, description) {
		AjaxController.genericAjaxRequest("createPermissions", {
			"level": level,
			"title": title,
			"description": description,
		}, success);
	}

	//Function to updatePermissions
	static updatePermissions(level, title, description) {
		AjaxController.genericAjaxRequest("updatePermissions", {
			"level": level,
			"title": title,
			"description": description,
		}, success);
	}

	//Function to queryPermissions
	static queryPermissions(level) {
		AjaxController.genericAjaxRequest("queryPermissions", {
			"level": level,
		}, success);
	}

	//Function to deletePermissions
	static deletePermissions(level) {
		AjaxController.genericAjaxRequest("deletePermissions", {
			"level": level,
		}, success);
	}

	//Function to createProjectDiary
	static createProjectDiary(day, project_id, creator_id, content, creation_date) {
		AjaxController.genericAjaxRequest("createProjectDiary", {
			"day": day,
			"project_id": project_id,
			"creator_id": creator_id,
			"content": content,
			"creation_date": creation_date,
		}, success);
	}

	//Function to updateProjectDiary
	static updateProjectDiary(day, project_id, creator_id, content, creation_date) {
		AjaxController.genericAjaxRequest("updateProjectDiary", {
			"day": day,
			"project_id": project_id,
			"creator_id": creator_id,
			"content": content,
			"creation_date": creation_date,
		}, success);
	}

	//Function to queryProjectDiary
	static queryProjectDiary(day, project_id) {
		AjaxController.genericAjaxRequest("queryProjectDiary", {
			"day": day,
			"project_id": project_id,
		}, success);
	}

	//Function to deleteProjectDiary
	static deleteProjectDiary(day, project_id) {
		AjaxController.genericAjaxRequest("deleteProjectDiary", {
			"day": day,
			"project_id": project_id,
		}, success);
	}

	//Function to createProjects
	static createProjects(id, title, description, creator_id) {
		AjaxController.genericAjaxRequest("createProjects", {
			"id": id,
			"title": title,
			"description": description,
			"creator_id": creator_id,
		}, success);
	}

	//Function to updateProjects
	static updateProjects(id, title, description, creator_id) {
		AjaxController.genericAjaxRequest("updateProjects", {
			"id": id,
			"title": title,
			"description": description,
			"creator_id": creator_id,
		}, success);
	}

	//Function to queryProjects
	static queryProjects(id) {
		AjaxController.genericAjaxRequest("queryProjects", {
			"id": id,
		}, success);
	}

	//Function to deleteProjects
	static deleteProjects(id) {
		AjaxController.genericAjaxRequest("deleteProjects", {
			"id": id,
		}, success);
	}

	//Function to createTaskListItemListItems
	static createTaskListItemListItems(id, task_item_list_id, title, order, description, creation_date, creator_id) {
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

	//Function to updateTaskListItemListItems
	static updateTaskListItemListItems(id, task_item_list_id, title, order, description, creation_date, creator_id) {
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

	//Function to queryTaskListItemListItems
	static queryTaskListItemListItems(id) {
		AjaxController.genericAjaxRequest("queryTaskListItemListItems", {
			"id": id,
		}, success);
	}

	//Function to deleteTaskListItemListItems
	static deleteTaskListItemListItems(id) {
		AjaxController.genericAjaxRequest("deleteTaskListItemListItems", {
			"id": id,
		}, success);
	}

	//Function to createTaskListItemLists
	static createTaskListItemLists(id, task_list_id, creator_id, title, description, creation_date, order_criteria) {
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

	//Function to updateTaskListItemLists
	static updateTaskListItemLists(id, task_list_id, creator_id, title, description, creation_date, order_criteria) {
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

	//Function to queryTaskListItemLists
	static queryTaskListItemLists(id) {
		AjaxController.genericAjaxRequest("queryTaskListItemLists", {
			"id": id,
		}, success);
	}

	//Function to deleteTaskListItemLists
	static deleteTaskListItemLists(id) {
		AjaxController.genericAjaxRequest("deleteTaskListItemLists", {
			"id": id,
		}, success);
	}

	//Function to createTaskLists
	static createTaskLists(id, project_id, title, creation_date, creator_id) {
		AjaxController.genericAjaxRequest("createTaskLists", {
			"id": id,
			"project_id": project_id,
			"title": title,
			"creation_date": creation_date,
			"creator_id": creator_id,
		}, success);
	}

	//Function to updateTaskLists
	static updateTaskLists(id, project_id, title, creation_date, creator_id) {
		AjaxController.genericAjaxRequest("updateTaskLists", {
			"id": id,
			"project_id": project_id,
			"title": title,
			"creation_date": creation_date,
			"creator_id": creator_id,
		}, success);
	}

	//Function to queryTaskLists
	static queryTaskLists(id) {
		AjaxController.genericAjaxRequest("queryTaskLists", {
			"id": id,
		}, success);
	}

	//Function to deleteTaskLists
	static deleteTaskLists(id) {
		AjaxController.genericAjaxRequest("deleteTaskLists", {
			"id": id,
		}, success);
	}

	//Function to createTaskListsOrderCriteria
	static createTaskListsOrderCriteria(id, title) {
		AjaxController.genericAjaxRequest("createTaskListsOrderCriteria", {
			"id": id,
			"title": title,
		}, success);
	}

	//Function to updateTaskListsOrderCriteria
	static updateTaskListsOrderCriteria(id, title) {
		AjaxController.genericAjaxRequest("updateTaskListsOrderCriteria", {
			"id": id,
			"title": title,
		}, success);
	}

	//Function to queryTaskListsOrderCriteria
	static queryTaskListsOrderCriteria(id) {
		AjaxController.genericAjaxRequest("queryTaskListsOrderCriteria", {
			"id": id,
		}, success);
	}

	//Function to deleteTaskListsOrderCriteria
	static deleteTaskListsOrderCriteria(id) {
		AjaxController.genericAjaxRequest("deleteTaskListsOrderCriteria", {
			"id": id,
		}, success);
	}

	//Function to createUsers
	static createUsers(id, username, password, level) {
		AjaxController.genericAjaxRequest("createUsers", {
			"id": id,
			"username": username,
			"password": password,
			"level": level,
		}, success);
	}

	//Function to updateUsers
	static updateUsers(id, username, password, level) {
		AjaxController.genericAjaxRequest("updateUsers", {
			"id": id,
			"username": username,
			"password": password,
			"level": level,
		}, success);
	}

	//Function to queryUsers
	static queryUsers(id) {
		AjaxController.genericAjaxRequest("queryUsers", {
			"id": id,
		}, success);
	}

	//Function to deleteUsers
	static deleteUsers(id) {
		AjaxController.genericAjaxRequest("deleteUsers", {
			"id": id,
		}, success);
	}
}