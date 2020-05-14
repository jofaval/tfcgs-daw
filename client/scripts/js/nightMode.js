var nightModeStatus = localStorage.getItem("nightMode");
if (nightModeStatus === null) {
    nightModeStatus = false;
    localStorage.setItem("nightMode", nightModeStatus);
}

$("#nightMode").on("click", function () {
    changeNightMode();
}).find(":checkbox").prop("checked", nightModeStatus);
changeNightMode();

var courtainEffect = false;

function changeNightMode() {
    var nightModeInput = $("#nightMode");
    var nightModeLabel = nightModeInput.next();

    nightModeStatus = nightModeInput.is(":checked");
    localStorage.setItem("nightMode", nightModeInput.is(":checked"));

    if (nightModeStatus) { //oscuro
        $("nav.navbar")
            .removeClass("bg-light").addClass("bg-transparent").removeClass("navbar-light").addClass("navbar-dark")
            .find(".nav-link:not(.btn)").removeClass("text-dark").addClass("text-white");
        $(".breadcrumb")
            .addClass("bg-transparent")
            .find("a:not(.text-muted)").addClass("text-white");
        $(".footer")
            .addClass("bg-transparent").removeClass("bg-light").addClass("text-white").removeClass("text-dark")
            .find("a").removeClass("text-dark").addClass("text-white");

        $(".tabContentContainer").removeClass("bg-light")
            .find(".bg-white").removeClass("bg-white").addClass("bg-dark");
        $(".tabContentContainer *:not(.dashboardCard)").addClass("text-white").removeClass("text-dark");

        $(".tabs").removeClass("bg-light")
            .find(".bg-white").removeClass("bg-white").addClass("bg-dark");
        $(".tabs *").addClass("text-white").removeClass("text-dark");

        $(".footer, .tabs").removeClass("bg-light grey lighten-4").addClass("bg-dark");

        $(".pagination *").removeClass("text-dark");
        $("select").removeClass("text-white").addClass("text-dark");

        THEME = DARK_THEME;
        //nightModeLabel.text("Modo oscuro");
    } else { //claro
        $("nav.navbar")
            .addClass("bg-light").removeClass("bg-transparent").removeClass("navbar-dark").addClass("navbar-light")
            .find(".nav-link:not(.btn)").addClass("text-dark").removeClass("text-white");
        $(".breadcrumb")
            .removeClass("bg-transparent")
            .find("a:not(.text-muted)").removeClass("text-white");
        $(".footer")
            .addClass("bg-light").removeClass("bg-transparent").removeClass("text-white").addClass("text-dark")
            .find("a").removeClass("text-white").addClass("text-dark");

        $(".tabContentContainer").addClass("bg-light")
            .find(".bg-dark").removeClass("bg-dark").addClass("bg-white");
        $(".tabContentContainer *:not(.dashboardCard)").addClass("text-dark").removeClass("text-white");

        $(".tabs").addClass("bg-light")
            .find(".bg-dark").removeClass("bg-dark").addClass("bg-white");
        $(".tabs *").addClass("text-dark").removeClass("text-white");

        $(".footer, .tabs").removeClass("bg-light bg-dark").addClass("grey lighten-4");

        $(".pagination *").addClass("text-dark");
        $("select").removeClass("text-white").addClass("text-dark");

        THEME = MIXED_THEME;
        //nightModeLabel.text("Modo claro");
    }

    if (courtainEffect) {
        $("body").removeClass("loaded");
        setTimeout(() => {
            $("body").addClass("loaded");
        }, 50);
    }
}