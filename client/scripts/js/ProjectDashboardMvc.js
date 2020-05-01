var $paginationItem = $(`<li class="page-item"><a class="page-link text-white"></a></li>`);
var $currentPaginationItem = $(`<span class="sr-only">(current)</span>`);

var $dashboardRow = $(`<div class="row dashboardCardRow d-flex flex-wrap justify-content-center m-0"></div>`);
var $dashboardPage = $(`<div class="dashboardsPage"></div>`);

var $dashboardFlagBookmarked = $(`<div class="dashboardsBtnBookmarked btn btn-sm btn-warning">Bookmarked</div>`);
var $dashboardFlagCreated = $(`<div class="dashboardsBtnCreated btn btn-sm btn-success">Created</div>`);
var $dashboardFlagShared = $(`<div class="dashboardsBtnShared btn btn-sm btn-primary">Shared</div>`);

var $dashboardCard = $(`
<div class="dashboardCard text-dark row col-12 col-sm m-2 bg-white">
    <div
        class="row dashboardCardDetails flex-wrap d-flex justify-content-start justify-items-center align-content-center align-items-center w-100 m-0 pt-2">
        <a href="" class="btn btn-sm btn-primary dashboardCardBtnView">View</a>
        <!--div class="btn btn-sm btn-danger dashboardCardBtnDisable">Disable dashboard</div-->
        <h5 class="dashboardCardTitle m-0 font-weight-bold">Dashboard title</h5>
        <div class="dashboardCardBookmarkedIcon"></div>
        <div class="dashboardCardFlags float-right btn-group"></div>
    </div>
    <a href="" class="dashboardReadMore">Read more...</a>
    <div class="dashboardCardDescription text-justify my-2"></div>
</div>`);

class Model {
    constructor() {
        this.paginationIndex = 1;
        this.projectId = this.getProjectId();
    }

    loadDashboards(whenFinished) {
        var model = this;
        $.ajax({
            url: "/daw/index.php?ctl=getDashboardsOfProject",
            data: {
                "id_project": model.projectId,
            },
            success: function (dashboards) {
                model.dashboards = dashboards;
                model.workingDashboards = dashboards;
                whenFinished(dashboards);
            }
        });
    }

    getProjectId() {
        var URL = window.location.href;
        var splittedURL = URL.split("/");

        return splittedURL[6];
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
            controller.reload(controller);
            $(".numberOfDashboards").text(dashboards.length);
            $(".page-item").eq(1).trigger("click");
        });

        var selectNumberOfRows = $("#selectNumberOfRows");
        selectNumberOfRows.val(localStorage.getItem("numberOfRowsInDashboards") || 3);
        selectNumberOfRows.on("change", function () {
            controller.reload(controller);
            localStorage.setItem("numberOfRowsInDashboards", selectNumberOfRows.val());
        });

        var searchBar = $("#dashboardSearch");
        whenUserDoneTypingInInput(searchBar, "dashboardSearch", function () {
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
                controller.reload(controller);
            } else {
                controller.clearContainer(controller);
                $(".dashboardsContainer").text("No se han encontrado resultados.");
            }
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

    clearContainer(controller) {
        $(".dashboardsContainer").html("");
    }

    reload(controller) {
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
            $(".dashboardsContainer").text("No se han encontrado resultados.");
        }

        console.log(controller.model.workingDashboards);

        $(".page-item").eq(1).trigger("click");
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
        var paginationItem = controller.view.visualizePaginationItem(controller.model.paginationIndex);
        controller.model.paginationIndex++;

        paginationItem.on("click", function () {
            $(this).addClass('active').siblings().removeClass('active');
            $(this).find(".page-link").append($currentPaginationItem);
            var dashboardPages = $(".dashboardsPage");
            dashboardPages.hide();
            dashboardPages.eq(parseInt($(this).text()) - 1).show();
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

        var url = `/daw/projects/id/${controller.model.projectId}/dashboards/${json.title}`;
        dashboard.find(".dashboardCardBtnView").prop("href", url);
        dashboard.find(".dashboardReadMore").prop("href", url);

        return dashboard;
    }

    bookmarkDashboard(controller, json, bookmarkedIcon) {
        return function () {
            $.ajax({
                url: "/daw/index.php?ctl=bookmarkDashboard",
                data: {
                    "id_project": json.id_project,
                    "title": json.title,
                    "bookmarked": json.bookmarked,
                },
                success: function (result) {
                    if (result !== false) {
                        bookmarkedIcon.toggleClass("active");
                        json.bookmarked = !json.bookmarked;
                    }
                    console.log("resultado", result, "activo", bookmarkedIcon.hasClass("active"));
                    bookmarkedIcon.bind("click", controller.bookmarkDashboard(controller, json, bookmarkedIcon));
                },
                error: function (result) {
                    sendNotification(`No se ha podido ${bookmarkedIcon.hasClass("active") ? "quitar" : "añadir"} a favoritos`, "bookmarkingDashboard");
                    bookmarkedIcon.bind("click", controller.bookmarkDashboard(controller, json, bookmarkedIcon));
                }
            });
            bookmarkedIcon.unbind("click");
        };
    }

    addDashboardBtnEvent(controller, event) {
        var event = event || window.event;

        var modal = $.sweetModal({
            title: 'Create dashboard',
            content: `<form action="/daw/index.php?ctl=createDashboards" id="formCreateDashboard" class="col-sm-10  p-3 mx-auto" method="POST">
                        <div class="md-form">
                            <input type="text" placeholder="" id="title" name="title" value="Prueba" class="form-control">
                            <label for="title">Title</label>
                        </div>
                        <div class="md-form">
                        <textarea class="md-textarea form-control" placeholder="" id="description" name="description">Test</textarea>
                        <label for="description">Description</label>
                        </div>
                        <div class="row m-0 d-flex justify-content-center align-content-center align-items-center justify-items-center">
                                <input class="btn btn-primary w-100" type="submit" name="createDashboard" id="createDashboard" value="Create dashboard">
                        </div>
                    </form>`,
            theme: $.sweetModal.THEME_DARK
        });
        modal.params["onOpen"] = function () {
            $("#description").focus();
            $("#title").focus();
            $("#formCreateDashboard").on("submit", function (event) {
                var event = event || window.event;
                event.preventDefault();

                $.ajax({
                    url: "/daw/index.php?ctl=createDashboards",
                    data: {
                        title: $("#title").val(),
                        description: $("#description").val(),
                        id_project: controller.model.projectId,
                    },
                    success: function (result) {
                        console.log(result);
                        if (result !== false) {
                            modal.close();
                            controller.addDashboard(controller, result[0]);
                            controller.model.dashboards.push(result[0]);
                            controller.model.workingDashboards.push(result[0]);
                            controller.reload(controller);
                        }
                    }
                });

            });
        };
    }

    //pagination
}

const dashboardsController = new Controller(
    new Model(),
    new View()
);