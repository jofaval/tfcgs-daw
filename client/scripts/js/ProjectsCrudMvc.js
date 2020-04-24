var $projectRow = $(`<div class="row projectCardRow d-flex justify-content-center m-0"></div>`);

var $projectFlagBookmarked = $(`<div class="projectsBtnBookmarked btn btn-sm btn-warning">Bookmarked</div>`);
var $projectFlagCreated = $(`<div class="projectsBtnCreated btn btn-sm btn-success">Created</div>`);
var $projectFlagShared = $(`<div class="projectsBtnShared btn btn-sm btn-primary">Shared</div>`);

var $projectCard = $(`
<div class="projectCard row col m-2 bg-white">
    <div
        class="row projectCardDetails flex-wrap d-flex justify-content-start justify-items-center align-content-center align-items-center w-100 m-0 pt-2">
        <div class="btn btn-sm btn-primary projectCardBtnView">Go to project</div>
        <!--div class="btn btn-sm btn-danger projectCardBtnDisable">Disable project</div-->
        <h5 class="projectCardTitle m-0 font-weight-bold">Project title</h5>
        <img src="" alt="" class="projectCardBookmarkedIcon">
        <div class="projectCardFlags float-right btn-group"></div>
    </div>
    <div class="projectCardDescription text-justify my-2"></div>
</div>`);

var newProjects = [{
        "id": "7",
        "title": "test",
        "description": "testeto",
        "created": "1",
        "bookmarked": "1",
    },
    {
        "id": "8",
        "title": "Prueba",
        "description": "Test",
        "created": "1",
        "bookmarked": "0",
    }
];


class Model {
    constructor() {

    }
}

class View {
    constructor() {

    }

    initializeView(container) {}

    visualizeProject(container, name, desc = "") {
        var clonedCard = $projectCard.clone();

        clonedCard.find(".projectCardTitle").text(name);
        clonedCard.find(".projectCardDescription").text(desc);

        container.append(clonedCard);

        return clonedCard;
    }

    visualizeProjectRow(container) {
        var clonedRow = $projectRow.clone();

        container.append(clonedRow);

        return clonedRow;
    }

    visualizeProjectFlags(project, created, bookmarked) {
        var projectFlagsContainer = project.find(".projectCardFlags");

        if (created) {
            projectFlagsContainer.append($projectFlagCreated.clone());
        } else {
            projectFlagsContainer.append($projectFlagShared.clone());
        }

        if (bookmarked) {
            projectFlagsContainer.prepend($projectFlagBookmarked.clone());
        }

        return projectFlagsContainer;
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

        var controller = this;

        var mainContainer = $("#mainProjectPanel");

        view.initializeView(mainContainer);

        var projectContainer = $(".projectsContainer");

        $.ajax({
            url: "/daw/index.php?ctl=getProjectsOfUser",
            success: function (data) {
                console.log("proyectos", data);
                $(data).each(function () {
                    var projectRow = projectContainer.find(".projectCardRow ");
                    if (projectContainer.find(".projectCardRow").length == 0 || (projectRow.last().find(".projectCard").length >= 2)) {
                        projectRow = controller.view.visualizeProjectRow(projectContainer);
                        console.log(projectRow);
                    } else {
                        projectRow = projectRow.last();
                    }

                    var project = controller.view.visualizeProject(projectRow, this.title, this.description);
                    controller.view.visualizeProjectFlags(project, this.created != 0, this.bookmarked != 0);
                });
            }
        });

        var searchBar = $("#projectSearch");
        whenUserDoneTypingInInput(searchBar, "projectSearch", function () {
            var content = searchBar.val().toLowerCase();
            $(".projectCard").each(function () {
                var projectCardTitle = $(this).find(".projectCardTitle").text().trim().toLowerCase();
                var projectCardDescription = $(this).find(".projectCardDescription").text().trim().toLowerCase();
                console.log(projectCardTitle, projectCardTitle.includes(content));

                if (content != "" && (!projectCardTitle.includes(content) && !projectCardDescription.includes(content))) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        }, 100);

        $(".projectBtnAdd").on("click", controller.addProjectBtnEvent);

        $(".projectsBtnBookmarked").on("click", function () {
            controller.hideProjectsOfType("bookmarked", $(this));
        });

        $(".projectsBtnCreated").on("click", function () {
            controller.hideProjectsOfType("created", $(this));
        });

        $(".projectsBtnShared").on("click", function () {
            controller.hideProjectsOfType("shared", $(this));
        });

    }

    hideProjectsOfType(className, btn) {
        btn.toggleClass("active");
        $(".projectCard").each(function () {
            var projectCard = $(this);
            if (projectCard.find(`.projectsBtn${className[0].toUpperCase()}${className.substring(1)}`).length == 1) {
                if (btn.hasClass("active")) {
                    projectCard.addClass("d-none");
                } else {
                    projectCard.removeClass("d-none");
                }
            }
        });
    }

    addProjectBtnEvent(event) {
        var event = event || window.event;

        var modal = $.sweetModal({
            title: 'Create project',
            content: `<form action="/daw/index.php?ctl=createProjects" id="formCreateProject" class="col-sm-10  p-3 mx-auto" method="POST">
                        <div class="md-form">
                            <input type="text" placeholder="" id="title" name="title" value="Prueba" class="form-control">
                            <label for="title">Title</label>
                        </div>
                        <div class="md-form">
                        <textarea class="md-textarea form-control" placeholder="" id="description" name="description">Test</textarea>
                        <label for="description">Description</label>
                        </div>
                        <div class="row m-0 d-flex justify-content-center align-content-center align-items-center justify-items-center">
                                <input class="btn btn-primary w-100" type="submit" name="createProject" id="createProject" value="Create project">
                        </div>
                    </form>`,
            theme: $.sweetModal.THEME_DARK
        });
        modal.params["onOpen"] = function () {
            $("#formCreateProject").on("submit", function (event) {
                var event = event || window.event;
                event.preventDefault();

                $.ajax({
                    url: "/daw/index.php?ctl=createProjects",
                    data: {
                        title: $("#title").val(),
                        description: $("#description").val(),
                    },
                    success: function (result) {
                        console.log(result);
                        if (result !== false) {
                            modal.close();
                        }
                    }
                });

            });
        };
    }

    //pagination
}

const projectsController = new Controller(
    new Model(),
    new View()
);

$('li').click(function () {
    $(this).addClass('active').siblings().removeClass('active');
});