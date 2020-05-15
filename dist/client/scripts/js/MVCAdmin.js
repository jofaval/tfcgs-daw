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

        $(".collapsed").on("click", function () {
            console.log("test");

            $(this).find(".fa").toggleClass("rotate-icon");
        });

        var searchInput = $("#searchTable");
        whenUserDoneTypingInInput(searchInput, "searchTable", function () {
            var valueToSearch = searchInput.val().toLowerCase();

            $(".dbTableCard").each(function () {
                var current = $(this);
                if (current.find(".dbTableCardTitle").text().trim().toLowerCase().includes(valueToSearch)) {
                    current.show('drop', {
                        duration: 200,
                    });
                } else {
                    current.hide('fold', {
                        duration: 200,
                    });
                }
            })
        }, 50);
    }

    static getInstance() {
        if (!Controller.instance) {
            Controller.instance = new AdminController(new Model(), new View());
        }

        return Controller.instance;
    }
}

adminController = new AdminController(new Model(), new View());