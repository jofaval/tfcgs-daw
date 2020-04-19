$(window).on("load", function () {
    $(document.body).removeClass("text-light");
    $(document.body).addClass("text-dark");
    $(".hiddendiv.common").remove();

    $("main").addClass("scrollOnTop");

    $("main").on("scroll", function () {
        var current = $(this);
        var scroll = current.scrollTop();
        var maxScrollHeight = current.innerHeight();
        var height = current.get(0).scrollHeight;
        //console.log(scroll, scroll + maxScrollHeight, height, (scroll + maxScrollHeight) == height);

        if (scroll == 0) {
            current.addClass("scrollOnTop");
            current.removeClass("scrollOnBottom");
        } else if (scroll + maxScrollHeight == height) {
            current.addClass("scrollOnBottom");
            current.removeClass("scrollOnTop");
        } else {
            current.removeClass("scrollOnTop");
            current.removeClass("scrollOnBottom");
        }
    });
});