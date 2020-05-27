var $paginationItem = $(`<li class="page-item"><a class="page-link text-dark"></a></li>`);
var $currentPaginationItem = $(`<span class="sr-only">(current)</span>`);

var $dashboardRow = $(`<div class="row dashboardCardRow d-flex flex-wrap justify-content-center m-0"></div>`);
var $dashboardPage = $(`<div class="dashboardsPage"></div>`);

var $dashboardFlagBookmarked = $(`<div class="dashboardsBtnBookmarked btn btn-sm btn-warning">Favorito</div>`);
var $dashboardFlagCreated = $(`<div class="dashboardsBtnCreated btn btn-sm btn-success text-dark">Creado</div>`);
var $dashboardFlagShared = $(`<div class="dashboardsBtnShared btn btn-sm btn-primary">Compartido</div>`);

var $dashboardCard = $(`
<div class="dashboardCard text-dark row col-12 px-0 col-sm m-2 bg-grey">
    <img src="" alt="" class="dashboardCardBgImg object-fit-cover opacity-80 brightness-30 position-absolute w-100 h-100 z-index">
    <div
        class="row dashboardCardDetails pl-3 z-index-overlap flex-wrap d-flex justify-content-start justify-items-center align-content-center align-items-center w-100 m-0 pt-2">
        <a href="" class="btn btn-sm btn-primary dashboardCardBtnView">Ver</a>
        <!--div class="btn btn-sm btn-danger dashboardCardBtnDisable">Disable dashboard</div-->
        <h5 class="dashboardCardTitle max-text-10 text-white text-overflow-ellipsis overflow-hidden m-0 font-weight-bold">Dashboard title</h5>
        <div class="dashboardCardBookmarkedIcon"></div>
        <div class="dashboardCardFlags float-right btn-group d-none d-sm-block"></div>
    </div>
    <a href="" class="dashboardReadMore text-white">Leer más...</a>
    <div class="dashboardCardDescription text-white max-text-20 text-overflow-ellipsis pl-3 z-index-overlap-bottom overflow-hidden text-justify my-2"></div>
</div>`);

class Model {
    constructor() {
        this.paginationIndex = 1;
        this.projectId = this.getProjectId();

        var splittedURL = window.location.href.split("/");
        this.rowNumberFromURL = splittedURL[URL_PROJECTS_TAB_ROWS_INDEX];
        this.pageIndexFromURL = splittedURL[URL_PROJECTS_TAB_PAGE_INDEX];
        if (splittedURL.length >= URL_PROJECTS_TAB_SEARCH_INDEX) {
            this.searchValueFromURL = splittedURL[URL_PROJECTS_TAB_SEARCH_INDEX];
        }
    }

    loadDashboards(whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=getDashboardsOfProject",
            data: {
                "id_project": model.projectId,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (dashboards) {
                model.dashboards = dashboards;
                model.workingDashboards = dashboards;
                whenFinished(dashboards);
            }
        });
    }

    createDashboard(title, description, whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=createDashboards",
            data: {
                "title": title,
                "description": description,
                "id_project": model.projectId,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (result) {
                model.workingDashboards.push(result[0]);
                whenFinished(result);
            }
        });
    }

    bookmarkDashboard(json, whenFinished, ifErrorThen) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=bookmarkDashboard",
            data: {
                "id_project": model.projectId,
                "title": json.title,
                "bookmarked": json.bookmarked,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (result) {
                whenFinished(result);
            },
            error: function (result) {
                ifErrorThen(result);
            }
        });
    }

    getProjectId() {
        var URL = window.location.href;
        var splittedURL = URL.split("/");

        return splittedURL[URL_PROJECTS_ID_INDEX];
    }
}

class View {
    constructor() {

    }

    initializeView(container) {}

    visualizeDashboard(container, name, desc = "") {
        var clonedCard = $dashboardCard.clone();

        clonedCard.find(".dashboardCardTitle").text(name);
        clonedCard.find(".dashboardCardDescription").text(desc);

        container.append(clonedCard);

        return clonedCard;
    }

    visualizeDashboardRow(container) {
        var clonedRow = $dashboardRow.clone();

        container.append(clonedRow);

        return clonedRow;
    }

    visualizeDashboardPage(container) {
        var clonedRow = $dashboardPage.clone();

        container.append(clonedRow);

        return clonedRow;
    }

    visualizePaginationItem(index) {
        var clonedPageItem = $paginationItem.clone();

        clonedPageItem.find(".page-link").html(index + "");
        $(".pagination .nav-next").before(clonedPageItem);

        return clonedPageItem;
    }

