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

var $formErrorContainer = $(`
<div class="errorContainer"></div>
`);

var $formErrorMessage = $(`
<small class="errorMessage font-weight-bold"></small>
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

    static addErrorToInput(input, id, errorMessage, regex) {
        var clonedError = $formErrorMessage.clone();
        clonedError.text(errorMessage);
        clonedError.addClass(id);

        var errorContainer = input.find(".errorContainer");
        if (errorContainer.length == 0) {
            errorContainer = $formErrorContainer.clone();
            input.append(errorContainer);
        }

        var inputElement = input.find("input, textarea");
        whenUserDoneTypingInInput(inputElement, inputElement.prop("id"), function () {
            var value = inputElement.val();

            var errorMessageInErrorContainer = errorContainer.find(`.${id}`);
            console.log("\"Regex: \"", regex, "\"Id:\"", id, "\"Error container: \"", errorContainer);
            if (regex.test(value)) {
                if (errorMessageInErrorContainer.length == 0) {
                    errorContainer.append(clonedError);
                    console.log("no existe previamente");
                }

                console.log("al final", regex.test(value));

            } else {
                errorMessageInErrorContainer.remove();
            }
        });

        return clonedError;
    }

    static addLenErrorToInput(input, fieldName, minLen, maxLen) {
        ViewUtils.addErrorToInput(input, "minLen", `${fieldName} is too short!`, new RegExp(`^(.){0,${minLen}}$`, "gi"));
        ViewUtils.addErrorToInput(input, "maxLen", `${fieldName} is too long!`, new RegExp(`^(.){${maxLen + 1},999999999}$`, "gi"));
        var inputElement = input.find("input, textarea");
        inputElement.prop("min", minLen);
        inputElement.prop("max", maxLen);
        inputElement.prop("maxlength", maxLen);
    }

    removePhpErrorMessages(input, className = "php", event = "keydown") {
        input.find("input, textarea").on(event, removePhpMessages);

        function removePhpMessages() {
            input.find(`.${className}`).remove();
            input.unbind(event, removePhpMessages);
        }
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
        form.children().first().prepend(clonedTitle);

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