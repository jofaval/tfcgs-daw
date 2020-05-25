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
$(".tabs *").removeClass("text-dark text-white");
var activeElement = $(".tabs .tab.active");
$(".tabs .tab").addClass("text-dark");
setTimeout(() => {
    activeElement.trigger('mouseenter');
}, 250);

function onEnter(currentTab) {
    activeElement.removeClass("text-primary").addClass("text-dark");
    currentTab.addClass("text-primary").removeClass("text-dark");
    tabIndicator.stop().animate({
        "width": currentTab.innerWidth(),
        "left": currentTab.offset().left - (currentTab.outerWidth() - currentTab.innerWidth()),
    }, 200);
    //tabIndicator.prependTo(`#${currentTab.prop("id")}`).show(400, 'swing', function () {});
}

function onExit(currentTab) {
    currentTab.removeClass("text-primary").addClass("text-dark");
    activeElement.addClass("text-primary").removeClass("text-dark");
    tabIndicator.stop().animate({
        "width": activeElement.innerWidth(),
        "left": activeElement.offset().left - (activeElement.outerWidth() - activeElement.innerWidth()),
    }, 200);
    //tabIndicator.prependTo(`#${activeElement.prop("id")}`).show(400, 'swing', function () {});
}

$(window).on("resize", function () {
    onExit(activeElement);
});