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
THEME = MIXED_THEME;

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
        console.log(settings);

        var modal = $.sweetModal({
            "title": settings["title"],
            "content": settings["content"],
            "theme": THEME
        });

        modal.params["onOpen"] = function () {
            settings["onOpen"](modal);
        };

        modal.params["onClose"] = function () {
            settings["onOpen"](modal);
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
                    "class": "greenB",
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
            settings["onOpen"](confirm);
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
        successAlert.params["onOpen"] = function () {
            settings["onOpen"](alert);
        }
        successAlert.params["onClose"] = function () {
            settings["onClose"](alert);
        }

        return modal;
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