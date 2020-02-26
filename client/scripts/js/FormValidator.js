class FormValidator {
    //Validate forms using validation class
    validateForm(formName, form) {
        var value = false;

        switch (formName) {
            case "signup":
                value = this.validateSignUp(form);
                break;
        }

        return value;
    }

    validateSignUp(form) {
        var rules = [{
            "fieldName": "name",
            "rules": "noEmpty,name",
        }, ];
        var inputs = {
            "name": form.find("#inputName"),
        };

        return Validator.validate(rules, inputs);
    }
}