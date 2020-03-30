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
        $("#diaryDate").val(printDateWithFormat(new Date(), "Y-m-d"));
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

const projectsController = new Controller(
    new Model(),
    new View()
);