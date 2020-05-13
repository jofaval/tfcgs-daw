LIGHT_THEME = [
    "dark-overlay",
    "light-modal"
];
MIXED_THEME = [
    "dark-overlay",
    "light-modal"
];
DARK_THEME = [
    "dark-overlay",
    "dark-modal",
];
THEME = DARK_THEME;

class Modal {

    /* 
    settings = {
        "title": "test",
        "content": "test",
        "onOpen": function () {},
        "onAccept": function () {},
        "onCancel": function () {},
        "onClose": function () {},
    }
    */
    static modal(settings) {
        Modal.addDefaultValuesToSettings(settings);
        //console.log(settings);

        var modal = $.sweetModal({
            "title": settings["title"],
            "content": settings["content"],
            "theme": THEME
        });
        console.log(modal);

        settings["onOpen"](modal);
        modal["$overlay"].addClass("d-flex justify-content-center align-content-center");
        modal["$overlay"].find(".sweet-modal-content").addClass("p-0 p-sm-5 m-auto");
        modal["$overlay"].find(".sweet-modal-title-wrap").prepend(modal["$overlay"].find(".sweet-modal-close").removeClass("position-absolute").addClass("float-right position-sticky"));
        modal["$overlay"].find(".sweet-modal-box.alert").css({
            "top": "0px", //35%
            "marginTop": "0px",
            "position": "unset",
            /* "maxHeight": "100vh", */
        }).addClass("m-auto overflow-auto");

        modal.params["onOpen"] = function () {
            //settings["onOpen"](modal);

            modal["$overlay"].find(".sweet-modal-overlay").addClass("d-flex justify-content-center justify-items-center align-content-center align-items-center");
        };

        modal.params["onClose"] = function () {
            settings["onClose"](modal);
        };

        return modal;
    }

    /* 
    settings = {
        title: "test",
        body: "test",
        onOpen: function () {},
        onAccept: function () {},
        onCancel: function () {},
        onClose: function () {},
    }
    */
    static confirmationModal(settings) {
        Modal.addDefaultValuesToSettings(settings);
        var confirm = $.confirm({
            "title": settings["title"],
            "message": settings["body"],
            "theme": THEME,
            "buttons": {
                "Cancelar": {
                    "class": "greenB text-dark",
                    "action": function () {
                        settings["onCancel"](confirm);
                    }
                },
                "Confirmar": {
                    "class": "redB",
                    "action": function () {
                        settings["onAccept"](confirm);
                    }
                },
            }
        });

        confirm.params["onOpen"] = function () {
            settings["onOpen"](confirm);
        };

        confirm.params["onClose"] = function () {
            settings["onClose"](confirm);
        };

        return confirm;
    }

    /* 
    settings = {
        message: "test",
        error: true,
        onOpen: function () {},
        onAccept: function () {},
        onCancel: function () {},
        onClose: function () {},
        theme: theme,
    }
    */
    static specialAlert(settings) {
        Modal.addDefaultValuesToSettings(settings);
        var alert = $.sweetModal({
            "content": settings["message"],
            "icon": settings["error"] ? $.sweetModal.ICON_ERROR : $.sweetModal.ICON_SUCCESS,
            "theme": THEME,
        });
        alert.params["onOpen"] = function () {
            settings["onOpen"](alert);
        }
        alert.params["onClose"] = function () {
            settings["onClose"](alert);
        }

        return alert;
    }

    static addDefaultValuesToSettings(settings) {
        Modal.ifUndefinedAddEmptyFunction(settings, "onOpen")
        Modal.ifUndefinedAddEmptyFunction(settings, "onAccept")
        Modal.ifUndefinedAddEmptyFunction(settings, "onCancel")
        Modal.ifUndefinedAddEmptyFunction(settings, "onClose")
    }

    static ifUndefinedAddEmptyFunction(array, name) {
        if (array[name] == undefined) {
            array[name] = function () {};
        }
    }
}