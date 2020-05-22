if (localStorage.getItem("interval") === null) {
    localStorage.setItem("interval", 0);
}

$(document).ready(function () {
    //Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        localStorage.setItem("interval", 0);
    });
    $(this).keypress(function (e) {
        localStorage.setItem("interval", 0);
    });
    $(this).on("touchstart", function (e) {
        localStorage.setItem("interval", 0);
    });
});

function timerIncrement() {
    localStorage.setItem("interval", parseInt(localStorage.getItem("interval")) + 1);
    if (parseInt(localStorage.getItem("interval")) > 15) { // 15 minutes
        window.location.href = EXECUTION_HOME_PATH + "signout/";
    }
}