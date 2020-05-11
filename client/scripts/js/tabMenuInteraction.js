var tabIndicator = $(".tab-active-indicator");
var tabIndicatorRadius = tabIndicator.width();
console.log(tabIndicatorRadius);

/* $(".tabs .tab").on("mousemove", function (event) {
    var event = event || window.event;
    var mouseX = event.clientX;
    var mouseY = event.clientY;

    tabIndicator.css({
        "top": mouseY - (tabIndicatorRadius / 2),
        "left": mouseX - (tabIndicatorRadius / 2),
    });

    console.log("test");
}); */
$(".tabs .tab").hover(function () {
    tabIndicator.appendTo(`#${$(this).prop("id")}`).show('slow');
}, function () {
    tabIndicator.appendTo('.tabs .tab.active').show('slow');
});