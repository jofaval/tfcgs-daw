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

var notifications = {

};
//function to send notificcation
function sendNotification(message = "An error occurred", id = "empty", title = "Origin - Notificación", timeout = 5000) {
    if (window.Notification) {
        Notification.requestPermission().then((permission) => {
            if (Notification.permission === "granted") {
                var notification = new Notification(title, {
                    body: message,
                    tag: "empty",
                });

                if (notifications[id]) {
                    notifications[id].close();
                    /* notifications[id]["audio"].stop(); */
                }

                /* let src = 'https://file-examples.com/wp-content/uploads/2017/11/file_example_MP3_700KB.mp3';

                notifications[id] = notification;
                notifications[id]["audio"] = new Audio(src);
                notifications[id]["audio"].play(); */

                notification.onclick = function () {
                    console.log("hola");
                };

                setTimeout(function () {
                    //Animation on close here
                    notification.close();
                }, timeout);
            }
        });
    } else {
        alert(message);
    }
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

function writeInElement(element, phrase, intervalTime = 25) {
    phrase = phrase.replace(/\ +/, " ");
    var phraseLen = phrase.length;
    element.text("");
    for (let phraseIndex = 0; phraseIndex < phraseLen; phraseIndex++) {
        const currentChar = phrase[phraseIndex];
        setTimeout(() => {
            element.text(element.first().text() + currentChar);
        }, intervalTime * phraseIndex);
    }
}