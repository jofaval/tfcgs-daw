$("footer").addClass("z-index-overlap-top");

var toggled = true;

var pushMenuContainer = $("#content");
var pushMenu = $(".pushMenu");

pushMenuContainer.before(pushMenu);
pushMenuContainer.prepend($(".pushMenuOverlap"));

$("main").toggleClass("flex-column flex-row");

$("#pushMenuToggleBtn, .pushMenu").on("click", function (event) {
    var event = event || window.event;
    event.preventDefault();
    event.stopPropagation();

    showPushMenu();

    if (toggled) {
        hidePushMenu();
    }
    $("#pushMenuToggleBtn").html(toggled ? "->" : "<-");

    console.log(toggled);

    toggled = !toggled;
});

$(".pushMenu a").on("click", function (event) {
    var event = event || window.event;
    event.stopPropagation();
});

$("#pushMenuToggleBtn").trigger("click");

pushMenuContainer.on("click", function (event) {
    var event = event || window.event;
    event.preventDefault();
    event.stopPropagation();

    if (toggled) {
        $("#pushMenuToggleBtn").trigger("click");
    }

    console.log(toggled);

    toggled = false;

});

function hidePushMenu() {
    $(".pushMenuOverlap").stop().animate({
        backgroundColor: "rgba(0, 0, 0, 0)",
    }).css("pointer-events", "all");

    pushMenu.stop().animate({
        marginLeft: `-${pushMenu.width()}px`,
    }, 200);
    $("#pushMenuToggleBtn").html(!toggled ? "->" : "<-");
}

function showPushMenu() {
    $(".pushMenuOverlap").stop().animate({
        backgroundColor: "rgba(0, 0, 0, 0.2)",
    }).css("pointer-events", "none");

    pushMenu.stop().animate({
        marginLeft: "0px",
    }, 200);
}