    visualizeDashboardFlags(dashboard, created, bookmarked) {
        var dashboardFlagsContainer = dashboard.find(".dashboardCardFlags");

        if (created) {
            dashboardFlagsContainer.append($dashboardFlagCreated.clone());
        } else {
            dashboardFlagsContainer.append($dashboardFlagShared.clone());
        }

        if (bookmarked) {
            //dashboardFlagsContainer.prepend($dashboardFlagBookmarked.clone());
        }

        return dashboardFlagsContainer;
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

        var mainContainer = $("#mainDashboardPanel");

        view.initializeView(mainContainer);

        model.loadDashboards(function (dashboards) {
            console.log("tableros", dashboards);
            if (controller.model.rowNumberFromURL != undefined) {
                if (controller.model.searchValueFromURL) {
                    searchBar.val(controller.model.searchValueFromURL);
                    $("#selectNumberOfRows").val(controller.model.rowNumberFromURL);
                    controller.searchDashboardEvent(searchBar, controller, function () {
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
            $(".numberOfDashboards").text(dashboards.length);
        });

        var selectNumberOfRows = $("#selectNumberOfRows");
        var localStorageNumberRows = localStorage.getItem("numberOfRowsInCollaborators");
        if (localStorageNumberRows === null) {
            localStorageNumberRows = 3;
        }
        selectNumberOfRows.val(localStorageNumberRows);
        selectNumberOfRows.on("change", function () {
            controller.reload(controller);
            localStorage.setItem("numberOfRowsInDashboards", selectNumberOfRows.val());
            controller.pageChanged(controller, 1);
        });

        var searchBar = $("#dashboardSearch");
        whenUserDoneTypingInInput(searchBar, "dashboardSearch", function () {
            controller.searchDashboardEvent(searchBar, controller);
        }, 100);

        $(".dashboardBtnAdd").on("click", function (event) {
            controller.addDashboardBtnEvent(controller, event);
        });

        $(".dashboardsBtnFilters .btn").on("click", function () {
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

    searchDashboardEvent(searchBar, controller, callback = null) {
        var content = searchBar.val().toLowerCase();
        var newDashboardsJSON = [];
        if (content == "") {
            newDashboardsJSON = controller.model.dashboards;
        } else {
            $(controller.model.dashboards).each(function () {
                if (content == "" || (!this.title.toLowerCase().includes(content) && !this.description.toLowerCase().includes(content))) {
                    return;
                }
                newDashboardsJSON.push(this);
            });
        }
        if (newDashboardsJSON.length > 0) {
            controller.model.workingDashboards = newDashboardsJSON;
            controller.model.filterDashboards = newDashboardsJSON;
            if (callback != null) {
                controller.reload(controller, callback);
            } else {
                controller.reload(controller);
            }
            controller.pageChanged(controller, 1);
        } else {
            controller.clearContainer(controller);
            $(".dashboardsContainer").text(controller.model.dashboards.length > 0 ? "No se han encontrado resultados." : "No hay tableros");
        }
    }

    clearContainer(controller) {
        $(".dashboardsContainer").html("");
    }

    pageChanged(controller, pageIndex) {
        var url = `${EXECUTION_HOME_PATH}projects/id/${controller.model.projectId}/dashboards/rows/${localStorage.getItem("numberOfRowsInDashboards")}/page/${pageIndex}/`;

        var search = $("#dashboardSearch").val();
        if (search.length > 0) {
            url += `search/${search}/`;
        }

        changeURL(url);
    }

    reload(controller, callback = null) {
        $(".numberOfDashboards").html(controller.model.dashboards.length);
        controller.clearContainer(controller);
        controller.model.paginationIndex = 1;
        var pagination = $(".pagination");

        var navigation = $(".page-item.nav-previous, .page-item.nav-next");
        pagination.before(navigation);
        pagination.html("");
        pagination.append(navigation);

        var dashboardFilters = $(".dashboardsBtnFilters");
        var hideBookmarked = dashboardFilters.find(".dashboardsBtnBookmarked").hasClass("active");
        var hideCreated = dashboardFilters.find(".dashboardsBtnCreated").hasClass("active");
        var hideShared = dashboardFilters.find(".dashboardsBtnShared").hasClass("active");

        console.log(
            "hideBookmarked", hideBookmarked,
            "hideCreated", hideCreated,
            "hideShared", hideShared
        );

        var noResultsFound = true;
        $(controller.model.workingDashboards).each(function () {
            if ((hideBookmarked && (this.bookmarked != 0)) ||
                (hideCreated && (this.created != 0)) ||
                (hideShared && !(this.created != 0))
            ) {
                return;
            }
            noResultsFound = false;

            this.html = controller.addDashboard(controller, this);
        });

        if (noResultsFound) {
            controller.clearContainer(controller);
            $(".dashboardsContainer").text(controller.model.dashboards.length > 0 ? "No se han encontrado resultados." : "No hay tableros");
        }

        console.log(controller.model.workingDashboards);

        $(".page-item").eq(1).trigger("click");

        if (callback != null) {
            callback();
        }
    }

    getDashboardPage(controller, container) {
        var dashboardsPage = container.find(".dashboardsPage").last();
        var dashboardPageRows = dashboardsPage.find(".dashboardCardRow");

        if (container.find(".dashboardsPage").length == 0 ||
            (dashboardPageRows.length >= $("#selectNumberOfRows").val() &&
                dashboardPageRows.last().find(".dashboardCard").length >= 2)) {
            dashboardsPage = controller.view.visualizeDashboardPage(container);

            controller.addPaginationItem(controller);
        }

        return dashboardsPage;
    }

    addPaginationItem(controller) {
        var currentPaginationIndex = controller.model.paginationIndex;
        var paginationItem = controller.view.visualizePaginationItem(controller.model.paginationIndex);
        controller.model.paginationIndex++;

        paginationItem.on("click", function () {
            $(this).addClass('active').siblings().removeClass('active');
            $(this).find(".page-link").append($currentPaginationItem);
            var dashboardPages = $(".dashboardsPage");
            dashboardPages.hide();
            dashboardPages.eq(parseInt($(this).text()) - 1).show();
            controller.pageChanged(controller, currentPaginationIndex);
        });
    }

    getDashboardRow(controller, container) {
        var dashboardPage = controller.getDashboardPage(controller, container);
        var dashboardRow = dashboardPage.find(".dashboardCardRow ");
        if (dashboardPage.find(".dashboardCardRow").length == 0 || (dashboardRow.last().find(".dashboardCard").length >= 2)) {
            dashboardRow = controller.view.visualizeDashboardRow(dashboardPage);
            //console.log(dashboardRow);
        } else {
            dashboardRow = dashboardRow.last();
        }

        return dashboardRow;
    }

    addDashboard(controller, json) {
        var dashboardContainer = $(".dashboardsContainer");
        var dashboardRow = controller.getDashboardRow(controller, dashboardContainer);

        console.log(json);

        var dashboard = controller.view.visualizeDashboard(dashboardRow, json.title, json.description);
        var bookmarkedIcon = dashboard.find(".dashboardCardBookmarkedIcon");
        bookmarkedIcon.addClass(json.bookmarked != 0 ? "active" : "");
        bookmarkedIcon.on("click", this.bookmarkDashboard(controller, json, bookmarkedIcon));
        controller.view.visualizeDashboardFlags(dashboard, json.created != 0, json.bookmarked != 0);

        var url = `${EXECUTION_HOME_PATH}projects/id/${controller.model.projectId}/dashboards/${json.title}/`;
        dashboard.find(".dashboardCardBtnView").prop("href", url);
        dashboard.find(".dashboardReadMore").prop("href", url);

        dashboard.find(".dashboardCardBgImg").prop("src", `${EXECUTION_HOME_PATH}img/projects/${controller.model.projectId}/dashboards/${json.title}/bg.png`);

        return dashboard;
    }

    bookmarkDashboard(controller, json, bookmarkedIcon) {
        return function () {
            bookmarkDashboard(json, function () {
                if (result !== false) {
                    bookmarkedIcon.toggleClass("active");
                    json.bookmarked = !json.bookmarked;
                }
                console.log("resultado", result, "activo", bookmarkedIcon.hasClass("active"));
                bookmarkedIcon.bind("click", controller.bookmarkDashboard(controller, json, bookmarkedIcon));
            }, function () {
                sendNotification(`No se ha podido ${bookmarkedIcon.hasClass("active") ? "quitar" : "añadir"} a favoritos`, "bookmarkingDashboard");
                bookmarkedIcon.bind("click", controller.bookmarkDashboard(controller, json, bookmarkedIcon));
            });
            bookmarkedIcon.unbind("click");
        };
    }

    addDashboardBtnEvent(controller, event) {
        var event = event || window.event;

        var modal = Modal.modal({
            "title": "Crear tablero",
            "content": `<form action=EXECUTION_HOME_PATH + "index.php?ctl=createDashboards" id="formCreateDashboard" class="col-sm-10  p-3 mx-auto" method="POST">
            <div class="md-form">
                <input type="text" placeholder="" id="title" name="title" value="Prueba" class="form-control text-dark">
                <label for="title">Título</label>
            </div>
            <div class="md-form">
            <textarea class="md-textarea form-control text-dark" placeholder="" id="description" name="description">Test</textarea>
            <label for="description">Descripción</label>
            </div>
            <input type="hidden" name="id_project" value="${controller.model.projectId}" >
            <div class="row m-0 d-flex justify-content-center align-content-center align-items-center justify-items-center">
                    <input class="btn btn-primary w-100" type="submit" name="createDashboard" id="createDashboard" value="Crear dashboard">
            </div>
        </form>`,
            "onOpen": function () {
                $("#description").focus();
                $("#title").focus();
                $("#formCreateDashboard").on("submit", function (event) {
                    var event = event || window.event;
                    event.preventDefault();

                    var title = $("#title").val();
                    controller.model.createDashboard(title, $("#description").val(), function (result) {
                        console.log(result);
                        if (result !== false) {
                            modal.close();
                            controller.addDashboard(controller, result[0]);
                            controller.reload(controller);
                            window.location.href = `${EXECUTION_HOME_PATH}projects/id/${controller.model.projectId}/dashboards/${title}/`;
                        }
                    });

                    return false;
                });
            },
        });

        modal.params["onOpen"] = function () {};
    }

    //pagination
}

const dashboardsController = new Controller(
    new Model(),
    new View()
);