//format number with certain number of 0
function minNumberOfDigits(number, numberOfDigits = 2) {
    return number.toLocaleString("es", {
        minimumIntegerDigits: numberOfDigits,
    });
}

//get all dates from a week given a date
function getWeekFromDate(dayDate) {
    var weekDates = [];
    var dayInNumber = dayDate.getDay();
    var startingNumber = 1;
    if (dayInNumber >= 1) {
        startingNumber = 0 - dayInNumber;
    }

    var currentDateInFor = new Date(dayDate.getFullYear(), dayDate.getMonth(), dayDate.getDate());

    currentDateInFor.setDate(currentDateInFor.getDate() + (startingNumber));
    for (var index = 0; index < 7; index++) {
        currentDateInFor.setDate(currentDateInFor.getDate() + 1);
        weekDates.push(new Date(currentDateInFor.getTime()));
        startingNumber++;
    }

    return weekDates;
}

//function to send notificcation
function sendNotification(message = "An error occurred", error = false) {
    setTimeout(() => {
        modalError(message);
    }, 250);
    //alert(message);
}

$("#currentYear").html(printDateWithFormat(new Date(), "Y"));

//print date with certain fromat
function printDateWithFormat(givenDate, format = "d/m/Y") {
    format = format.replace("y", givenDate.getYear());
    format = format.replace("Y", givenDate.getFullYear());

    format = format = format.toLowerCase();

    format = format.replace("d", minNumberOfDigits(givenDate.getDate()));

    format = format.replace("m", minNumberOfDigits(givenDate.getMonth() + 1));

    return format;
}