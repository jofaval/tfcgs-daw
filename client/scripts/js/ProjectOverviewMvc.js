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
        <div class="informationTextQuote collaboratorRoleDescription text-white p-3 position-absolute rounded z-index-overlap"></div>
    </div>
    <div class="collaboratorProfileBtn btn btn-sm btn-primary align-self-center float-right">See profile
    </div>
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
                "limit": 4,
            },
            success: function (collaborators) {
                model.collaborators = collaborators;
                model.workingCollaborators = collaborators;
                whenFinished(collaborators);
            }
        });
    }

    deleteProject(whenFinished) {
        var model = this;
        $.ajax({
            url: "/daw/index.php?ctl=deleteProjects",
            data: {
                "id": model.projectId,
            },
            success: function (result) {
                whenFinished(result);
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

        var activeTime = $(".activeTime");
        var activeTimeDate = $(".activeTime").html().trim();
        activeTime.html(getTimeFromThisMoment(activeTimeDate));
        activeTime.append(`<span class="originalDate d-none">${activeTimeDate}</span>`);

        $("#actionAddColaborator").on("click", function (event) {
            controller.addCollaboratorBtnEvent(controller, event);
        });

        $("#actionAddDashboard").on("click", function (event) {
            controller.addDashboardBtnEvent(controller, event);
        });

        $("#actionDeleteProject").on("click", function (event) {
            var event = event || window.event;
            event.preventDefault();

            var confirmationModal = $.sweetModal.confirm('¿Borrar el proyecto?', `Confimar esta acción y borrar <b>"${controller.model.projectId}"</b>`, function () {
                controller.model.deleteProject(function (result) {
                    console.log(result);
                    if (result === true) {
                        var successAlert = $.sweetModal({
                            content: `Se ha borrado el proyecto <b>"${controller.model.projectId}"</b>`,
                            icon: $.sweetModal.ICON_SUCCESS,
                            theme: $.sweetModal.THEME_DARK,
                        });
                        successAlert.params["onClose"] = function () {
                            window.location.reload();
                        }
                    } else {
                        var errorAlert = $.sweetModal({
                            content: `No se ha podido borrar el proyecto <b>"${controller.model.projectId}"</b>`,
                            icon: $.sweetModal.ICON_ERROR,
                            theme: $.sweetModal.THEME_DARK,
                        });
                    }
                })
            }, function () {

            });

            confirmationModal.params["onOpen"] = function () {
                var buttons = $(".sweet-modal-buttons .button");
                buttons.eq(0).text("Cancelar").removeClass("redB bordered").addClass("greenB");
                buttons.eq(1).text("Borrar").removeClass("greenB").addClass("redB");
            };
        });

        $("#actionAddCollaborator").on("click", function (event) {
            controller.inviteCollaboratorEvent(controller, event);
        });

        $("#actionRemoveCollaborator").on("click", function (event) {
            controller.removeCollaboratorEvent(controller, event);
        });

        $("#actionViewDashboard").on("click", function (event) {
            controller.viewDashboard(controller, event);
        });
    }

    addDashboardBtnEvent(controller, event) {
        var event = event || window.event;
        event.preventDefault();

        var modal = $.sweetModal({
            title: 'Create dashboard',
            content: `<form action="/daw/index.php?ctl=createDashboards" id="formCreateDashboard" class="col-sm-10  p-3 mx-auto" method="POST">
                        <div class="md-form">
                            <input type="text" placeholder="" id="title" name="title" value="Prueba" class="form-control text-white">
                            <label for="title">Title</label>
                        </div>
                        <div class="md-form">
                        <textarea class="md-textarea form-control text-white" placeholder="" id="description" name="description">Test</textarea>
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
                            redirectTo(`/daw/projects/id/${controller.model.projectId}/dashboards/`);
                            modal.close();
                        }
                    }
                });

            });
        };

        return false;
    }

    inviteCollaboratorEvent(controller, event) {
        var event = event || window.event;
        event.preventDefault();

        var modal = $.sweetModal({
            title: 'Invitar colaborador/a',
            content: `<form action="/daw/index.php?ctl=createCollaborators" id="formCreateCollaborator" class="col-sm-10  p-3 mx-auto" method="POST">
                        <div class="md-form">
                            <input type="text" placeholder="" id="username" name="username" value="jofaval" class="form-control text-white">
                            <label for="username">Username</label>
                        </div>
                        <div class="row m-0 d-flex justify-content-center align-content-center align-items-center justify-items-center">
                                <input class="btn btn-primary w-100" type="submit" name="createCollaborators" id="createCollaborators" value="Invitar colaborador/a">
                        </div>
                    </form>`,
            theme: $.sweetModal.THEME_DARK
        });



        modal.params["onOpen"] = function () {
            $("#username").focus();
            $("#formCreateCollaborator").on("submit", function (event) {
                var event = event || window.event;
                event.preventDefault();

                var username = $("#username").val();
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
                                    id_project: controller.model.projectId,
                                },
                                success: function (result) {
                                    console.log(result);
                                    if (result) {
                                        window.location.reload();
                                    } else {
                                        sendNotification("No se ha podido añadir", "projectInviteCollaborator");
                                    }
                                }
                            });
                        }
                    }
                });

            });
        };

        return false;
    }

    removeCollaboratorEvent(controller, event) {
        var event = event || window.event;
        event.preventDefault();

        var modal = $.sweetModal({
            title: 'Eliminar colaborador/a',
            content: `<form action="/daw/index.php?ctl=deleteCollaborators" id="formremoveCollaborator" class="col-sm-10  p-3 mx-auto" method="POST">
                        <div class="md-form">
                            <input type="text" placeholder="" id="username" name="username" value="jofaval" class="form-control text-white">
                            <label for="username">Username</label>
                        </div>
                        <div class="row m-0 d-flex justify-content-center align-content-center align-items-center justify-items-center">
                                <input class="btn btn-primary w-100" type="submit" name="deleteCollaborators" id="deleteCollaborators" value="Eliminar colaborador/a">
                        </div>
                    </form>`,
            theme: $.sweetModal.THEME_DARK
        });



        modal.params["onOpen"] = function () {
            $("#username").focus();
            $("#formremoveCollaborator").on("submit", function (event) {
                var event = event || window.event;
                event.preventDefault();

                var username = $("#username").val();
                $.ajax({
                    url: "/daw/index.php?ctl=doesUsernameExists",
                    data: {
                        username: username,
                    },
                    success: function (result) {
                        console.log(result);
                        if (result) {
                            $.ajax({
                                url: "/daw/index.php?ctl=deleteCollaborators",
                                data: {
                                    username: username,
                                    id_project: controller.model.projectId,
                                },
                                success: function (result) {
                                    console.log(result);
                                    if (result) {
                                        window.location.reload();
                                    } else {
                                        sendNotification("No se ha podido añadir", "projectInviteCollaborator");
                                    }
                                }
                            });
                        }
                    }
                });

            });
        };

        return false;
    }

    viewDashboard(controller, event) {
        var event = event || window.event;
        event.preventDefault();

        var modal = $.sweetModal({
            title: 'Ver tablero',
            content: `<form action="/daw/index.php?ctl=viewDashboard" id="viewDashboard" class="col-sm-10  p-3 mx-auto" method="POST">
                        <div class="md-form">
                            <input type="text" placeholder="" id="dashboardName" name="dashboardName" value="" class="form-control text-white">
                            <label for="dashboardName">Dashboard Name</label>
                        </div>
                        <div class="row m-0 d-flex justify-content-center align-content-center align-items-center justify-items-center">
                                <input class="btn btn-primary w-100" type="submit" name="viewDashboard" id="viewDashboard" value="Ver tablero">
                        </div>
                    </form>`,
            theme: $.sweetModal.THEME_DARK
        });

        var dashboardName = $("#dashboardName").val();

        modal.params["onOpen"] = function () {
            $("#dashboardName").focus();
            $("#formremoveCollaborator").on("submit", function (event) {
                var event = event || window.event;
                event.preventDefault();

                redirectTo(`/daw/projects/id/${controller.model.projectId}/dashboards/${dashboardName}`);

                return false;
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