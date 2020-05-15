function createProjectSection(parent, title) {
    var container = $(`<div id="projectContainer${title}" class="projectContainer aqua-gradient rounded shadow mb-4 justify-content-around d-flex flex-wrap"
            style="max-height: 20rem !important; overflow: hidden;">
        </div>`);
    var title = $(
        `<h6 class="mt-4 projectContainerTitle mb-0 waves-effect text shadow p-2 rounded text-white">${title} <span class="icon float-right"></span></h6>`
    );
    var toggled = true;
    var styles = "blue darken-1 font-weight-bold";
    title.toggleClass(styles);
    var alterStyles = "grey darken-3";
    title.on("click", function () {
        container.stop().animate({
            maxHeight: toggled ? "0px" : "20rem",
            paddingTop: toggled ? "0rem" : "1.5rem",
            paddingBottom: toggled ? "0rem" : "1.5rem",
        }, toggled ? 450 : 250);
        //container.toggleClass("py-4");
        title.toggleClass(styles);
        title.toggleClass(alterStyles);
        title.find(".icon").text(toggled ? "+" : "^");
        toggled = !toggled;

    });
    parent.append(container);
    container.before(title);
    for (let index = 0; index < 5; index++) {
        container.append($(`<div class="card my-3 mx-0" style="width: 12.5rem !important;">
                <div class="card-body px-3 py-2">
                        <h5 class="card-title mb-2">Test</h5>
                        <small style="line-height: 1rem !important;" class="d-block">This is some text within a card body.</small>
                </div>
            </div>`));
    }
}

var container = $(
    `<div class="col-md-9" id="projectsContainer" style="overflow: auto;"></div>`
);
$("#mainProjectPanel").append(container);
createProjectSection(container, "Bookmarked");
createProjectSection(container, "Yours");
createProjectSection(container, "Shared");
createProjectSection(container, "All");

$(".projectContainerTitle").trigger("click");