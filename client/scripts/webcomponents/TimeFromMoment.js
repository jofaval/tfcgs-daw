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

        if (instance.dateInDateUtils === false) {
            return false;
        }

        instance.dateElement.text(
            instance.dateInDateUtils.getTimeFromThisMoment()
        );

        instance.setNewTimeout(instance);

        container.append(instance.htmlContent);
    }

    setNewTimeout(instance) {
        var newTimeStamp = instance.getNewTimeSpan(instance);
        console.log(newTimeStamp);

        setTimeout(() => {
            instance.setTimeFromCurrentMoment(instance);
            instance.setNewTimeout(instance);
        }, newTimeStamp + 1000);
    }

    getNewTimeSpan(instance) {
        var current = new Date();
        var currentTimestamp = current.getTime();
        var newDate;
        var unitTime = instance.dateInDateUtils.unitTime;
        switch (unitTime) {
            case "weeks":
                current.setDate()
                var lastDayOfWeek = new DateUtils(current, false).getWeekFromDate()[6];
                lastDayOfWeek.setDate(lastDayOfWeek.getDate() + 1);
                current = new DateUtils(lastDayOfWeek, false).getWeekFromDate()[0];
                newDate.setHours(0);
                newDate.setMinutes(0);
                newDate.setSeconds(0);
                break;
            case "days":
                current.setDate(current.getDate() + 1);
                current.setHours(0);
                current.setMinutes(0);
                current.setSeconds(0);
                break;
            case "hours":
                current.setHours(current.getHours() + 1);
                current.setMinutes(0);
                current.setSeconds(0);
                break;
            case "minutes":
            case "seconds":
                current.setMinutes(current.getMinutes() + 1);
                current.setSeconds(0);
                break;
        }

        return current.getTime() - currentTimestamp;
    }

    setTimeFromCurrentMoment(instance) {
        instance.dateElement.text(
            instance.dateInDateUtils.getTimeFromThisMoment()
        );
    }
}