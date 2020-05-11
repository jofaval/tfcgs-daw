var tabIndicator = $(".tabActiveIndicator");
var tabIndicatorRadius = tabIndicator.width();

tabIndicator.css("margin-top", `-${tabIndicator.outerHeight()}px`);
console.log(tabIndicatorRadius);

var tabElements = $(".tabs .tab");
tabElements.hover(function () {
    onEnter($(this));
}, function () {
    onExit($(this));
});
var activeElement = $(".tabs .tab.active");
onEnter(activeElement);
activeElement.blur();

function onEnter(currentTab) {
    activeElement.removeClass("text-primary");
    currentTab.addClass("text-primary");
    tabIndicator.stop().animate({
        "width": currentTab.innerWidth(),
        "left": currentTab.offset().left - (currentTab.outerWidth() - currentTab.innerWidth()),
    }, 200);
    //tabIndicator.prependTo(`#${currentTab.prop("id")}`).show(400, 'swing', function () {});
}

function onExit(currentTab) {
    currentTab.removeClass("text-primary");
    activeElement.addClass("text-primary");
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