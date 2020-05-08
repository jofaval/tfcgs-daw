class Modal {

    LIGHT_THEME = $.sweetModal.THEME_MIXED;
    DARK_THEME = $.sweetModal.THEME_DARK;
    THEME = LIGHT_THEME;

    /* 
    settings = {
        title: "test",
        content: "test",
        onOpen: function () {},
        onAccept: function () {},
        onCancel: function () {},
        onClose: function () {},
    }
    */
    static modal(settings) {
        var modal = $.sweetModal({
            title: settings.title,
            content: settings.content,
            theme: $.sweetModal.THEME_DARK
        });

        modal.params["onOpen"] = function () {
            settings.onOpen(modal);
        };

        modal.params["onClose"] = function () {
            settings.onOpen(modal);
        };
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
        var modal = $.sweetModal.confirm(settings.title, settings.title, function () {
            settings.onAccept(modal);
        }, function () {
            settings.onCancel(modal);
        });

        modal.params["onOpen"] = function () {
            settings.onOpen(modal);
        };

        modal.params["onClose"] = function () {
            settings.onOpen(modal);
        };
    }

    /* 
    settings = {
        title: "test",
        error: true,
        onOpen: function () {},
        onAccept: function () {},
        onCancel: function () {},
        onClose: function () {},
    }
    */
    static specialAlert(settings) {
        var alert = $.sweetModal({
            content: settings.title,
            icon: settings.error ? $.sweetModal.ICON_ERROR : $.sweetModal.ICON_SUCCESS,
            theme: $.sweetModal.THEME_DARK,
        });
        successAlert.params["onOpen"] = function () {
            settings.onOpen(alert);
        }
        successAlert.params["onClose"] = function () {
            settings.onClose(alert);
        }
    }
}