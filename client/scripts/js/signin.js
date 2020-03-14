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
    $("#loginPanel").removeClass("d-flex");
    $("#loginPanel").hide();

    $("#registerPanel").addClass("d-flex");
    $("#registerPanel").show();

    $("#registerForm").find("*").stop().animate({
        opacity: "0",
    }, fadeAnimationDuration);
    $("#loginForm").find("*").stop().animate({
        opacity: "1",
    }, fadeAnimationDuration);

    $("#mainPanel").stop().animate({
        marginLeft: "-90%",
    }, panelAnimationDuration);

    setTimeout(() => {
        $("#mainPanel").stop().animate({
            marginLeft: "-95%",
        }, panelAnimationDuration * 1.3);
    }, panelAnimationDuration - (panelAnimationDuration * .3));

    writeInElement($("#registerPanel h2"), "Registration form", intervalTime);
    writeInElement($("#registerPanel p"), "I'm already signed up, take me to:", intervalTime / 2);
    writeInElement($("#registerPanel button"), "Login form", intervalTime);

    $("#mainPanel").css("transform", "scale(0.95) rotateY(" + perspectiveAngle + "deg)");
    $("#mainPanel").addClass("moveImage");
});

$("#registerPanel .btn").on("click", function () {
    $("#loginPanel").addClass("d-flex");
    $("#loginPanel").show();

    $("#registerPanel").removeClass("d-flex");
    $("#registerPanel").hide();

    $("#loginForm").find("*").stop().animate({
        opacity: "0",
    }, fadeAnimationDuration);
    $("#registerForm").find("*").stop().animate({
        opacity: "1",
    }, fadeAnimationDuration);

    $("#mainPanel").stop().animate({
        marginLeft: "-50%",
    }, panelAnimationDuration);

    setTimeout(() => {
        $("#mainPanel").stop().animate({
            marginLeft: "-45%",
        }, panelAnimationDuration * 1.3);
    }, panelAnimationDuration - (panelAnimationDuration * .3));

    writeInElement($("#loginPanel h2"), "Login form", intervalTime);
    writeInElement($("#loginPanel p"), "I'm not signed up, take me to:", intervalTime / 2);
    writeInElement($("#loginPanel button"), "Registration form", intervalTime);

    $("#mainPanel").css("transform", "scale(0.95) rotateY(-" + perspectiveAngle + "deg)");
    $("#mainPanel").removeClass("moveImage");
});

$("#registerPanel .btn").trigger("click");