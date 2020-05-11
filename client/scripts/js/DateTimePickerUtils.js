class DateTimePickerUtils {
    constructor(date, datepickerElement, onSelectDate) {
        var instance = this;
        $.datetimepicker.setLocale('es');

        var timesArray = [];

        var minutes = ["00", "15", "30", "45"]

        for (let hourIndex = 0; hourIndex < 24; hourIndex++) {
            for (let minuteIndex = 0; minuteIndex < 4; minuteIndex++) {
                timesArray.push(`${hourIndex}:${minutes[minuteIndex]}`);
            }
        }

        var datetimepicker = datepickerElement.datetimepicker({
            value: new DateUtils(date, false).printDateWithFormat("Y.m.d"),
            format: 'Y-m-d',
            theme: 'dark',
            dayOfWeekStart: 1,
            allowTimes: timesArray,
            onSelectDate: function (ct, $input) {
                onSelectDate(ct, $input);
            }
        });
    }
}