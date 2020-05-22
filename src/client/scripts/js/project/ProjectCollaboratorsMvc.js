var $paginationItem = $(`<li class="page-item"><a class="page-link text-white"></a></li>`);
var $currentPaginationItem = $(`<span class="sr-only">(current)</span>`);

var $collaboratorRow = $(`<div class="row collaboratorCardRow d-flex flex-wrap justify-content-center m-0"></div>`);
var $collaboratorPage = $(`<div class="collaboratorsPage"></div>`);

var $collaboratorFlagBookmarked = $(`<div class="collaboratorsBtnBookmarked btn btn-sm btn-warning">Favorito</div>`);
var $collaboratorFlagCreated = $(`<div class="collaboratorsBtnCreated btn btn-sm btn-success">Creado</div>`);
var $collaboratorFlagShared = $(`<div class="collaboratorsBtnShared btn btn-sm btn-primary">Compartido</div>`);


var $collaboratorCard = $(`
<div class="collaboratorCardContainer m-sm-2">
    <a href="" class="collaboratorCard d-none d-sm-block cursor-pointer text-center collaboratorProfileBtn view overlay rounded m-2 m-2">
        <img class="collaboratorImg img-fluid w-100-2 h-100" src=EXECUTION_HOME_PATH + "img/profile-pic.png" width="150" height="150" alt="">
        <div class="collaboratorDetails bg-primary mask flex-center flex-column center-elements h-100 my-auto col">
            <p class="collaboratorUsername text-white m-0 font-weight-bold">Administrator</p>
            <h5 class="collaboratorName text-white m-0">Pepe Fabra Valverde</h5>
            <p class="collaboratorRole mt-3 mb-2 text-white m-0 font-weight-bold">Administrator</p>
        </div>
    </a>
    <a href="" class="collaboratorCard rounded d-sm-none text-dark row col-12 px-0 col-sm m-2 bg-white">
        <img src=EXECUTION_HOME_PATH + "img/default.png" alt="" class="collaboratorImg object-fit-cover w-100 z-index" height="100">
        <div class="row collaboratorDetails border pl-3 z-index-overlap flex-wrap center-elements w-100">
            <h5 class="collaboratorName text-dark text-overflow-ellipsis overflow-hidden m-0 font-weight-normal">
                Pepe Fabra Valverde</h5>
        </div>
        <p class="collaboratorDetails w-100 text-dark text-center pl-3 z-index-overlap-bottom overflow-hidden my-2">
            <span class="ml-2">@</span><span class="collaboratorUsername text-dark font-weight-bold">jofaval2</span>
            <span class="collaboratorRole mt-3 mb-2 text-dark m-0">Administrator</span>
        </p>
    </a>
</div>`);
var $collaboratorCard = $(`
<div class="collaboratorCardContainer m-2">
    <a href="" class="collaboratorCard d-none d-sm-block cursor-pointer text-center collaboratorProfileBtn view overlay rounded">
        <img class="collaboratorImg img-fluid w-100-2 h-100" src=EXECUTION_HOME_PATH + "img/profile-pic.png" width="200" height="200" alt="">
        <div class="collaboratorDetails bg-dark mask flex-center flex-column center-elements h-100 my-auto col">
            <p class="collaboratorUsername text-white m-0 font-weight-bold">Administrator</p>
            <h5 class="collaboratorName text-white m-0">Pepe Fabra Valverde</h5>
            <p class="collaboratorRole mt-5 mb-2 text-white m-0 informationText font-weight-bold">Administrator</p>
            <div class="informationTextQuote w-auto mt-0 text-left collaboratorRoleDescription text-white p-3 position-fixed rounded z-index-overlap"></div>
        </div>
    </a>
    <a href="" class="collaboratorCard d-sm-none text-dark px-0 row col-12 m-2 mx-auto bg-white">
        <img src=EXECUTION_HOME_PATH + "img/default.png" alt="" class="collaboratorImg object-fit-cover w-100 z-index" height="100">
        <div class="row collaboratorDetails border pl-3 z-index-overlap flex-wrap center-elements m-0 w-100">
            <h5 class="collaboratorName text-dark text-overflow-ellipsis overflow-hidden py-1 m-0 font-weight-normal">
                Pepe Fabra Valverde</h5>
        </div>
        <p class="collaboratorDetails w-100 text-dark text-center pl-3 z-index-overlap-bottom overflow-hidden my-2">
            <span class="ml-2">@</span><span class="collaboratorUsername text-dark font-weight-bold">jofaval2</span>
            <span class="collaboratorRole mt-3 mb-2 text-dark m-0">Administrator</span>
        </p>
    </a>
</div>`);

class Model {
    constructor() {
        this.paginationIndex = 1;
        this.projectId = this.getProjectId();

        var splittedURL = window.location.href.split("/");
        this.rowNumberFromURL = splittedURL[9];
        this.pageIndexFromURL = splittedURL[11];
        if (splittedURL.length >= 13) {
            this.searchValueFromURL = splittedURL[13];
        }
    }

