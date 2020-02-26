class Validator {
    //Given input, rules pairs validates their content
    static validate(validationParams, inputs) {
        if (!Array.isArray(validationParams)) {
            return false;
        }
        validationParams.forEach(validationInfo => {
            var currentInput = inputs[validationInfo["fieldName"]];
            var currentInputVal = currentInput.val();
            var rulesToExecute = validationInfo["rules"].split(",");

            rulesToExecute.array.forEach(validationRule => {
                if (window["Validator"][validationRule](currentInputVal)) {
                    currentInput.removeClass("error");
                } else {
                    currentInput.addClass("error");
                    return false;
                }
            });
        });

        return true;
    }

    static noEmpty(valor) {
        return valor.toString().length != 0;
    }

    static numeric(valor) {
        return isNaN(valor);
    }

    static email(valor) {
        return /^[a-z]+([\.]?[a-z0-9\_\-]+)*@iesabastos\.org$/.test(valor);
    }

    static datetime(valor) {
        return /^\d\d\d\d-(0?[1-9]|1[0-2])-(0?[1-9]|[12][0-9]|3[01]) (00|[0-9]|1[0-9]|2[0-3]):([0-9]|[0-5][0-9]):([0-9]|[0-5][0-9])$/.test(valor);
    }

    static date(valor) {
        return /^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/.test(valor);
    }

    static name(valor) {
        return /^[a-zñºª ]+$/iu.test(valor);
    }

    static password(valor) {
        return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,24}$/i.test(valor);
    }

    static state(valor) {
        return ["perfect", "on_repair", "left_out"].includes(valor);
    }

    static text(valor) {
        return /^[a-zñ ]*$/iu.test(valor);
    }

    static username(valor) {
        return /^[a-z0-9\_\-]{3,24}$/i.test(valor);
    }

    static image(valor) {
        return /^.+[\.jpg|\.jpeg|\.png|\.gif]$/i.test(valor);
    }
}