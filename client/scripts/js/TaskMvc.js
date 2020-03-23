var $taskListsContainer = $(`<div class="d-flex justify-content-start mx-2 mx-sm-4 listContainer"></div>`);

var $taskList = $(`
<div class="taskListContainer mx-2">
    <div class="taskList shadow bg-light rounded">
        <div class="taskListProperties d-none">
            <span class="taskListId"></span>
        </div>
        <section class="taskListTitle rounded grey lighten-3 text-left p-2">
            <p class="mb-0 ml-3 taskListTitleText">Titulo 1</p>
        </section>
        <div class="taskListItemsContainer px-3 pt-2 mb-3 " ondragover="event.preventDefault()">
        </div>
        <div class="pb-3 taskListInputContainer">
            <div class="col d-flex taskListInputRow">
                <div class="input-group md-form my-0 taskListInputGroup">
                    <input type="text" class="form-control taskListInput" placeholder="Title">
                    <div class="input-group-append taskListInputBtnContainer">
                        <button class="btn addTask btn-sm btn-primary m-0 taskListInputBtn">+</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>`);

var $taskListItem = $(`
<div class="taskListItem card mb-2" draggable="true" draggable="true">
    <div class="taskListItemBody card-body px-2 py-1">
        <p class="card-text taskListItemTitle">project description.</p>
    </div>
</div>`);

var $referenceTaskListItem = $(`<div class="taskListItem taskListItemReference card mb-2 bg-dark" draggable="true">
                        <div class="card-body px-2 py-1 taskListItemBody">
                            <p class="card-text taskListItemTitle text-transparent">&nbsp;</p>
                        </div>
                    </div>`);

var taskListJSON = [{
        "id": 0,
        "title": "Prueba",
        "items": [{
            "id": 0,
            "order": 0,
            "title": "TaskList 1 Item 1",
        }, ],
    },
    {
        "id": 1,
        "title": "Test",
        "items": [{
            "id": 0,
            "order": 1,
            "title": `TaskList 2 Item 1
            TaskList 2 Item 1
            TaskList 2 Item 1
            TaskList 2 Item 1
            TaskList 2 Item 1`,
        }, ],
    },
];

class Model {
    constructor() {

    }
}

class View {
    constructor() {

    }

    initializeView(parent) {
        parent.append($taskListsContainer);

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

    scrollTo(element) {
        $(element).get(0).scrollIntoView({
            behavior: "smooth"
        });
    }
}

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

        $(taskListJSON).each(function () {
            var taskList = controller.createTaskList(controller, this);

            var items = this.items;

            if (items.length > 0) {
                $(items).each(function () {
                    controller.createTaskItem(controller, taskList, this);
                });
            }
        });
    }

    taskListInputCreationEvent(event, controller) {
        var taskListAddInput = $("#taskListInputCreation").find(".taskListInput");
        var returnedValue = {
            "id": 0,
            "title": taskListAddInput.val(),
            "items": [],
        };
        //ajax here
        var taskList = controller.createTaskList(controller, returnedValue);
        controller.onTaskListCreation(returnedValue);

        controller.view.scrollTo(taskListAddInput);

        taskListAddInput.val("");
    }

    onTaskListCreation(taskList) {

    }

    onTaskListItemCreation(taskList, taskItem) {

    }

    onTaskItemMoved(movedData) {
        if (movedData.startingTaskList != movedData.endingTaskList) {

        }
    }

    createTaskList(controller, taskListData) {
        var controllerView = controller.view;
        var taskList = controllerView.visualizeTaskList(taskListData.id, taskListData.title);

        /* controller.createTaskItem(controller, taskList, {
            "id": -1,
            "order": -1,
            "title": "",
        }).addClass("sr-only"); */

        taskList.find(".taskListInputBtn").on("click", function () {
            var event = event || window.event;
            controller.taskListItemCreation(event, controller, taskList);
        });

        taskList.find(".taskListInput").on("keypress", function (event) {
            var event = event || window.event;
            if (event.keyCode == 13) {
                controller.taskListItemCreation(event, controller, taskList);
            }
        });

        return taskList;
    }

    taskListItemCreation(event, controller, taskList) {
        var taskListInput = taskList.find(".taskListInput");
        var returnedValue = {
            "id": 0,
            "order": 0,
            "title": taskListInput.val(),
        };
        controller.createTaskItem(controller, taskList, returnedValue);
        controller.onTaskListItemCreation(taskList, returnedValue);
        taskListInput.val("");
    }

    createTaskItem(controller, taskList, taskItemData) {
        var taskItem = controller.view.visualizeTaskListItem(taskList, taskItemData.id, taskItemData.title);

        var startingTaskListParent = null;
        var startingIndex = 0;
        var endingTaskListParent = null;
        var endingIndex = 0;

        taskItem.prop("draggable", true);

        taskItem.on("dragstart", function () {
            $(this).addClass("dragging");
            startingIndex = $(this).index();

            startingTaskListParent = $(this).parents(".taskList");
            console.log("Empieza");
        });

        taskItem.on("drop", function () {
            console.log("Se suelta");
        });

        taskItem.on("dragover", function () {
            $referenceTaskListItem.show();

            $referenceTaskListItem.find(".taskListItemTitle").html(taskItem.text());

            var index = $(this).index();
            if (index == 0) {
                $(this).before($referenceTaskListItem);
                endingIndex = 0;
            } else {
                if (index > 1) {
                    endingIndex = -1;
                }
                $(this).after($referenceTaskListItem);
            }
        });

        taskItem.on("dragend", function () {
            $(this).removeClass("dragging");
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