    loadCollaborators(whenFinished) {
        var model = this;
        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=getCollaboratorsOfProject",
            data: {
                "id_project": model.projectId,
                "idProjectForAccessLevel": model.projectId,
            },
            success: function (collaborators) {
                model.collaborators = collaborators;
                model.workingCollaborators = collaborators;
                whenFinished(collaborators);
            }
        });
    }

    inviteCollaborator(username, whenFinished) {
        var model = this;

        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=doesUsernameExists",
            data: {
                username: username,
            },
            success: function (result) {
                console.log(result);
                if (result) {
                    $.ajax({
                        url: EXECUTION_HOME_PATH + "index.php?ctl=createCollaborators",
                        data: {
                            username: username,
                            id_project: model.projectId,
                            "idProjectForAccessLevel": model.projectId,
                        },
                        success: function (result) {
                            model.collaborators.push(result);
                            whenFinished(result);
                        }
                    });
                }
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

    visualizeCollaborator(container, json) {
        var clonedCard = $collaboratorCard.clone();

        clonedCard.find(".collaboratorName").text(json.collaboratorName);
        var username = json.collaboratorUsername;
        clonedCard.find(".collaboratorUsername").text(username);
        clonedCard.find(".collaboratorImg").prop("src", `${EXECUTION_HOME_PATH}img/users/${username}/${username}.png`);
        clonedCard.find(".collaboratorCard").prop("href", `${EXECUTION_HOME_PATH}profile/${username}/`);

        clonedCard.find(".collaboratorRole").text(json.collaborationRole);
        clonedCard.find(".collaboratorRoleDescription").text(json.collaborationRoleDescription);

        container.append(clonedCard);

        return clonedCard;
    }

    visualizeCollaboratorRow(container) {
        var clonedRow = $collaboratorRow.clone();

        container.append(clonedRow);

        return clonedRow;
    }

    visualizeCollaboratorPage(container) {
        var clonedRow = $collaboratorPage.clone();

        container.append(clonedRow);

        return clonedRow;
    }

    visualizePaginationItem(index) {
        var clonedPageItem = $paginationItem.clone();

        clonedPageItem.find(".page-link").html(index + "");
        $(".pagination .nav-next").before(clonedPageItem);

        return clonedPageItem;
    }

    visualizeCollaboratorFlags(collaborator, created, bookmarked) {
        var collaboratorFlagsContainer = collaborator.find(".collaboratorCardFlags");

        if (created) {
            collaboratorFlagsContainer.append($collaboratorFlagCreated.clone());
        } else {
            collaboratorFlagsContainer.append($collaboratorFlagShared.clone());
        }

        if (bookmarked) {
            //collaboratorFlagsContainer.prepend($collaboratorFlagBookmarked.clone());
        }

        return collaboratorFlagsContainer;
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

        var mainContainer = $("#mainCollaboratorPanel");

        view.initializeView(mainContainer);

        model.loadCollaborators(function (collaborators) {
            console.log("colaboradores", collaborators);
            if (controller.model.rowNumberFromURL != undefined) {
                if (controller.model.searchValueFromURL) {
                    searchBar.val(controller.model.searchValueFromURL);
                    $("#selectNumberOfRows").val(controller.model.rowNumberFromURL);
                    controller.searchCollaboratorEvent(searchBar, controller, function () {
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
        });

        var selectNumberOfRows = $("#selectNumberOfRows");
        var localStorageNumberRows = localStorage.getItem("numberOfRowsInCollaborators");
        if (localStorageNumberRows === null) {
            localStorageNumberRows = 3;
        }
        selectNumberOfRows.val(localStorageNumberRows);
        selectNumberOfRows.on("change", function () {
            controller.reload(controller);
            localStorage.setItem("numberOfRowsInCollaborators", selectNumberOfRows.val());
            controller.pageChanged(controller, currentPaginationIndex);
        });

        var searchBar = $("#searchCollaborator");
        whenUserDoneTypingInInput(searchBar, "searchCollaborator", function () {
            this.searchCollaboratorEvent(searchBar, controller);
        }, 100);

        $(".collaboratorBtnAdd").on("click", function (event) {
            controller.addCollaboratorBtnEvent(controller, event);
        });

        $(".collaboratorsBtnFilters .btn").on("click", function () {
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

        $(".collaboratorBtnInvite").on("click", function (event) {
            controller.inviteCollaboratorEvent(controller, event);
        });
    }

    searchCollaboratorEvent(searchBar, controller, callback = null) {
        var content = searchBar.val().toLowerCase();
        var newCollaboratorsJSON = [];
        if (content == "") {
            newCollaboratorsJSON = controller.model.collaborators;
        } else {
            $(controller.model.collaborators).each(function () {
                if (content == "" || (!this.collaboratorUsername.toLowerCase().includes(content) && !this.collaboratorName.toLowerCase().includes(content))) {
                    return;
                }
                newCollaboratorsJSON.push(this);
            });
        }
        if (newCollaboratorsJSON.length > 0) {
            controller.model.workingCollaborators = newCollaboratorsJSON;
            controller.model.filterCollaborators = newCollaboratorsJSON;
            if (callback != null) {
                controller.reload(controller, callback)
            } else {
                controller.reload(controller);
            }
        } else {
            controller.clearContainer(controller);
            $(".collaboratorsContainer").text("No se han encontrado resultados.");
        }
    }

    pageChanged(controller, pageIndex) {
        var url = `${EXECUTION_HOME_PATH}projects/id/${controller.model.projectId}/collaborators/rows/${localStorage.getItem("numberOfRowsInCollaborators")}/page/${pageIndex}/`;

        var search = $("#searchCollaborator").val();
        if (search.length > 0) {
            url += `search/${search}/`;
        }

        changeURL(url);
    }

    inviteCollaboratorEvent(controller, event) {
        var event = event || window.event;
        event.preventDefault();

        var username = $("#searchCollaborator").val();

        controller.model.inviteCollaborator(username, function (result) {
            console.log(result);
            if (result) {
                controller.reload(controller);
            } else {
                sendNotification("No se ha podido añadir", "projectInviteCollaborator");
            }
        });

        return false;
    }

    clearContainer(controller) {
        $(".collaboratorsContainer").html("");
    }

    reload(controller, callback = null) {
        controller.clearContainer(controller);
        controller.model.paginationIndex = 1;
        var pagination = $(".pagination");

        $(".numberOfCollaborators").html(controller.model.collaborators.length);

        var navigation = $(".page-item.nav-previous, .page-item.nav-next");
        pagination.before(navigation);
        pagination.html("");
        pagination.append(navigation);

        var noResultsFound = true;
        $(controller.model.workingCollaborators).each(function () {
            noResultsFound = false;

            this.html = controller.addCollaborator(controller, this);
        });

        if (noResultsFound) {
            controller.clearContainer(controller);
            $(".collaboratorsContainer").text("No se han encontrado resultados.");
        }

        console.log(controller.model.workingCollaborators);

        $(".page-item").eq(1).trigger("click");

        if (callback != null) {
            callback();
        }
    }

    getCollaboratorPage(controller, container) {
        var collaboratorsPage = container.find(".collaboratorsPage").last();
        var collaboratorPageRows = collaboratorsPage.find(".collaboratorCardRow");

        if (container.find(".collaboratorsPage").length == 0 ||
            (collaboratorPageRows.length >= $("#selectNumberOfRows").val() &&
                collaboratorPageRows.last().find(".collaboratorCardContainer").length >= 6)) {
            collaboratorsPage = controller.view.visualizeCollaboratorPage(container);

            controller.addPaginationItem(controller);
        }

        return collaboratorsPage;
    }

    addPaginationItem(controller) {
        var currentPaginationIndex = controller.model.paginationIndex;
        var paginationItem = controller.view.visualizePaginationItem(controller.model.paginationIndex);
        controller.model.paginationIndex++;

        paginationItem.on("click", function () {
            $(this).addClass('active').siblings().removeClass('active');
            $(this).find(".page-link").append($currentPaginationItem);
            var collaboratorPages = $(".collaboratorsPage");
            collaboratorPages.hide();
            collaboratorPages.eq(parseInt($(this).text()) - 1).show();
            controller.pageChanged(controller, currentPaginationIndex);
        });
    }

    getCollaboratorRow(controller, container) {
        var collaboratorPage = controller.getCollaboratorPage(controller, container);
        var collaboratorRow = collaboratorPage.find(".collaboratorCardRow ");
        if (collaboratorPage.find(".collaboratorCardRow").length == 0 || (collaboratorRow.last().find(".collaboratorCardContainer").length >= 6)) {
            collaboratorRow = controller.view.visualizeCollaboratorRow(collaboratorPage);
            //console.log(collaboratorRow);
        } else {
            collaboratorRow = collaboratorRow.last();
        }

        return collaboratorRow;
    }

    addCollaborator(controller, json) {
        var collaboratorContainer = $(".collaboratorsContainer");
        var collaboratorRow = controller.getCollaboratorRow(controller, collaboratorContainer);

        var collaborator = controller.view.visualizeCollaborator(collaboratorRow, json);
        controller.view.visualizeCollaboratorFlags(collaborator, json.created != 0);

        var url = `${EXECUTION_HOME_PATH}projects/id/${controller.model.projectId}/collaborators/${json.title}`;
        collaborator.find(".collaboratorCardBtnView").prop("href", url);
        collaborator.find(".collaboratorReadMore").prop("href", url);

        return collaborator;
    }

    addCollaboratorBtnEvent(controller, event) {
        var event = event || window.event;

    };
}

const collaboratorsController = new Controller(
    new Model(),
    new View()
);