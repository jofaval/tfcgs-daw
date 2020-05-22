var $paginationItem = $(`<li class="page-item"><a class="page-link text-white"></a></li>`);
var $currentPaginationItem = $(`<span class="sr-only">(current)</span>`);

var $projectRow = $(`<div class="row projectCardRow d-flex flex-wrap justify-content-center m-0"></div>`);
var $projectPage = $(`<div class="projectsPage"></div>`);

var $projectFlagBookmarked = $(`<div class="projectsBtnBookmarked btn btn-sm btn-warning">Favorito</div>`);
var $projectFlagCreated = $(`<div class="projectsBtnCreated btn btn-sm btn-success text-dark">Creado</div>`);
var $projectFlagShared = $(`<div class="projectsBtnShared btn btn-sm btn-primary">Compartido</div>`);

var $projectCard = $(`
<div class="projectCard text-dark row col-12 px-0 col-sm m-2 bg-grey">
    <img src="" alt="" class="projectCardBgImg object-fit-cover opacity-80 brightness-30 position-absolute w-100 h-100 z-index">
    <div
        class="row projectCardDetails pl-3 z-index-overlap flex-wrap d-flex justify-content-start justify-items-center align-content-center align-items-center w-100 m-0 pt-2">
        <a href="" class="btn btn-sm btn-primary projectCardBtnView">Ver</a>
        <!--div class="btn btn-sm btn-danger projectCardBtnDisable">Disable project</div-->
        <h5 class="projectCardTitle text-white max-text-10 text-overflow-ellipsis overflow-hidden m-0 font-weight-bold">Título del proyecto</h5>
        <div class="projectCardBookmarkedIcon"></div>
        <div class="projectCardFlags float-right btn-group d-none d-sm-block"></div>
    </div>
    <a href="" class="projectReadMore p-2 text-white">Leer más...</a>
    <div class="projectCardDescription text-white max-text-20 text-overflow-ellipsis pl-3 z-index-overlap-bottom overflow-hidden text-justify my-2"></div>
</div>`);

class Model {
    constructor() {
        this.paginationIndex = 1;

        var splittedURL = window.location.href.split("/");
        this.rowNumberFromURL = splittedURL[6];
        this.pageIndexFromURL = splittedURL[8];
        if (splittedURL.length >= 10) {
            this.searchValueFromURL = splittedURL[10];
        }

    }

    loadProjects(whenFinished) {
        var model = this;
        $.ajax({
            url: "/daw/index.php?ctl=getProjectsOfUser",
            success: function (projects) {
                model.projects = projects;
                model.workingProjects = projects;
                whenFinished(projects);
            }
        });
    }

    createProject(title, description, whenFinished) {
        var model = this;

        $.ajax({
            url: "/daw/index.php?ctl=createProjects",
            data: {
                "title": title,
                "description": description,
                "id_project": model.projectId,
            },
            success: function (result) {
                model.workingProjects.push(result[0]);
                whenFinished(result);
            }
        });
    }

