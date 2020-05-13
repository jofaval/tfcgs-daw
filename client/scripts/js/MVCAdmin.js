/**
 * @class Model
 *
 * Manages the data of the application.
 */

let calendarController;

class Model {
    constructor() {

    }

    //AJAX CRUD for Teachers, Classrooms and Schedules
    loadTeachers(model, whenFinished) {
        model.teachers = [];
        AjaxController.getTeachers(function (data) {
            model.teachers = data;
            whenFinished(model.teachers);
        });
    }

    instance = null;

    getInstance() {
        if (instance == null) {
            instance = new Model();
        }

        return instance;
    }
}

/**
 * @class View
 *
 * Visual representation of the model.
 */
class View {
    constructor() {
        this.mainContainer = $('main');
        this.mainContainer.before('<div class="d-block d-sm-none my-5 w-100">&nbsp;</div>');
        var addButton = $("<span class='w-100 btn btn-warning mb-2'>Add <i class='fa fa-plus'></i></span>");

        //Create tab
        this.createTab("Teachers", this.mainContainer);

        //Teachers
        this.tableTeachers = $(`<table class="text-center table mx-auto w-100 table-striped table-light table-bordered table-sm dataTable" role="grid" aria-describedby="dtBasicExample_info" cellspacing="0">
            <thead class="text-center">
                <tr>
                    <th>Usuario</th>
                    <th>Full name</th>
                    <th>Type</th>
                    <th>Email</th>
                    <th>Activate</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>`);
        this.tableTeachers.prop("id", "dtTeachers");
        $("#tabContainerTeachers").append(addButton.clone().attr("id", "addTeachers"));
        $("#tabContainerTeachers").append(this.tableTeachers);
    }

    //Create a tab given a name
    createTab(tabName, container) {
        if ($("#tab" + tabName).length) {
            return false;
        }

        this.createTabHeader(tabName, container);
        this.createTabContainer(tabName, container);
    }

    //Create tab header
    createTabHeader(tabName, container) {
        var $tabHeader = $("<span id='tab" + tabName + "' class='btn btn-warning w-25 text-dark p-4 col-xs col-md-10'></span>");
        $tabHeader.html(`<p class="my-auto">${tabName.substring(0,5)}<span class="d-none d-sm-inline">${tabName.substring(5,tabName.length)}</span></p>`);
        $tabHeader.prop("id", "tab" + tabName);
        $tabHeader.attr("tabContainer", "tabContainer" + tabName);
        var $tabHeaderContainer = $("#tabHeaders");
        if ($tabHeaderContainer.length == 0) {
            $tabHeaderContainer = $("<div id='tabHeaders' class='btn-group rounded col-xs w-100 text-center text-white d-flex justify-content-center'></div>");
            container.append($tabHeaderContainer);
        }

        $tabHeaderContainer.append($tabHeader);
    }

    //Create tab content container
    createTabContainer(tabName, container) {
        var $tabContainer = $("<div id='tabContainer' class='tabContainer w-auto py-2 col-md-12 mx-0 rounded bg-dark col-xs'></div>");
        $tabContainer.prop("id", "tabContainer" + tabName);
        $tabContainerContainer = $("#tabContainers");
        if ($tabContainerContainer.length == 0) {
            var $tabContainerContainer = $("<div id='tabContainers' class='w-100 text-white'></div>");
            container.append($tabContainerContainer);
        }
        $tabContainerContainer.append($tabContainer);
    }

    //Fade out item
    fadeOutItem(item, miliseconds = 250) {
        item.fadeOut(250);
        setTimeout(() => {
            //item.hide();
        }, miliseconds);
    }

    //Fade in item
    fadeInItem(item) {
        //item.show();
        item.fadeIn(250);
    }

    //Event for displaying tabs
    tabDispalyEvent() {
        var current = $(this);
        $("#tabContainer" + current.attr("tabContainer"));
        $(".tabContainer").each(function () {
            adminController.fadeOutItem($(this));
        });
        adminController.fadeInItem(current);
    }

