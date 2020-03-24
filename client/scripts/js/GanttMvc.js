var currentDate = new Date();
var newDate = new Date();
newDate.setDate(currentDate.getDate() + 3);
var tasks = [{
    "id": 1,
    "color": 1,
    "title": "Title",
    "desc": "Desc",
    "startingDate": currentDate,
    "endingDate": newDate,
    "subTasks": [{
            "id": 1,
            "title": "Title",
            "desc": "Desc",
            "startingDate": currentDate,
            "endingDate": newDate,
            "daysSpan": "3",
        },
        {
            "id": 2,
            "title": "Title",
            "desc": "Desc",
            "startingDate": currentDate,
            "endingDate": newDate,
            "daysSpan": "3",
        },
        {
            "id": 3,
            "title": "Title",
            "desc": "Desc",
            "startingDate": currentDate,
            "endingDate": newDate,
            "daysSpan": "3",
        },
        {
            "id": 4,
            "title": "Title",
            "desc": "Desc",
            "startingDate": currentDate,
            "endingDate": newDate,
            "daysSpan": "3",
        },
    ],
}, ];

var weekDays = {
    0: "Sunday",
    1: "Monday",
    2: "Tuesday",
    3: "Wednesday",
    4: "Thursday",
    5: "Friday",
    6: "Saturday",
};

var taskColorCode = {
    0: {
        "background": "danger",
        "gradient": "young-passion-gradient",
        "task": "red",
    },
    1: {
        "background": "warning",
        "gradient": "peach-gradient",
        "task": "yellow",
    },
    2: {
        "background": "success",
        "gradient": "dusty-grass-gradient",
        "task": "green",
    },
    3: {
        "background": "primary",
        "gradient": "blue-gradient",
        "task": "blue",
    },
    4: {
        "background": "secondary",
        "gradient": "ripe-malinka-gradient",
        "task": "purple",
    },
    5: {
        "background": "light",
        "gradient": "bg-white",
        "task": "grey",
    }
};

var $taskTitleSpan = $(`
<span class="position-absolute py-3 shadow ganttTitle"
style="left: 0; padding-left: 2rem; padding-right: 1rem; margin-top: -1rem;"></span>
`);

var $taskProgress = $(`
<div class="progress my-auto bg-dark" title="50%">
    <div class="progress-bar text-dark font-weight-bold" role="progressbar"
        style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
</div>
`);

var $taskCreation = $(`
<tr class="subTaskCreationRow text-dark">
    <td colspan="999999">
        <button class="btn btn-sm ">Create Task +</button>
    </td>
</tr>
`);

class Model {
    constructor(startDate, endDate) {
        this.startingDate = startDate;
        this.endingDate = endDate;
    }
}

class View {
    constructor() {

    }

    initializeView(container) {
        var table = ViewUtils.createTable(container);
        table.addClass("ganttTable");
        var thead = ViewUtils.createTableHeader(table);
        thead.addClass("ganttTableHeader");
        var rowDates = ViewUtils.createTableRow(thead);

        rowDates.addClass("ganttRowDates weekDays");
        var days = ViewUtils.createTableHead(rowDates, "");
        days.addClass("nonRotatedText");

        this.visualizeTaskIntervalForm(days);

        var rowTaskTitles = ViewUtils.createTableRow(thead);
        rowTaskTitles.addClass("ganttRowMonth");
        this.visualizeTaskHeaderTitles(rowTaskTitles);

        days.prop("colspan", 5);
        var tbody = ViewUtils.createTableBody(table);
    }

    visualizeMonth(monthName, days) {
        var month = ViewUtils.createTableHead($(".ganttRowMonth"), monthName);
        month.prop("colspan", days);
        month.addClass("text-center align-middle");
    }

    visualizeTaskIntervalForm(tableData) {
        var daysForm = ViewUtils.createForm(tableData);
        daysForm.removeClass("bg-white");

        var daysFormRow = ViewUtils.addFormRow(daysForm);

        ViewUtils.addInput(daysFormRow, "startDate", "date", "Starting Date").find("input").addClass("text-white");
        ViewUtils.addInput(daysFormRow, "endDate", "date", "Ending Date").find("input").addClass("text-white");

        var daysFormRow = ViewUtils.addSubmit(daysForm, "Change interval", "newDateInterval");
    }

    visualizeTaskHeaderTitles(tableRow) {
        var taskTitles = ViewUtils.createTableHead(tableRow, "Task titles");
        taskTitles.prop("id", "titles");

        ViewUtils.createTableHead(tableRow, "Starting day").addClass("text-center align-middle");
        ViewUtils.createTableHead(tableRow, "Ending day").addClass("text-center align-middle");
        ViewUtils.createTableHead(tableRow, "Progress").addClass("text-center align-middle");
        ViewUtils.createTableHead(tableRow, "Days span").addClass("text-center align-middle");
    }

