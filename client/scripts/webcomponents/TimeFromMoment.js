class TimeFromMoment {
    constructor(container, originalDate) {
        var instance = this;
        instance.htmlContent = $(`
        <div class="timeOutContainer row">
            <p class="timeOutDate"></p>
            <p class="timeOutOriginal ml-2 text-muted"></p>
        </div>
        `);

        instance.originalDateElement = instance.htmlContent.find(".timeOutOriginal");
        instance.originalDateElement.text(`Fecha completa: ${originalDate}`);

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

    functionsToExecute(instance) {
        instance.setTimeFromCurrentMoment(instance);
        instance.setNewTimeout(instance);
    }

    setNewTimeout(instance) {
        var newTimeStamp = instance.getNewTimeSpan(instance);
        console.log(newTimeStamp);

        setTimeout(() => {
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
                var lastDayOfWeek = new DateUtils(finalDate, false).getWeekFromDate()[6];
                lastDayOfWeek.setDate(lastDayOfWeek.getDate() + 1);
                finalDate = new DateUtils(lastDayOfWeek, false).getWeekFromDate()[0];
                break;
            default:
                finalDate.setTime(finalDate.getTime() * 50);
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