    //Create datatable from table and limit rows to 5
    createDataTable(table) {
        table.DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
        });

        var select = $(".dataTables_length select");
        select.html("");
        var acumulative = 5;
        var increment = 5;
        for (let rowOptionsIndex = 0; rowOptionsIndex < 3; rowOptionsIndex++) {
            select.append(`<option value='${acumulative}'>${acumulative}</option>`);
            acumulative += increment;
        }

        select.prop("selectedIndex", 0);
        select.trigger("change");

        table.find('.dataTables_length').addClass('bs-select');
    }

    //Load add JSON row to table
    addRowToTable(dataArray, table) {
        var row = $("<tr></tr>");

        var disableState = dataArray["enabled"];
        delete dataArray["enabled"];

        row.on("click", this.selectionEvent);
        for (const key in dataArray) {
            if (dataArray.hasOwnProperty(key)) {
                const element = dataArray[key];

                row.append($("<td class='align-middle'>" + element + "</td>"));
            }
        }

        var $checkDisable = $(`<td class='align-middle'>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input  rounded-circle" id="disable"
                    name="disable">
                <label class="custom-control-label rounded-circle" for="monday"></label>
            </div>
        </td>`);

        $checkDisable.on("click", function () {

        });

        if (disableState != 0) {
            $checkDisable.find("input").attr("checked", true);
        }
        row.append($checkDisable);

        var $btnRemove = $("<td><button class='btnRemove btn btn-danger'>Remove</button></td>");
        row.append($btnRemove);
        if (table.find("tbody").length) {
            table.find("tbody").append(row);
        } else {
            table.find("tbody").append(row);
        }
    }

    //Add JSON to table
    addRowsToTable(dataArray, table) {
        var parsedArray = JSON.parse(dataArray);

        if (parsedArray.length > 0) {
            parsedArray.forEach(rowElement => {
                this.addRowToTable(rowElement, table);
            });
        }
    }

    //Row selection event
    selectionEvent() {
        var toggle = !$(this).hasClass("selected");
        $('.selected').removeClass("selected");
        if (toggle) {
            $(this).addClass("selected");
        }
    }

    instance = null;

    getInstance() {
        if (instance == null) {
            instance = new View();
        }

        return instance;
    }
}

/**
 * @class Controller
 *
 * Links the user input and the view output.
 *
 * @param model
 * @param view
 */
class AdminController {
    instance = null;

    constructor(model, view) {
        this.model = model;
        this.view = view;

        $("#tabHeaders .btn").on("click", function () {
            var current = $(this);
            if (!current.hasClass("active")) {
                $("#tabHeaders .btn.active").removeClass("active");
                current.addClass("active");
                $(".tabContainer").each(function () {
                    //view.fadeOutItem($(this));
                    $(this).hide();
                });
                var tabContainer = $("#" + current.attr("tabContainer"));
                view.fadeInItem(tabContainer);
                //tabContainer.show();
            }
        });

        //Tab teachers is selected by default
        $("#tabTeachers").trigger("click");

        //Load all teachers into datatable
        model.loadTeachers(model, function (data) {
            var table = $("#dtTeachers");
            view.addRowsToTable(model.teachers, table);

            $("#tabContainerTeachers .btnRemove").on("click", function name(params) {
                var btn = $(this);

                var row = btn.parent().parent();
                var columns = row.children();
                AjaxController.deleteTeacher(columns.eq(3).text(), function (data) {
                    row.remove();
                });
            });
        });

        //Load add teachers to database with modal
        $("#addTeachers").on("click", function () {
            Modal.genericModalWithForm("Teacher", false, function (modalContent) {
                $("*[type=submit]").on("click", function (event) {
                    var event = event || window.event
                    event.preventDefault();
                    modalContent.close();
                    return false;
                });
                var form = $("form");
                form.find(":submit").on("click", function (event) {
                    var event = event || window.event;
                    event.preventDefault();

                    var fd = new FormData();
                    var files = $('#inputTeacherName')[0].files[0];
                    fd.append('file', files);

                    var teacherData = {
                        "username": $("#inputTeacherUsername").val(),
                        "password": $("#inputTeacherPassword").val(),
                        "name": $("#inputTeacherName").val(),
                        "image": $("#inputImage").val(),
                        "email": $("#inputTeacherEmail").val(),
                        "enabled": true,
                    }
                    AjaxController.createTeacher(teacherData.username, teacherData.password, teacherData.name, "default.png", teacherData.email, function success(data) {});
                })
            });
        });
    }

    static getInstance() {
        if (!Controller.instance) {
            Controller.instance = new AdminController(new Model(), new View());
        }

        return Controller.instance;
    }
}

adminController = new AdminController(new Model(), new View());