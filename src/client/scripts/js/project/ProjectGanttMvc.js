var $paginationItem = $(`<li class="page-item"><a class="page-link text-dark"></a></li>`);
var $currentPaginationItem = $(`<span class="sr-only">(current)</span>`);

var $ganttRow = $(`<div class="row ganttCardRow d-flex flex-wrap justify-content-center m-0"></div>`);
var $ganttPage = $(`<div class="ganttsPage"></div>`);

var $ganttFlagBookmarked = $(`<div class="ganttsBtnBookmarked btn btn-sm btn-warning">Favorito</div>`);
var $ganttFlagCreated = $(`<div class="ganttsBtnCreated btn btn-sm btn-success text-dark">Creado</div>`);
var $ganttFlagShared = $(`<div class="ganttsBtnShared btn btn-sm btn-primary">Compartido</div>`);

var $ganttCard = $(`
<div class="ganttCard text-dark row col-12 px-0 col-sm m-2 bg-grey">
    <img src="" alt="" class="ganttCardBgImg object-fit-cover opacity-80 brightness-30 position-absolute w-100 h-100 z-index">
    <div
        class="row ganttCardDetails pl-3 z-index-overlap flex-wrap d-flex justify-content-start justify-items-center align-content-center align-items-center w-100 m-0 pt-2">
        <a href="" class="btn btn-sm btn-primary ganttCardBtnView">Ver</a>
        <!--div class="btn btn-sm btn-danger ganttCardBtnDisable">Disable gantt</div-->
        <h5 class="ganttCardTitle max-text-10 text-white text-overflow-ellipsis overflow-hidden m-0 font-weight-bold">Gantt title</h5>
        <div class="ganttCardBookmarkedIcon"></div>
        <div class="ganttCardFlags float-right btn-group d-none d-sm-block"></div>
    </div>
    <a href="" class="ganttReadMore text-white">Leer más...</a>
    <div class="ganttCardDescription text-white max-text-20 text-overflow-ellipsis pl-3 z-index-overlap-bottom overflow-hidden text-justify my-2"></div>
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

    loadGantts(whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=getGanttsOfProject",
            data: {
                "id_project": model.projectId,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (gantts) {
                model.gantts = gantts;
                model.workingGantts = gantts;
                whenFinished(gantts);
            }
        });
    }

    createGantt(title, description, whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=createGantts",
            data: {
                "title": title,
                "description": description,
                "id_project": model.projectId,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (result) {
                model.workingGantts.push(result[0]);
                whenFinished(result);
            }
        });
    }

    bookmarkGantt(json, whenFinished, ifErrorThen) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=bookmarkGantt",
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

    visualizeGantt(container, name, desc = "") {
        var clonedCard = $ganttCard.clone();

        clonedCard.find(".ganttCardTitle").text(name);
        clonedCard.find(".ganttCardDescription").text(desc);

        container.append(clonedCard);

        return clonedCard;
    }

    visualizeGanttRow(container) {
        var clonedRow = $ganttRow.clone();

        container.append(clonedRow);

        return clonedRow;
    }

    visualizeGanttPage(container) {
        var clonedRow = $ganttPage.clone();

        container.append(clonedRow);

        return clonedRow;
    }

    visualizePaginationItem(index) {
        var clonedPageItem = $paginationItem.clone();

        clonedPageItem.find(".page-link").html(index + "");
        $(".pagination .nav-next").before(clonedPageItem);

        return clonedPageItem;
    }

    visualizeGanttFlags(gantt, created, bookmarked) {
        var ganttFlagsContainer = gantt.find(".ganttCardFlags");

        if (created) {
            ganttFlagsContainer.append($ganttFlagCreated.clone());
        } else {
            ganttFlagsContainer.append($ganttFlagShared.clone());
        }

        if (bookmarked) {
            //ganttFlagsContainer.prepend($ganttFlagBookmarked.clone());
        }

        return ganttFlagsContainer;
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

        var mainContainer = $("#mainGanttPanel");

        view.initializeView(mainContainer);

        model.loadGantts(function (gantts) {
            console.log("tableros", gantts);
            if (controller.model.rowNumberFromURL != undefined) {
                if (controller.model.searchValueFromURL) {
                    searchBar.val(controller.model.searchValueFromURL);
                    $("#selectNumberOfRows").val(controller.model.rowNumberFromURL);
                    controller.searchGanttEvent(searchBar, controller, function () {
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
            $(".numberOfGantts").text(gantts.length);
        });

        var selectNumberOfRows = $("#selectNumberOfRows");
        var localStorageNumberRows = localStorage.getItem("numberOfRowsInCollaborators");
        if (localStorageNumberRows === null) {
            localStorageNumberRows = 3;
        }
        selectNumberOfRows.val(localStorageNumberRows);
        selectNumberOfRows.on("change", function () {
            controller.reload(controller);
            localStorage.setItem("numberOfRowsInGantts", selectNumberOfRows.val());
            controller.pageChanged(controller, 1);
        });

        var searchBar = $("#ganttSearch");
        whenUserDoneTypingInInput(searchBar, "ganttSearch", function () {
            controller.searchGanttEvent(searchBar, controller);
        }, 100);

        $(".ganttBtnAdd").on("click", function (event) {
            controller.addGanttBtnEvent(controller, event);
        });

        $(".ganttsBtnFilters .btn").on("click", function () {
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

    searchGanttEvent(searchBar, controller, callback = null) {
        var content = searchBar.val().toLowerCase();
        var newGanttsJSON = [];
        if (content == "") {
            newGanttsJSON = controller.model.gantts;
        } else {
            $(controller.model.gantts).each(function () {
                if (content == "" || (!this.title.toLowerCase().includes(content) && !this.description.toLowerCase().includes(content))) {
                    return;
                }
                newGanttsJSON.push(this);
            });
        }
        if (newGanttsJSON.length > 0) {
            controller.model.workingGantts = newGanttsJSON;
            controller.model.filterGantts = newGanttsJSON;
            if (callback != null) {
                controller.reload(controller, callback);
            } else {
                controller.reload(controller);
            }
            controller.pageChanged(controller, 1);
        } else {
            controller.clearContainer(controller);
            $(".ganttsContainer").text(controller.model.gantts.length > 0 ? "No se han encontrado resultados." : "No hay tableros");
        }
    }

    clearContainer(controller) {
        $(".ganttsContainer").html("");
    }

    pageChanged(controller, pageIndex) {
        var url = `${EXECUTION_HOME_PATH}projects/id/${controller.model.projectId}/gantts/rows/${localStorage.getItem("numberOfRowsInGantts")}/page/${pageIndex}/`;

        var search = $("#ganttSearch").val();
        if (search.length > 0) {
            url += `search/${search}/`;
        }

        changeURL(url);
    }

    reload(controller, callback = null) {
        $(".numberOfGantts").html(controller.model.gantts.length);
        controller.clearContainer(controller);
        controller.model.paginationIndex = 1;
        var pagination = $(".pagination");

        var navigation = $(".page-item.nav-previous, .page-item.nav-next");
        pagination.before(navigation);
        pagination.html("");
        pagination.append(navigation);

        var ganttFilters = $(".ganttsBtnFilters");
        var hideBookmarked = ganttFilters.find(".ganttsBtnBookmarked").hasClass("active");
        var hideCreated = ganttFilters.find(".ganttsBtnCreated").hasClass("active");
        var hideShared = ganttFilters.find(".ganttsBtnShared").hasClass("active");

        console.log(
            "hideBookmarked", hideBookmarked,
            "hideCreated", hideCreated,
            "hideShared", hideShared
        );

        var noResultsFound = true;
        $(controller.model.workingGantts).each(function () {
            if ((hideBookmarked && (this.bookmarked != 0)) ||
                (hideCreated && (this.created != 0)) ||
                (hideShared && !(this.created != 0))
            ) {
                return;
            }
            noResultsFound = false;

            this.html = controller.addGantt(controller, this);
        });

        if (noResultsFound) {
            controller.clearContainer(controller);
            $(".ganttsContainer").text(controller.model.gantts.length > 0 ? "No se han encontrado resultados." : "No hay tableros");
        }

        console.log(controller.model.workingGantts);

        $(".page-item").eq(1).trigger("click");

        if (callback != null) {
            callback();
        }
    }

    getGanttPage(controller, container) {
        var ganttsPage = container.find(".ganttsPage").last();
        var ganttPageRows = ganttsPage.find(".ganttCardRow");

        if (container.find(".ganttsPage").length == 0 ||
            (ganttPageRows.length >= $("#selectNumberOfRows").val() &&
                ganttPageRows.last().find(".ganttCard").length >= 2)) {
            ganttsPage = controller.view.visualizeGanttPage(container);

            controller.addPaginationItem(controller);
        }

        return ganttsPage;
    }

    addPaginationItem(controller) {
        var currentPaginationIndex = controller.model.paginationIndex;
        var paginationItem = controller.view.visualizePaginationItem(controller.model.paginationIndex);
        controller.model.paginationIndex++;

        paginationItem.on("click", function () {
            $(this).addClass('active').siblings().removeClass('active');
            $(this).find(".page-link").append($currentPaginationItem);
            var ganttPages = $(".ganttsPage");
            ganttPages.hide();
            ganttPages.eq(parseInt($(this).text()) - 1).show();
            controller.pageChanged(controller, currentPaginationIndex);
        });
    }

    getGanttRow(controller, container) {
        var ganttPage = controller.getGanttPage(controller, container);
        var ganttRow = ganttPage.find(".ganttCardRow ");
        if (ganttPage.find(".ganttCardRow").length == 0 || (ganttRow.last().find(".ganttCard").length >= 2)) {
            ganttRow = controller.view.visualizeGanttRow(ganttPage);
            //console.log(ganttRow);
        } else {
            ganttRow = ganttRow.last();
        }

        return ganttRow;
    }

    addGantt(controller, json) {
        var ganttContainer = $(".ganttsContainer");
        var ganttRow = controller.getGanttRow(controller, ganttContainer);

        console.log(json);

        var gantt = controller.view.visualizeGantt(ganttRow, json.title, json.description);
        var bookmarkedIcon = gantt.find(".ganttCardBookmarkedIcon");
        bookmarkedIcon.addClass(json.bookmarked != 0 ? "active" : "");
        bookmarkedIcon.on("click", this.bookmarkGantt(controller, json, bookmarkedIcon));
        controller.view.visualizeGanttFlags(gantt, json.created != 0, json.bookmarked != 0);

        var url = `${EXECUTION_HOME_PATH}projects/id/${controller.model.projectId}/gantts/${json.title}/`;
        gantt.find(".ganttCardBtnView").prop("href", url);
        gantt.find(".ganttReadMore").prop("href", url);

        gantt.find(".ganttCardBgImg").prop("src", `${EXECUTION_HOME_PATH}img/projects/${controller.model.projectId}/gantts/${json.title}/bg.png`);

        return gantt;
    }

    bookmarkGantt(controller, json, bookmarkedIcon) {
        return function () {
            controller.model.bookmarkGantt(json, function (result) {
                if (result !== false) {
                    bookmarkedIcon.toggleClass("active");
                    json.bookmarked = !json.bookmarked;
                }
                console.log("resultado", result, "activo", bookmarkedIcon.hasClass("active"));
                bookmarkedIcon.bind("click", controller.bookmarkGantt(controller, json, bookmarkedIcon));
            }, function () {
                sendNotification(`No se ha podido ${bookmarkedIcon.hasClass("active") ? "quitar" : "añadir"} a favoritos`, "bookmarkingGantt");
                bookmarkedIcon.bind("click", controller.bookmarkGantt(controller, json, bookmarkedIcon));
            });
            bookmarkedIcon.unbind("click");
        };
    }

    addGanttBtnEvent(controller, event) {
        var event = event || window.event;

        var modal = Modal.modal({
            "title": "Crear Diagrama de gantt",
            "content": `<form action=EXECUTION_HOME_PATH + "index.php?ctl=createGantts" id="formCreateGantt" class="col-sm-10  p-3 mx-auto" method="POST">
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
                    <input class="btn btn-primary w-100" type="submit" name="createGantt" id="createGantt" value="Crear gantt">
            </div>
        </form>`,
            "onOpen": function () {
                $("#description").focus();
                $("#title").focus();
                $("#formCreateGantt").on("submit", function (event) {
                    var event = event || window.event;
                    event.preventDefault();

                    var title = $("#title").val();
                    controller.model.createGantt(title, $("#description").val(), function (result) {
                        console.log(result);
                        if (result !== false) {
                            modal.close();
                            controller.addGantt(controller, result[0]);
                            controller.reload(controller);
                            window.location.href = `${EXECUTION_HOME_PATH}projects/id/${controller.model.projectId}/gantts/${title}/`;
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

const ganttsController = new Controller(
    new Model(),
    new View()
);