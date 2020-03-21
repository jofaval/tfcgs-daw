var $dashboard = $(`
<aside class="col-md-3 p-3 px-4 dashboard">
    <div class="list-group list-group-flush shadow">
        <a href="#" class="list-group-item active waves-effect">
            <i class="fas fa-chart-pie mr-3"></i>Dashboard
        </a>
    </div>
</aside>`);

var $dashboardOption = $(`
<a href="#" class="list-group-item list-group-item-action waves-effect">
    <i class="fas icon mr-3"></i>
    Profile
</a>`);

var $dashboardContainers = $(`<div class="col-md-9" id="dashboardContainers" style="overflow: auto;"></div>`);
var $dashboardContainer = $(`<div class="w-100" style="overflow: auto;"></div>`);

var $projectContainer = $(`<div class="projectContainer aqua-gradient rounded shadow mb-4 justify-content-around d-flex flex-wrap"
style="max-height: 20rem !important; overflow: hidden;">
</div>`);
var $projectContainerTitle = $(`<h6 class="mt-4 projectContainerTitle mb-0 waves-effect text shadow p-2 rounded text-white">&nbsp;<span class="icon float-right"></span></h6>`);

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

        $dashboard.find(".list-group").append(clonedOption);

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
        component.hide();
    }

    showComponent(component) {
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
            controllerView.hideComponent($(".dashboardContainer"));
            controllerView.showComponent($("#" + $(this).prop("dashboard-container")));
        });
        option.trigger("click");

        return container;
    }
}

const projectsController = new Controller(
    new Model(),
    new View()
);