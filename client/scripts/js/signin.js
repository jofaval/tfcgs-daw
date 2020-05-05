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
        url: "/daw/index.php?ctl=doesUsernameExists",
        data: {
            "username": signupUsername.val(),
        },
        success: function (result) {
            console.log(result);
            if (result === true) {
                if (signupUsernameParent.find("#usernameExist").length == 0) {
                    signupUsernameParent.append(usernameExists);
                }
            } else {
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
        url: "/daw/index.php?ctl=doesEmailExists",
        data: {
            "email": signupEmail.val(),
        },
        success: function (result) {
            console.log(result);
            if (result === true) {
                if (signupEmailParent.find("#emailExist").length == 0) {
                    signupEmailParent.append(emailExists);
                }
            } else {
                signupEmailParent.find("#emailExist").remove();
            }
        }
    });
}