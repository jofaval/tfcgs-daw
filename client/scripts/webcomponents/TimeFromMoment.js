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
        //instance.dateInDateUtils.date.setMinutes(instance.dateInDateUtils.date.getMinutes() + 1);
        console.log(instance.dateInDateUtils.date);


        if (instance.dateInDateUtils === false) {
            return false;
        }

        instance.dateElement.text(
            instance.dateInDateUtils.getTimeFromThisMoment()
        );

        instance.setTimeFromCurrentMoment(instance);
        instance.setNewTimeout(instance);

        container.append(instance.htmlContent);
    }

    setNewTimeout(instance) {
        var newTimeStamp = instance.getNewTimeSpan(instance);
        console.log(newTimeStamp);

        setTimeout(() => {
            instance.setTimeFromCurrentMoment(instance);
            //instance.setNewTimeout(instance);
        }, newTimeStamp + 1000);
    }

    getNewTimeSpan(instance) {
        /* var current = new Date();

        var original = new Date(instance.dateInDateUtils.date.getTime());
        current.setSeconds(original.getSeconds());
        var currentTimestamp = current.getTime();

        var unitTime = instance.dateInDateUtils.unitTime;
        console.log(unitTime); */

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