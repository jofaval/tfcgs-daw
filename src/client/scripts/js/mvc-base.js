var $collaboratorCard = $(`<div class="collaboratorCard rounded row col-12 col-sm m-2 m-2 bg-white">
    <img class="collaboratorImg my-2 rounded-pill" src=EXECUTION_HOME_PATH + "img/profile-pic.png" alt="">
    <div class="collaboratorDetails my-auto col">
        <p class="collaboratorUsername m-0 font-weight-bold">Administrator</p>
        <h5 class="collaboratorName m-0">Pepe Fabra Valverde</h5>
        <p class="collaboratorRole m-0 informationText font-weight-bold">Administrator</p>
        <div class="informationTextQuote text-left collaboratorRoleDescription text-white p-3 position-absolute rounded z-index-overlap"></div>
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
            url: EXECUTION_HOME_PATH + "index.php?ctl=getCollaboratorsOfProject",
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

    visualizeCollaborator(container, json) {
        var clonedCard = $collaboratorCard.clone();

        clonedCard.find(".collaboratorName").text(json.collaboratorName);
        var username = json.collaboratorUsername;
        clonedCard.find(".collaboratorUsername").text(username);
        clonedCard.find(".collaboratorImg").prop("src", `${EXECUTION_HOME_PATH}img/users/${username}/${username}.png`);

        clonedCard.find(".collaboratorRole").text(json.collaborationRole);
        clonedCard.find(".collaboratorRoleDescription").text(json.collaborationRoleDescription);

        container.append(clonedCard);

        return clonedCard;
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
        });

        $(".collaboratorBtnAdd").on("click", function (event) {
            controller.testFunction(controller, event);
        });
    }

    testFunction(params) {

    }
}

const controller = new Controller(
    new Model(),
    new View()
);