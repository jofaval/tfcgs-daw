var $taskListsContainer = $(`<div class="d-flex overflow-scroll w-100 h-100 justify-content-start mx-1 mx-sm-1 listContainer"></div>`);

var $taskList = $(`
<div class="taskListContainer mx-1">
    <div class="taskList shadow grey lighten-3 rounded">
        <div class="taskListProperties d-none">
            <span class="taskListId"></span>
        </div>
        <section class="taskListTitle grey lighten-3 text-dark hide-on-blur text-left p-2">
            <a class="float-right dashboardListBtnClose p-1 btn btn-sm elementToHide m-1 text-dark align-self-center">
                <i class="fa fa-times"></i>
            </a>
            <p class="mb-0 ml-3 taskListTitleText">Titulo 1</p>
        </section>
        <div class="taskListItemsContainer px-2 pt-2 mb-3 " ondragover="event.preventDefault()">
        </div>
        <div class="pb-3 taskListInputContainer">
            <div class="col d-flex taskListInputRow">
                <div class="input-group md-form my-0 taskListInputGroup">
                    <input type="text" class="form-control taskListInput text-dark" placeholder="Título">
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
<div class="taskListItem grey lighten-4 card mb-2" draggable="true" draggable="true">
    <div class="taskListItemBody hide-on-blur  grey lighten-4 text-dark hide card-body px-2 py-1">
        <p class="card-text taskListItemTitle m-0">project description.</p>
        <a class="position-absolute dashboardBtnEdit p-1 btn btn-sm elementToHide right-0 m-1 top-0 text-dark align-self-center">
            <i class="fa fa-times"></i>
        </a>
        <a class="position-absolute dashboardBtnClose p-1 btn btn-sm elementToHide right-0 m-1 top-0 text-dark align-self-center">
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
        <small class="dashboardModalListNameContainer text-muted">en la lista <a href=""
                class="dashboardModalListName">list</a></small>
        <div class="row">
            <div class="col-sm-8 order-2 order-sm-1">
                <h4 class="dashboardModalDescriptionTitle"><span class="fa fa-align-justify mr-2"></span>Descripción</h4>
                <div class="md-form my-0">
                    <textarea id="dashboardModalDescription" class="md-textarea form-control text-dark" rows="3"></textarea>
                    <label for="dashboardModalDescription">Descripción</label>
                </div>
                <div class="row dashboardModalSaveChanges">
                <button class="btn mx-auto btn-sm btn-primary dashboardModalBtnSaveChanges">Guardar cambios</button>
                </div>
                <h4 class="dashboardModalCommentsTitle"><span class="fa fa-comments mr-2"></span>Comentarios</h4>
                <div class="md-form input-group mb-4">
                    <input type="text" class="form-control text-dark" id="comment">
                    <label for="comment" class="">Comentario</label>
                    <div class="input-group-append">
                        <span class="input-group-text dashboardModalCommentBtn md-addon btn btn-sm btn-primary">Comentar</span>
                    </div>
                </div>
                <div class="dashboardCommentsContainer overflow-y-auto overflow-x-hidden max-height-15"></div>
            </div>
            <div class="col-sm-4 order-1 order-sm-2">
                <div class="dashboardModalActions d-flex flex-column">
                    <div class="dashboardModalActionsTitle text-uppercase">Del equipo</div>
                    <div id="dashboardModalActionAssignation" class="dashboardModalAction text-dark btn btn-sm btn-default">Asignar</div>
                    <div id="dashboardModalActionModifyAssignation" class="dashboardModalAction text-dark btn btn-sm btn-default">Modificar asignación</div>
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
    <img src=EXECUTION_HOME_PATH + "img/default.png" width="50"
        class="dashboardCommentUserImg rounded-pill float-left mr-2" />
    <div class="row dashboardCommentInformation mb-2">
        <div class="dashboardCommentUsername text-dark mr-2">Test</div>
        <div class="dashboardCommentName text-dark mr-2">Test</div>
        <div width="25" class="dashboardCommentTime text-muted">10 seconds ago</div>
    </div>
    <span class="dashboardCommentContent text-dark p-2 m-2 rounded w-auto bg-light" contenteditable="true">Test</span>
    <div class="row dashboardCommentActions text-dark ml-2 mt-2">
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

        var URL = window.location.href;
        var splittedURL = URL.split("/");

        if (splittedURL.length >= 11) {
            this.taskIdFromURL = splittedURL[11];
        }

        if (URL.includes("#")) {
            this.listIdFromURL = URL.substr(URL.lastIndexOf("#") + 1);
        }
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
            url: EXECUTION_HOME_PATH + "index.php?ctl=getListsOfDashboard",
            data: {
                "id_project": model.projectId,
                "dashboard": model.title,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (dashboardElements) {
                model.dashboardElements = dashboardElements;
                model.workingdashboardElements = dashboardElements;
                whenFinished(dashboardElements);
            }
        });
    }

    findListWithId(id, whenFound) {
        var model = this;

        var dashboardLists = model.dashboardElements;
        for (const listKey in dashboardLists) {
            if (dashboardLists.hasOwnProperty(listKey)) {
                const listElement = dashboardLists[listKey];
                if (listElement.id == id) {
                    whenFound(listElement);
                    return;
                }
            }
        }
    }

    findDashboardItemWithId(id, whenFound) {
        var model = this;

        var dashboardLists = model.dashboardElements;
        for (const listKey in dashboardLists) {
            if (dashboardLists.hasOwnProperty(listKey)) {
                const listElement = dashboardLists[listKey];
                var itemsFromListElement = listElement.items;
                for (const taskKey in itemsFromListElement) {
                    if (itemsFromListElement.hasOwnProperty(taskKey)) {
                        const taskElement = itemsFromListElement[taskKey];
                        if (taskElement.id == id) {
                            whenFound(taskElement);
                            return;
                        }
                    }
                }
            }
        }
    }

    addDashboardList(title, whenFinished) {
        var model = this;
        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=createDashboardList",
            data: {
                "id_project": model.projectId,
                "dashboard_title": model.title,
                "title": title,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (dashboardElements) {
                model.dashboardElements.push(dashboardElements);
                model.workingdashboardElements.push(dashboardElements);
                whenFinished(dashboardElements);
            }
        });
    }

    addDashboardItem(id_dashboard_list, title, whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=createDashboardItem",
            data: {
                "id_dashboard_list": id_dashboard_list,
                "title": title,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (dashboardItem) {
                /* model.dashboardElements.push(dashboardElements);
                model.workingdashboardElements.push(dashboardElements); */
                whenFinished(dashboardItem);
            }
        });
    }

    deleteDashboardItem(id, whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=deleteDashboardItem",
            data: {
                "id": id,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    enableDashboardItem(id, enable, whenFinished) {
        var model = this;
        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=disableDashboardItem",
            data: {
                "id": id,
                "enabled": enable ? 1 : 0,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    deleteDashboardList(id, whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=deleteDashboardList",
            data: {
                "id": id,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    deleteDashboard(whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=deleteDashboards",
            data: {
                "id_project": model.projectId,
                "title": model.title,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    createComment(id, comment, whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=createDashboardItemComments",
            data: {
                "id_dashboard_item": id,
                "comment": comment,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    deleteDashboardItemComments(id, whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=deleteDashboardItemComments",
            data: {
                "id": id,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    setAssignationFinishState(id, newState, whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=updateDashboardsItemAssignation",
            data: {
                "id": id,
                "finished": newState ? 1 : 0,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    moveDashboardItem(order, taskItemId, dashboardListId, whenFinished) {
        var model = this;
        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=updateDashboardItem",
            data: {
                "order": order,
                "id_dashboard_list": dashboardListId,
                "id": taskItemId,
                "idProjectForAccessLevel": model.projectId,
                //"moveForward": movedData["endingIndex"] > movedData["startingIndex"] ? 1 : 0,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    getCommentsOfDashboardItem(taskItemDataId, whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=getCommentsOfDashboardItem",
            data: {
                "id_dashboard_item": taskItemDataId,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    getDashboardItemDetails(taskItemDataId, whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=getDashboardItemDetails",
            data: {
                "id": taskItemDataId,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (result) {
                whenFinished(result);
            }
        })
    }

    updateDashboardItem(taskItemId, title, description, whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=updateDashboardItem",
            data: {
                "id": taskItemId,
                "title": title,
                "description": description,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    createDashboardsItemAssignation(taskItemId, startDate, endDate, username, whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=createDashboardsItemAssignation",
            data: {
                "id_dashboard_item": taskItemData.id,
                "start_date": startDate,
                "end_date": endDate,
                "assigned_to": username,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    queryDashboardsItemAssignation(taskItemId, username, whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=createDashboardsItemAssignation",
            data: {
                "id_dashboard_item": taskItemId,
                "assigned_to": username,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    updateDashboardsItemAssignation(taskItemId, startDate, endDate, username, whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=updateDashboardsItemAssignation",
            data: {
                "id_dashboard_item": taskItemId,
                "start_date": startDate,
                "end_date": endDate,
                "assigned_to": username,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    deleteDashboardsItemAssignation(taskItemId, username, whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=updateDashboardsItemAssignation",
            data: {
                "id_dashboard_item": taskItemId,
                "assigned_to": username,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    updateDashboardItemComments(id, comment, whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=updateDashboardsItemAssignation",
            data: {
                "id_dashboard_item": taskItemId,
                "assigned_to": username,
                "idProjectForAccessLevel": model.projectId,
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
        clonedTaskList.prop("id", json.id);
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
        /* $(element).get(0).scrollIntoView({
            behavior: "smooth",
            block: 'nearest', 
            inline: 'start'
        }); */
        //$(".listContainer").scrollLeft(element.offset().left);
        $(".listContainer").stop().animate({
            scrollLeft: element.offset().left,
        }, function () {
            $(window).scrollTop(0);
        });
        /* $(".listContainer, main, body, html").scrollTop(0);
        setTimeout(() => {
            $(window).scrollTop(0);
        }, 250); */
    }

    visualizeModalComment(container, commentData) {
        var clonedComment = $dashboardModalComment.clone();

        clonedComment.find(".dashboardCommentName").text(commentData.commentCreatorName);
        var commentUsername = commentData.commentCreatorUsername;
        clonedComment.find(".dashboardCommentUsername").text(commentData.commentCreatorUsername);
        clonedComment.find(".dashboardCommentUserImg").prop("src", `${EXECUTION_HOME_PATH}img/users/${commentUsername}/${commentUsername}.png`);

        var commentDate = commentData.commentDate;
        var commentTimeHTML = clonedComment.find(".dashboardCommentTime");
        var timeFromMoment = new TimeFromMoment(commentTimeHTML, commentData.commentDate, false);

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

            if (controller.model.taskIdFromURL != undefined) {
                controller.model.findDashboardItemWithId(controller.model.taskIdFromURL, function (taskElement) {
                    $(taskElement.html).trigger("click");
                });
            }

            if (controller.model.listIdFromURL != undefined) {
                controller.model.findListWithId(controller.model.listIdFromURL, function (listElement) {
                    controller.view.scrollTo(listElement.html);
                });
            }
        });

        var dashboardSearchInput = $("#dashboardSearch");
        whenUserDoneTypingInInput(dashboardSearchInput, "dashboardSearch", function () {
            var valueToSearch = dashboardSearchInput.val().toLowerCase();

            $(".taskListContainer").each(function () {
                if ($(this).find(".taskListTitleText").text().trim().toLowerCase().includes(valueToSearch)) {
                    $(this).show('slow');
                } else {
                    $(this).hide('slow');
                }
            })

        }, 50);

        controller.moveScrollWithMouse();

        $(".dashboardBtnDelete").on("click", function (event) {
            controller.deleteDashboardEvent(controller, event);
        });

        /* $(".listContainer").scroll(function () {
            $(".taskListContainer").each(function () {
                var current = $(this);
                if ($(".listContainer").scrollLeft() >= current.offset().left) {
                    controller.addIdToURL(controller, current.prop("id"));
                }
            })
        }) */
        document.title = `${controller.model.title}`;
    }

    addIdToURL(controller, id) {
        changeURL(`${EXECUTION_HOME_PATH}projects/id/${controller.model.projectId}/dashboards/${controller.model.title}/#${id}`);
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
            sendNotification("El título de la lista debe tener al menos 3 carácteres", "taskListTitleTooShort");
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

        var order = movedData["endingIndex"];
        var dashboardListId = movedData["endingTaskList"]["id"];
        var taskItemId = movedData["taskItem"]["id"];

        controller.model.moveDashboardItem(order, taskItemId, dashboardListId, function (result) {
            console.log("mover de lista", result);
        });
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
            sendNotification("El título de la tarea debe tener al menos 3 carácteres", "taskListItemTooShort");
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
                    document.title = `${controller.model.title}`;
                    changeURL(`${EXECUTION_HOME_PATH}projects/id/${controller.model.projectId}/dashboards/${controller.model.title}/`);
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
        controller.view.scrollTo(taskItem);

        var urlBaseInDashboardModal = `${EXECUTION_HOME_PATH}projects/id/${controller.model.projectId}/dashboards/${controller.model.title}/task/id/${taskItemData.id}/`;

        document.title = `${taskItemData.title}`;
        changeURL(urlBaseInDashboardModal);

        var inputs = $("input, textarea");
        inputs.focus();
        inputs.first().focus();
        inputs.first().blur();
        console.log(inputs);

        controller.model.findListWithId(taskItemData.id_dashboard_list, function (listElement) {
            $(".dashboardModalListName").html(listElement.title)
                .prop("href", `${EXECUTION_HOME_PATH}projects/id/${controller.model.projectId}/dashboards/${controller.model.title}/#${listElement.id}`)
                .on("click", function (event) {
                    var event = event || window.event;
                    event.preventDefault();

                    console.log($(`#${listElement.id}`));

                    controller.view.scrollTo($(`#${listElement.id}`));
                    modal.close();

                    return false;
                });
        });

        if (taskItemData.assigned === true) {
            controller.dashboardModalAssignedTask(taskItemData, controller, taskItem);
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
        controller.model.getCommentsOfDashboardItem(taskItemData.id, function (result) {
            if (result !== false) {
                commentsContainer.html("");
                $(result).each(function () {
                    var commentJSON = this;
                    console.log(commentJSON);
                    controller.createComment(controller, commentJSON, commentsContainer);
                });
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

        $("#dashboardModalActionModifyAssignation").on("click", function (event) {
            controller.dashboardAssignationModifyModalEvent(controller, taskItemData)
        });

        $("#dashboardModalActionDetails").on("click", function (event) {
            controller.model.getDashboardItemDetails(taskItemData.id, function (result) {
                console.log("details", result);
                if (result !== false) {
                    Modal.modal({
                        "title": `Detalles de ${taskItemData.title}`,
                        "content": `<div class="row">
                        <p class="mb-0">Creado por <a href=EXECUTION_HOME_PATH + "profile/${result.username}" class="dashboardItemCreator">${result.fullname}</a></p>
                        <div class="dashboardItemCreationDate ml-auto mr-2"></div>
                    </div>`,
                        "onOpen": function (modal) {
                            var creationDateContainer = $(".dashboardItemCreationDate");
                            var originalDate = result.creation_date;
                            var timeFromMoment = new TimeFromMoment(creationDateContainer, originalDate)
                            timeFromMoment.delete(timeFromMoment);
                        }
                    });
                } else {
                    sendNotification("No se han podido extraer los detalles", "dashboardItemDetailsFail");
                }
            });
        });

        if (taskItemData.enabled != 0) {
            $("#dashboardModalActionDisableDashboardItem").show();
            $("#dashboardModalActionEnableDashboardItem").hide();
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

        $("#dashboardModalActionMoveTask").on("click", function (event) {
            controller.dashboardModalMoveTaskEvent(controller, taskItemData, taskItem);
        })

        $(".dashboardModalBtnSaveChanges").on("click", function (event) {
            var event = event || window.event;
            var currentBtn = $(this);

            controller.dashboardSaveChangesEvent(controller, taskItemData);
        });

        $("#comment").on("keypress", function (event) {
            console.log(event.keyCode);
            if (event.keyCode == 13) {
                controller.createModalCommentEvent(taskItemData, controller, commentsContainer)
            }
        });
    }

    dashboardModalMoveTaskEvent(controller, taskItemData, taskItem) {
        console.log("test");
        var modal = Modal.modal({
            "title": "Mover tarea de lista",
            "content": `
                    <form action=EXECUTION_HOME_PATH + "index.php?ctl=updateDashboardItem" id="formMoveDashboardList" method="POST">
                        <div class="form-row mb-2">
                            <div class="col-sm">
                                <label for="id_dashboard_list">Lista de tareas</label>
                                <select class="browser-default border-0 bg-dark text-light custom-select" name="id_dashboard_list" id="id_dashboard_list">
                                </select>
                            </div>
                            <div class="col-sm">
                                <label for="order">Orden</label>
                                <select class="browser-default border-0 bg-dark text-light custom-select" name="order" id="order">
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="id_project" value="${controller.model.projectId}">
                        <input type="hidden" name="id" value="${taskItemData.id}">
                        <div class="row flex-center">
                            <button class="btn btn-primary mx-auto" name="moveDashboardItemToList" id="moveDashboardItemToList">Mover
                                tarea</button>
                        </div>
                    </form>
            `,
            "onOpen": function (modal) {
                var selectDashboardList = $("#id_dashboard_list");
                var selectOrder = $("#order");
                var elements = controller.model.dashboardElements;
                $(elements).each(function () {
                    var newOption = $(`<option value="${this.id}">${this.title}</option>`);
                    selectDashboardList.append(newOption);
                    var itemsLen = this.items.length;
                    newOption.on("click", function () {
                        selectOrder.html("");
                        selectOrder.append($(`<option value="0">1</option>`));
                        for (let orderIndex = 1; orderIndex <= itemsLen; orderIndex++) {
                            selectOrder.append($(`<option value="${orderIndex + 1}">${orderIndex + 1}</option>`));
                        }
                    });
                });
                selectDashboardList.val(taskItemData.id_dashboard_list);
                selectDashboardList.find("option:selected").trigger("click");
                selectOrder.val(taskItemData.order);
                $("#formMoveDashboardList").on("submit", function (event) {
                    var event = event || window.event;
                    event.preventDefault();
                    var id_dashboard_list = selectDashboardList.find("option:selected").val();
                    var order = $("#order option:selected").val();
                    var movingForward = order == 0;
                    if (taskItemData.id_dashboard_list == id_dashboard_list) {
                        movingForward = taskItemData.order > order;
                    }
                    controller.model.moveDashboardItem(order, taskItemData.id, id_dashboard_list, function (result) {
                        console.log(result);
                        if (result !== false) {
                            sendNotification("Se ha cambiado de lista correctamente", "changeTaskListSuccess");
                        } else {
                            sendNotification("No se ha podido cambiar de lista", "changeTaskListFail");
                        }
                    })
                });
                controller.view.scrollTo(taskItem);
            },
            "onClose": function () {
                controller.view.scrollTo(taskItem);
            },
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

    dashboardSaveChangesEvent(controller, taskItemData) {
        var title = $(".dashboardModalTitle").text();
        var description = $("#dashboardModalDescription").val();

        controller.model.updateDashboardItem(taskItemData.id, title, description, function (result) {
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
        });
    }

    dashboardAssignationModalEvent(controller, taskItemData) {
        var modal = Modal.modal({
            "title": "Asignar tarea",
            "content": `<form action=EXECUTION_HOME_PATH + "index.php?ctl=createDashboardItemAssignation" id="formAssignDashboard" class="col-sm-10  p-3 mx-auto" method="POST">
                            <div class="form-row">
                                <div class="md-form col-sm">
                                    <input type="text" name="startDate" id="startDate" class="form-control text-dark" aria-describedby="startDateTime">
                                    <label for="startDate">Fecha inicio</label>
                                </div>
                                <div class="md-form col-sm">
                                    <input type="text" name="endDate" id="endDate" class="form-control text-dark" aria-describedby="endDateTime">
                                    <label for="endDate">Fecha límite</label>
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

                var startDateUtils = new DateTimePickerUtils(new Date(), startDate, function (ct, $input) {}, "Y-m-d H:i:s");

                var newDate = new Date();
                newDate.setDate(newDate.getDate() + 20);

                var endDate = $("#endDate");
                endDate.focus();
                var endDateUtils = new DateTimePickerUtils(newDate, endDate, function (ct, $input) {}, "Y-m-d H:i:s");

                var userSearch = new UserSearchInput($(".userSearchContainer"));
                userSearch.input.addClass("text-dark");
                $("#formAssignDashboard").on("submit", function (event) {
                    var event = event || window.event;
                    event.preventDefault();

                    var startDateVal = startDate.val();
                    var endDateVal = endDate.val();
                    var username = userSearch.input.val();

                    controller.model.createDashboardsItemAssignation(taskItemData.id, startDateVal, endDateVal, username, function (result) {
                        console.log(result);
                        if (result !== false) {
                            sendNotification("Se ha asignato con éxito", "assignateTaskSuccess");
                            modal.close();
                        } else {
                            sendNotification("No se ha podido asignar", "assignateTaskFail");
                        }
                    });

                    return false;
                });
            },
        });
    }

    dashboardAssignationModifyModalEvent(controller, taskItemData) {
        var modal = Modal.modal({
            "title": "Asignar tarea",
            "content": `<form action=EXECUTION_HOME_PATH + "index.php?ctl=updateDashboardItemAssignation" id="formModifyAssignDashboard" class="col-sm-10  p-3 mx-auto" method="POST">
                            <div class="form-row">
                                <div class="md-form col-sm">
                                    <input type="text" name="startDate" id="startDate" class="form-control text-dark" aria-describedby="startDateTime">
                                    <label for="startDate">Fecha inicio</label>
                                </div>
                                <div class="md-form col-sm">
                                    <input type="text" name="endDate" id="endDate" class="form-control text-dark" aria-describedby="endDateTime">
                                    <label for="endDate">Fecha límite</label>
                                </div>
                            </div>
                            <div class="form-row userSearchContainer"></div>
                            <input type="hidden" name="id_project" value="${controller.model.projectId}" >
                            <div class="row m-0 d-flex justify-content-center align-content-center align-items-center justify-items-center">
                                <button class="btn btn-primary col-sm" id="getAssignationData">Recoger datos</button>
                                <input class="btn btn-primary col-sm" type="submit" name="updateDashboard" disabled="true" id="updateDashboard" value="Modificar asignación">
                            </div>
                        </form>`,
            "onOpen": function () {

                var startDate = $("#startDate");
                startDate.focus();
                var startDateUtils = new DateTimePickerUtils(new DateUtils(taskItemData.start_date).date, startDate, function (ct, $input) {}, "Y-m-d H:i:s");

                var endDate = $("#endDate");
                endDate.focus();
                var endDateUtils = new DateTimePickerUtils(new DateUtils(taskItemData.end_date).date, endDate, function (ct, $input) {}, "Y-m-d H:i:s");

                var assignationId;
                var userSearch = new UserSearchInput($(".userSearchContainer"));
                userSearch.input.addClass("text-dark");
                userSearch.whenBtnSearchClicked = function (event) {
                    var event = event || window.event;
                    event.stopPropagation();
                    event.preventDefault();

                    controller.model.queryDashboardsItemAssignation(taskItemData.id, userSearch.input.val(), function (result) {
                        console.log(result);
                        if (result !== false) {
                            $("#startDate").val(result.start_date);
                            $("#endDate").val(result.end_date);
                            assignationId = result.id;
                            $("#updateDashboard").prop("disabled", false);
                        } else {
                            sendNotification("No se han podido encontrar los datos", "assignateTaskQueryFail");
                        }
                    });
                };
                $("#getAssignationData").on("click", function (event) {
                    var event = event || window.event;
                    event.stopPropagation();
                    event.preventDefault();

                    controller.model.queryDashboardsItemAssignation(taskItemData.id, userSearch.input.val(), function (result) {
                        console.log(result);
                        if (result !== false) {
                            $("#startDate").val(result.start_date);
                            $("#endDate").val(result.end_date);
                            assignationId = result.id;
                            $("#updateDashboard").prop("disabled", false);
                        } else {
                            sendNotification("No se han podido encontrar los datos", "assignateTaskQueryFail");
                        }
                    });
                });
                $("#formModifyAssignDashboard").on("submit", function (event) {
                    var event = event || window.event;
                    event.preventDefault();

                    var startDateVal = startDate.val();
                    var endDateVal = endDate.val();
                    var username = userSearch.input.val();

                    controller.model.updateDashboardsItemAssignation(taskItemData.id, startDateVal, endDateVal, username, function (result) {
                        console.log(result);
                        if (result !== false) {
                            sendNotification("Se ha modificado con éxito", "modifyAsignateTaskSuccess");
                            modal.close();
                        } else {
                            sendNotification("No se ha podido asignar", "modifyAsignateTaskFail");
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
            "content": `<form action=EXECUTION_HOME_PATH + "index.php?ctl=deleteDashboardItemAssignation" id="formRemoveAssignation" class="col-sm-10  p-3 mx-auto" method="POST">
                            <div class="form-row userSearchContainer"></div>
                            <input type="hidden" name="id_project" value="${controller.model.projectId}" >
                            <div class="row m-0 d-flex justify-content-center align-content-center align-items-center justify-items-center">
                                <input class="btn btn-primary w-100" type="submit" name="removeAssignation" id="removeAssignation" value="Quitar asignación">
                            </div>
                        </form>`,
            "onOpen": function () {
                var userSearch = new UserSearchInput($(".userSearchContainer"));
                userSearch.input.addClass("text-dark");
                $("#formRemoveAssignation").on("submit", function (event) {
                    var event = event || window.event;
                    event.preventDefault();

                    var username = userSearch.input.val();

                    controller.model.deleteDashboardsItemAssignation(taskItemData.id, userSearch.input.val(), function (result) {
                        console.log(result);
                        if (result !== false) {
                            sendNotification("Se ha quitado la asignación", "removeAssignationTaskSuccess");
                            modal.close();
                        } else {
                            sendNotification("No se ha quitar la asignación", "removeAssignationTaskFail");
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
            assignationItem = controller.dashboardAssignationModalCheckboxEvent(assignationCheckbox, controller, taskItemData, taskItem, assignationItem);
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

            controller.model.updateDashboardItemComments(commentJSON.id, commentContent, function (result) {
                console.log("cambiar comentario", commentJSON.id, result);
                if (result !== false) {
                    btnEditComment.hide();
                } else {

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