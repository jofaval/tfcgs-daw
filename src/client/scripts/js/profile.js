$("#searchUserProfileForm").on("submit", function (event) {
    var event = event || event;
    event.preventDefault();

    var username = $("#username").val();
    $.ajax({
        url: EXECUTION_HOME_PATH + "index.php?ctl=doesUsernameExists/",
        data: {
            "username": username,
        },
        success: function (exist) {
            if (exist !== false) {
                window.location.href = `${EXECUTION_HOME_PATH}profile/${username}/`;
            } else {
                sendNotification("No se ha encontrado ese usuario", "usernameDoesNotExist")
            }
        }
    });

    return false;
});

var userSearch = new UserSearchInput($(".searchUserProfileContainer"));

function goToProfile(username) {
    $.ajax({
        url: EXECUTION_HOME_PATH + "index.php?ctl=doesUsernameExists",
        data: {
            "username": username,
        },
        success: function (exist) {
            if (exist !== false) {
                userSearch.input.val("");
                window.location.href = `${EXECUTION_HOME_PATH}profile/${username}/`;
            } else {
                sendNotification("No se ha encontrado ese usuario", "usernameDoesNotExist")
            }
        }
    });
}

userSearch.whenBtnSearchClicked = function () {
    var username = userSearch.currentUsername;
    goToProfile(username);
}

userSearch.whenUserCardClicked = function (usernameClicked) {
    goToProfile(usernameClicked);
}