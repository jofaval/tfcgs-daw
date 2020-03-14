var test = $(`<div class="taskItem card mb-2 bg-dark" draggable="true">
                        <div class="card-body px-2 py-1">
                            <p class="card-text">&nbsp;</p>
                        </div>
                    </div>`);
var emptyTaskTemplate = $(`<div class="taskItem card mb-2" draggable="true">
                        <div class="card-body px-2 py-1">
                            <p class="card-text">&nbsp;</p>
                        </div>
                    </div>`);

var emptyListTemplate = $(`<div class="taskContainer mx-2">
            <div class="taskList bg-light rounded">
                <section class="listTitle rounded grey lighten-3 text-left p-2">
                    <p class="mb-0 ml-3">Titulo 1</p>
                </section>
                <div class="px-3 pt-2 mb-3 taskItemContainer" ondrop="console.log('hola');"
                    ondragover="event.preventDefault()">
                </div>
                <div class="pb-3">
                    <div class="col d-flex">
                        <div class="input-group md-form my-0">
                            <input type="text" class="form-control" placeholder="First name">
                            <div class="input-group-append">
                                <button class="btn addTask btn-sm btn-primary m-0">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`);

var startingTaskListParent = null;
var startingIndex = 0;
var endingTaskListParent = null;
var endingIndex = 0;
//$(".taskItem").draggable();
$(".taskItem").on("dragstart", function () {
    $(this).addClass("dragging");
    startingIndex = $(this).index();

    console.log("test");
    startingTaskListParent = $(this).parent().parent().find(".listTitle rounded").text()
        .trim();
});

$(".taskItem").on("drop", function () {
    console.log("hahahaha");
});

$(".taskItem").on("dragover", function () {
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

    //console.log("estas encima");
    //console.log($(this).text());
});
$(".taskItem").on("dragend", function () {
    $(this).removeClass("dragging");
    test.hide();
    var parent = test.parent().parent();
    endingTaskListParent = parent.find(".listTitle rounded").text().trim();
    endingIndex += test.index();
    //endingIndex = endingIndex > 1 ? endingIndex - 1 : 0;
    parent.find(".taskItem:nth-child(" + (endingIndex + 1) + ")").after($(this));

    var count = 0;
    console.log("startingTaskListParent", startingTaskListParent,
        "endingTaskListParent", endingTaskListParent);
    console.log("startingIndex", startingIndex,
        "endingIndex", endingIndex);
    $(this).parent().find(".taskItem").each(function () {
        count++;
        //console.log("count: ", count, "title", $(this).text().trim());

    });
});

$(".addTask").on("click", addTaskToList);
$(".addList").on("click", function () {
    var input = $(this).parents(".input-group").find("input");
    var inputValue = input.val();
    input.val("");
    var container = $(this).parents(".taskContainer");
    var newList = emptyListTemplate.clone();
    newList.find(".addTask").on("click", addTaskToList);
    newList.find(".listTitle rounded p").text(inputValue);
    container.before(newList);
    console.log(container);

    $('main').animate({
        scrollLeft: newList.offset().left
    }, 1000);

});
/* $(".md-form input").focus(function () {
    $(this).parent().removeClass("md-form");
}).blur(function () {
    $(this).parent().addClass("md-form");
}); */

function addTaskToList() {
    var input = $(this).parents(".input-group").find("input");
    var inputValue = input.val();
    input.val("");
    var container = $(this).parents(".taskContainer").find(".taskItemContainer");
    var newTask = emptyTaskTemplate.clone();
    newTask.find(".card-text").text(inputValue);
    container.append(newTask);
}