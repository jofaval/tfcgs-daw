class Model {
    constructor() {

    }
}

class View {
    constructor() {

    }

    initializeView(container) {

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

        var mainContainer = $("#content");

        view.initializeView(mainContainer);
    }

}

const projectsController = new Controller(
    new Model(),
    new View()
);