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

    $("#registerForm").stop().animate({
        opacity: "0",
    }, fadeAnimationDuration);
    $("#loginForm").stop().animate({
        opacity: "1",
    }, fadeAnimationDuration);
});

$("#registerPanel .btn").on("click", function () {
    togglePanel($("#registerPanel"), $("#loginPanel"), true);

    $("#loginForm").stop().animate({
        opacity: "0",
    }, fadeAnimationDuration);
    $("#registerForm").stop().animate({
        opacity: "1",
    }, fadeAnimationDuration);
});

function togglePanel(toHide, toShow, toRight) {
    var panelInformationTextArray = [
        [
            "Formulario de registro",
            "Ya estoy registrado, llevame al:",
            "Formulario de inicio",
        ],
        [
            "Formulario de inicio",
            "No estoy registrado, llevame al:",
            "Formulario de registro",
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

    changeURL(`${EXECUTION_HOME_PATH}${toRight ? "signin" : "signup"}/`);

    writeInElement(toShow.find("h2"), panelInformationTextArray[textIndex][0], intervalTime);
    writeInElement(toShow.find("p"), panelInformationTextArray[textIndex][1], intervalTime / 2);
    writeInElement(toShow.find("button"), panelInformationTextArray[textIndex][2], intervalTime);
}

var url = window.location.href;
var positionOfLastBar = url.lastIndexOf("/");
var params = url.substring(positionOfLastBar);
var panelToActivate = params.includes("#login") ? "registerPanel" : "loginPanel";

$(`.formToLoad .btn`).trigger("click");

var isInLogin = $(".formToLoad").prop("id").includes("login");
$("#changeForm").on("click", function () {
    var current = $(this);

    current.stop().animate({
        left: isInLogin ? "50%" : "0%",
        right: isInLogin ? "0%" : "50%",
    });

    current.text(`Go to ${isInLogin ? "signin" : "signup"} form`);

    $(`#${isInLogin ? "loginForm" : "registerForm"}`).get(0).scrollIntoView({
        behavior: "smooth"
    });

    isInLogin = !isInLogin;
});
$("#changeForm").trigger("click");
$("#changeForm").trigger("click");
$("#changeForm").trigger("click");

var credentials = localStorage.getItem("signin-credentials");
if (credentials != null) {
    var credentialsJSON = JSON.parse(credentials);
    $("#rememberCredentials").prop("checked", true);
    $("#registerForm #username").val(credentialsJSON.username);
    $("#registerForm #password").val(credentialsJSON.password);
    $("#registerForm #password").focus();
    $("#registerForm #username").focus();
}

$("#registerForm").on("submit", function () {
    if ($("#rememberCredentials").is(":checked")) {
        localStorage.setItem("signin-credentials", JSON.stringify({
            username: $("#username").val(),
            password: $("#password").val(),
        }));
    } else {
        localStorage.removeItem("signin-credentials");
    }
});

var signupUsername = $("#loginForm #username");
var signupUsernameParent = signupUsername.parent();

var usernameExists = $(`<small id="usernameExist" class="font-weigh-bold float-right text-danger">El usuario existe</small>`)
whenUserDoneTypingInInput(signupUsername, "loginFormUsername", doesUsernameExist, 25);
doesUsernameExist();

function doesUsernameExist() {
    $.ajax({
        url: EXECUTION_HOME_PATH + "index.php?ctl=doesUsernameExists",
        data: {
            "username": signupUsername.val(),
        },
        success: function (result) {
            console.log(result);
            if (result === true) {
                if (signupUsernameParent.find("#usernameExist").length == 0) {
                    signupUsernameParent.removeClass("validate-green");
                    signupUsernameParent.addClass("validate-red");
                    signupUsernameParent.append(usernameExists);
                }
            } else {
                signupUsernameParent.addClass("validate-green");
                signupUsernameParent.removeClass("validate-red");
                signupUsernameParent.find("#usernameExist").remove();
            }
        }
    });
}

var signupEmail = $("#email");
var signupEmailParent = signupEmail.parent();

var emailExists = $(`<small id="emailExist" class="font-weigh-bold float-right text-danger">El email existe</small>`)
whenUserDoneTypingInInput(signupEmail, "loginFormUsername", doesEmailExist, 25);
doesEmailExist();

function doesEmailExist() {
    $.ajax({
        url: EXECUTION_HOME_PATH + "index.php?ctl=doesEmailExists",
        data: {
            "email": signupEmail.val(),
        },
        success: function (result) {
            console.log(result);
            if (result === true) {
                if (signupEmailParent.find("#emailExist").length == 0) {
                    signupEmailParent.removeClass("validate-green");
                    signupEmailParent.addClass("validate-red");
                    signupEmailParent.append(emailExists);
                }
            } else {
                signupEmailParent.addClass("validate-green");
                signupEmailParent.removeClass("validate-red");
                signupEmailParent.find("#emailExist").remove();
            }
        }
    });
}

var oldHorizontalScroll = 0;
$("main").scroll(function () {
    var newHorizontalScroll = $(this).scrollLeft();

    if (newHorizontalScroll > oldHorizontalScroll) {
        $("#loginForm").get(0).scrollIntoView({
            behavior: 'smooth',
            block: 'nearest',
            inline: 'start'
        });
    } else {
        $("#registerForm").get(0).scrollIntoView({
            behavior: 'smooth',
            block: 'nearest',
            inline: 'start'
        });
    }

    oldHorizontalScroll = newHorizontalScroll;
});

$("#btnToSignup").on("click", function (event) {
    var event = event || window.event;
    $("main").scrollLeft(5);
});
$("#btnToSignin").on("click", function (event) {
    var event = event || window.event;
    $("main").scrollLeft(5);
});