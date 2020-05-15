var radius = 25;
var borderRadius = 100;
var opacity = 50;
var animationDuration = 250;
var animate = true;

$(window).on("load", function () {
    var cursor = $(`<div id="cursor"></div>`);
    cursor.css({
        background: "black",
        position: "absolute",
        width: `${radius}`,
        height: `${radius}`,
        borderRadius: `${borderRadius}%`,
        opacity: `${opacity}%`,
    });

    var body = $(document.body);

    body.append(cursor);
    body.addClass("waves-effect waves-light");
    $("*").css("cursor", "none");

    body.on("mousemove", function (event) {
        var event = event || window.event;

        var x = event.clientX - radius / 2;
        var y = event.clientY - radius / 2;

        //console.log("x", event.clientX, "y", event.clientY);

        cursor.css({
            top: `${y}px`,
            left: `${x}px`,
        });
    });

    body.on("click", function () {
        if (animate) {
            cursor.stop().animate({
                width: `${radius * .5}`,
                height: `${radius * .5}`,
            }, animationDuration / 3);

            setTimeout(function () {
                cursor.stop().animate({
                    width: `${radius * 1.75}`,
                    height: `${radius * 1.75}`,
                }, animationDuration / 2);

                setTimeout(function () {
                    cursor.stop().animate({
                        width: `${radius}`,
                        height: `${radius}`,
                    }, animationDuration / 8);
                }, animationDuration / 2);
            }, animationDuration / 3);
        }
    });
});