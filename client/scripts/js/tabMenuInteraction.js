var tabIndicator = $(".tab-active-indicator");
var tabIndicatorRadius = tabIndicator.width();

tabIndicator.css("margin-top", `-${tabIndicator.outerHeight()}px`);
console.log(tabIndicatorRadius);

var tabElements = $(".tabs .tab");
tabElements.hover(function () {
    onEnter($(this));
}, function () {
    onExit();
});
var activeElement = $(".tabs .tab.active");

function onEnter(currentTab) {
    tabIndicator.stop().animate({
        "width": currentTab.innerWidth(),
        "left": currentTab.offset().left - (currentTab.outerWidth() - currentTab.innerWidth()),
    }, 200);
    //tabIndicator.prependTo(`#${currentTab.prop("id")}`).show(400, 'swing', function () {});
}

function onExit() {
    tabIndicator.stop().animate({
        "width": activeElement.innerWidth(),
        "left": activeElement.offset().left - (activeElement.outerWidth() - activeElement.innerWidth()),
    }, 200);
    //tabIndicator.prependTo(`#${activeElement.prop("id")}`).show(400, 'swing', function () {});
}
onExit();

$(window).on("resize", function () {
    onExit();
});