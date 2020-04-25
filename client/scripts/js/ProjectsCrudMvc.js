var $projectRow = $(`<div class="row projectCardRow d-flex flex-wrap justify-content-center m-0"></div>`);

var $projectFlagBookmarked = $(`<div class="projectsBtnBookmarked btn btn-sm btn-warning">Bookmarked</div>`);
var $projectFlagCreated = $(`<div class="projectsBtnCreated btn btn-sm btn-success">Created</div>`);
var $projectFlagShared = $(`<div class="projectsBtnShared btn btn-sm btn-primary">Shared</div>`);

var $projectCard = $(`
<div class="projectCard row col-12 col-sm m-2 bg-white">
    <div
        class="row projectCardDetails flex-wrap d-flex justify-content-start justify-items-center align-content-center align-items-center w-100 m-0 pt-2">
        <a href="" class="btn btn-sm btn-primary projectCardBtnView">Go to project</a>
        <!--div class="btn btn-sm btn-danger projectCardBtnDisable">Disable project</div-->
        <h5 class="projectCardTitle m-0 font-weight-bold">Project title</h5>
        <div class="projectCardBookmarkedIcon"></div>
        <div class="projectCardFlags float-right btn-group"></div>
    </div>
    <div class="projectCardDescription text-justify my-2"></div>
</div>`);

class Model {
    constructor() {

    }

    loadProjects(whenFinished) {
        var model = this;
        $.ajax({
            url: "/daw/index.php?ctl=getProjectsOfUser",
            success: function (data) {
                model.projects = data;
                whenFinished(data);
            }
        });
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
            //projectFlagsContainer.prepend($projectFlagBookmarked.clone());
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

        model.loadProjects(function (projects) {
            console.log("proyectos", projects);
            $(projects).each(function () {
                controller.addProject(controller, this);
            });
            $(".numberOfProjects").text(projects.length);
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

        $(".projectBtnAdd").on("click", function (event) {
            controller.addProjectBtnEvent(controller, event);
        });

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

    addProject(controller, json) {
        var projectContainer = $(".projectsContainer");
        var projectRow = projectContainer.find(".projectCardRow ");
        if (projectContainer.find(".projectCardRow").length == 0 || (projectRow.last().find(".projectCard").length >= 2)) {
            projectRow = controller.view.visualizeProjectRow(projectContainer);
            console.log(projectRow);
        } else {
            projectRow = projectRow.last();
        }

        var project = controller.view.visualizeProject(projectRow, json.title, json.description);
        var bookmarkedIcon = project.find(".projectCardBookmarkedIcon");
        bookmarkedIcon.addClass(json.bookmarked != 0 ? "active" : "");
        bookmarkedIcon.on("click", this.bookmarkProject(controller, json, bookmarkedIcon));
        controller.view.visualizeProjectFlags(project, json.created != 0, json.bookmarked != 0);
        project.find(".projectCardBtnView").prop("href", `/daw/projects/id/${json.id}/`);

        return project;
    }

    bookmarkProject(controller, json, bookmarkedIcon) {
        return function () {
            $.ajax({
                url: "/daw/index.php?ctl=bookmarkProject",
                data: {
                    "id_project": json.id,
                    "bookmarked": json.bookmarked,
                },
                success: function (result) {
                    if (result !== false) {
                        bookmarkedIcon.toggleClass("active");
                        json.bookmarked = !json.bookmarked;
                    }
                    console.log("resultado", result, "activo", bookmarkedIcon.hasClass("active"));
                    bookmarkedIcon.bind("click", controller.bookmarkProject(controller, json, bookmarkedIcon));
                },
                error: function (result) {
                    sendNotification(`No se ha podido ${bookmarkedIcon.hasClass("active") ? "quitar" : "añadir"} a favoritos`, "bookmarkingProject");
                    bookmarkedIcon.bind("click", controller.bookmarkProject(controller, json, bookmarkedIcon));
                }
            });
            bookmarkedIcon.unbind("click");
        };
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
            /* if (projectCard.find(`.projectsBtn${className[0].toUpperCase()}${className.substring(1)}`).length == 1) {
                if (btn.hasClass("active")) {
                    projectCard.removeClass("d-none");
                } else {
                    projectCard.addClass("d-none");
                }
            } else {
                projectCard.removeClass("d-none");
            } */
        });
    }

    addProjectBtnEvent(controller, event) {
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
                            controller.addProject(controller, result[0]);
                            controller.model.projects.push(result[0]);
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