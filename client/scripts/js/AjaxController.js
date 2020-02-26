class AjaxController {
    static request(requestLocation, requestType = "POST", params = {}, success = AjaxController.defaultAjaxSuccessAction, error = AjaxController.defaultAjaxErrorAction, async = true) {
        $.ajax({
            url: 'index.php?ctl=' + requestLocation,
            data: params,
            type: requestType,
            async: async,
            success: success,
            error: error,
        });
    }

    //When AJAX is succesful
    static defaultAjaxSuccessAction(data) {
        //var jsonData = JSON.parse(data);
    }

    //When AJAX has some errors
    static defaultAjaxErrorAction(data) {
        sendNotification("Ha surgido un error al realizar la operación", true);
    }

    //Generic request for AJAX
    static genericAjaxRequest(requestName, params, success, error = null) {
        if (error == null) {
            error = function (data) {
                sendNotification("Couldn't execute operation succesfully", true);
            };
        }

        AjaxController.request(requestName, "POST", params, success, error);
    }

    static getEventsFromMonth(month, year, success) {
        AjaxController.genericAjaxRequest("getEventsFromMonth", {
            "month": month,
            "year": year,
        }, success);
    }
}