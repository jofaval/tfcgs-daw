class TimeFromMoment {
    constructor(container, originalDate, showOriginalDate = true) {
        var instance = this;
        container.html("");
        instance.htmlContent = $(`
        <div class="timeOutContainer d-inline-flex mx-1 row">
            <p class="timeOutDate mb-0"></p>
            <p class="timeOutOriginal d-none d-sm-block font-weight-normal mb-0 ml-2 text-muted"></p>
        </div>
        `);

        instance.originalDateElement = instance.htmlContent.find(".timeOutOriginal");
        if (showOriginalDate) {
            instance.originalDateElement.text(`Fecha completa: ${originalDate}`);
        }

        instance.dateElement = instance.htmlContent.find(".timeOutDate");

        instance.dateInDateUtils = new DateUtils(originalDate);
        console.log(instance.dateInDateUtils.date);

        if (instance.dateInDateUtils === false) {
            return false;
        }

        var currentTimestamp = new Date().getTime();
        var originalDateTimestamp = instance.dateInDateUtils.date.getTime();
        if (originalDateTimestamp > currentTimestamp) {
            var timestamp = originalDateTimestamp - currentTimestamp;
            setTimeout(() => {
                instance.functionsToExecute(instance);
            }, timestamp);
        } else {
            instance.functionsToExecute(instance);
        }

        container.append(instance.htmlContent);
    }

    delete(instance) {
        clearTimeout(instance.timeoutID);
    }

    functionsToExecute(instance) {
        instance.setTimeFromCurrentMoment(instance);
        instance.setNewTimeout(instance);
    }

    setNewTimeout(instance) {
        var newTimeStamp = instance.getNewTimeSpan(instance);
        console.log(newTimeStamp);

        instance.timeoutID = setTimeout(() => {
            instance.setTimeFromCurrentMoment(instance);
            instance.setNewTimeout(instance);
        }, newTimeStamp + 25);
    }

    getNewTimeSpan(instance) {
        var finalDate = new Date();

        var originalDate = instance.dateInDateUtils.date;
        finalDate.setSeconds(originalDate.getSeconds());

        var currentDate = new Date();

        var unitTime = instance.dateInDateUtils.unitTime;
        switch (unitTime) {
            case "seconds":
            case "minutes":
                finalDate.setMinutes(finalDate.getMinutes() + 1);
                break;
            case "hours":
                finalDate.setHours(finalDate.getHours() + 1);
                break;
            case "days":
                finalDate.setDate(finalDate.getDate() + 1);
                break;
            case "weeks":
            default:
                var lastDayOfWeek = new DateUtils(finalDate, false).getWeekFromDate()[6];
                lastDayOfWeek.setDate(lastDayOfWeek.getDate() + 1);
                finalDate = new DateUtils(lastDayOfWeek, false).getWeekFromDate()[0];
                break;
        }

        console.log("finalDate", finalDate, "currentDate", currentDate);

        return finalDate.getTime() - currentDate.getTime();
    }

    setTimeFromCurrentMoment(instance) {
        instance.dateElement.text(
            instance.dateInDateUtils.getTimeFromThisMoment()
        );
    }
}