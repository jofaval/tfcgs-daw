var summernote = $('#summernote').summernote({
    lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
    disableDragAndDrop: true,
    height: 400,
    codeviewFilter: false,
    codeviewIframeFilter: true,
    tabDisable: true,
    placeholder: '',
    enable: false,
    codemirror: { // codemirror options
        theme: 'monokai'
    },
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['fontname', ['fontname', 'fontsize', 'fontsizeunit']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']],
    ],
    oninit: function () {
        console.log("test");
    }
});

$("div.note-editor button[data-event='codeview']").click();
$('#summernote').summernote('codeview.toggle');