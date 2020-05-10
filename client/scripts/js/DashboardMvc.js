var $taskListsContainer = $(`<div class="d-flex overflow-scroll w-100 h-100 justify-content-start mx-1 mx-sm-1 listContainer"></div>`);

var $taskList = $(`
<div class="taskListContainer mx-1">
    <div class="taskList shadow bg-light rounded">
        <div class="taskListProperties d-none">
            <span class="taskListId"></span>
        </div>
        <section class="taskListTitle hide-on-blur text-left p-2">
            <a class="float-right dashboardListBtnClose p-1 btn btn-sm elementToHide m-1 text-white align-self-center">
                <i class="fa fa-times"></i>
            </a>
            <p class="mb-0 ml-3 taskListTitleText text-white">Titulo 1</p>
        </section>
        <div class="taskListItemsContainer px-2 pt-2 mb-3 " ondragover="event.preventDefault()">
        </div>
        <div class="pb-3 taskListInputContainer">
            <div class="col d-flex taskListInputRow">
                <div class="input-group md-form my-0 taskListInputGroup">
                    <input type="text" class="form-control taskListInput text-white" placeholder="Title">
                    <div class="input-group-append taskListInputBtnContainer">
                        <button class="btn addTask btn-sm btn-primary m-0 taskListInputBtn">+</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>`);

var $referenceTaskList = $(`
<div class="taskListContainer mx-1">
    <div class="taskList shadow bg-light rounded">
        
    </div>
</div>`);

var $taskListItem = $(`
<div class="taskListItem card mb-2" draggable="true" draggable="true">
    <div class="taskListItemBody hide-on-blur text-white hide card-body px-2 py-1">
        <p class="card-text taskListItemTitle m-0">project description.</p>
        <a class="position-absolute dashboardBtnEdit p-1 btn btn-sm elementToHide right-0 m-1 top-0 text-white align-self-center">
            <i class="fa fa-times"></i>
        </a>
        <a class="position-absolute dashboardBtnClose p-1 btn btn-sm elementToHide right-0 m-1 top-0 text-white align-self-center">
            <i class="fa fa-times"></i>
        </a>
    </div>
</div>`);

var $referenceTaskListItem = $(`<div class="taskListItem taskListItemReference card mb-2" draggable="true">
                        <div class="card-body px-2 py-1 taskListItemBody">
                            <p class="card-text taskListItemTitle text-transparent">&nbsp;</p>
                        </div>

                    </div>`);

var $dashboardModal = $(`
<div>
    <div class="col text-left">
    <span class="float-left my-auto mr-2 align-self-center fa fa-pencil h3" style="font-size: 1.75rem !important;"></span><h3 class="dashboardModalTitle" contenteditable="true">Task title</h3>
        <small class="dashboardModalListNameContainer text-muted">in list <a href=""
                class="dashboardModalListName">list</a></small>
        <div class="row">
            <div class="col-sm-8 order-2 order-sm-1">
                <h4 class="dashboardModalDescriptionTitle"><span class="fa fa-align-justify mr-2"></span>Description</h4>
                <div class="md-form my-0">
                    <textarea id="dashboardModalDescription" class="md-textarea form-control text-white" rows="3"></textarea>
                    <label for="dashboardModalDescription">Descripción</label>
                </div>
                <div class="row dashboardModalSaveChanges">
                <button class="btn mx-auto btn-sm btn-primary dashboardModalBtnSaveChanges">Guardar cambios</button>
                </div>
                <h4 class="dashboardModalCommentsTitle"><span class="fa fa-comments mr-2"></span>Comments</h4>
                <div class="md-form input-group mb-4">
                    <input type="text" class="form-control text-white" id="comment">
                    <label for="comment" class="">Comment</label>
                    <div class="input-group-append">
                        <span class="input-group-text dashboardModalCommentBtn md-addon btn btn-sm btn-primary">Comment</span>
                    </div>
                </div>
                <div class="dashboardCommentsContainer overflow-y-auto overflow-x-hidden max-height-15"></div>
            </div>
            <div class="col-sm-4 order-1 order-sm-2">
                <div class="dashboardModalActions d-flex flex-column">
                    <div class="dashboardModalActionsTitle text-uppercase">Del equipo</div>
                    <div id="dashboardModalActionAssignation" class="dashboardModalAction text-dark btn btn-sm btn-default">Asignar</div>
                    <div id="dashboardModalActionRemoveAssignation" class="dashboardModalAction text-dark btn btn-sm btn-default">Quitar asignación</div>
                    <div id="dashboardModalActionMoveTask" class="dashboardModalAction text-dark btn btn-sm btn-default">Mover</div>
                    <div id="dashboardModalActionDetails" class="dashboardModalAction text-dark btn btn-sm btn-default">Ver detalles</div>
                </div>
                <div class="dashboardModalActions d-flex flex-column">
                    <div class="dashboardModalActionsTitle text-uppercase">Del tablero</div>
                    <div id="dashboardModalActionEnableDashboardItem" class="dashboardModalAction text-dark btn btn-sm btn-success">Habilitar tarea</div>
                    <div id="dashboardModalActionDisableDashboardItem" class="dashboardModalAction text-light btn btn-sm btn-danger">Deshabilitar tarea</div>
                    <div id="dashboardModalActionRemoveDashboardItem" class="dashboardModalAction text-light btn btn-sm btn-danger">Eliminar tarea</div>
                </div>
            </div>
        </div>
    </div>
</div>
`);
var $dashboardModalComment = $(`
<div class="w-100 dashboardComment my-2">
    <button class="btn btn-primary btn-sm align-self-center float-right btnEditComment">Cambiar</button>
    <img src="/daw/img/default.png" width="50"
        class="dashboardCommentUserImg rounded-pill float-left mr-2" />
    <div class="row dashboardCommentInformation mb-2">
        <div class="dashboardCommentUsername text-white mr-2">Test</div>
        <div class="dashboardCommentName text-white mr-2">Test</div>
        <div width="25" class="dashboardCommentTime text-muted">10 seconds ago</div>
    </div>
    <span class="dashboardCommentContent text-dark p-2 m-2 rounded w-auto bg-light" contenteditable="true">Test</span>
    <div class="row dashboardCommentActions text-white ml-2 mt-2">
        <a href="" class="dashboardCommentAction dashboardCommentEdit">Editar</a>
        &nbsp;-&nbsp;
        <a href="" class="dashboardCommentAction dashboardCommentDelete">Eliminar</a>
    </div>
</div>
`);

