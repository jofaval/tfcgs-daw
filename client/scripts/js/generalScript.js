let vw;
let vh;

$(window).on("load", function () {
    $(document.body).removeClass("text-light");
    $(document.body).addClass("text-dark");
    $(".hiddendiv.common").remove();

    $("main").addClass("scrollOnTop");

    var oldScroll = 0;

    $("main").on("scroll", function () {
        var $main = $(this);
        var scroll = $main.scrollTop();
        var maxScrollHeight = $main.innerHeight();
        var height = $main.get(0).scrollHeight;
        //console.log(scroll, scroll + maxScrollHeight, height, (scroll + maxScrollHeight) == height);

        if (scroll == 0) {
            $main.addClass("scrollOnTop");
            $main.removeClass("scrollOnBottom");
        } else if (scroll + maxScrollHeight == height) {
            $main.addClass("scrollOnBottom");
            $main.removeClass("scrollOnTop");
        } else {
            $main.removeClass("scrollOnTop");
            $main.removeClass("scrollOnBottom");
        }

        if (scroll > oldScroll) {
            $main.removeClass("scrollingUp");
            $main.addClass("scrollingDown");
        } else {
            $main.addClass("scrollingUp");
            $main.removeClass("scrollingDown");
        }
    });

    $("#backToTop").on("click", function (event) {
        var event = event || window.event;
        event.preventDefault();

        $("main, body").scrollTop(0);
    });

    vw = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    vh = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
});