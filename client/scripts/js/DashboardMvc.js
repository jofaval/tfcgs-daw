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
            <div class="col-sm-8">
                <h4 class="dashboardModalDescriptionTitle"><span class="fa fa-align-justify mr-2"></span>Description</h4>
                <div class="md-form">
                    <textarea id="description" class="md-textarea form-control text-white" rows="3"></textarea>
                    <label for="description">Description</label>
                </div>
                <h4 class="dashboardModalCommentsTitle"><span class="fa fa-comments mr-2"></span>Comments</h4>
                <div class="md-form input-group mb-4">
                    <input type="text" class="form-control text-white" id="comment">
                    <label for="comment" class="">Comment</label>
                    <div class="input-group-append">
                        <span class="input-group-text dashboardModalCommentBtn md-addon btn btn-sm btn-primary">Comment</span>
                    </div>
                </div>
                <div class="dashboardCommentsContainer"></div>
            </div>
            <div class="col-sm-4">
                <div class="dasbhoardModalActions d-flex flex-column">
                    <div class="dasbhoardModalActionsTitle text-uppercase">Action title</div>
                    <div class="dasbhoardModalAction btn btn-sm btn-default">action</div>
                    <div class="dasbhoardModalAction btn btn-sm btn-default">action</div>
                    <div class="dasbhoardModalAction btn btn-sm btn-default">action</div>
                    <div class="dasbhoardModalAction btn btn-sm btn-default">action</div>
                    <div class="dasbhoardModalAction btn btn-sm btn-default">action</div>
                    <div class="dasbhoardModalAction btn btn-sm btn-default">action</div>
                </div>
                <div class="dasbhoardModalActions d-flex flex-column">
                    <div class="dasbhoardModalActionsTitle text-uppercase">Action title</div>
                    <div class="dasbhoardModalAction btn btn-sm btn-default">action</div>
                    <div class="dasbhoardModalAction btn btn-sm btn-default">action</div>
                </div>
                <div class="dasbhoardModalActions d-flex flex-column">
                    <div class="dasbhoardModalActionsTitle text-uppercase">Action title</div>
                    <div class="dasbhoardModalAction btn btn-sm btn-default">action</div>
                    <div class="dasbhoardModalAction btn btn-sm btn-default">action</div>
                    <div class="dasbhoardModalAction btn btn-sm btn-default">action</div>
                    <div class="dasbhoardModalAction btn btn-sm btn-default">action</div>
                    <div class="dasbhoardModalAction btn btn-sm btn-default">action</div>
                    <div class="dasbhoardModalAction btn btn-sm btn-default">action</div>
                </div>
            </div>
        </div>
    </div>
</div>
`);
var $dashboardModalComment = $(`
<div class="w-100 dashboardComment my-2">
    <img src="/daw/img/default.png" width="50"
        class="dashboardCommentUserImg rounded-pill float-left mr-2" />
    <div class="row dashboardCommentInformation mb-2">
        <div class="dashboardCommentUsername text-white mr-2">Test</div>
        <div class="dashboardCommentName text-white mr-2">Test</div>
        <div width="25" class="dashboardCommentTime text-muted">10 seconds ago</div>
    </div>
    <span class="dashboardCommentContent text-dark p-2 m-2 rounded w-auto bg-light">Test</span>
    <div class="row dashboardCommentActions text-white ml-2 mt-2">
        <a href="" class="dashboardCommentAction dashboardCommentEdit">Edit</a>
        &nbsp;-&nbsp;
        <a href="" class="dashboardCommentAction dashboardCommentDelete">Delete</a>
    </div>
</div>
`);

var $dashboardAssignationContainer = $(`<div class="dashboardAssignationContainer row"></div>`);
var $dashboardAssignationFinishedStateInput = $(`
<div class="custom-control w-auto text-right ml-2 custom-checkbox">
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
                "id": commentJSON.id,
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
        if (json.assigned !== false) {

            this.visualizeDashboardAssignation(clonedTaskListItem, json.start_date, json.end_date, json.finished);
        }
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

        clonedComment.find(".dashboardCommentContent").text(commentData.comment);
        container.prepend(clonedComment);

        return clonedComment;
    }
}

var startingTaskListParent = null;
var startingIndex = 0;
var endingTaskListParent = null;
var endingIndex = 0;
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
                clearTimeout(scrollID);
                scrollID = setTimeout(() => {
                    main.scrollLeft(main.scrollLeft() + (originalPosition - newPosition));
                }, 5);
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
        if (movedData.startingTaskList != movedData.endingTaskList) {

        }
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

                var totalTaskListItems = itemsContainer.children(".taskListItem").length;

                if (totalTaskListItems == 0) {
                    endingIndex = 0;
                    itemsContainer.append($referenceTaskListItem);
                }
            }
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

        taskItem.on("dragstart", function (event) {
            mousedown = false;

            var event = event.originalEvent || window.event;
            var currentTaskItem = $(this);

            controllerView.addGhostImage(event, currentTaskItem, this);

            startingIndex = currentTaskItem.index();
            draggingTaskItem = currentTaskItem;
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

            $referenceTaskListItem.before(taskItem);

            controller.onTaskItemMoved({
                "startingTaskList": startingTaskListParent,
                "startingIndex": startingIndex,
                "endingTaskList": endingTaskListParent,
                "endingIndex": endingIndex,
                "taskItem": taskItem,
            });
        });

        taskItem.find(".dashboardBtnClose").on("click", function (event) {
            var event = event || window.event;
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
                            Modal.specialAlert({
                                title: `"${taskItemData.title}" ha sido borrado con éxito`,
                                error: false,
                            });
                        } else {
                            Modal.specialAlert({
                                title: `"${taskItemData.title}" no se ha podido borrar`,
                                error: true,
                            });
                        }
                    })
                },
            });
        })

        taskItem.on("click", function (event) {
            var event = event || window.event;
            event.stopPropagation();

            Modal.modal({
                "title": "",
                "content": $dashboardModal.html(),
                "onOpen": function () {
                    controller.onOpenDashboardModal(taskItemData, controller);
                },
                "onClose": function () {
                    controller.view.scrollTo(taskItem);
                },
            });
        });

        return taskItem;
    }

    onOpenDashboardModal(taskItemData, controller) {
        console.log(taskItemData);

        var inputs = $("input, textarea");
        inputs.focus();
        inputs.first().focus();
        console.log(inputs);

        if (taskItemData.assigned === true) {
            console.log("FUNCIONA", taskItemData);

            console.log($dashboardAssignationContainer);
            $dashboardAssignationContainer.append($dashboardAssignationFinishedStateInput.clone());
            var assignationItem = controller.view.visualizeDashboardAssignation($dashboardAssignationContainer, taskItemData.start_date, taskItemData.end_date, taskItemData.finished);
            assignationItem.removeClass("ml-auto");
            $dashboardAssignationFinishedStateInput.find(":checkbox").val(taskItemData.finished !== 0);
            $(".dashboardModalDescriptionTitle").after($dashboardAssignationContainer);
        }

        $(".dashboardModalTitle").text(taskItemData.title);
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
        $("#comment").on("keypress", function (event) {
            console.log(event.keyCode);
            if (event.keyCode == 13) {
                controller.createModalCommentEvent(taskItemData, controller, commentsContainer)
            }
        });
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
                controller.model.deleteDashboardItem(taskItemData.id, function (result) {
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