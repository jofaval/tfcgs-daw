$(".togglePassword").on("click", function (event) {
    var event = event || window.event;
    event.preventDefault();

    var togglePassword = $(this);

    var passwordInput = togglePassword.parent().prevAll("input");
    var isPassword = passwordInput.is(":password");
    passwordInput.prop("type", isPassword ? "text" : "password");

    togglePassword.find(".fa").removeClass(isPassword ? "fa-eye" : "fa-eye-slash");
    togglePassword.find(".fa").addClass(isPassword ? "fa-eye-slash" : "fa-eye");
});

var fadeAnimationDuration = 350;
var panelAnimationDuration = 350;
var perspectiveAngle = 15;
var intervalTime = 30;

$("#loginPanel .btn").on("click", function () {
    togglePanel($("#loginPanel"), $("#registerPanel"), false);

    $("#registerForm").find("*").stop().animate({
        opacity: "0",
    }, fadeAnimationDuration);
    $("#loginForm").find("*").stop().animate({
        opacity: "1",
    }, fadeAnimationDuration);
});

$("#registerPanel .btn").on("click", function () {
    togglePanel($("#registerPanel"), $("#loginPanel"), true);

    $("#loginForm").find("*").stop().animate({
        opacity: "0",
    }, fadeAnimationDuration);
    $("#registerForm").find("*").stop().animate({
        opacity: "1",
    }, fadeAnimationDuration);
});

$("#loginPanel .btn").trigger("click");

function togglePanel(toHide, toShow, toRight) {
    var panelInformationTextArray = [
        [
            "Registration form",
            "I'm already signed up, take me to:",
            "Login form",
        ],
        [
            "Login form",
            "I'm not signed up, take me to:",
            "Registration form",
        ],
    ];

    var marginLeftBeforeSteering;
    var marginLeftAfterSteering;
    var textIndex;

    var mainPanel = $("#mainPanel");
    var perspectivePositive = toRight ? "-" : " ";

    if (!toRight) {
        marginLeftBeforeSteering = "-90%";
        marginLeftAfterSteering = "-95%";
        textIndex = 0;
    } else {
        marginLeftBeforeSteering = "-50%";
        marginLeftAfterSteering = "-45%";
        textIndex = 1;
    }

    toHide.removeClass("d-flex");
    toHide.hide();

    toShow.addClass("d-flex");
    toShow.show();

    mainPanel.stop().animate({
        marginLeft: marginLeftBeforeSteering,
    }, panelAnimationDuration);

    setTimeout(() => {
        mainPanel.stop().animate({
            marginLeft: marginLeftAfterSteering,
        }, panelAnimationDuration * 1.3);
    }, panelAnimationDuration - (panelAnimationDuration * .3));

    mainPanel.css("transform", `scale(0.95) rotateY(${perspectivePositive}${perspectiveAngle}deg)`);

    if (toRight) {
        mainPanel.addClass("moveImage");
    } else {
        mainPanel.removeClass("moveImage");
    }

    writeInElement(toShow.find("h2"), panelInformationTextArray[textIndex][0], intervalTime);
    writeInElement(toShow.find("p"), panelInformationTextArray[textIndex][1], intervalTime / 2);
    writeInElement(toShow.find("button"), panelInformationTextArray[textIndex][2], intervalTime);
}