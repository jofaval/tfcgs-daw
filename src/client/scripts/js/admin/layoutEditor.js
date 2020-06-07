var summernote = $('#summernote').summernote({
    lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
    disableDragAndDrop: true,
    height: 800,
    codeviewFilter: true,
    codeviewIframeFilter: false,
    tabDisable: true,
    placeholder: '',
    enable: false,
    codemirror: { // codemirror options
        theme: 'monokai'
    },
    toolbar: [
        ['view', ['fullscreen', 'codeview', 'help']],
    ],
    oninit: function () {
        console.log("test");
    }
});
$themesheet.attr('href', themes['cyborg']);

$("div.note-editor button[data-event='codeview']").click();
$(".dropdown-toggle").click();
$('#summernote').summernote('codeview.toggle');
//$('#summernote .note-editable.card-block').text($('#summernote .note-editable.card-block').text().replace("?>", "<? <p></p>"))
/* var fileContentHTML = $(".fileContent").text();
fileContentHTML = fileContentHTML.replace("<?php", "");
fileContentHTML = fileContentHTML.replace("?>", "");
$('#summernote').summernote('pasteHTML', fileContentHTML); */