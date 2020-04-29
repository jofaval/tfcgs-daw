var $taskListsContainer = $(`<div class="d-flex justify-content-start mx-1 mx-sm-1 listContainer"></div>`);

var $taskList = $(`
<div class="taskListContainer mx-1">
    <div class="taskList shadow bg-light rounded">
        <div class="taskListProperties d-none">
            <span class="taskListId"></span>
        </div>
        <section class="taskListTitle text-left p-2">
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
    <div class="taskListItemBody text-white card-body px-2 py-1">
        <p class="card-text taskListItemTitle">project description.</p>
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
        <h3 class="dashboardModalTitle" contenteditable="true"><span class="fa fa-eye"></span>Task title</h3>
        <small class="dashboardModalListNameContainer text-muted">in list <a href=""
                class="dashboardModalListName">list</a></small>
        <div class="row">
            <div class="col-sm-8">
                <h4 class="dashboardModalDescriptionTitle"><span class="fa fa-eye"></span>Description</h4>
                <div class="md-form">
                    <textarea id="description" class="md-textarea form-control text-white" rows="3"></textarea>
                    <label for="description">Description</label>
                </div>
                <h4 class="dashboardModalCommentsTitle"><span class="fa fa-eye"></span>Comments</h4>
                <div class="md-form input-group mb-4">
                    <input type="text" class="form-control text-white" id="comment">
                    <label for="comment" class="">Comment</label>
                    <div class="input-group-append">
                        <span class="input-group-text md-addon btn btn-sm btn-primary">Comment</span>
                    </div>
                </div>
                <div class="dashboardCommentsContainer">
                    <div class="w-100 dashboardComment my-2">
                        <img src="../img/profile-pic.png" width="50"
                            class="dashboardCommentUserImg rounded-pill float-left mr-2" />
                        <div class="row dashboardCommentInformation mb-2">
                            <div class="dashboardCommentUsername text-white mr-2">Test</div>
                            <div width="25" class="dashboardCommentTime text-muted">10 seconds ago</div>
                        </div>
                        <span class="dashboardCommentContent text-dark p-2 m-2 rounded w-auto bg-light">Test</span>
                        <div class="row dashboardCommentActions text-white ml-2 mt-2">
                            <a href="" class="dashboardCommentAction">Edit</a>
                            &nbsp;-&nbsp;
                            <a href="" class="dashboardCommentAction">Delete</a>
                        </div>
                    </div>
                    <div class="w-100 dashboardComment my-2">
                        <img src="../img/profile-pic.png" width="50"
                            class="dashboardCommentUserImg rounded-pill float-left mr-2" />
                        <div class="row dashboardCommentInformation mb-2">
                            <div class="dashboardCommentUsername text-white mr-2">Test</div>
                            <div width="25" class="dashboardCommentTime text-muted">10 seconds ago</div>
                        </div>
                        <span class="dashboardCommentContent text-dark p-2 m-2 rounded w-auto bg-light">Test</span>
                        <div class="row dashboardCommentActions text-white ml-2 mt-2">
                            <a href="" class="dashboardCommentAction">Edit</a>
                            &nbsp;-&nbsp;
                            <a href="" class="dashboardCommentAction">Delete</a>
                        </div>
                    </div>
                    <div class="w-100 dashboardComment my-2">
                        <img src="../img/profile-pic.png" width="50"
                            class="dashboardCommentUserImg rounded-pill float-left mr-2" />
                        <div class="row dashboardCommentInformation mb-2">
                            <div class="dashboardCommentUsername text-white mr-2">Test</div>
                            <div width="25" class="dashboardCommentTime text-muted">10 seconds ago</div>
                        </div>
                        <span class="dashboardCommentContent text-dark p-2 m-2 rounded w-auto bg-light">Test</span>
                        <div class="row dashboardCommentActions text-white ml-2 mt-2">
                            <a href="" class="dashboardCommentAction">Edit</a>
                            &nbsp;-&nbsp;
                            <a href="" class="dashboardCommentAction">Delete</a>
                        </div>
                    </div>
                </div>
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

class Model {
    constructor() {
        this.projectId = this.getProjectId();
        this.title = this.getDashboardtitle();
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

    getProjectId() {
        var URL = window.location.href;
        var splittedURL = URL.split("/");

        return splittedURL[6];
    }

    getDashboardtitle() {
        var URL = window.location.href;
        var splittedURL = URL.split("/");

        return splittedURL[8];
    }
}

class View {
    constructor() {

    }

    initializeView(parent) {
        parent.append($taskListsContainer);

        $("#content").addClass("pt-2");
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

    visualizeTaskList(id, title, items = []) {
        var clonedTaskList = $taskList.clone();

        console.log(id, title, items);

        var view = this;

        clonedTaskList.find(".taskListId").text(id);
        clonedTaskList.find(".taskListTitleText").text(title);

        $("#taskListInputCreation").before(clonedTaskList);

        return clonedTaskList;
    }

    visualizeTaskListItem(taskList, id, title) {
        var clonedTaskListItem = $taskListItem.clone();

        clonedTaskListItem.find(".taskListItemTitle").text(title);
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
            behavior: "smooth"
        });
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

                if (items.length > 0) {
                    $(items).each(function () {
                        controller.createTaskItem(controller, taskList, this);
                    });
                }
            });
        });

        controller.moveScrollWithMouse();
    }

    moveScrollWithMouse(increment = 5) {
        var originalPosition;
        var scrollID = 0;
        var main = $("main");
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
        var taskListAddContainer = $("#taskListInputCreation");
        var taskListAddInput = $("#taskListInputCreation").find(".taskListInput");

        var newTaskListTitle = taskListAddInput.val();
        if (newTaskListTitle.length < 3) {
            sendNotification("Task list title must have at least 3 characters", "taskListTitleTooShort");
            return;
        }

        var returnedValue = {
            "id": 0,
            "title": newTaskListTitle,
            "items": [],
        };
        //ajax here
        var taskList = controller.createTaskList(controller, returnedValue);
        controller.onTaskListCreation(returnedValue);

        controller.view.scrollTo(taskListAddContainer);

        taskListAddInput.val("");
    }

    onTaskListCreation(taskList) {
        console.log(taskList);
    }

    onTaskListItemCreation(taskList, taskItem) {
        console.log(taskList, taskItem);
    }

    onTaskItemMoved(movedData) {
        if (movedData.startingTaskList != movedData.endingTaskList) {

        }
    }

    createTaskList(controller, taskListData) {
        var controllerView = controller.view;
        var taskList = controllerView.visualizeTaskList(taskListData.id, taskListData.title);

        taskList.find(".taskListInputBtn").on("click", function () {
            var event = event || window.event;
            controller.taskListItemCreation(event, controller, taskList, taskListData);
        });

        taskList.find(".taskListInput").on("keypress", function (event) {
            var event = event || window.event;
            if (event.keyCode == 13) {
                controller.taskListItemCreation(event, controller, taskList);
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

        return taskList;
    }

    taskListItemCreation(event, controller, taskList, taskListData) {
        var taskListInput = taskList.find(".taskListInput");

        var taskListItemValue = taskListInput.val();
        if (taskListItemValue.length < 3) {
            sendNotification("Task list item title must have at least 3 characters", "taskListItemTooShort");
            return;
        }

        var returnedValue = {
            "id": 0,
            "order": 0,
            "title": taskListItemValue,
        };

        var taskItem = controller.createTaskItem(controller, taskList, returnedValue);
        controller.onTaskListItemCreation(taskList, returnedValue);
        taskListInput.val("");
    }

    createTaskItem(controller, taskList, taskItemData) {
        var controllerView = controller.view;
        var taskItem = controllerView.visualizeTaskListItem(taskList, taskItemData.id, taskItemData.title);

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

        taskItem.on("click", function (event) {
            var event = event || window.event;

            $.sweetModal({
                content: $dashboardModal.html(),
                theme: $.sweetModal.THEME_DARK
            });


        });

        return taskItem;
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