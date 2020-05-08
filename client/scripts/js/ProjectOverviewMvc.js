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
                "limit": 3,
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

    createDashboard(title, description, whenFinished) {
        var model = this;

        $.ajax({
            url: "/daw/index.php?ctl=createDashboards",
            data: {
                "title": title,
                "description": description,
                "id_project": model.projectId,
            },
            success: function (result) {
                model.workingDashboards.push(result[0]);
                whenFinished(result);
            }
        });
    }

    doesUsernameExist(username, whenFinished) {
        $.ajax({
            url: "/daw/index.php?ctl=doesUsernameExists",
            data: {
                "username": username,
            },
            success: function (result) {
                whenFinished(result);
            }
        });
    }

    inviteCollaborator(username, whenFinished) {
        var model = this;

        model.doesUsernameExist(username, function (result) {
            console.log(result);
            if (result) {
                $.ajax({
                    url: "/daw/index.php?ctl=createCollaborators",
                    data: {
                        "username": username,
                        "id_project": model.projectId,
                    },
                    success: function (result) {
                        model.collaborators.push(result);
                        whenFinished(result);
                    }
                });
            }
        });
    }

    removeCollaborator(username, whenFinished) {
        var model = this;

        model.doesUsernameExist(username, function (result) {
            console.log(result);
            if (result) {
                $.ajax({
                    url: "/daw/index.php?ctl=deleteCollaborators",
                    data: {
                        "username": username,
                        "id_project": model.projectId,
                    },
                    success: function (result) {
                        whenFinished(result);
                    }
                });
            }
        });
    }

    changeCollaboratorRole(username, role, whenFinished) {
        var model = this;

        model.doesUsernameExist(username, function (result) {
            console.log(result);
            if (result) {
                $.ajax({
                    url: "/daw/index.php?ctl=updateCollaborators",
                    data: {
                        "username": username,
                        "id_project": model.projectId,
                        "level": role,
                    },
                    success: function (result) {
                        whenFinished(result);
                    }
                });
            }
        });
    }

    getProjectCollaborationRoles(whenFinished) {
        $.ajax({
            url: "/daw/index.php?ctl=getProjectCollaborationRoles",
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
        });

        var activeTime = $(".activeTime");
        var activeTimeDate = activeTime.html().trim();
        activeTime.html(new DateUtils(activeTimeDate).getTimeFromThisMoment());
        activeTime.append(`<span class="originalDate d-none">${activeTimeDate}</span>`);

        //Tablero
        $("#actionAddDashboard").on("click", function (event) {
            controller.addDashboardBtnEvent(controller, event);
        });

        $("#actionViewDashboard").on("click", function (event) {
            controller.viewDashboard(controller, event);
        });

        //Diario
        $("#actionDiary").on("click", function (event) {
            controller.viewDiary(controller, event);
        });

        //Proyecto
        $("#actionAddCollaborator").on("click", function (event) {
            controller.inviteCollaboratorEvent(controller, event);
        });

        $("#actionRemoveCollaborator").on("click", function (event) {
            controller.removeCollaboratorEvent(controller, event);
        });

        $("#actionChangeRoleCollaborator").on("click", function (event) {
            controller.changeCollaboratorRoleEvent(controller, event);
        });

        $("#actionDeleteProject").on("click", function (event) {
            controller.deleteProject(controller, event);
        });
    }

    deleteProject(controller, event) {
        var event = event || window.event;
        event.preventDefault();


        var confirmationModal = Modal.confirmationModal({
            title: "¿Borrar el proyecto?",
            body: `Confimar esta acción y borrar <b>"${controller.model.projectId}"</b>`,
            onAccept: function () {
                controller.model.deleteProject(function (result) {
                    console.log(result);
                    if (result === true) {
                        Modal.specialAlert({
                            title: `Se ha borrado el proyecto <b>"${controller.model.projectId}"</b>`,
                            error: false,
                            onClose: function () {
                                window.location.reload();
                            },
                        });
                    } else {
                        Modal.specialAlert({
                            title: `No se ha podido borrar el proyecto <b>"${controller.model.projectId}"</b>`,
                            error: true,
                        });
                    }
                })
            },
        });
    }

    addDashboardBtnEvent(controller, event) {
        var event = event || window.event;
        event.preventDefault();

        Modal.modal({
            "title": "Crear tablero",
            "content": `<form action="/daw/index.php?ctl=createDashboards" id="formCreateDashboard" class="col-sm-10  p-3 mx-auto" method="POST">
            <div class="md-form">
                <input type="text" placeholder="" id="title" name="title" value="Prueba" class="form-control text-white">
                <label for="title">Título</label>
            </div>
            <div class="md-form">
            <textarea class="md-textarea form-control text-white" placeholder="" id="description" name="description">Test</textarea>
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
                            window.location.href = `/daw/projects/id/${controller.model.projectId}/dashboards/${title}/`;
                        }
                    });

                });
            },
        });

        return false;
    }

    inviteCollaboratorEvent(controller, event) {
        var event = event || window.event;
        event.preventDefault();

        Modal.modal({
            "title": "Invitar colaborador/a",
            "content": `<form action="/daw/index.php?ctl=createCollaborators" id="formCreateCollaborator" class="col-sm-10  p-3 mx-auto" method="POST">
                            <div class="md-form">
                                <input type="text" placeholder="" id="username" name="username" value="jofaval" class="form-control text-white">
                                <label for="username">Username</label>
                            </div>
                            <div class="row m-0 d-flex justify-content-center align-content-center align-items-center justify-items-center">
                                    <input class="btn btn-primary w-100" type="submit" name="createCollaborators" id="createCollaborators" value="Invitar colaborador/a">
                            </div>
                        </form>`,
            "onOpen": function () {
                $("#username").focus();
                $("#formCreateCollaborator").on("submit", function (event) {
                    var event = event || window.event;
                    event.preventDefault();

                    var username = $("#username").val();

                    controller.model.inviteCollaborator(username, function () {
                        console.log(result);
                        if (result) {
                            controller.reload(controller);
                        } else {
                            sendNotification("No se ha podido añadir", "projectInviteCollaborator");
                        }
                    });

                });
            },
        });

        return false;
    }

    removeCollaboratorEvent(controller, event) {
        var event = event || window.event;
        event.preventDefault();

        Modal.modal({
            "title": "Eliminar colaborador/a",
            "content": `<form action="/daw/index.php?ctl=deleteCollaborators" id="formRemoveCollaborator" class="col-sm-10  p-3 mx-auto" method="POST">
                            <div class="md-form">
                                <input type="text" placeholder="" id="username" name="username" value="jofaval" class="form-control text-white">
                                <label for="username">Username</label>
                            </div>
                            <div class="row m-0 d-flex justify-content-center align-content-center align-items-center justify-items-center">
                                    <input class="btn btn-primary w-100" type="submit" name="deleteCollaborators" id="deleteCollaborators" value="Eliminar colaborador/a">
                            </div>
                        </form>`,
            "onOpen": function () {
                $("#username").focus();
                $("#formRemoveCollaborator").on("submit", function (event) {
                    var event = event || window.event;
                    event.preventDefault();

                    var username = $("#username").val();

                    controller.model.inviteCollaborator(username, function () {
                        console.log(result);
                        if (result) {
                            controller.reload(controller);
                        } else {
                            sendNotification("No se ha podido eliminar", "projectInviteCollaborator");
                        }
                    });

                });
            },
        });

        return false;
    }

    viewDashboard(controller, event) {
        var event = event || window.event;
        event.preventDefault();

        Modal.modal({
            "title": "Ver tablero",
            "content": `<form action="/daw/index.php?ctl=viewDashboard" id="formViewDashboard" class="col-sm-10  p-3 mx-auto" method="POST">
                            <div class="md-form">
                                <input type="text" placeholder="" id="dashboardName" name="dashboardName" value="" class="form-control text-white">
                                <label for="dashboardName">Nombre del tablero</label>
                            </div>
                            <div class="row m-0 d-flex justify-content-center align-content-center align-items-center justify-items-center">
                                    <input class="btn btn-primary w-100" type="submit" name="viewDashboard" id="viewDashboard" value="Ver tablero">
                            </div>
                        </form>`,
            "onOpen": function () {
                $("#dashboardName").focus();
                $("#formViewDashboard").on("submit", function (event) {
                    var event = event || window.event;
                    event.preventDefault();

                    var dashboardName = $("#dashboardName").val();

                    redirectTo(`/daw/projects/id/${controller.model.projectId}/dashboards/${dashboardName}/`);

                    return false;
                });
            },
        });

        return false;
    }

    viewDiary(controller, event) {
        var event = event || window.event;
        event.preventDefault();

        Modal.modal({
            "title": "Ver diario",
            "content": `<form action="/daw/projects/id/${controller.model.projectId}/diary/" id="formViewDiary" class="col-sm-10  p-3 mx-auto" method="POST">
                            <div class="md-form">
                                <input type="date" placeholder="" id="diaryDate" name="diaryDate" value="" class="form-control text-white">
                                <label for="diaryDate">Fecha</label>
                            </div>
                            <div class="row m-0 d-flex justify-content-center align-content-center align-items-center justify-items-center">
                                    <input class="btn btn-primary w-100" type="submit" name="viewDiary" id="viewDiary" value="Ver diario">
                            </div>
                        </form>`,
            "onOpen": function () {
                $("#diaryDate").focus();
                $("#formViewDiary").on("submit", function (event) {
                    var event = event || window.event;
                    event.preventDefault();

                    var diaryDate = $("#diaryDate").val();

                    redirectTo(`/daw/projects/id/${controller.model.projectId}/diary/date/${diaryDate}/`);

                    return false;
                });
            },
        });

        return false;
    }

    changeCollaboratorRoleEvent(controller, event) {
        var event = event || window.event;
        event.preventDefault();

        Modal.modal({
            "title": "Cambiar rol",
            "content": `<form action="/daw/index.php?ctl=updateCollaborators" id="formChangeCollaboratorRole" class="col-sm-10  p-3 mx-auto" method="POST">
                            <div class="md-form">
                                <input type="text" placeholder="" id="username" name="username" value="jofaval" class="form-control text-white">
                                <label for="username">Username</label>
                            </div>
                            <select class="browser-default mb-3 custom-select" name="role" id="role"></select>
                            <div class="row m-0 d-flex justify-content-center align-content-center align-items-center justify-items-center">
                                    <input class="btn btn-primary w-100" type="submit" name="updateCollaborators" id="updateCollaborators" value="Cambiar rol">
                            </div>
                        </form>`,
            "onOpen": function () {
                $("#username").focus();

                controller.model.getProjectCollaborationRoles(function (result) {
                    if (result !== false) {
                        console.log(result);
                        $(result).each(function () {
                            var jsonData = this;
                            var option = $(`
                            <option title="${jsonData.description}" value="${jsonData.level}">${jsonData.title}</option>
                            `)
                            $("#role").append(option);
                        });
                    }
                });

                $("#formChangeCollaboratorRole").on("submit", function (event) {
                    var event = event || window.event;
                    event.preventDefault();

                    var username = $("#username").val();
                    var role = $("#role").val();

                    controller.model.changeCollaboratorRole(username, role, function (result) {
                        console.log(result);
                        if (result !== false) {
                            sendNotification("Se ha cambiado correctamente", "projectChangeCollaboratorRoleSuccess");
                            modal.close();
                        } else {
                            sendNotification("No se ha podido cambiar", "projectChangeCollaboratorRoleError");
                        }
                    });

                });
            },
        });

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
            $(".collaboratorsContainer").append("<span class='text-center text-white'>No se han encontrado resultados.</span>");
        }

        console.log(controller.model.workingCollaborators);
    }

    getCollaboratorPage(controller, container) {
        var collaboratorsPage = container.find(".collaboratorsPage").last();
        var collaboratorPageRows = collaboratorsPage.find(".collaboratorCardRow");

        if (container.find(".collaboratorsPage").length == 0 ||
            (collaboratorPageRows.length >= $("#selectNumberOfRows").val() &&
                collaboratorPageRows.last().find(".collaboratorCard").length >= 2)) {
            collaboratorsPage = controller.view.visualizeCollaboratorPage(container);
        }

        return collaboratorsPage;
    }

    getCollaboratorRow(controller, container) {
        var collaboratorPage = controller.getCollaboratorPage(controller, container);
        var collaboratorRow = collaboratorPage.find(".collaboratorCardRow ");
        if (collaboratorPage.find(".collaboratorCardRow").length == 0 || (collaboratorRow.last().find(".collaboratorCard").length >= 1)) {
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
}

const overviewController = new Controller(
    new Model(),
    new View()
);