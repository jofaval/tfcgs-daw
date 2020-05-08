class Model {
    constructor() {

    }
}

class View {
    constructor() {

    }

    initializeView(container) {
        $("#content").addClass("d-flex flex-row");
        var form = ViewUtils.createForm($("#diaryForm"), "./diary/date/")
            .addClass("w-100").removeClass("bg-white").css({
                background: "#222224",
            });
        var title = ViewUtils.addFormTitle($("#diaryForm"), "Project diary")
            .addClass("text-white").replaceWith(function () {
                return $("<h3>", {
                    "class": this.className,
                    html: $(this).html(),
                });
            });
        var row = ViewUtils.addFormRow(form);
        var date = ViewUtils.addInput(form, "diaryDate", "date")
            .find("input").addClass("text-white");
        ViewUtils.addSubmit(form, "Go to date", "date");
        $("#diaryDate").val(new DateUtils(new Date()).printDateWithFormat("Y-m-d"));
    }

    hideComponent(component) {
        //component.fadeOut();
        component.hide();
    }

    showComponent(component) {
        //component.fadeIn();
        component.show();
    }
}

class Controller {
    constructor(model, view) {
        this.model = model;
        this.view = view;

        var mainContainer = $("#content");

        view.initializeView(mainContainer);
    }

}

const projectController = new Controller(
    new Model(),
    new View()
);

$('.pagination li').click(function () {
    $(this).addClass('active').siblings().removeClass('active');
});

$(".projectBtnAdd").on("click", function (event) {
    var event = event || window.event;

    $.sweetModal({
        title: 'Create dashboard',
        content: `<form action="/daw/index.php?ctl=createProjects" class="col-sm-10  p-3 mx-auto" method="POST">
                <div class="md-form">
                    <input type="text" placeholder="" id="title" name="title" class="form-control">
                    <label for="title">Title</label>
                </div>
                <div class="md-form">
                <textarea class="md-textarea form-control" placeholder="" id="description" name="description"></textarea>
                <label for="description">Description</label>
                </div>
                <div class="row m-0 d-flex justify-content-center align-content-center align-items-center justify-items-center">
                        <input class="btn btn-primary w-100" type="submit" name="createProject" value="Crear project">
                </div>
            </form>`,
        theme: $.sweetModal.THEME_DARK
    });
});

/* $('.tab').on("click", function () {
    var current = $(this);

    $(".tabContent.d-block").addClass("d-none")
        .removeClass("d-block");

    $(`#tabContent${current.index() + 1}`).addClass("d-block")
        .removeClass("d-none");

    $(".tab.active").removeClass("active");
    current.addClass("active");
});
$('.tab').eq(0).click(); */

var navigationScheme = $("#projectDiaryNavigationScheme");
$(".note-editable.card-block").append("<h1>Test 1656</h1>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h1>Test 552</h1>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h2>subtitle</h2>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h3>ewgewhweh</h3>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h3>trjyuykt</h3>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h3>weyweywey45yh5r</h3>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h4>jeggwef</h4>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h5>yjk67kj67</h5>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h1>Test 12</h1>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h1>subtitle 2</h1>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h2>subtitle</h2>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h3>ewgewhweh</h3>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h3>trjyuykt</h3>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h3>weyweywey45yh5r</h3>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h4>jeggwef</h4>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h1>Test 1564156</h1>");


$("#navigationSchemeBtn").on("click", function () {
    navigationScheme.html("");
    var levels = {
        "H1": 0,
        "H2": 0,
        "H3": 0,
        "H4": 0,
        "H5": 0,
        "H6": 0,
    };
    var summernoteContent = $(".note-editable.card-block");
    var content = $(summernoteContent.html());
    summernoteContent.html("");
    content.each(function () {
        var current = $(this);
        current.find(".level").remove();
        var indentationLevel = -1;
        var tagName = current.get(0).tagName;
        levels[tagName]++;
        if (current.is("h1, h2, h3, h4, h5, h6")) {
            //console.log("current", current.get(0).tagName.replace("H", ""), current);

            indentationLevel += parseInt(tagName.replace("H", ""));
            levels
        }


        var title = current.text().trim();
        if (indentationLevel != -1) {
            var tagNameToResetIndex = indentationLevel + 2;
            while (tagNameToResetIndex <= 6) {
                levels["H" + tagNameToResetIndex] = 0;
                tagNameToResetIndex++;
            }

            var newTitle = title;
            if (newTitle.length > 15) {
                newTitle = newTitle.substring(0, 14);
            }

            var trueLevel = getTrueLevel(levels, indentationLevel);
            navigationScheme.append($(
                `<li style="padding-left: ${indentationLevel * 0.5}em">
                    <a href="#${trueLevel}">
                        ${trueLevel} ${newTitle}
                    </a>
                </li>`));
            current.prop("id", trueLevel);
            if (current.find(".level").length == 0) {
                current.prepend(`<span class="level">${trueLevel}</span> `);
            }
        }
        summernoteContent.append(current);
    });
});
$("#navigationSchemeBtn").click();

function getTrueLevel(levels, indentationLevel) {
    indentationLevel++;
    var string = "";

    while (indentationLevel >= 1) {
        string = `${levels["H" + indentationLevel]}.${string}`;
        indentationLevel--;
    }

    return string;
}