var $dashboardAssignationContainer = $(`<div class="dashboardAssignationContainer row"></div>`);
var $dashboardAssignationFinishedStateInput = $(`
<div class="custom-control w-auto text-right ml-auto custom-checkbox">
    <input type="checkbox" class="custom-control-input" name="finished" id="finished">
    <label class="custom-control-label" for="finished">Terminado</label>
</div>
`);
var $dashboardAssignation = $(`
<div class="w-auto dashboardAssignation text-white small ml-auto text-right p-1 mx-2 mb-2 mt-0 rounded">
    <span><i class="fa fa-clock-o"></i></span>
    <span class="startDate"></span>
    <span class="">&nbsp;-&nbsp;</span>
    <span class="endDate"></span>
</div>
`);

class Model {
    constructor() {
        this.projectId = this.getProjectId();
        this.title = this.getDashboardtitle().trim();
    }

    getProjectId() {
        var URL = window.location.href;
        var splittedURL = URL.split("/");

        return splittedURL[6];
    }

    getDashboardtitle() {
        var URL = window.location.href;
        var splittedURL = URL.split("/");

        return decodeURI(splittedURL[8]);
    }

    loadDashboardContent(whenFinished) {
        var model = this;
        $.ajax({
            url: "/daw/index.php?ctl=getListsOfDashboard",
            data: {
                "id_project": model.projectId,
                "dashboard": model.title,
            },
            success: function (dashboardElements) {
                model.dashboardElements = dashboardElements;
                model.workingdashboardElements = dashboardElements;
                whenFinished(dashboardElements);
            }
        });
    }

    addDashboardList(title, whenFinished) {
        var model = this;
        $.ajax({
            url: "/daw/index.php?ctl=createDashboardList",
            data: {
                "id_project": model.projectId,
                "dashboard_title": model.title,
                "title": title,
            },
            success: function (dashboardElements) {
                model.dashboardElements.push(dashboardElements);
                model.workingdashboardElements.push(dashboardElements);
                whenFinished(dashboardElements);
            }
        });
    }

    addDashboardItem(id_dashboard_list, title, whenFinished) {
        $.ajax({
            url: "/daw/index.php?ctl=createDashboardItem",
            data: {
                "id_dashboard_list": id_dashboard_list,
                "title": title,
            },
            success: function (dashboardItem) {
                /* model.dashboardElements.push(dashboardElements);
                model.workingdashboardElements.push(dashboardElements); */
                whenFinished(dashboardItem);
            }
        });
    }