    visualizeTask(tbody, taskData) {
        var colorCode = "primary";
        var tr = ViewUtils.createTableRow(tbody);
        tr.addClass(`task bg-${colorCode}`);

        var td = ViewUtils.createTableData(tr, "&nbsp;").addClass("text-dark");
        td.prop("colspan", "999999");

        var clonedSpan = $taskTitleSpan.clone()
            .addClass("taskTitle");
        clonedSpan.text(taskData.title);
        td.append(clonedSpan);

        this.onGanttTitleHover(clonedSpan);

        return tr;
    }

    onGanttTitleHover(element) {
        element.hover(function () {
            element.stop().animate({
                paddingLeft: "6rem"
            }, 200);

            element.css("cursor", "pointer");
        }, function () {
            element.stop().animate({
                paddingLeft: "2rem"
            }, 350);
        });
    }

    visualizeSubTask(tbody, subTaskData) {
        var tr = ViewUtils.createTableRow(tbody).addClass("subTask");
        tr.addClass("task");

        var td = ViewUtils.createTableData(tr, "&nbsp;");

        var clonedSpan = $taskTitleSpan.clone()
            .addClass("subTaskTitle");
        clonedSpan.text(subTaskData.title);
        td.append(clonedSpan);

        this.onGanttTitleHover(clonedSpan);

        var startingDate = ViewUtils.createTableData(tr, "&nbsp;")
            .addClass("startingDate");
        startingDate.text(printDateWithFormat(subTaskData.startingDate, "d/m/Y"));

        var endingDate = ViewUtils.createTableData(tr, "&nbsp;")
            .addClass("endingDate");
        endingDate.text(printDateWithFormat(subTaskData.endingDate, "d/m/Y"));

        var progressIndicator = ViewUtils.createTableData(tr, "")
            .addClass("progressIndicator align-middle");
        this.visualizeProgress(progressIndicator, 50);

        var daysSpan = ViewUtils.createTableData(tr, "wegwegweg")
            .addClass("daysSpan");
        daysSpan.text(subTaskData.daysSpan)

        for (let index = 0; index < 60; index++) {
            ViewUtils.createTableData(tr, "&nbsp;");
        }

        tbody.append(tr);

        return tr;
    }

    visualizeProgress(progress, value, gradient = "aqua-gradient") {
        var clonedProgress = $taskProgress.clone();

        progress.append(clonedProgress);
        var progressBar = clonedProgress.find(".progress-bar")
            .addClass(gradient);
        progressBar.prop("title", `${value}%`);
        progressBar.width(`${value}%`);
        progressBar.prop("aria-valuenow", `${value}`);
        progressBar.text(`${value}%`);

        return clonedProgress
    }

    visualizeTaskCreation(tbody, text = "Create Task +") {
        var clonedTaskCreation = $taskCreation.clone();

        clonedTaskCreation.find(".btn").text(text);
        tbody.append(clonedTaskCreation);

        return clonedTaskCreation;
    }

    adjustMaxLengthTitles() {
        var titlesLengths = [];
        $(".taskTitle, .subTaskTitle").each(function () {
            titlesLengths.push($(this).width());
        });

        $("#titles, .taskTitle, .subTaskTitle").css("min-width", `calc(${Math.max.apply(null, titlesLengths)}px + 3rem)`);
    }
}

class Controller {
    constructor(model, view) {
        this.model = model;
        this.view = view;

        var controller = this;

        view.initializeView($("#content"));

        view.visualizeMonth("March", 30);
        var weekDaysLen = 7;
        for (let index = 0; index < 30; index++) {
            var dayInString = `${weekDays[(index + 1) % weekDaysLen]}, ${(index + 1)}`;
            ViewUtils.createTableHead($(".ganttRowDates"), dayInString);
        }
        view.visualizeMonth("April", 30);
        var weekDaysLen = 7;
        for (let index = 0; index < 30; index++) {
            var dayInString = `${weekDays[(index + 1) % weekDaysLen]}, ${(index + 1)}`;
            ViewUtils.createTableHead($(".ganttRowDates"), dayInString);
        }

        //Load from JSON
        $(tasks).each(function () {
            var taskData = this;
            var task = controller.createTask(controller, taskData);
            var subTasks = this.subTasks;

            $(subTasks).each(function () {
                var subTask = controller.createSubTask(controller, taskData, this);
            })
        });

        controller.createTaskCreationBtn(controller);

        $("main").scroll(function () {
            var height = $(this).scrollTop();

            $(".taskTitle, .subTaskTitle").css("margin-top", `calc(-1rem - ${height}px)`);
        });
    }

