class UserSearchInput {
    constructor(container) {
        var userSearchClass = this;
        userSearchClass.htmlContent = $(`
        <div class="md-form input-group mb-4">
            <input type="text" class="form-control" name="searchUser" id="searchUser" placeholder="" aria-describedby="btnSearch">
            <label for="searchUser">Usuario</label>
            <div class="input-group-append">
                <span class="input-group-text md-addon btn btn-sm btn-primary" id="btnSearch">
                <span><i class="fa fa-search"></i></span>
                &nbsp;
                Buscar
                </span>
                </div>
            <div class="searchUserResult top-3 w-auto bg-white shadow rounded flex-column position-absolute p-3"></div>
        </div>
        `);

        userSearchClass.usernameCard = $(`
        <div class="usernameCard">
            <img src="" alt="" class="usernameProfileImg">
            <span class="font-weight-bold username"></span>
        </div>`);

        container.append(userSearchClass.htmlContent);

        userSearchClass.htmlContent.find("#searchUser")
            .focus().val("jofaval");

        userSearchClass.resultContainer = userSearchClass.htmlContent.find(".searchUserResult");
        userSearchClass.resultContainer.addClass("d-none");

        /* userSearchClass.resultContainer.hover(function () {
            userSearchClass.showResults(userSearchClass);
        }, function () {
            userSearchClass.resultContainer.addClass("d-none");
            userSearchClass.resultContainer.removeClass("d-flex");
        }); */

        userSearchClass.input = userSearchClass.htmlContent.find("input");
        whenUserDoneTypingInInput(userSearchClass.input, "searchUserInputInterval", function () {
            userSearchClass.whenUserKeyPressSearch(userSearchClass, userSearchClass.input, userSearchClass.resultContainer);
        }, 50);

        userSearchClass.htmlContent.find("#btnSearch").on("click", function (event) {
            var usernameToSearch = userSearchClass.input.val();
            userSearchClass.getUsersLike(usernameToSearch, function (result) {
                userSearchClass.whenUserSearchFinished(result, userSearchClass, userSearchClass.resultContainer);
            });
        });
    }

    showResults(userSearchClass) {
        userSearchClass.resultContainer.removeClass("d-none");
        userSearchClass.resultContainer.addClass("d-flex");
    }

    hideResults(userSearchClass) {
        userSearchClass.resultContainer.addClass("d-none");
        userSearchClass.resultContainer.removeClass("d-flex");
    }

    whenUserKeyPressSearch(userSearchClass, input, container) {
        userSearchClass.getUsersLike(input.val(), function (result) {
            userSearchClass.whenUserSearchFinished(result, userSearchClass, container);
        });
    }

    whenUserSearchFinished(result, userSearchClass, container) {
        if (result !== false) {
            console.log(result);
            userSearchClass.usernames = result;
            container.html("");
            userSearchClass.showResults(userSearchClass);
            result.forEach(usernameData => {
                userSearchClass.loadUser(userSearchClass, container, usernameData.username);
            });
            $(window).on("click", function () {
                userSearchClass.hideResults(userSearchClass);
                $(window).off("click");
            });
        }
    }

    getUsersLike(username, whenFinished) {
        $.ajax({
            url: "/daw/index.php?ctl=searchUsers",
            data: {
                "username": username,
            },
            success: function (result) {
                whenFinished(result);
            }
        })
    }

    loadUser(userSearchClass, container, username) {
        var usernameCardClone = userSearchClass.usernameCard.clone();

        usernameCardClone.find(".usernameProfileImg").prop("src", `/daw/profile/users/${username}/${username}.png`);
        usernameCardClone.find(".username").text(`@${username}`);
        usernameCardClone.on("click", function () {
            userSearchClass.input.val(username);
        });
        console.log(container);

        container.append(usernameCardClone);

        return usernameCardClone;
    }
}