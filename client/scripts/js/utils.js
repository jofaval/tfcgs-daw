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
                    icon: "/daw/img/branding/favicon-96x96.png",
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

function stringToDate(date) {
    var timestamp = Date.parse(date);

    if (!isNaN(timestamp)) {
        return new Date(timestamp);
    }

    return false;
}

$("#currentYear").html(printDateWithFormat(new Date(), "Y"));

//print date with certain fromat
function printDateWithFormat(givenDate, format = "d/m/Y") {
    format = format.replace("y", givenDate.getYear());
    format = format.replace("Y", givenDate.getFullYear());
    format = format = format.toLowerCase();
    format = format.replace("d", minNumberOfDigits(givenDate.getDate()));
    format = format.replace("m", minNumberOfDigits(givenDate.getMonth() + 1));

    format = format.replace("h", minNumberOfDigits(givenDate.getHours() + 1));
    format = format.replace("i", minNumberOfDigits(givenDate.getMinutes() + 1));
    format = format.replace("s", minNumberOfDigits(givenDate.getSeconds() + 1));
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

function redirectTo(url) {
    var a = document.createElement("a");
    document.body.appendChild(a);
    a.href = url;
    a.click();
}

function getTimeFromThisMoment(date, parseFromString = true) {
    if (parseFromString) {
        date = new Date(Date.parse(date));
    }
    var givenDate = date.getTime();

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