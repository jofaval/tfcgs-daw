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
});
$("main").scroll(function () {
    var height = $(this).scrollTop();
    //console.log("is working", height + "rem !important");

    $(".taskTitle").css("margin-top", `calc(-1rem - ${height}px)`);
    $(".subTaskTitle").css("margin-top", `calc(-1rem - ${height}px)`);
}); */

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