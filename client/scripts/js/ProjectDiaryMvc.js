$(".summernoteContainer").on("keypress", function () {
    generateNavigationScheme();
});

var navigationScheme = $(".pushMenu .content");

$(".note-editable.card-block").append("<h1>Test 1656</h1>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h1>Test 552</h1>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h2>subtitle</h2>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h3>ewgewhweh</h3>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h3>trjyuykt</h3>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h3>weyweywey45yh5r</h3>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h4>jeggwef</h4>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h5>yjk67kj67</h5>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h1>Test 12</h1>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h1>subtitle 2</h1>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h2>subtitle</h2>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h3>ewgewhweh</h3>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h3>trjyuykt</h3>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h3>weyweywey45yh5r</h3>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h4>jeggwef</h4>");
$(".note-editable.card-block").append("<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>");
$(".note-editable.card-block").append("<h1>Test 1564156</h1>");

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
    var summernoteContentContainer = $(".note-editable.card-block");
    var summernoteContent = summernoteContentContainer.html();
    console.log(summernoteContent);

    var content = $(summernoteContent);

    var encodedContent = encodeURI(summernoteContent);
    var decodedContent = decodeURI(encodedContent);
    console.log("content", typeof summernoteContent, summernoteContent, "\nencoded", encodedContent, "\ndecoded", decodedContent);

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
                `<a class="py-2 navigationElement" style="padding-left: ${indentationLevel * 0.5}em" href="#${trueLevel}">
                        ${trueLevel} ${newTitle}
                    </a>`));
            current.prop("id", trueLevel);
            if (current.find(".level").length == 0) {
                current.prepend(`<span class="level">${trueLevel}</span> `);
            }
        }
        summernoteContentContainer.append(current);
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