    createTaskCreationBtn(controller) {
        var controllerView = controller.view;
        var taskCreationButton = controllerView.visualizeTaskCreation($("tbody"))
            .removeClass("text-dark").addClass("text-white");

        taskCreationButton.find(".btn").on("click", function () {
            var newTask = controller.createTask(controller, {
                "title": `Task ${$(".taskTitle").length + 1}`,
                "id": `${$(".taskTitle").length + 1}`,
            });

            $("tbody").append(taskCreationButton);
        });

        return taskCreationButton;
    }

    createTask(controller, taskData) {
        var controllerView = controller.view;

        var task = controllerView.visualizeTask($("tbody"), taskData);
        controller.createSubTaskCreationBtn(controller, taskData);

        controllerView.adjustMaxLengthTitles();

        return task;
    }

    createSubTask(controller, taskData, subTaskData) {
        var controllerView = controller.view;

        var subTask = controllerView.visualizeSubTask($("tbody"), subTaskData);
        controller.onSubTaskDrop(subTask.find("td"));
        $(`#${taskData.id}SubTaskCreation`).before(subTask);

        controllerView.adjustMaxLengthTitles();

        return subTask;
    }

    createSubTaskCreationBtn(controller, taskData) {
        var controllerView = controller.view;
        var subTaskCreationButton = controllerView.visualizeTaskCreation($("tbody"), "Create SubTask +")
            .removeClass("text-dark").addClass("text-white")
            .prop("id", `${taskData.id}SubTaskCreation`);

        var count = 0;
        subTaskCreationButton.find(".btn").on("click", function () {
            var newsubTask = controller.createSubTask(controller, taskData, {
                "title": `Sub Task ${count + 1}`,
                "startingDate": currentDate,
                "endingDate": newDate,
                "daysSpan": "3",
            });
            count++;

            subTaskCreationButton.before(newsubTask);
        }).addClass("btn-primary text-dark");

        return subTaskCreationButton;
    }

    onSubTaskDrop(elements) {
        var startingIndex = 0;
        var firstOne = null;
        var secondOne = null;
        var rowOne = null;
        elements.prop("draggable", true);
        elements.on("dragstart", function () {
            console.log("start");
            firstOne = $(this);
            rowOne = firstOne.parent();
            if (rowOne.find(".taskBar").length > 0) {
                alert("This already has a taskBar");
                return;
            }
        }).on("dragend", function () {
            console.log("end");
            firstOne = null;
            secondOne = null;
        }).on("dragover", function (event) {
            var event = event || window.event;
            event.preventDefault();
            console.log("encima");
        }).on("drop", function () {
            console.log("drop");
            if (rowOne.prop("id") != $(this).parent().prop("id")) {
                return;
            }
            secondOne = $(this);
            var indexes = [firstOne.index(), secondOne.index()];
            var toBeAffected = rowOne.children().slice(Math.min.apply(null,
                indexes), Math.max.apply(null, indexes) + 1);
            var newTd = $("<td class='taskBar'></td>");
            $(toBeAffected[0]).before(newTd);
            toBeAffected.remove();
            newTd.prop("colspan", toBeAffected.length);
            newTd.addClass("bg-dark");
        });
    }

    addDaysToDeadline(deadline) {
        deadline.find(".addDays").on("click", function (event) {
            var event = event || window.event;
            event.preventDefault();
            var current = $(this).parents("td");
            current.prop("colspan", parseInt(current.prop("colspan")) + 1);
            current.next().remove();
        }, false);
    }

    removeDaysToDeadline(deadline) {
        deadline.find(".removeDays").on("click", function (event) {
            var event = event || window.event;
            event.preventDefault();
            var current = $(this).parents("td");
            var colspan = parseInt(current.prop("colspan"));
            current.prop("colspan", colspan - 1);
            current.after($("<td>&nbsp;</td>"));
            if (colspan <= 1) {
                current.remove();
            }
        }, false);
    }

    onTaskCreation(taskData) {

    }

    onSubTaskCreation(taskData, subTaskData) {

    }

    onTaskRemoval(taskData) {

    }

    onTaskModify(taskData) {

    }

    onTaskAddDeadline(taskData, deadlineData) {

    }

    onTaskModifyDeadline(taskData, deadlineData) {

    }

    onTaskRemoveDeadline(taskData, deadlineData) {

    }
}

var startDate = new Date();
startDate.setDate(currentDate.getDate());

var endDate = new Date();
endDate.setDate(newDate.getDate() + 90);

const ganttController = new Controller(
    new Model(startDate, endDate),
    new View()
);