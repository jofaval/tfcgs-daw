document.querySelector("#menuDisplay").addEventListener("click", function () {
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
}