$(document).ready(function () {
    $('#dtBasicExample').DataTable();
    var selectNumberofRows = $("select[name='dtBasicExample_length']");
    selectNumberofRows.html("");
    selectNumberofRows.append($(`<option value="5" selected="true">5</option>`))
        .trigger("change");
    for (let index = 2; index <= 5; index++) {
        selectNumberofRows.append($(`<option value="${5 * index}">${5 * index}</option>`))
            .trigger("change");
        //crear array con numeracion para los options
        //header order nocturno al principio
    }
    $('.dataTables_length').addClass('bs-select');
});