class UserSearchInput {
    constructor(container) {
        var userSearchClass = this;
        userSearchClass.htmlContent = $(`
        <div class="md-form input-group mb-4">
            <input type="text" class="form-control" autocomplete="off"
            name="searchUser" id="searchUser" placeholder=""
            aria-describedby="btnSearch">
            <label for="searchUser">Usuario</label>
            <div class="input-group-append">
                <span class="input-group-text md-addon btn btn-sm btn-primary" id="btnSearch">
                <span><i class="fa fa-search"></i></span>
                &nbsp;
                Buscar
                </span>
                </div>
            <div class="searchUserResult top-3 w-auto z-index-overlap-top bg-white shadow rounded flex-column position-absolute p-3"></div>
        </div>
        `);

        userSearchClass.selectedUsernameCardClasses = "selected grey lighten-3";

        userSearchClass.whenBtnSearchClicked = function () {};
        userSearchClass.whenUserCardClicked = function () {};

        userSearchClass.usernameCard = $(`
        <div class="usernameCard p my-1 p-1 text-dark cursor-pointer">
            <img src="" width="25" height="25" alt="" class="usernameProfileImg rounded-circle">
            @<span class="font-weight-bold username"></span>
        </div>`);

        container.append(userSearchClass.htmlContent);

        /* userSearchClass.htmlContent.find("#searchUser")
            .focus().val("jofaval"); */

        userSearchClass.resultContainer = userSearchClass.htmlContent.find(".searchUserResult");
        userSearchClass.resultContainer.addClass("d-none");

        /* userSearchClass.resultContainer.hover(function () {
            userSearchClass.showResults(userSearchClass);
        }, function () {
            userSearchClass.resultContainer.addClass("d-none");
            userSearchClass.resultContainer.removeClass("d-flex");
        }); */

        userSearchClass.input = userSearchClass.htmlContent.find("input");
        userSearchClass.input.on("keyup", function (event) {
            var event = event || window.event;
            var keyPressCode = event.keyCode;
            console.log(event.keyCode);

            var selected = userSearchClass.resultContainer
                .find(".selected");

            var newSelected = null;

            switch (keyPressCode) {
                case 40:
                    newSelected = selected.next();
                    break;
                case 38:
                    newSelected = selected.prev();
                    break;
                case 32:
                    var serachVal = userSearchClass.input.val();
                    userSearchClass.input.val(serachVal.substr(0, serachVal.length - 2));
                case 13:
                case 18:
                case 9:
                    selected.trigger("click");
                    return;
                    break;

                default:
                    return;
                    break;
            }

            if (newSelected != null && newSelected.length == 1) {
                selected.removeClass(userSearchClass.selectedUsernameCardClasses);
                newSelected.addClass(userSearchClass.selectedUsernameCardClasses);
            }
        })
        whenUserDoneTypingInInput(userSearchClass.input, "searchUserInputInterval", function (event) {
            var keyCode = event.keyCode;

            if ([38, 40, 13, 32, 18, 9].includes(keyCode)) {
                return;
            }

            userSearchClass.currentUsername = userSearchClass.input.val();
            userSearchClass.whenUserKeyPressSearch(userSearchClass, userSearchClass.input, userSearchClass.resultContainer);
        }, 50);

        userSearchClass.htmlContent.find("#btnSearch").on("click", function (event) {
            var usernameToSearch = userSearchClass.input.val();
            userSearchClass.currentUsername = usernameToSearch;
            userSearchClass.getUsersLike(usernameToSearch, function (result) {
                userSearchClass.whenUserSearchFinished(result, userSearchClass, userSearchClass.resultContainer);
                userSearchClass.whenBtnSearchClicked(event);
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
            //console.log(result);
            userSearchClass.usernames = result;
            container.html("");
            if (result.length > 0) {
                userSearchClass.showResults(userSearchClass);
            } else {
                userSearchClass.hideResults(userSearchClass);
            }
            result.forEach(usernameData => {
                userSearchClass.loadUser(userSearchClass, container, usernameData.username);
            });
            $(window).on("click", function () {
                userSearchClass.hideResults(userSearchClass);
                $(window).off("click");
            });

            userSearchClass.resultContainer.children().eq(0).addClass(userSearchClass.selectedUsernameCardClasses);
        }
    }

    getUsersLike(username, whenFinished) {
        $.ajax({
            url: EXECUTION_HOME_PATH + "index.php?ctl=searchUsers",
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

        usernameCardClone.find(".usernameProfileImg").prop("src", `${EXECUTION_HOME_PATH}img/users/${username}/${username}.png`);
        usernameCardClone.find(".username").text(`${username}`);
        usernameCardClone.on("click", function () {
            userSearchClass.input.val(username);
            userSearchClass.whenUserCardClicked(username);
            userSearchClass.hideResults(userSearchClass);
        });
        //console.log(container);

        container.append(usernameCardClone);

        return usernameCardClone;
    }
}