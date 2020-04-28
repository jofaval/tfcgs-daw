/* $.ajax({
    url: 'https://api.github.com/emojis',
    async: false
}).then(function (data) {
    window.emojis = Object.keys(data);
    window.emojiUrls = data;
});; */

$('#summernote').summernote({
    lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
    disableDragAndDrop: true,
    codeviewFilter: false,
    codeviewIframeFilter: true,
    tabDisable: true,
    placeholder: 'Write here...',
    codemirror: { // codemirror options
        theme: 'monokai'
    },
    hint: [{
            mentions: ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com'],
            match: /@(\w*)$/,
            search: function (keyword, callback) {
                callback($.grep(this.mentions, function (item) {
                    return item.indexOf(keyword) == 0;
                }));
            },
            content: function (item) {
                return '@' + item;
            }
        },
        /* {
               match: /:([\-+\w]+)$/,
               search: function (keyword, callback) {
                   callback($.grep(emojis, function (item) {
                       return item.indexOf(keyword) === 0;
                   }));
               },
               template: function (item) {
                   var content = emojiUrls[item];
                   return '<img src="' + content + '" width="20" /> :' + item + ':';
               },
               content: function (item) {
                   var url = emojiUrls[item];
                   if (url) {
                       return $('<img />').attr('src', url).css('width', 20)[0];
                   }
                   return '';
               }
           } */
    ],
});
//$('#datepicker').datepicker();
$('#datepicker').focus();

$(".note-statusbar").on("touchmove", function (e) {
    var adjustment = (e.touches[0].clientY - 155) - $(this).position().top;

    $(".note-editable").height($(".note-editable").height() + adjustment);
});