$("#searchUserProfileForm").on("submit", function (event) {
    var event = event || event;
    event.preventDefault();

    var username = $("#username").val();
    $.ajax({
        url: "/daw/index.php?ctl=doesUsernameExists",
        data: {
            "username": username,
        },
        success: function (exist) {
            if (exist !== false) {
                window.location.href = `/daw/profile/${username}/`;
            } else {
                sendNotification("No se ha encontrado ese usuario", "usernameDoesNotExist")
            }
        }
    });

    return false;
});