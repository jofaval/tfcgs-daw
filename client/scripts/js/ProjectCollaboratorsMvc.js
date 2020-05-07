var $paginationItem = $(`<li class="page-item"><a class="page-link text-white"></a></li>`);
var $currentPaginationItem = $(`<span class="sr-only">(current)</span>`);

var $collaboratorRow = $(`<div class="row collaboratorCardRow d-flex flex-wrap justify-content-center m-0"></div>`);
var $collaboratorPage = $(`<div class="collaboratorsPage"></div>`);

var $collaboratorFlagBookmarked = $(`<div class="collaboratorsBtnBookmarked btn btn-sm btn-warning">Bookmarked</div>`);
var $collaboratorFlagCreated = $(`<div class="collaboratorsBtnCreated btn btn-sm btn-success">Created</div>`);
var $collaboratorFlagShared = $(`<div class="collaboratorsBtnShared btn btn-sm btn-primary">Shared</div>`);

var $collaboratorCard = $(`<div class="collaboratorCard rounded row col-12 col-sm m-2 m-2 bg-white">
    <img class="collaboratorImg my-2 rounded-pill" src="/daw/img/profile-pic.png" alt="">
    <div class="collaboratorDetails my-auto col">
        <p class="collaboratorUsername m-0 font-weight-bold">Administrator</p>
        <h5 class="collaboratorName m-0">Pepe Fabra Valverde</h5>
        <p class="collaboratorRole m-0 informationText font-weight-bold">Administrator</p>
        <div class="informationTextQuote text-left collaboratorRoleDescription text-white p-3 position-absolute rounded z-index-overlap"></div>
    </div>
    <a href="" class="collaboratorProfileBtn btn btn-sm btn-primary align-self-center float-right">See profile
    </a>
</div>`);

class Model {
    constructor() {
        this.paginationIndex = 1;
        this.projectId = this.getProjectId();
    }

    loadCollaborators(whenFinished) {
        var model = this;
        $.ajax({
            url: "/daw/index.php?ctl=getCollaboratorsOfProject",
            data: {
                "id_project": model.projectId,
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
            url: "/daw/index.php?ctl=doesUsernameExists",
            data: {
                username: username,
            },
            success: function (result) {
                console.log(result);
                if (result) {
                    $.ajax({
                        url: "/daw/index.php?ctl=createCollaborators",
                        data: {
                            username: username,
                            id_project: model.projectId,
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
        clonedCard.find(".collaboratorImg").prop("src", `/daw/img/users/${username}/${username}.png`);
        clonedCard.find(".collaboratorProfileBtn").prop("href", `/daw/profile/${username}/`);

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
            controller.reload(controller);
            $(".numberOfCollaborators").text(collaborators.length);
            $(".page-item").eq(1).trigger("click");
        });

        var selectNumberOfRows = $("#selectNumberOfRows");
        selectNumberOfRows.val(localStorage.getItem("numberOfRowsInCollaborators") || 3);
        selectNumberOfRows.on("change", function () {
            controller.reload(controller);
            localStorage.setItem("numberOfRowsInCollaborators", selectNumberOfRows.val());
        });

        var searchBar = $("#searchCollaborator");
        whenUserDoneTypingInInput(searchBar, "searchCollaborator", function () {
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
                controller.reload(controller);
            } else {
                controller.clearContainer(controller);
                $(".collaboratorsContainer").text("No se han encontrado resultados.");
            }
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

    inviteCollaboratorEvent(controller, event) {
        var event = event || window.event;
        event.preventDefault();

        modal.params["onOpen"] = function () {
            $("#searchCollaborator").focus();
            $("#formCreateCollaborator").on("submit", function (event) {
                var event = event || window.event;
                event.preventDefault();

                var username = $("#searchCollaborator").val();

                controller.model.inviteCollaborator(username, function () {
                    console.log(result);
                    if (result) {
                        controller.reload(controller);
                    } else {
                        sendNotification("No se ha podido añadir", "projectInviteCollaborator");
                    }
                });

            });
        };

        return false;
    }

    clearContainer(controller) {
        $(".collaboratorsContainer").html("");
    }

    reload(controller) {
        controller.clearContainer(controller);
        controller.model.paginationIndex = 1;
        var pagination = $(".pagination");

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
    }

    getCollaboratorPage(controller, container) {
        var collaboratorsPage = container.find(".collaboratorsPage").last();
        var collaboratorPageRows = collaboratorsPage.find(".collaboratorCardRow");

        if (container.find(".collaboratorsPage").length == 0 ||
            (collaboratorPageRows.length >= $("#selectNumberOfRows").val() &&
                collaboratorPageRows.last().find(".collaboratorCard").length >= 2)) {
            collaboratorsPage = controller.view.visualizeCollaboratorPage(container);

            controller.addPaginationItem(controller);
        }

        return collaboratorsPage;
    }

    addPaginationItem(controller) {
        var paginationItem = controller.view.visualizePaginationItem(controller.model.paginationIndex);
        controller.model.paginationIndex++;

        paginationItem.on("click", function () {
            $(this).addClass('active').siblings().removeClass('active');
            $(this).find(".page-link").append($currentPaginationItem);
            var collaboratorPages = $(".collaboratorsPage");
            collaboratorPages.hide();
            collaboratorPages.eq(parseInt($(this).text()) - 1).show();
        });
    }

    getCollaboratorRow(controller, container) {
        var collaboratorPage = controller.getCollaboratorPage(controller, container);
        var collaboratorRow = collaboratorPage.find(".collaboratorCardRow ");
        if (collaboratorPage.find(".collaboratorCardRow").length == 0 || (collaboratorRow.last().find(".collaboratorCard").length >= 2)) {
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

        var url = `/daw/projects/id/${controller.model.projectId}/collaborators/${json.title}`;
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