/* document.querySelector("#menuDisplay").addEventListener("click", function () {
    if (this.checked) {
        this.previousElementSibling.classList.remove("toggledMenuDispaly");
        this.classList.remove("toggledMenuDispaly");
    } else {
        this.previousElementSibling.classList.add("toggledMenuDispaly");
        this.classList.add("toggledMenuDispaly");
    }
});
document.querySelector("#menuDisplay").click();
document.querySelector("#menuDisplay").click();

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
} */

/* var pageIndexFromLocalStorage = localStorage.getItem("pageIndex");
var selectedPageIndex = pageIndexFromLocalStorage;
if (pageIndexFromLocalStorage === null) { */
selectedPageIndex = 1;
//}

window.onwheel = function () {
    return false;
}
$(window).on("keyup", function (event) {
    var event = event || window.event;
    var keyCode = event.keyCode;
    console.log(keyCode);

    var valueToAdd = null;
    var changePage = false;

    switch (keyCode) {
        case 37:
            if (selectedPageIndex > 1) {
                valueToAdd = -1;
                changePage = true;
            }
            break;
        case 39:
            if (selectedPageIndex < 5) {
                valueToAdd = 1;
                changePage = true;
            }
            break;
    }

    if (changePage) {
        if (valueToAdd !== null) {
            selectedPageIndex += valueToAdd;
            //var pageIndexFromLocalStorage = localStorage.setItem("pageIndex", selectedPageIndex);
        }
    }

    changeURL(`/daw/client/about/#page${selectedPageIndex}`);

    $(".page.active").removeClass("active");
    $(`.page${selectedPageIndex}`).addClass("active").get(0).scrollIntoView({
        behavior: "smooth",
        block: 'nearest',
        inline: 'start'
    });
})