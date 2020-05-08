class Model {
    constructor() {
        this.paginationIndex = 1;
        this.projectId = this.getProjectId();
    }

    loadContent(whenFinished) {
        var model = this;

        var dateInString = new DateUtils(model.currentDate).printDateWithFormat("Y-m-d");
        $.ajax({
            url: "/daw/index.php?ctl=queryProjectDiary",
            data: {
                "day": dateInString,
                "id_project": model.projectId,
            },
            success: function (content) {
                whenFinished(decodeURI(content));
            },
        });
    }

    getProjectId() {
        var URL = window.location.href;
        var splittedURL = URL.split("/");

        return splittedURL[6];
    }

    saveContent(content, whenFinished, ifError) {
        var model = this;

        content = encodeURI(content);
        var dateInString = new DateUtils(model.currentDate).printDateWithFormat("Y-m-d");
        $.ajax({
            url: "/daw/index.php?ctl=createProjectDiary",
            data: {
                "day": dateInString,
                "id_project": model.projectId,
                "content": content,
            },
            success: function (result) {
                whenFinished(result);
            },
        });
    }

    modifyContent(content, whenFinished) {
        var model = this;

        content = encodeURI(content);
        var dateInString = new DateUtils(model.currentDate).printDateWithFormat("Y-m-d");
        $.ajax({
            url: "/daw/index.php?ctl=updateProjectDiary",
            data: {
                "day": dateInString,
                "id_project": model.projectId,
                "content": content,
            },
            success: function (result) {
                whenFinished(result);
            },
        })
    }
}

class View {
    constructor() {

    }

    initializeView(container) {}

    visualizeContent(container, content) {
        container.html(content);

        return container;
    }

    hideComponent(component) {
        //component.fadeOut();
        component.hide();
    }

    showComponent(component) {
        //component.fadeIn();
        component.show();
    }

    scrollTo(element) {
        $(element).get(0).scrollIntoView({
            behavior: "smooth"
        });
    }
}

class Controller {
    constructor(model, view) {
        this.model = model;
        this.view = view;

        var controller = this;

        var date = $("#datepicker").val();

        if (isNaN(Date.parse(date))) {
            date = new Date();
        } else {
            date = new Date(Date.parse(date));
        }

        controller.model.currentDate = date;

        controller.loadDateContent(controller);

        $(".collaboratorBtnAdd").on("click", function (event) {
            controller.testFunction(controller, event);
        });

        $(".projectDiaryBtnPrev").on("click", function (event) {
            var result = controller.setDateToPrev(controller, event);
            if (result === false) {
                return false;
            }
        });

        $(".projectDiaryBtnNext").on("click", function (event) {
            var result = controller.setDateToNext(controller, event);
            if (result === false) {
                return false;
            }
        });

        $("#diaryBtnSave").on("click", function () {
            controller.saveContent(controller);
        });

        $("#datepicker").on("change", function (event) {
            controller.inputDateFormatCheck(controller, $(this), event);
        });

        $("#navigationSchemeBtn").on("click", function () {
            controller.generateNavigationScheme(controller);
        });

        whenUserDoneTypingInInput($(".note-editable.card-block"), "summernoteContent", function () {
            controller.generateNavigationScheme(controller);
        }, 2.5 * 1000);
    }

    generateNavigationScheme(controller) {
        var navigationScheme = $(".pushMenu .content");

        navigationScheme.html("");
        var levels = {
            "H1": 0,
            "H2": 0,
            "H3": 0,
            "H4": 0,
            "H5": 0,
            "H6": 0,
        };
        var summernoteContentContainer = $(".note-editable.card-block");
        var summernoteContent = summernoteContentContainer.html();
        summernoteContentContainer.html("")

        var content = $(summernoteContent);

        var encodedContent = encodeURI(summernoteContent);
        var decodedContent = decodeURI(encodedContent);
        console.log(
            "content type", typeof summernoteContent,
            "\ncontent", summernoteContent,
            "\nencoded", encodedContent,
            "\ndecoded", decodedContent
        );

        content.each(function () {
            var current = $(this);
            controller.eachNavigationElementProcessing(current, levels, controller, navigationScheme, summernoteContentContainer);
        });

        controller.generateNavigationSchemeEvents(controller);
    }