    bookmarkProject(json, whenFinished, ifErrorThen) {
        var model = this;

        $.ajax({
            url: "/daw/index.php?ctl=bookmarkProject",
            data: {
                "id_project": model.projectId,
                "title": json.title,
                "bookmarked": json.bookmarked,
            },
            success: function (result) {
                whenFinished(result);
            },
            error: function (result) {
                ifErrorThen(result);
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

    visualizeProjectPage(container) {
        var clonedRow = $projectPage.clone();

        container.append(clonedRow);

        return clonedRow;
    }

    visualizePaginationItem(index) {
        var clonedPageItem = $paginationItem.clone();

        clonedPageItem.find(".page-link").html(index + "");
        $(".pagination .nav-next").before(clonedPageItem);

        return clonedPageItem;
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
            if (controller.model.rowNumberFromURL != undefined) {
                if (controller.model.searchValueFromURL) {
                    searchBar.val(controller.model.searchValueFromURL);
                    $("#selectNumberOfRows").val(controller.model.rowNumberFromURL);
                    controller.searchProjectEvent(searchBar, controller, function () {
                        var indexToLoad = controller.model.pageIndexFromURL;
                        $(".page-item").eq(indexToLoad).trigger("click");
                    });
                } else {
                    controller.reload(controller, function () {
                        var indexToLoad = controller.model.pageIndexFromURL;
                        $(".page-item").eq(indexToLoad).trigger("click");
                    });
                }
            } else {
                controller.reload(controller, function () {
                    $(".page-item").eq(1).trigger("click");
                });
            }
            $(".numberOfProjects").text(projects.length);
        });

        var selectNumberOfRows = $("#selectNumberOfRows");
        var localStorageNumberRows = localStorage.getItem("numberOfRowsInCollaborators");
        if (localStorageNumberRows === null) {
            localStorageNumberRows = 3;
        }
        selectNumberOfRows.val(localStorageNumberRows);
        selectNumberOfRows.on("change", function () {
            controller.reload(controller);
            localStorage.setItem("numberOfRowsInProjects", selectNumberOfRows.val());
            controller.pageChanged(controller, 1);
        });

        var searchBar = $("#projectSearch");
        whenUserDoneTypingInInput(searchBar, "projectSearch", function () {
            controller.searchProjectEvent(searchBar, controller);
        }, 100);

        $(".projectBtnAdd").on("click", function (event) {
            controller.addProjectBtnEvent(controller, event);
        });

        $(".projectsBtnFilters .btn").on("click", function () {
            //controller.hideProjectsOfType(controller, $(this));
            $(this).toggleClass("active");

            controller.reload(controller);
        });

        $(".page-item.nav-previous .page-link").on("click", function () {
            var activePage = $(this).parent().siblings(".active").prev();
            if (!activePage.hasClass("nav-previous")) {
                activePage.trigger("click");
            }
        });

        $(".page-item.nav-next .page-link").on("click", function () {
            var activePage = $(this).parent().siblings(".active").next();
            if (!activePage.hasClass("nav-next")) {
                activePage.trigger("click");
            }
        });
    }

    searchProjectEvent(searchBar, controller, callback = null) {
        var content = searchBar.val().toLowerCase();
        var newProjectsJSON = [];
        if (content == "") {
            newProjectsJSON = controller.model.projects;
        } else {
            $(controller.model.projects).each(function () {
                if (content == "" || (!this.title.toLowerCase().includes(content) && !this.description.toLowerCase().includes(content))) {
                    return;
                }
                newProjectsJSON.push(this);
            });
        }
        if (newProjectsJSON.length > 0) {
            controller.model.workingProjects = newProjectsJSON;
            controller.model.filterProjects = newProjectsJSON;
            if (callback != null) {
                controller.reload(controller, callback);
            } else {
                controller.reload(controller);
            }
            controller.pageChanged(controller, 1);
        } else {
            controller.clearContainer(controller);
            $(".projectsContainer").text(controller.model.projects.length > 0 ? "No se han encontrado resultados." : "No hay proyectos");
        }
    }

    clearContainer(controller) {
        $(".projectsContainer").html("");
    }

    pageChanged(controller, pageIndex) {
        var url = `/daw/projects/rows/${localStorage.getItem("numberOfRowsInProjects")}/page/${pageIndex}/`;

        var search = $("#projectSearch").val();
        if (search.length > 0) {
            url += `search/${search}/`;
        }

        changeURL(url);
    }

    reload(controller, callback = null) {
        $(".numberOfProjects").html(controller.model.projects.length);
        controller.clearContainer(controller);
        controller.model.paginationIndex = 1;
        var pagination = $(".pagination");

        var navigation = $(".page-item.nav-previous, .page-item.nav-next");
        pagination.before(navigation);
        pagination.html("");
        pagination.append(navigation);

        var projectFilters = $(".projectsBtnFilters");
        var hideBookmarked = projectFilters.find(".projectsBtnBookmarked").hasClass("active");
        var hideCreated = projectFilters.find(".projectsBtnCreated").hasClass("active");
        var hideShared = projectFilters.find(".projectsBtnShared").hasClass("active");

        console.log(
            "hideBookmarked", hideBookmarked,
            "hideCreated", hideCreated,
            "hideShared", hideShared
        );

        var noResultsFound = true;
        $(controller.model.workingProjects).each(function () {
            if ((hideBookmarked && (this.bookmarked != 0)) ||
                (hideCreated && (this.created != 0)) ||
                (hideShared && !(this.created != 0))
            ) {
                return;
            }
            noResultsFound = false;

            this.html = controller.addProject(controller, this);
        });

        if (noResultsFound) {
            controller.clearContainer(controller);

            $(".projectsContainer").text(controller.model.projects.length > 0 ? "No se han encontrado resultados." : "No hay proyectos");
        }

        console.log(controller.model.workingProjects);

        var len = $(".page-item").length;
        for (let index = len - 2; index > 0; index--) {
            $(".page-item").eq(index).trigger("click");
        }

        if (callback != null) {
            callback();
        }
    }

    getProjectPage(controller, container) {
        var projectsPage = container.find(".projectsPage").last();
        var projectPageRows = projectsPage.find(".projectCardRow");

        /* console.log(
            "número páginas", container.find(".projectsPage").length,
            "demasiadas rows por página", projectPageRows.length > $("#selectNumberOfRows").val(),
            "la página está completa", projectPageRows.last().find(".projectCard").length >= 2
        ); */

        if (container.find(".projectsPage").length == 0 ||
            (projectPageRows.length >= $("#selectNumberOfRows").val() &&
                projectPageRows.last().find(".projectCard").length >= 2)) {
            projectsPage = controller.view.visualizeProjectPage(container);

            controller.addPaginationItem(controller);
            //console.log(projectsPage);
        }

        return projectsPage;
    }

    addPaginationItem(controller) {
        var currentPaginationIndex = controller.model.paginationIndex;
        var paginationItem = controller.view.visualizePaginationItem(currentPaginationIndex);
        controller.model.paginationIndex++;

        paginationItem.on("click", function () {
            $(this).addClass('active').siblings().removeClass('active');
            $(this).find(".page-link").append($currentPaginationItem);
            var projectPages = $(".projectsPage");
            projectPages.hide();
            projectPages.eq(parseInt($(this).text()) - 1).show();
            controller.pageChanged(controller, currentPaginationIndex);
        });
    }

    getProjectRow(controller, container) {
        var projectPage = controller.getProjectPage(controller, container);
        var projectRow = projectPage.find(".projectCardRow ");
        if (projectPage.find(".projectCardRow").length == 0 || (projectRow.last().find(".projectCard").length >= 2)) {
            projectRow = controller.view.visualizeProjectRow(projectPage);
            //console.log(projectRow);
        } else {
            projectRow = projectRow.last();
        }

        return projectRow;
    }

    addProject(controller, json) {
        var projectContainer = $(".projectsContainer");
        var projectRow = controller.getProjectRow(controller, projectContainer);

        var project = controller.view.visualizeProject(projectRow, json.title, json.description);
        var bookmarkedIcon = project.find(".projectCardBookmarkedIcon");
        bookmarkedIcon.addClass(json.bookmarked != 0 ? "active" : "");
        bookmarkedIcon.on("click", this.bookmarkProject(controller, json, bookmarkedIcon));
        controller.view.visualizeProjectFlags(project, json.created != 0, json.bookmarked != 0);

        var url = `/daw/projects/id/${json.id}/`;
        project.find(".projectCardBtnView").prop("href", url);
        project.find(".projectCardBgImg").prop("src", `/daw/img/projects/${json.id}/bg.png`);
        project.find(".projectReadMore").prop("href", url);

        return project;
    }

    bookmarkProject(controller, json, bookmarkedIcon) {
        return function () {
            bookmarkProject(json, function () {
                if (result !== false) {
                    bookmarkedIcon.toggleClass("active");
                    json.bookmarked = !json.bookmarked;
                }
                console.log("resultado", result, "activo", bookmarkedIcon.hasClass("active"));
                bookmarkedIcon.bind("click", controller.bookmarkProject(controller, json, bookmarkedIcon));
            }, function () {
                sendNotification(`No se ha podido ${bookmarkedIcon.hasClass("active") ? "quitar" : "añadir"} a favoritos`, "bookmarkingProject");
                bookmarkedIcon.bind("click", controller.bookmarkProject(controller, json, bookmarkedIcon));
            });
            bookmarkedIcon.unbind("click");
        };
    }

    addProjectBtnEvent(controller, event) {
        var event = event || window.event;

        var modal = Modal.modal({
            "title": "Crear proyecto",
            "content": `<form action="/daw/index.php?ctl=createProjects" id="formCreateProject" class="col-sm-10  p-3 mx-auto" method="POST">
                        <div class="md-form">
                            <input type="text" placeholder="" id="title" name="title" value="Prueba" class="form-control text-white">
                            <label for="title">Título</label>
                        </div>
                        <div class="md-form">
                        <textarea class="md-textarea form-control text-white" placeholder="" id="description" name="description">Test</textarea>
                        <label for="description">Descripción</label>
                        </div>
                        <div class="row m-0 d-flex justify-content-center align-content-center align-items-center justify-items-center">
                                <input class="btn btn-primary w-100" type="submit" name="createProject" id="createProject" value="Crear project">
                        </div>
                    </form>`,
            "onOpen": function () {
                $("#description").focus();
                $("#title").focus();
                $("#formCreateProject").on("submit", function (event) {
                    var event = event || window.event;
                    event.preventDefault();

                    controller.model.createProject($("#title").val(), $("#description").val(), function (result) {
                        console.log(result);
                        if (result !== false) {
                            modal.close();
                            controller.addProject(controller, result[0]);
                            controller.reload(controller);
                            window.location.href = `/daw/projects/id/${result[0]["id"]}/`;
                        }
                    });

                    return false;
                });
            },
        });
    }

    //pagination
}

const projectsController = new Controller(
    new Model(),
    new View()
);