    deleteDashboardItem(id, whenFinished) {
        $.ajax({
            url: "/daw/index.php?ctl=deleteDashboardItem",
            data: {
                "id": id,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    enableDashboardItem(id, enable, whenFinished) {
        $.ajax({
            url: "/daw/index.php?ctl=disableDashboardItem",
            data: {
                "id": id,
                "enabled": enable ? 1 : 0,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    deleteDashboardList(id, whenFinished) {
        $.ajax({
            url: "/daw/index.php?ctl=deleteDashboardList",
            data: {
                "id": id,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    deleteDashboard(whenFinished) {
        var model = this;
        $.ajax({
            url: "/daw/index.php?ctl=deleteDashboards",
            data: {
                "id_project": model.projectId,
                "title": model.title,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    createComment(id, comment, whenFinished) {
        var model = this;

        $.ajax({
            url: "/daw/index.php?ctl=createDashboardItemComments",
            data: {
                "id_dashboard_item": id,
                "comment": comment,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    deleteDashboardItemComments(id, whenFinished) {
        var model = this;

        $.ajax({
            url: "/daw/index.php?ctl=deleteDashboardItemComments",
            data: {
                "id": id,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    setAssignationFinishState(id, newState, whenFinished) {
        var model = this;

        $.ajax({
            url: "/daw/index.php?ctl=updateDashboardsItemAssignation",
            data: {
                "id": id,
                "finished": newState ? 1 : 0,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }
}

class View {
    constructor() {

    }

    initializeView(parent) {
        parent.append($taskListsContainer);

        $("#content").addClass("pt-2 h-100");
        this.visualizeTaskListCreation($taskListsContainer);
    }

    visualizeTaskListCreation(container) {
        var taskListInput = $taskList.clone();

        taskListInput.prop("id", "taskListInputCreation");
        taskListInput.find(".taskListTitle").remove();
        taskListInput.find(".taskListItemsContainer").remove();
        taskListInput.find(".taskListProperties").remove();
        taskListInput.find(".taskListInputGroup")
            .addClass("mt-3 mb-1").removeClass("my-0");

        container.append(taskListInput);

        return taskListInput;
    }

    visualizeTaskList(json, items = []) {
        var clonedTaskList = $taskList.clone();

        console.log(json.id, json.title, items);

        var view = this;

        clonedTaskList.find(".taskListId").text(json.id);
        clonedTaskList.find(".taskListTitleText").text(json.title);
        json["html"] = clonedTaskList;

        $("#taskListInputCreation").before(clonedTaskList);

        return clonedTaskList;
    }

    visualizeDashboardAssignation(taskItem, start_date, end_date, finished) {
        var clonedAssignation = $dashboardAssignation.clone();

        var startDateInDate = new DateUtils(start_date).date;
        var endDateInDate = new DateUtils(end_date).date;
        clonedAssignation.find(".startDate").text(
            new DateUtils(start_date).printDateStylish()
        );
        clonedAssignation.find(".endDate").text(
            new DateUtils(end_date).printDateStylish()
        );

        var className = "inTime";

        var currentDate = DateUtils.getCurrentDateTime();

        if (finished != 0) {
            className = "green";
        } else if (new DateUtils(currentDate).compareTo(startDateInDate) == -1 ||
            new DateUtils(currentDate).compareTo(endDateInDate) == 1) {
            className = "red";
        }

        clonedAssignation.addClass(className);
        taskItem.append(clonedAssignation);

        return clonedAssignation;
    }

    visualizeTaskListItem(taskList, json) {
        var clonedTaskListItem = $taskListItem.clone();

        clonedTaskListItem.find(".taskListItemTitle").text(json.title);

        if (json.assigned === true) {
            this.visualizeDashboardAssignation(clonedTaskListItem, json.start_date, json.end_date, json.finished);
        }

        json["html"] = clonedTaskListItem;
        taskList.find(".taskListItemsContainer").append(clonedTaskListItem);

        return clonedTaskListItem;
    }

    //Reference - https://kryogenix.org/code/browser/custom-drag-image.html
    addGhostImage(e, taskItem, nodeToClone, addClass = "dragging") {
        var crt = nodeToClone.cloneNode(true);

        var currentHeight = taskItem.height();
        var currentWidth = taskItem.width();

        $("body").append(
            $(crt).css({
                position: "absolute",
                width: `${currentWidth}px`,
                height: `${currentHeight}px`,
                opacity: `100%`,
            }).addClass(addClass)
        );
        e.dataTransfer.setDragImage(crt, currentWidth, currentHeight);
        return crt;
    }

    scrollTo(element) {
        $(element).get(0).scrollIntoView({
            behavior: "smooth",
            block: 'nearest',
            inline: 'start'
        });
    }

    visualizeModalComment(container, commentData) {
        var clonedComment = $dashboardModalComment.clone();

        clonedComment.find(".dashboardCommentName").text(commentData.commentCreatorName);
        var commentUsername = commentData.commentCreatorUsername;
        clonedComment.find(".dashboardCommentUsername").text(commentData.commentCreatorUsername);
        clonedComment.find(".dashboardCommentUserImg").prop("src", `/daw/img/users/${commentUsername}/${commentUsername}.png`);

        var commentDate = commentData.commentDate;
        var commentTimeHTML = clonedComment.find(".dashboardCommentTime");
        commentTimeHTML.text(new DateUtils(commentDate).getTimeFromThisMoment());
        commentTimeHTML.append(`<span class="originalDate d-none">${commentDate}</span>`);
        setInterval(() => {
            //console.log(getTimeFromThisMoment(commentDate));
            commentTimeHTML.text(new DateUtils(commentDate).getTimeFromThisMoment());
        }, 3 * 1000);

        clonedComment.find(".dashboardCommentContent").html(decodeURI(commentData.comment));
        container.prepend(clonedComment);

        return clonedComment;
    }
}

var startingTaskListParent = null;
var startingTaskListData = null;
var startingIndex = 0;
var endingTaskListParent = null;
var endingTaskListData = null;
var endingIndex = 0;
var taskItemMovedData = 0;

var mousedown = false;

class Controller {
    constructor(model, view) {
        this.model = model;
        this.view = view;
        var controller = this;

        var mainContainer = $("#content");

        view.initializeView(mainContainer);

        $("#taskListInputCreation").find(".taskListInputBtn").on("click", function (event) {
            var event = event || window.event;
            controller.taskListInputCreationEvent(event, controller);
        });
        $("#taskListInputCreation").find(".taskListInput").on("keypress", function (event) {
            var event = event || window.event;
            if (event.keyCode == 13) {
                controller.taskListInputCreationEvent(event, controller);
            }
        });

        controller.model.loadDashboardContent(function (dashboardElements) {
            if (dashboardElements === false) {
                return;
            }

            console.log(dashboardElements);

            $(dashboardElements).each(function () {
                var taskList = controller.createTaskList(controller, this);

                var items = this.items;

                if (items != undefined) {
                    if (items.length > 0) {
                        $(items).each(function () {
                            controller.createTaskItem(controller, taskList, this);
                        });
                    }
                }
            });
        });

        controller.moveScrollWithMouse();

        $(".dashboardBtnDelete").on("click", function (event) {
            controller.deleteDashboardEvent(controller, event);
        });
    }

    deleteDashboardEvent(controller, event) {
        var confirmationModal = Modal.confirmationModal({
            title: "¿Borrar el tablero?",
            body: `Confimar esta acción y borrar <b>"${controller.model.title}"</b>`,
            onAccept: function () {
                controller.model.deleteDashboard(function (result) {
                    console.log(result);
                    if (result === true) {
                        Modal.specialAlert({
                            title: `Se ha borrado el tablero <b>"${controller.model.title}"</b>`,
                            error: false,
                            onClose: function () {
                                window.location.reload();
                            },
                        });
                    } else {
                        Modal.specialAlert({
                            title: `No se ha podido borrar el tablero <b>"${controller.model.title}"</b>`,
                            error: true,
                        });
                    }
                })
            },
        });
    }

    moveScrollWithMouse(increment = 5) {
        var originalPosition;
        var scrollID = 0;
        var main = $(".listContainer");
        main.on("mousedown", function (event) {
            var event = event || window.event;
            mousedown = true;
            originalPosition = event.pageX;
            $(this).addClass("cursor-grabbing");
        }).on("mouseup", function (event) {
            var event = event || window.event;
            $(this).removeClass("cursor-grabbing");
            mousedown = false;
        }).on("mousemove", function (event) {
            var event = event || window.event;
            var newPosition = event.pageX;
            if (mousedown) {
                //clearTimeout(scrollID);
                //scrollID = setTimeout(() => {
                main.scrollLeft(main.scrollLeft() + (originalPosition - newPosition) * 0.5);
                //}, 5);
            }
        });
    }

    taskListInputCreationEvent(event, controller) {
        //var taskListAddContainer = $("#taskListInputCreation");
        var taskListAddInput = $("#taskListInputCreation").find(".taskListInput");

        var newTaskListTitle = taskListAddInput.val();
        if (newTaskListTitle.length < 3) {
            sendNotification("Task list title must have at least 3 characters", "taskListTitleTooShort");
            return;
        }
        controller.onTaskListCreation(controller, newTaskListTitle, function (result) {
            if (result !== false) {
                var taskList = controller.createTaskList(controller, result);
                //controller.view.scrollTo(taskListAddContainer);

                taskListAddInput.val("");
                sendNotification("Se ha añadido la lista \"" + newTaskListTitle + "\"", "dashboardListCouldBeCreated" + newTaskListTitle);
            } else {
                sendNotification("No se ha podido crear la lista \"" + newTaskListTitle + "\"", "dashboardListCouldNotBeCreated" + newTaskListTitle);
                return;
            }
        });
    }

    onTaskListCreation(controller, newTaskListTitle, whenFinished) {
        console.log(newTaskListTitle, controller);
        controller.model.addDashboardList(newTaskListTitle, function (result) {
            whenFinished(result);
        });
    }

    onTaskItemMoved(movedData) {
        console.log(movedData);

        if (movedData["endingIndex"] == movedData["startingIndex"] &&
            movedData["endingTaskList"]["id"] == movedData["startingTaskList"]["id"]) {
            sendNotification("La posición es la misma", "taskItemMoveSamePosition");
            return;
        }

        var newOrder = movedData["endingIndex"];
        var taskListID = movedData["endingTaskList"]["id"];
        /* 
                $.ajax({
                    //rearrange order
                    url: "/daw/index.php?ctl=updateOrderInDashboardList",
                    data: {
                        order: newOrder,
                        id_dashboard_list: taskListID,
                    },
                    success: function (result) {
        console.log("updatedOrder", result); */
        $.ajax({
            url: "/daw/index.php?ctl=updateDashboardItem",
            data: {
                "order": newOrder,
                "id_dashboard_list": taskListID,
                "id": movedData["taskItem"]["id"],
                "moveForward": movedData["endingIndex"] > movedData["startingIndex"] ? 1 : 0,
            },
            success: function (result) {
                console.log("mover de lista", result);
            }
        });
        /*     }
        })
 */
    }

    createTaskList(controller, taskListData) {
        var controllerView = controller.view;
        var taskList = controllerView.visualizeTaskList(taskListData);

        taskList.find(".taskListInputBtn").on("click", function () {
            var event = event || window.event;
            controller.taskListItemCreation(event, controller, taskList, taskListData);
        });

        taskList.find(".taskListInput").on("keypress", function (event) {
            var event = event || window.event;
            if (event.keyCode == 13) {
                controller.taskListItemCreation(event, controller, taskList, taskListData);
            }
        });

        taskList.on("dragover", function () {
            if ($referenceTaskListItem.is(":visible")) {
                var itemsContainer = taskList.find(".taskListItemsContainer");
                $referenceTaskListItem.show();

                endingTaskListData = taskListData;

                var totalTaskListItems = itemsContainer.children(".taskListItem").length;

                if (totalTaskListItems == 0) {
                    endingIndex = 1;
                    itemsContainer.append($referenceTaskListItem);
                }
            }
        }).on("dragend", function () {
            console.log("se llama", taskListData);
            startingTaskListData = taskListData;

            controller.onTaskItemMoved({
                "startingTaskList": startingTaskListData,
                "startingIndex": startingIndex,
                "endingTaskList": endingTaskListData,
                "endingIndex": endingIndex + 1,
                "taskItem": taskItemMovedData,
            });
        });

        taskList.find(".dashboardListBtnClose").on("click", function (event) {
            var event = event || window.event;
            event.stopPropagation();

            var confirmationModal = Modal.confirmationModal({
                title: "¿Borrar el lista?",
                body: `Confimar esta acción y borrar <b>"${taskListData.title}"</b>`,
                onAccept: function () {
                    controller.model.deleteDashboardList(taskListData.id, function (result) {
                        console.log(result);
                        if (result === true) {
                            taskList.remove();
                            Modal.specialAlert({
                                title: `"${taskListData.title}" ha sido borrado con éxito`,
                                error: false,
                            });
                        } else {
                            Modal.specialAlert({
                                title: `"${taskListData.title}" no se ha podido borrar`,
                                error: true,
                            });
                        }
                    })
                },
            });
        })

        return taskList;
    }

    taskListItemCreation(event, controller, taskList, taskListData) {
        var taskListInput = taskList.find(".taskListInput");

        var taskListItemValue = taskListInput.val();
        if (taskListItemValue.length < 3) {
            sendNotification("Task list item title must have at least 3 characters", "taskListItemTooShort");
            return;
        }

        console.log(taskList);

        controller.onTaskListItemCreation(controller, taskListData, taskListItemValue, function (result) {
            if (result !== false) {
                var taskItem = controller.createTaskItem(controller, taskList, result);

                taskListInput.val("");
                sendNotification("Se ha añadido el item \"" + taskListItemValue + "\"", "dashboardItemCouldBeCreated" + taskListItemValue);
            } else {
                sendNotification("No se ha podido crear el item \"" + taskListItemValue + "\"", "dashboardItemCouldNotBeCreated" + taskListItemValue);
                return;
            }
        });

    }

    onTaskListItemCreation(controller, taskListData, title, whenFinished) {
        controller.model.addDashboardItem(taskListData.id, title, function (dashboardItem) {
            whenFinished(dashboardItem);
        });
    }

    createTaskItem(controller, taskList, taskItemData) {
        var controllerView = controller.view;
        var taskItem = controllerView.visualizeTaskListItem(taskList, taskItemData);

        var draggingTaskItem = taskItem;

        taskItem.prop("draggable", true);

        var ghostImage = null;

        ({
            ghostImage,
            draggingTaskItem
        } = controller.addTaskItemDragginEvents(taskItem, ghostImage, controllerView, draggingTaskItem, taskItemData));

        taskItem.find(".dashboardBtnClose").on("click", function (event) {
            var event = event || window.event;
            controller.addTaskItemRemoveEvent(event, taskItemData, controller, taskItem);
        })

        taskItem.on("click", function (event) {
            var event = event || window.event;
            event.stopPropagation();

            Modal.modal({
                "title": "",
                "content": $dashboardModal.html(),
                "onOpen": function (modal) {

                    controller.onOpenDashboardModal(modal, taskItemData, taskItem, controller);
                    controller.view.scrollTo(taskItem);
                },
                "onClose": function () {
                    controller.view.scrollTo(taskItem);
                },
            });
        });

        return taskItem;
    }

    addTaskItemRemoveEvent(event, taskItemData, controller, taskItem, whenFinished) {
        event.stopPropagation();
        console.log(taskItemData.id_dashboard_list);
        var confirmationModal = Modal.confirmationModal({
            title: "¿Borrar elemento de la lista?",
            body: `Confimar esta acción y borrar <b>"${taskItemData.title}"</b>`,
            onAccept: function () {
                controller.model.deleteDashboardItem(taskItemData.id, function (result) {
                    console.log(result);
                    if (result === true) {
                        taskItem.remove();
                        var modalSuccess = Modal.specialAlert({
                            title: `"${taskItemData.title}" ha sido borrado con éxito`,
                            error: false,
                        });
                        whenFinished();
                    } else {
                        Modal.specialAlert({
                            title: `"${taskItemData.title}" no se ha podido borrar`,
                            error: true,
                        });
                    }
                });
            },
        });
    }

    addTaskItemDragginEvents(taskItem, ghostImage, controllerView, draggingTaskItem, taskItemData) {
        taskItem.on("dragstart", function (event) {
            mousedown = false;
            var event = event.originalEvent || window.event;
            var currentTaskItem = $(this);
            ghostImage = controllerView.addGhostImage(event, currentTaskItem, this);
            startingIndex = currentTaskItem.index() + 1;
            draggingTaskItem = currentTaskItem;
            taskItemMovedData = taskItemData;
            startingTaskListParent = currentTaskItem.parents(".taskList");
            $referenceTaskListItem.find(".taskListItemTitle").html(draggingTaskItem.text());
            console.log("Empieza");
        }).on("drop", function () {
            console.log("Se suelta");
        }).on("dragover", function () {
            var currentTaskItem = $(this);
            $referenceTaskListItem.show();
            var index = currentTaskItem.index();
            if (index == 0) {
                currentTaskItem.before($referenceTaskListItem);
                endingIndex = 0;
            } else {
                if (index > 1) {
                    endingIndex = -1;
                }
                currentTaskItem.after($referenceTaskListItem);
            }
        }).on("dragend", function () {
            var currentTaskItem = $(this);
            currentTaskItem.removeClass("dragging");
            $referenceTaskListItem.hide();
            endingTaskListParent = $referenceTaskListItem.parents(".taskList");
            endingIndex += $referenceTaskListItem.index();
            if (ghostImage != null) {
                ghostImage.remove();
            }
            $referenceTaskListItem.before(taskItem);
        });
        return {
            ghostImage,
            draggingTaskItem
        };
    }

    onOpenDashboardModal(modal, taskItemData, taskItem, controller) {
        console.log(taskItemData);

        var inputs = $("input, textarea");
        inputs.focus();
        inputs.first().focus();
        inputs.first().blur();
        console.log(inputs);

        if (taskItemData.assigned === true) {
            this.dashboardModalAssignedTask(taskItemData, controller, taskItem);
        }

        $(".dashboardModalTitle").text(taskItemData.title);
        $("#dashboardModalDescription").text(taskItemData.description)
            .focus().blur();
        $("#description.md-textarea").html(`${taskItemData.description}`);
        var commentsContainer = $(".dashboardCommentsContainer");
        $(".dashboardModalCommentBtn").on("click", function () {
            controller.createModalCommentEvent(taskItemData, controller, commentsContainer);
        });
        //comments
        $.ajax({
            url: "/daw/index.php?ctl=getCommentsOfDashboardItem",
            data: {
                "id_dashboard_item": taskItemData.id,
            },
            success: function (result) {
                if (result !== false) {
                    commentsContainer.html("");
                    $(result).each(function () {
                        var commentJSON = this;
                        console.log(commentJSON);
                        controller.createComment(controller, commentJSON, commentsContainer);
                    });
                }
            }
        });

        $(".dashboardModalSaveChanges").hide();
        $(".dashboardModalTitle, #dashboardModalDescription").on("keyup input blur paste", function () {
            console.log("evento input", $(".dashboardModalTitle").text(), taskItemData.title != $(".dashboardModalTitle").text() ||
                taskItemData.description != $("#dashboardModalDescription").val());
            if (taskItemData.title != $(".dashboardModalTitle").text() ||
                taskItemData.description != $("#dashboardModalDescription").val()) {
                $(".dashboardModalSaveChanges").show();
            } else {
                $(".dashboardModalSaveChanges").hide();
            }
        });

        $("#dashboardModalActionAssignation").on("click", function (event) {
            controller.dashboardAssignationModalEvent(controller, taskItemData);
        });

        $("#dashboardModalActionRemoveDashboardItem").on("click", function (event) {
            controller.addTaskItemRemoveEvent(event, taskItemData, controller, taskItem, function () {
                modal.close();
            });
        });

        $("#dashboardModalActionRemoveAssignation").on("click", function (event) {
            controller.removeDashboardAssignationModalEvent(controller, taskItemData);
        });

        $("#dashboardModalActionDetails").on("click", function (event) {
            $.ajax({
                url: "/daw/index.php?&ctl=getDashboardItemDetails",
                data: {
                    "id": taskItemData.id,
                },
                success: function (result) {
                    console.log("details", result);
                    if (result !== false) {
                        Modal.modal({
                            "title": `Detalles de ${taskItemData.title}`,
                            "content": `<div class="row">
                            <p>Creado por <a href="/daw/profile/${result.username}" class="dashboardItemCreator">${result.fullname}</a></p>
                            <p class="dashboardItemCreationDate ml-auto"></p>
                            <p class="dashboardItemCreationDateOriginal ml-2 text-muted"></p>
                        </div>`,
                            "onOpen": function (modal) {
                                var creationDateContainer = $(".dashboardItemCreationDate");
                                var originalDate = result.creation_date;
                                $(".dashboardItemCreationDateOriginal").text(`Fecha completa: ${originalDate}`);
                                creationDateContainer.text(
                                    new DateUtils(originalDate).getTimeFromThisMoment()
                                );
                            }
                        });
                    } else {
                        sendNotification("No se han podido extraer los detalles", "dashboardItemDetailsFail");
                    }
                }
            })
        });

        if (taskItemData.enabled != 0) {
            $("#dashboardModalActionDisableDashboardItem").show();
            $("#dashboardModalActionEnableDashboardItem").hide();
            taskItem.remove();
        } else {
            $("#dashboardModalActionDisableDashboardItem").hide();
            $("#dashboardModalActionEnableDashboardItem").show();
        }

        $("#dashboardModalActionDisableDashboardItem").on("click", function (event) {
            controller.dashboardModalActionDisableDashboardItemEvent(event, taskItemData, controller, taskItem, function () {
                //modal.close();

                console.log("segundo", taskItemData.enabled);

                if (taskItemData.enabled != 0) {
                    $("#dashboardModalActionDisableDashboardItem").show();
                    $("#dashboardModalActionEnableDashboardItem").hide();
                    taskItem.remove();
                } else {
                    $("#dashboardModalActionDisableDashboardItem").hide();
                    $("#dashboardModalActionEnableDashboardItem").show();
                }
            });
        });

        $("#dashboardModalActionEnableDashboardItem").on("click", function (event) {
            controller.dashboardModalActionDisableDashboardItemEvent(event, taskItemData, controller, taskItem, function () {
                //modal.close();

                if (taskItemData.enabled != 0) {
                    $("#dashboardModalActionDisableDashboardItem").show();
                    $("#dashboardModalActionEnableDashboardItem").hide();
                    taskItem.remove();
                } else {
                    $("#dashboardModalActionDisableDashboardItem").hide();
                    $("#dashboardModalActionEnableDashboardItem").show();
                }
            });
        });

        $(".dashboardModalBtnSaveChanges").on("click", function (event) {
            var event = event || window.event;
            var currentBtn = $(this);

            controller.dashboardSaveChangesEvent(taskItemData);
        });

        $("#comment").on("keypress", function (event) {
            console.log(event.keyCode);
            if (event.keyCode == 13) {
                controller.createModalCommentEvent(taskItemData, controller, commentsContainer)
            }
        });
    }

    dashboardModalActionDisableDashboardItemEvent(event, taskItemData, controller, taskItem, whenSuccess) {
        event.stopPropagation();
        var bool = taskItemData.enabled != 0 ? true : false;
        console.log(taskItemData.id_dashboard_list);
        var confirmationModal = Modal.confirmationModal({
            title: "Deshabilitar elemento de la lista?",
            body: `Confimar esta acción y deshabilitar <b>"${taskItemData.title}"</b>`,
            onAccept: function () {
                controller.model.enableDashboardItem(taskItemData.id, !bool, function (result) {
                    console.log(result);
                    if (result === true) {
                        taskItemData.enabled = !bool ? 1 : 0;
                        console.log("primero", taskItemData.enabled);
                        var modalSuccess = Modal.specialAlert({
                            title: `"${taskItemData.title}" ha sido deshabilitado con éxito`,
                            error: false,
                        });
                        whenSuccess();
                    } else {
                        Modal.specialAlert({
                            title: `"${taskItemData.title}" no se ha podido deshabilitar`,
                            error: true,
                        });
                    }
                });
            },
        });
    }

    dashboardSaveChangesEvent(taskItemData) {
        var title = $(".dashboardModalTitle").text();
        var description = $("#dashboardModalDescription").val();
        $.ajax({
            url: "/daw/index.php?ctl=updateDashboardItem",
            data: {
                "id": taskItemData.id,
                "title": title,
                "description": description,
            },
            success: function (result) {
                console.log("modificar Detalles", result);
                if (result !== false) {
                    console.log(taskItemData);
                    taskItemData.title = title;
                    taskItemData.description = description;
                    taskItemData.html.find(".taskListItemTitle").text(taskItemData.title);
                    $(".dashboardModalSaveChanges").hide();
                } else {
                    sendNotification("No se han podido cambiar los detalles", "changeTaskItemDetailsFail");
                }
            }
        });
    }

    dashboardAssignationModalEvent(controller, taskItemData) {
        var modal = Modal.modal({
            "title": "Asignar tarea",
            "content": `<form action="/daw/index.php?ctl=createDashboardItemAssignation" id="formAssignDashboard" class="col-sm-10  p-3 mx-auto" method="POST">
                            <div class="form-row">
                                <div class="md-form input-group col-sm">
                                    <input type="text" name="startDate" id="startDate" class="form-control text-white" aria-describedby="startDateTime">
                                    <label for="startDate">Fecha inicio</label>
                                    <div class="input-group-append">
                                        <input type="time" name="startDateTime" id="startDateTime">
                                    </div>
                                </div>
                                <div class="md-form input-group col-sm">
                                    <input type="text" name="endDate" id="endDate" class="form-control text-white" aria-describedby="endDateTime">
                                    <label for="endDate">Fecha límite</label>
                                    <div class="input-group-append">
                                        <input type="time" name="endDateTime" id="endDateTime">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row userSearchContainer"></div>
                            <input type="hidden" name="id_project" value="${controller.model.projectId}" >
                            <div class="row m-0 d-flex justify-content-center align-content-center align-items-center justify-items-center">
                                <input class="btn btn-primary w-100" type="submit" name="createDashboard" id="createDashboard" value="Asginar tarea">
                            </div>
                        </form>`,
            "onOpen": function () {

                var startDate = $("#startDate");
                startDate.focus();
                startDate.val(new DateUtils(new Date(), false).printDateWithFormat("Y-m-d h:i:s"));

                var newDate = new Date();
                newDate.setDate(newDate.getDate() + 20);

                var endDate = $("#endDate");
                endDate.focus();
                endDate.blur();
                endDate.val(new DateUtils(newDate, false).printDateWithFormat("Y-m-d h:i:s"));

                var userSearch = new UserSearchInput($(".userSearchContainer"));
                userSearch.input.addClass("text-white");
                $("#formAssignDashboard").on("submit", function (event) {
                    var event = event || window.event;
                    event.preventDefault();

                    var startDateVal = startDate.val();
                    var endDateVal = endDate.val();
                    var username = userSearch.input.val();

                    $.ajax({
                        url: "/daw/index.php?ctl=createDashboardsItemAssignation",
                        data: {
                            "id_dashboard_item": taskItemData.id,
                            "start_date": startDateVal,
                            "end_date": endDateVal,
                            "assigned_to": username,
                        },
                        success: function (result) {
                            console.log(result);
                            if (result !== false) {
                                sendNotification("Se ha asignato con éxito", "assignateTaskSuccess");
                                modal.close();
                            } else {
                                sendNotification("No se ha podido asignar", "assignateTaskFail");
                            }
                        }
                    });
                    return false;
                });
            },
        });
    }

    removeDashboardAssignationModalEvent(controller, taskItemData) {
        var modal = Modal.modal({
            "title": "Asignar tarea",
            "content": `<form action="/daw/index.php?ctl=deleteDashboardItemAssignation" id="formRemoveAssignation" class="col-sm-10  p-3 mx-auto" method="POST">
                            <div class="form-row userSearchContainer"></div>
                            <input type="hidden" name="id_project" value="${controller.model.projectId}" >
                            <div class="row m-0 d-flex justify-content-center align-content-center align-items-center justify-items-center">
                                <input class="btn btn-primary w-100" type="submit" name="removeAssignation" id="removeAssignation" value="Quitar asignación">
                            </div>
                        </form>`,
            "onOpen": function () {
                var userSearch = new UserSearchInput($(".userSearchContainer"));
                userSearch.input.addClass("text-white");
                $("#formRemoveAssignation").on("submit", function (event) {
                    var event = event || window.event;
                    event.preventDefault();

                    var username = userSearch.input.val();

                    $.ajax({
                        url: "/daw/index.php?ctl=deleteDashboardsItemAssignation",
                        data: {
                            "id_dashboard_item": taskItemData.id,
                            "assigned_to": username,
                        },
                        success: function (result) {
                            console.log(result);
                            if (result !== false) {
                                sendNotification("Se ha quitado la asignación", "removeAssignationTaskSuccess");
                                modal.close();
                            } else {
                                sendNotification("No se ha quitar la asignación", "removeAssignationTaskFail");
                            }
                        }
                    });
                    return false;
                });
            },
        });
    }

    dashboardModalAssignedTask(taskItemData, controller, taskItem) {
        console.log("FUNCIONA", taskItemData);
        console.log($dashboardAssignationContainer);

        $dashboardAssignationContainer.html("");
        $dashboardAssignationContainer.append($dashboardAssignationFinishedStateInput);
        $dashboardAssignationFinishedStateInput.addClass("mr-auto align-self-center");

        var assignationItem = controller.view.visualizeDashboardAssignation(
            $dashboardAssignationContainer,
            taskItemData.start_date,
            taskItemData.end_date,
            taskItemData.finished
        );
        assignationItem.removeClass("ml-auto");

        var assignationCheckbox = $dashboardAssignationFinishedStateInput.find(":checkbox");
        assignationCheckbox.prop("checked", taskItemData.finished != 0);
        assignationCheckbox.unbind("change");
        assignationCheckbox.on("change", function () {
            assignationItem = this.dashboardAssignationModalCheckboxEvent(assignationCheckbox, controller, taskItemData, taskItem, assignationItem);
        });

        console.log("test", assignationCheckbox);
        $("#dashboardModalDescription").after($dashboardAssignationContainer);
    }

    dashboardAssignationModalCheckboxEvent(assignationCheckbox, controller, taskItemData, taskItem, assignationItem) {
        console.log("AQUI", assignationCheckbox.is(":checked"));
        var checkboxValue = assignationCheckbox.is(":checked");
        controller.model.setAssignationFinishState(taskItemData.assignation_id, checkboxValue, function (result) {
            console.log(result);
            if (result !== false) {
                taskItemData.finished = checkboxValue;
                sendNotification("Se ha cambiado el estado", "changeFinishStatusSuccess");
                taskItem.find(".dashboardAssignation").remove();
                controller.view.visualizeDashboardAssignation(taskItem, taskItemData.start_date, taskItemData.end_date, taskItemData.finished);
                assignationItem.remove();
                assignationItem = controller.view.visualizeDashboardAssignation($dashboardAssignationContainer, taskItemData.start_date, taskItemData.end_date, taskItemData.finished);
                assignationItem.removeClass("ml-auto");
            } else {
                sendNotification("No se ha podido cambiar el estado", "changeFinishStatusFail");
            }
        });
        return assignationItem;
    }

    createModalCommentEvent(taskItemData, controller, commentsContainer) {
        var commentInput = $("#comment");
        controller.model.createComment(taskItemData.id, commentInput.val(), function (result) {
            console.log(result);
            if (result !== false) {
                controller.createComment(controller, result, commentsContainer);
            } else {
                sendNotification("No se ha podido añadir el comentario", "dashboardModalCommentNotAdded");
            }
        });
        commentInput.val("");
    }

    createComment(controller, commentJSON, container) {
        var clonedComment = controller.view.visualizeModalComment(container, commentJSON);

        clonedComment.find(".dashboardCommentDelete").on("click", function (event) {
            controller.deleteCommentEvent(controller, event, commentJSON, clonedComment);
        });

        var btnEditComment = clonedComment.find(".btnEditComment");
        btnEditComment.hide();
        clonedComment.find(".dashboardCommentEdit").on("click", function (event) {
            var event = event || window.event;
            event.preventDefault();

            btnEditComment.show();

            return false;
        });

        btnEditComment.on("click", function () {
            var commentContent = encodeURI(clonedComment.find(".dashboardCommentContent").html());

            $.ajax({
                url: "/daw/index.php?ctl=updateDashboardItemComments",
                data: {
                    "id": commentJSON.id,
                    "comment": commentContent,
                },
                success: function (result) {
                    console.log("cambiar comentario", commentJSON.id, result);
                    if (result !== false) {
                        btnEditComment.hide();
                    } else {

                    }
                }
            });
        });

        return clonedComment;
    }

    deleteCommentEvent(controller, event, commentJSON, clonedComment) {
        var event = event || window.event;
        event.preventDefault();
        var creationDate = clonedComment.find(".originalDate").text().trim();

        var confirmationModal = Modal.confirmationModal({
            title: "¿Borrar el comentario?",
            body: `Esta acción no tiene marcha atrás`,
            onAccept: function () {
                controller.model.deleteDashboardItemComments(commentJSON.id, function (result) {
                    console.log(result);
                    if (result === true) {
                        clonedComment.remove();
                        Modal.specialAlert({
                            title: `El comentario se ha borrado con éxito`,
                            error: false,
                        });
                    } else {
                        Modal.specialAlert({
                            title: `No se ha podido borrar el comentario`,
                            error: true,
                        });
                    }
                })
            },
        });

        return false;
    }

    parseTaskListToJSON() {

    }

    parseTaskListItemToJSON() {

    }
}

const tasksController = new Controller(
    new Model(),
    new View()
);