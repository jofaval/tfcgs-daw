var $dashboard = $(`
<aside class="w-100 p-3 px-4 dashboard">
    <div class="btn-group bg-white rounded shadow">
    </div>
</aside>`);

var $dashboardOption = $(`
<a href="#" class="btn shadow-none waves-effect float-left" style="text-transform: capitalize !important;">
    <i class="fas icon mr-3"></i>
    Profile
</a>`);

var $dashboardContainers = $(`<div class="w-100 mb-auto mt-3" id="dashboardContainers" style="overflow: auto;"></div>`);
var $dashboardContainer = $(`<div class="w-100" style="overflow: auto;"></div>`);

var $projectContainer = $(`<div class="projectContainer px-3 mb-4 aqua-gradient rounded shadow justify-content-around d-flex flex-wrap"
style="max-height: 20rem !important; overflow: hidden;">
</div>`);
var $projectContainerTitle = $(`<h6 class="projectContainerTitle my-0 waves-effect text shadow p-2 rounded text-white">&nbsp;<span class="icon float-right"></span></h6>`);

var $projectCard = $(`
<div class="card my-3 mx-0" style="width: 12.5rem !important;">
    <div class="card-body px-3 py-2">
        <h5 class="card-title projectTitle mb-2"></h5>
        <small style="line-height: 1rem !important;" class="d-block projectDescription"></small>
    </div>
</div>`);

var newProjects = [{
        "title": "Title",
        "desc": "Desc",
    },
    {
        "title": "Title",
        "desc": "Desc",
    },
    {
        "title": "Title",
        "desc": "Desc",
    },
    {
        "title": "Title",
        "desc": "Desc",
    },
    {
        "title": "Title",
        "desc": "Desc",
    },
    {
        "title": "Title",
        "desc": "Desc",
    },
    {
        "title": "Title",
        "desc": "Desc",
    },
    {
        "title": "Title",
        "desc": "Desc",
    },
    {
        "title": "Title",
        "desc": "Desc",
    },
    {
        "title": "Title",
        "desc": "Desc",
    },
    {
        "title": "Title",
        "desc": "Desc",
    },
    {
        "title": "Title",
        "desc": "Desc",
    },
    {
        "title": "Title",
        "desc": "Desc",
    },
    {
        "title": "Title",
        "desc": "Desc",
    },
    {
        "title": "Title",
        "desc": "Desc",
    },
    {
        "title": "Title",
        "desc": "Desc",
    },
];

class Model {
    constructor() {

    }
}

class View {
    constructor() {

    }

    initializeView(container) {
        container.append($dashboard, $dashboardContainers);
    }

    visualizeDashboardOption(name) {
        var clonedOption = $dashboardOption.clone();

        clonedOption.text(name);
        clonedOption.prop("dashboard-container", `${name}`);
        clonedOption.addClass("dashboardOption");

        $dashboard.children(".btn-group").append(clonedOption);

        return clonedOption;
    }

    visualizeDashboardContainer(name) {
        var clonedOption = $dashboardContainer.clone();

        clonedOption.prop("id", `${name}`);
        clonedOption.addClass("dashboardContainer");

        $dashboardContainers.append(clonedOption);

        return clonedOption;
    }

    visualizeProjectContainer(container, name) {
        var clonedContainer = $projectContainer.clone();
        clonedContainer.prop("id", name);

        var clonedTitle = $projectContainerTitle.clone();
        clonedTitle.text(name);

        container.append(clonedTitle, clonedContainer);

        return clonedContainer;
    }

    visualizeProject(container, name, desc = "") {
        var clonedCard = $projectCard.clone();

        clonedCard.find(".projectTitle").text(name);
        clonedCard.find(".projectDescription").text(desc);

        container.append(clonedCard);

        return clonedCard;
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

        var mainContainer = $("#mainProjectPanel");

        view.initializeView(mainContainer);

        var projectsContainer = this.createDashboardOption(this, "Projects");

        this.createProjectSection(projectsContainer, "Bookmarked", newProjects);
        this.createProjectSection(projectsContainer, "Yours", newProjects);
        this.createProjectSection(projectsContainer, "Shared", newProjects);
        this.createProjectSection(projectsContainer, "All", newProjects);

        var create = this.createDashboardOption(this, "Create");

        create.append($(`<form action="" class="col-sm-10 bg-white p-3 mx-auto" method="POST">
        <div class="md-form">
            <input type="text" placeholder="" id="title" name="title" class="form-control">
            <label for="title">Title</label>
        </div>
        <div class="md-form">
        <textarea class="md-textarea form-control" placeholder="" id="desc" name="desc"></textarea>
        <label for="desc">Description</label>
        </div>
        <input class="btn btn-primary w-100" type="submit" name="createProject" value="Create project">
    </form>`));
    }

    addToggleProjectsEvent(title, container) {
        var toggled = true;

        var styles = "blue darken-1 font-weight-bold";
        title.toggleClass(styles);

        var alterStyles = "grey darken-3";

        title.on("click", function () {
            container.stop().animate({
                maxHeight: toggled ? "0px" : "20rem",
                paddingTop: toggled ? "0rem" : "1.5rem",
                paddingBottom: toggled ? "0rem" : "1.5rem",
            }, toggled ? 450 : 250);

            title.toggleClass(styles);
            title.toggleClass(alterStyles);

            title.find(".icon").text(toggled ? "+" : "^");

            toggled = !toggled;
        });
    }

    createProjectSection(container, name, projects) {
        var controllerView = this.view;
        var projectsContainer = controllerView.visualizeProjectContainer(container, name);
        this.addToggleProjectsEvent(projectsContainer.prev(), projectsContainer);

        $(projects).each(function () {
            var currentProject = $(this);
            controllerView.visualizeProject(projectsContainer, currentProject.prop("title"), currentProject.prop("desc"));
        });
    }

    createDashboardOption(controller, name) {
        var controllerView = controller.view;

        var option = controllerView.visualizeDashboardOption(name);
        var container = controllerView.visualizeDashboardContainer(name);

        option.on("click", function () {
            controller.onDashboardOptionClick($(this));
        });
        option.trigger("click");

        return container;
    }

    onDashboardOptionClick(dashboardOption) {
        this.view.hideComponent($(".dashboardContainer"));
        this.view.showComponent($("#" + dashboardOption.prop("dashboard-container")));
        $(".dashboardOption.btn-primary").removeClass("btn-primary");
        dashboardOption.addClass("btn-primary");
    }
}

const projectsController = new Controller(
    new Model(),
    new View()
);