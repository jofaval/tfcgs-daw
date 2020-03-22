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

var taskListJSON = [{
        "id": 0,
        "title": "Prueba",
        "items": [{
            "id": 0,
            "order": 0,
            "title": "test",
        }, ],
    },
    {
        "id": 1,
        "title": "Test",
        "items": [{
            "id": 0,
            "order": 1,
            "title": "test",
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
}

class Controller {
    constructor(model, view) {
        this.model = model;
        this.view = view;
        var controller = this;

        var mainContainer = $("#content");

        view.initializeView(mainContainer);

        $("#taskListInputCreation").find(".taskListInputBtn").on("click", function () {
            var taskListAddInput = $("#taskListInputCreation").find(".taskListInput");
            var returnedValue = {
                "id": 0,
                "title": taskListAddInput.val(),
                "items": [],
            };
            //ajax here
            controller.createTaskList(controller, returnedValue);

            taskListAddInput.val("");
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

    createTaskList(controller, taskListData) {
        var controllerView = controller.view;
        var taskList = controllerView.visualizeTaskList(taskListData.id, taskListData.title);

        taskList.find(".taskListInputBtn").on("click", function () {
            var taskListInput = taskList.find(".taskListInput");
            var returnedValue = {
                "id": 0,
                "order": 0,
                "title": taskListInput.val(),
            };
            controller.createTaskItem(controller, taskList, returnedValue);
            taskListInput.val("");
        });

        return taskList;
    }

    createTaskItem(controller, taskList, taskItemData) {
        var taskItem = controller.view.visualizeTaskListItem(taskList, taskItemData.id, taskItemData.title);

        var startingTaskListParent = null;
        var startingIndex = 0;
        var endingTaskListParent = null;
        var endingIndex = 0;

        taskItem.draggable(true);

        taskItem.on("dragstart", function () {
            $(this).addClass("dragging");
            startingIndex = $(this).index();

            console.log("test");
            startingTaskListParent = $(this).parent().parent().find(".listTitle rounded").text()
                .trim();
        });

        taskItem.on("drop", function () {
            console.log("hahahaha");
        });

        taskItem.on("dragover", function () {
            test.show();
            var index = $(this).index();
            if (index == 0) {
                $(this).before(test);
                endingIndex = 0;
            } else {
                if (index > 1) {
                    endingIndex = -1;
                }
                $(this).after(test);
            }
        });
        taskItem.on("dragend", function () {
            $(this).removeClass("dragging");
            test.hide();
            var parent = test.parent().parent();
            endingTaskListParent = parent.find(".listTitle rounded").text().trim();
            endingIndex += test.index();

            parent.find(".taskItem:nth-child(" + (endingIndex + 1) + ")").after($(this));

            var count = 0;
            console.log("startingTaskListParent", startingTaskListParent,
                "endingTaskListParent", endingTaskListParent);
            console.log("startingIndex", startingIndex,
                "endingIndex", endingIndex);
            $(this).parent().find(".taskItem").each(function () {
                count++;
            });
        });

        return taskItem;
    }
}

const tasksController = new Controller(
    new Model(),
    new View()
);