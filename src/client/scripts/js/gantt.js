$(".addDays").on("click", function (event) {
    var event = event || window.event;
    event.preventDefault();
    var current = $(this).parents("td");
    current.prop("colspan", parseInt(current.prop("colspan")) + 1);
    current.next().remove();
}, false);

$(".removeDays").on("click", function (event) {
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

var taskColorCode = [{
    "background": "danger",
    "gradient": "young-passion-gradient",
    "task": "red",
}, {
    "background": "warning",
    "gradient": "peach-gradient",
    "task": "yellow",
}, {
    "background": "success",
    "gradient": "dusty-grass-gradient",
    "task": "green",
}, {
    "background": "primary",
    "gradient": "blue-gradient",
    "task": "blue",
}, {
    "background": "secondary",
    "gradient": "ripe-malinka-gradient",
    "task": "purple",
}, {
    "background": "light",
    "gradient": "bg-white",
    "task": "grey",
}];
var taskColorCodeLen = taskColorCode.length;
var tBody = $("tbody");
for (var taskIndex = 0; taskIndex < taskColorCodeLen; taskIndex++) {
    const colorCode = taskColorCode[taskIndex];
    createTask(tBody, colorCode, taskIndex);
}
var taskCreation = $(`<tr class="taskCreationRow">
                        <td class="text-dark" colspan="999999">
                                <button class="btn btn-sm text-white">Create Task +</button>
                            </td>
                            </tr>`);
tBody.append(taskCreation);
taskCreation.find(".btn").on("click", function () {
    createTask(tBody, taskColorCode[0], taskIndex++).after(taskCreation);
});

function createTask(tBody, colorCode, taskIndex) {
    var mainTask = $(`<tr class="bg-${colorCode.background}">
                                        <td class="text-dark" colspan="999999"><span
                                                class="position-absolute py-3 shadow bg-${colorCode.background} taskTitle gantttitle"
                                                style="left: 0; padding-left: 2rem; padding-right: 1rem; margin-top: -1rem;">
                                                Task ${(taskIndex + 1)}</span>&nbsp;</td>
                                    </tr>`);
    tBody.append(mainTask);
    mainTask.find(".taskTitle").unbind("hover");
    mainTask.find(".taskTitle").on("hover", function () {
        $(this).stop(true, true).animate({
            paddingLeft: "6rem"
        }, 200);
        //console.log($(this).css("padding-left"));

        $(this).css("cursor", "pointer");
    }, function () {
        $(this).stop(true, true).animate({
            paddingLeft: "2rem"
        }, 350);
    });
    var randomTasksNumber = Math.floor(Math.random() * 6);
    for (var subTaskIndex = 0; subTaskIndex < 5; subTaskIndex++) {
        tBody.append(createSubTask(tBody, colorCode, taskIndex, subTaskIndex));
    }
    var subTaskCreation = $(`<tr class="subTaskCreationRow">
    <td class="text-dark" colspan="999999">
            <button class="btn btn-${colorCode.background} btn-sm text-dark">Create Sub Task +</button>
        </td>
        </tr>`);
    tBody.append(subTaskCreation);
    subTaskCreation.find(".btn").on("click", function () {
        var subTask = createSubTask(tBody, colorCode, taskIndex,
            subTaskIndex++);
        subTaskCreation.before(subTask);

        subTask.find(".subTaskTitle").unbind("hover");
        subTask.find(".subTaskTitle").on("hover", function () {
            $(this).stop(true, true).animate({
                paddingLeft: "6rem"
            }, 200);
            //console.log($(this).css("padding-left"));

            $(this).css("cursor", "pointer");
        }, function () {
            $(this).stop(true, true).animate({
                paddingLeft: "2rem"
            }, 350);
        });
    });
    return subTaskCreation;
}

function createSubTask(tBody, colorCode, taskIndex, subTaskIndex) {
    var randomProgress = Math.floor(Math.random() * 70) + 30;
    var subTask = $(`<tr class="subtask" id="task${(taskIndex + 1)}_subtask${(subTaskIndex + 1)}">
            <td><span class="position-absolute py-3 shadow subTaskTitle gantttitle"
                    style="left: 0; padding-left: 2rem; padding-right: 1rem; margin-top: -1rem; background: #343a40;">Sub
                    Task ${(subTaskIndex + 1)}</span></td>
            <td class="startingDate">&nbsp;</td>
            <td class="endingDate">&nbsp;</td>
            <td class="progressIndicator">
                <div class="progress my-auto bg-dark" title="${randomProgress}%">
                    <div class="progress-bar ${colorCode.gradient} text-dark font-weight-bold" role="progressbar"
                        style="width: ${randomProgress}%;" aria-valuenow="${randomProgress}" aria-valuemin="0" aria-valuemax="100">${randomProgress}%</div>
                </div>
            </td>
            <td class="daysSpan">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td class="${colorCode.task} rounded" colspan="4">&nbsp; <span class="shadow text-dark removeDays">-</span><span
                    class="shadow text-dark addDays float-right">+</span>
            </td>
            </tr>`);
    for (let subTaskColumnIndex = 0; subTaskColumnIndex < 53; subTaskColumnIndex++) {
        subTask.append(`<td>&nbsp;</td>`);
    }
    return subTask;
}

/* var selectedRow = null;
var firstPoint = null;
var secondPoint = null;
$("td").on("click", function () {
    var currentTd = $(this);
    var currentRow = currentTd.parents("tr");
    if (currentRow.find(".taskBar").length > 0) {
        alert("This already has a taskBar");
        return;
    }
    if (selectedRow != null) {
        if (currentRow.prop("id") != selectedRow.prop("id")) {
            console.log(currentRow, selectedRow);
            firstPoint = currentTd;
            selectedRow = currentRow;
            return;
        }
    }
    selectedRow = currentRow;
    if (firstPoint != null) {
        secondPoint = currentTd;
        var indexes = [firstPoint.index(), secondPoint.index()];
        var toBeAffected = selectedRow.children().slice(Math.min.apply(null,
            indexes), Math.max.apply(null, indexes) + 1);
        var newTd = $("<td class='taskBar'></td>");
        $(toBeAffected[0]).before(newTd);
        toBeAffected.remove();
        newTd.prop("colspan", toBeAffected.length);
        newTd.addClass("bg-dark");
        firstPoint = null;
        secondPoint = null;

        //toBeAffected.addClass("bg-dark");

    } else {
        firstPoint = currentTd;
    }
}); */
$("main").scroll(function () {
    var height = $(this).scrollTop();
    //console.log("is working", height + "rem !important");

    $(".taskTitle").css("margin-top", `calc(-1rem - ${height}px)`);
    $(".subTaskTitle").css("margin-top", `calc(-1rem - ${height}px)`);
});

$(".taskTitle, .subTaskTitle").hover(function () {
    $(this).stop(true, true).animate({
        paddingLeft: "6rem"
    }, 200);
    //console.log($(this).css("padding-left"));

    $(this).css("cursor", "pointer");
}, function () {
    $(this).stop(true, true).animate({
        paddingLeft: "2rem"
    }, 350);
});

var titlesLengths = [];
$(".taskTitle, .subTaskTitle").each(function () {
    titlesLengths.push($(this).width());
});

$("#titles").css("min-width", "calc(" + Math.max.apply(null, titlesLengths) +
    "px + 3rem)");

var currentDate = new Date();
$(".startingDate").text(printDateWithFormat(currentDate, "d/m/Y"));

var newDate = new Date();
newDate.setDate(currentDate.getDate() + 3);
$(".endingDate").text(printDateWithFormat(newDate, "d/m/Y"));

var days = Math.round((newDate - currentDate) / (1000 * 60 * 60 * 24));
$(".daysSpan").text(`${days}`); /* day(s)*/

$("th").on("click", function () {
    var index = $(this).index() + 5;
    $(".selectedColumn").removeClass("selectedColumn");

    $(".subtask").each(function () {
        console.log("test");
        var current = $(this);
        var children = current.children();
        var newIndex = index - 1;

        var colspan = current.find("*[colspan]");
        console.log("colspan", colspan);

        if (colspan.length) {
            var colspanElement = colspan.first();
            if (colspanElement.index() < newIndex) {
                var indexSubstraction = colspanElement.prop(
                    "colspan") - 1;
                console.log(indexSubstraction);

                newIndex -= indexSubstraction;
            }
        }

        children.eq(newIndex).addClass("selectedColumn");
    });
});


var startingIndex = 0;
var firstOne = null;
var secondOne = null;
var rowOne = null;
$(".subtask td").prop("draggable", true);
$(".subtask td").on("dragstart", function () {
    //console.log("start");
    firstOne = $(this);
    rowOne = firstOne.parent();
    if (rowOne.find(".taskBar").length > 0) {
        alert("This already has a taskBar");
        return;
    }
}).on("dragend", function () {
    //console.log("end");
    firstOne = null;
    secondOne = null;
}).on("dragover", function (event) {
    var event = event || window.event;
    event.preventDefault();
    //console.log("encima");
}).on("drop", function () {
    //console.log("drop");
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