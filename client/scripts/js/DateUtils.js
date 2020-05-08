class DateUtils {
    monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ];

    constructor(date, convert = true) {
        this.date = date;

        if (convert) {
            if (!stringToDate()) {
                return false;
            }
        }
    }

    stringToDate() {
        if (typeof this.date == "string") {
            var timestamp = Date.parse(this.date);

            if (!isNaN(timestamp)) {
                this.date = new Date(timestamp);
            }
        }

        return false;
    }

    //get all dates from a week given a date
    getWeekFromDate() {
        var weekDates = [];
        var dayInNumber = this.date.getDay();
        var startingNumber = 1;
        if (dayInNumber >= 1) {
            startingNumber = 0 - dayInNumber;
        }

        var currentDateInFor = new Date(this.date.getFullYear(), this.date.getMonth(), this.date.getDate());

        currentDateInFor.setDate(currentDateInFor.getDate() + (startingNumber));
        for (var index = 0; index < 7; index++) {
            currentDateInFor.setDate(currentDateInFor.getDate() + 1);
            weekDates.push(new Date(currentDateInFor.getTime()));
            startingNumber++;
        }

        return weekDates;
    }

    dateBetweenInterval(from, to) {
        return this.dateToCheck.getTime() <= to.getTime() && this.dateToCheck.getTime() >= from.getTime();
    }

    printDateStylish() {
        var monthName = this.monthNames[this.date.getMonth()];
        monthName = monthName.substring(0, 3).toLowerCase();
        return `${this.date.getDate()} de ${monthName}.`;
    }

    //print date with certain fromat
    printDateWithFormat(format = "d/m/Y") {
        format = format.replace("y", this.date.getYear());
        format = format.replace("Y", this.date.getFullYear());
        format = format = format.toLowerCase();
        format = format.replace("d", minNumberOfDigits(this.date.getDate()));
        format = format.replace("m", minNumberOfDigits(this.date.getMonth() + 1));

        format = format.replace("h", minNumberOfDigits(this.date.getHours() + 1));
        format = format.replace("i", minNumberOfDigits(this.date.getMinutes() + 1));
        format = format.replace("s", minNumberOfDigits(this.date.getSeconds() + 1));
        return format;
    }

    getTimeFromThisMoment() {
        var givenDate = this.date.getTime();

        var now = Date.now();

        // get total seconds between the times
        var delta = Math.abs(now - givenDate) / 1000;

        // calculate (and subtract) whole days
        var days = Math.floor(delta / 86400);
        delta -= days * 86400;

        // calculate (and subtract) whole hours
        var hours = Math.floor(delta / 3600) % 24;
        delta -= hours * 3600;

        // calculate (and subtract) whole minutes
        var minutes = Math.floor(delta / 60) % 60;
        delta -= minutes * 60;

        // what's left is seconds
        var seconds = Math.floor(delta % 60); // in theory the modulus is not required

        var finalString = "Hace ";
        if (days > 0) {
            if (Math.floor(days / (((365 * 5) * 2) * 10)) > 0) {
                finalString += `${Math.floor(days / (((365 * 5) * 2) * 10))} siglo(s)`;
            } else if (Math.floor(days / ((365 * 5) * 2)) > 0) {
                finalString += `${Math.floor(days / ((365 * 5) * 2))} década(s)`;
            } else if (Math.floor(days / (365 * 5)) > 0) {
                finalString += `${Math.floor(days / (365 * 5))} lustro(s)`;
            } else if (Math.floor(days / 365) > 0) {
                finalString += `${Math.floor(days / 365)} año(s)`;
            } else if (Math.floor(days / 30) > 0) {
                finalString += `${Math.floor(days / 30)} mes(es)`;
            } else if (Math.floor(days / 7) > 0) {
                finalString += `${Math.floor(days / 7)} semana(s)`;
            } else {
                finalString += `${days} dia(s)`;
            }
        } else if (hours > 0) {
            finalString += `${hours} hora(s)`;
        } else if (minutes > 0) {
            finalString += `${minutes} minuto(s)`;
        } else if (seconds > 0) {
            //finalString += `${seconds} segundo(s)`;
            finalString += `unos segundos`;
        }

        //return [days, hours, minutes, seconds];
        return finalString;
    }
}