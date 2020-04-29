$("footer").addClass("z-index-overlap");

var toggled = true;

var pushMenuContainer = $("body");
var pushMenu = $(".pushMenu");

pushMenuContainer.before(pushMenu);
pushMenuContainer.prepend($(".pushMenuOverlap"));

$("main").toggleClass("flex-column flex-row");

$("#pushMenuToggleBtn, .pushMenu").on("click", function (event) {
    var event = event || window.event;
    //event.preventDefault();
    event.stopPropagation();

    showPushMenu();

    if (toggled) {
        hidePushMenu();
    }

    toggled = !toggled;
    $("#pushMenuToggleBtn").html(toggled ? "->" : "<-");

    console.log(toggled);

});

$(".pushMenuOverlap").on("click", function () {
    if (toggled) {
        hidePushMenu();
    }
});

pushMenuContainer.on("click", function (event) {
    var event = event || window.event;
    //event.preventDefault();
    //event.stopPropagation();

    if (toggled) {
        hidePushMenu();
        console.log(toggled);
    }
});

$(".pushMenu a").on("click", function (event) {
    var event = event || window.event;
    event.stopPropagation();
});

$(".pushMenu").trigger("click");

function hidePushMenu() {
    $(".pushMenuOverlap").stop().animate({
        backgroundColor: "rgba(0, 0, 0, 0)",
    }).addClass("click-through");

    pushMenuContainer.stop().animate({
        marginLeft: `-0.25em`,
    }, 350);

    pushMenu.stop().animate({
        marginLeft: `-${pushMenu.width()/16 + 2}em`,
    }, 350);
    $("#pushMenuToggleBtn").html(!toggled ? "->" : "<-");

    //toggled = false;
}

function showPushMenu() {
    $(".pushMenuOverlap").stop().animate({
        backgroundColor: "rgba(0, 0, 0, 0.2)",
    }).removeClass("click-through");

    pushMenuContainer.stop().animate({
        marginLeft: `${pushMenu.width()/16 + 2}em`,
    }, 750);

    pushMenu.stop().animate({
        marginLeft: "0px",
    }, 750);

    //toggled = true;
}