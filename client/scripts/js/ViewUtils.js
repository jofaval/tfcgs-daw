var $formBase = $(`
<form action="" class="bg-white p-3 rounded shadow" method="POST">
</form>
`);

var $formInput = $(`
<div class="md-form col">
    <input type="" class="form-control" />
    <label for="" />
</div>
`);

var $formSubmit = $(`
<button class="btn btn-primary btn-block" type="submit"></button>
`);

var $formSelect = $(`
<div class="md-form col">
    <select class="browser-default custom-select"></select>
</div>
`);

var $formOption = $(`
<option></option>
`);

var $formTextArea = $(`
<div class="md-form col">
    <textarea class="md-textarea form-control"></textarea>
    <label for="" />
</div>
`);

var $formRow = $(`
<div class="form-row">
</div>`);

var $formTitle = $(`
<h1></h1>
`);

var $formCheckeable = $(`
<div class="custom-control">
    <input type="" class="custom-control-input">
    <label class="custom-control-label"></label>
</div>
`);

var $table = $(`<table class="table mb-0 w-100 table-dark table-bordered"></table>`);
var $thead = $(`<thead class="thead-dark"></thead>`);
var $tbody = $(`<tbody></tbody>`);
var $tr = $(`<tr></tr>`);
var $th = $(`<th></th>`);
var $td = $(`<td></td>`);

class ViewUtils {
    static createForm(container, action = "", method = "POST") {
        var clonedForm = $formBase.clone();

        clonedForm.prop("action", action);
        clonedForm.prop("method", method);
        container.append(clonedForm);

        return clonedForm;
    }

    static addInput(parent, id, type = "text", placeholder = "") {
        var clonedInput = $formInput.clone();

        var inputControl = clonedInput.find("input");
        inputControl.prop("type", type);
        inputControl.prop("placeholder", "");
        inputControl.prop("id", id);
        inputControl.prop("name", id);

        var label = inputControl.next();
        label.prop("for", id);
        label.text(placeholder);

        parent.append(clonedInput);

        return clonedInput;
    }

    static addSelect(parent, id) {
        var clonedInput = $formSelect.clone();

        clonedInput.prop("id", id);
        clonedInput.prop("name", id);

        parent.append(clonedInput);

        return clonedInput;
    }

    static addOptionToSelect(select, value, text) {
        var clonedOption = $formOption.clone();

        clonedOption.prop("value", value);
        clonedOption.text(text);

        select.find("select").append(clonedOption);

        return clonedOption;
    }

    static addFormTitle(form, title) {
        var clonedTitle = $formTitle.clone();

        clonedTitle.text(title);
        form.prepend(clonedTitle);

        return clonedTitle;
    }

    static addTextArea(parent, id, placeholder = "") {
        var clonedInput = $formTextArea.clone();

        var inputControl = clonedInput.find("textarea");
        inputControl.prop("placeholder", "");
        inputControl.prop("id", id);
        inputControl.prop("name", id);

        var label = inputControl.next();
        label.prop("for", id);
        label.text(placeholder);

        parent.append(clonedInput);

        return clonedInput;
    }

    static addFormRow(form) {
        var clonedRow = $formRow.clone();

        form.append(clonedRow);

        return clonedRow;
    }

    static addFormCheckboxRadio(parent, text, id, type = "checkbox") {
        var checkeable = $formCheckeable.clone();

        var input = checkeable.find("input");
        input.prop("type", type);
        input.prop("id", id);
        input.prop("name", id);

        var label = input.next();
        label.prop("for", id);
        label.text(text);

        parent.append(checkeable);

        return checkeable;
    }

    static addSubmit(form, text = "", id = "submit") {
        var submitInput = $formSubmit.clone();

        submitInput.prop("id", id);
        submitInput.prop("name", id);
        submitInput.text(text);

        form.append(submitInput);

        return submitInput;
    }

    static createTable(container) {
        var clonedTable = $table.clone();

        container.append(clonedTable);

        return clonedTable;
    }
    static createTableHeader(table) {
        var clonedTheader = $thead.clone();

        table.append(clonedTheader);

        return clonedTheader;
    }

    static createTableBody(table) {
        var clonedTbody = $tbody.clone();

        table.append(clonedTbody);

        return clonedTbody;
    }

    static createTableRow(parent) {
        var clonedTableRow = $tr.clone();

        parent.append(clonedTableRow);

        return clonedTableRow;
    }

    static createTableHead(row, content) {
        var clonedTheader = $th.clone();

        row.append(clonedTheader);
        clonedTheader.html(content);

        return clonedTheader;
    }

    static createTableData(row, content) {
        var clonedTdata = $td.clone();

        row.append(clonedTdata);
        clonedTdata.html(content);

        return clonedTdata;
    }
}