    generateNavigationSchemeEvents(controller) {
        $(".pushMenu .content a").on("click", function (event) {
            var event = event || window.event;
            event.preventDefault();

            console.log("test");

            var aElement = $(this);
            var elementHref = aElement.prop("href");
            elementHref = elementHref.substring(elementHref.lastIndexOf("/") + 1);
            elementHref = elementHref.split(".").join("\\.");
            var elementScrollTarget = $(elementHref);

            controller.view.scrollTo(elementScrollTarget);
            hidePushMenu();

            return false;
        });
    }

    eachNavigationElementProcessing(current, levels, controller, navigationScheme, summernoteContentContainer) {
        current.find(".level").remove();
        var indentationLevel = -1;
        var tagName = current.get(0).tagName;
        levels[tagName]++;
        if (current.is("h1, h2, h3, h4, h5, h6")) {
            indentationLevel += parseInt(tagName.replace("H", ""));
            levels;
        }
        var title = current.text().trim();
        if (indentationLevel != -1) {
            var tagNameToResetIndex = indentationLevel + 2;
            while (tagNameToResetIndex <= 6) {
                levels["H" + tagNameToResetIndex] = 0;
                tagNameToResetIndex++;
            }
            var newTitle = title;
            if (newTitle.length > 15) {
                newTitle = newTitle.substring(0, 14);
            }
            var trueLevel = controller.getTrueLevel(levels, indentationLevel);
            navigationScheme.append($(`<a class="py-2 navigationElement" style="padding-left: ${indentationLevel * 0.5}em" href="#${trueLevel}">
                            ${trueLevel} ${newTitle}
                        </a>`));
            current.prop("id", trueLevel);
            if (current.find(".level").length == 0) {
                current.prepend(`<span class="level">${trueLevel}</span> `);
            }
        }
        summernoteContentContainer.append(current);
    }

    inputDateFormatCheck(controller, inputDate, event) {
        var inputDateValue = inputDate.val();

        var inputDateInTimeStamp = Date.parse(inputDateValue);
        if (isNaN(inputDateInTimeStamp)) {
            sendNotification("La fecha introducida no es correcta", "diaryDateNotValid");
            inputDate.addClass("not-valid");
            return;
        }

        inputDate.removeClass("not-valid");
    }

    saveContent(controller) {
        var summernoteContentContainer = $(".note-editable.card-block");
        var summernoteContent = summernoteContentContainer.html();

        controller.model.saveContent(summernoteContent, function (result) {
            console.log("result crearlo", result);
            if (result !== true) {
                controller.model.modifyContent(summernoteContent, function (result) {
                    console.log("result modificarlo", result);
                    if (result !== false) {
                        sendNotification("Se ha guardado con éxito.", "diarySavedWithSuccess");
                    } else {
                        sendNotification("No se ha podido guardar.", "diarySavedWithFail");
                    }
                });
            } else {
                sendNotification("Se ha guardado con éxito.", "diarySavedWithSuccess");
            }
        });
    }

    setDateToPrev(controller, event) {
        var event = event || window.event;
        event.preventDefault();

        controller.modifyDate(controller, -1);

        return false;
    }

    setDateToNext(controller, event) {
        var event = event || window.event;
        event.preventDefault();

        controller.modifyDate(controller, 1);

        return false;
    }

    modifyDate(controller, increment) {
        var workingDate = controller.model.currentDate;
        workingDate.setDate(workingDate.getDate() + (increment));

        controller.loadDateContent(controller);
        controller.model.currentDate = workingDate;

        var dateInFormat = new DateUtils(workingDate).printDateWithFormat("Y-m-d");

        $("#datepicker").val(dateInFormat);

        window.history.pushState('page2', document.title, `/daw/projects/id/${controller.model.projectId}/diary/date/${dateInFormat}/`);
    }

    loadDateContent(controller) {
        controller.model.loadContent(function (content) {
            if (content == false) {
                content = "";
            }
            console.log("result cargarlo", decodeURI(content));
            controller.view.visualizeContent($(".note-editable.card-block"), decodeURI(content))
            controller.generateNavigationScheme(controller);
        });
    }

    getTrueLevel(levels, indentationLevel) {
        indentationLevel++;
        var string = "";

        while (indentationLevel >= 1) {
            string = `${levels["H" + indentationLevel]}.${string}`;
            indentationLevel--;
        }

        return string;
    }
}

const controller = new Controller(
    new Model(),
    new View()
);