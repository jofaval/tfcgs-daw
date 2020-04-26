var $paginationItem = $(`<li class="page-item"><a class="page-link text-white"></a></li>`);
var $currentPaginationItem = $(`<span class="sr-only">(current)</span>`);

var $collaboratorRow = $(`<div class="row collaboratorCardRow d-flex flex-wrap justify-content-center m-0"></div>`);
var $collaboratorPage = $(`<div class="collaboratorsPage"></div>`);

var $collaboratorFlagBookmarked = $(`<div class="collaboratorsBtnBookmarked btn btn-sm btn-warning">Bookmarked</div>`);
var $collaboratorFlagCreated = $(`<div class="collaboratorsBtnCreated btn btn-sm btn-success">Created</div>`);
var $collaboratorFlagShared = $(`<div class="collaboratorsBtnShared btn btn-sm btn-primary">Shared</div>`);

var $collaboratorCard = $(`
<div class="collaboratorCard text-dark row col-12 col-sm m-2 bg-white">
    <div
        class="row collaboratorCardDetails flex-wrap d-flex justify-content-start justify-items-center align-content-center align-items-center w-100 m-0 pt-2">
        <a href="" class="btn btn-sm btn-primary collaboratorCardBtnView">View</a>
        <!--div class="btn btn-sm btn-danger collaboratorCardBtnDisable">Disable collaborator</div-->
        <h5 class="collaboratorCardTitle m-0 font-weight-bold">Collaborator title</h5>
        <div class="collaboratorCardBookmarkedIcon"></div>
        <div class="collaboratorCardFlags float-right btn-group"></div>
    </div>
    <a href="" class="collaboratorReadMore">Read more...</a>
    <div class="collaboratorCardDescription text-justify my-2"></div>
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

    visualizeCollaborator(container, name, desc = "") {
        var clonedCard = $collaboratorCard.clone();

        clonedCard.find(".collaboratorCardTitle").text(name);
        clonedCard.find(".collaboratorCardDescription").text(desc);

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
            console.log("tableros", collaborators);
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

        var searchBar = $("#collaboratorSearch");
        whenUserDoneTypingInInput(searchBar, "collaboratorSearch", function () {
            var content = searchBar.val().toLowerCase();
            var newCollaboratorsJSON = [];
            if (content == "") {
                newCollaboratorsJSON = controller.model.collaborators;
            } else {
                $(controller.model.collaborators).each(function () {
                    if (content == "" || (!this.title.toLowerCase().includes(content) && !this.description.toLowerCase().includes(content))) {
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

        var collaboratorFilters = $(".collaboratorsBtnFilters");
        var hideBookmarked = collaboratorFilters.find(".collaboratorsBtnBookmarked").hasClass("active");
        var hideCreated = collaboratorFilters.find(".collaboratorsBtnCreated").hasClass("active");
        var hideShared = collaboratorFilters.find(".collaboratorsBtnShared").hasClass("active");

        console.log(
            "hideBookmarked", hideBookmarked,
            "hideCreated", hideCreated,
            "hideShared", hideShared
        );

        var noResultsFound = true;
        $(controller.model.workingCollaborators).each(function () {
            if ((hideBookmarked && (this.bookmarked != 0)) ||
                (hideCreated && (this.created != 0)) ||
                (hideShared && !(this.created != 0))
            ) {
                return;
            }
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

        var collaborator = controller.view.visualizeCollaborator(collaboratorRow, json.title, json.description);
        controller.view.visualizeCollaboratorFlags(collaborator, json.created != 0);

        var url = `/daw/projects/id/${controller.model.projectId}/collaborators/${json.title}`;
        collaborator.find(".collaboratorCardBtnView").prop("href", url);
        collaborator.find(".collaboratorReadMore").prop("href", url);

        return collaborator;
    }

    addCollaboratorBtnEvent(controller, event) {
        var event = event || window.event;

        var modal = $.sweetModal({
            title: 'Create collaborator',
            content: `<form action="/daw/index.php?ctl=createCollaborators" id="formCreateCollaborator" class="col-sm-10  p-3 mx-auto" method="POST">
                        <div class="md-form">
                            <input type="text" placeholder="" id="title" name="title" value="Prueba" class="form-control">
                            <label for="title">Title</label>
                        </div>
                        <div class="md-form">
                        <textarea class="md-textarea form-control" placeholder="" id="description" name="description">Test</textarea>
                        <label for="description">Description</label>
                        </div>
                        <div class="row m-0 d-flex justify-content-center align-content-center align-items-center justify-items-center">
                                <input class="btn btn-primary w-100" type="submit" name="createCollaborator" id="createCollaborator" value="Create collaborator">
                        </div>
                    </form>`,
            theme: $.sweetModal.THEME_DARK
        });
        modal.params["onOpen"] = function () {
            $("#formCreateCollaborator").on("submit", function (event) {
                var event = event || window.event;
                event.preventDefault();

                $.ajax({
                    url: "/daw/index.php?ctl=createCollaborators",
                    data: {
                        title: $("#title").val(),
                        description: $("#description").val(),
                        id_project: controller.model.projectId,
                    },
                    success: function (result) {
                        console.log(result);
                        if (result !== false) {
                            modal.close();
                            controller.addCollaborator(controller, result[0]);
                            controller.model.collaborators.push(result[0]);
                            controller.model.workingCollaborators.push(result[0]);
                        }
                    }
                });

            });
        };
    }

    //pagination
}

const collaboratorsController = new Controller(
    new Model(),
    new View()
);