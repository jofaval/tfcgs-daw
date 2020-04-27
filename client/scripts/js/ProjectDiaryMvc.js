$(".summernoteContainer").on("keypress", function () {
    generateNavigationScheme();
});

var navigationScheme = $(".pushMenu .content");

window.addEventListener('resize', function (event) {
    hidePushMenu();
    //showPushMenu();
});

function generateNavigationScheme() {
    navigationScheme.html("");
    var levels = {
        "H1": 0,
        "H2": 0,
        "H3": 0,
        "H4": 0,
        "H5": 0,
        "H6": 0,
    };
    var summernoteContent = $(".note-editable.card-block");
    var content = $(summernoteContent.html() + "");
    summernoteContent.html("");
    content.each(function () {
        var current = $(this);
        current.find(".level").remove();
        var indentationLevel = -1;
        var tagName = current.get(0).tagName;
        levels[tagName]++;
        if (current.is("h1, h2, h3, h4, h5, h6")) {

            indentationLevel += parseInt(tagName.replace("H", ""));
            levels
        }


        var title = current.text().trim();
        if (indentationLevel != -1) {
            var tagNameToResetIndex = indentationLevel + 2;
            while (tagNameToResetIndex <= 6) {
                levels["H" + tagNameToResetIndex] = 0;
                tagNameToResetIndex++;
            }

            var newTitle = title;
            if (newTitle.length > 15) {
                newTitle = newTitle.substring(0, 14);
            }

            var trueLevel = getTrueLevel(levels, indentationLevel);
            navigationScheme.append($(
                `<a style="padding-left: ${indentationLevel * 0.5}em" href="#${trueLevel}">
                        ${trueLevel} ${newTitle}
                    </a>`));
            current.prop("id", trueLevel);
            if (current.find(".level").length == 0) {
                current.prepend(`<span class="level">${trueLevel}</span> `);
            }
        }
        summernoteContent.append(current);
    });
};
generateNavigationScheme();

function getTrueLevel(levels, indentationLevel) {
    indentationLevel++;
    var string = "";

    while (indentationLevel >= 1) {
        string = `${levels["H" + indentationLevel]}.${string}`;
        indentationLevel--;
    }

    return string;
}