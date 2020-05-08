//format number with certain number of 0
function minNumberOfDigits(number, numberOfDigits = 2) {
    return number.toLocaleString("es", {
        minimumIntegerDigits: numberOfDigits,
    });
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

$("#currentYear").html(new DateUtils(new Date()).printDateWithFormat("Y"));

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