function getFormData(formId, asObject) {
    if (typeof asObject == 'boolean' && asObject) {
        var $form = $("#" + formId);
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i) {
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }

    var formData = new FormData();
    var input = $('#' + formId + ' input');
    var select = $('#' + formId + ' select');
    var textarea = $('#' + formId + ' textarea');
    var ignored = ['submit', 'button', 'reset'];
    var i, j, inputType, inputName, inputValue, file, files;

    for (i = 0; i < input.length; i++) {
        inputType = input[i].getAttribute('type');
        inputName = input[i].getAttribute('name');
        inputValue = input[i].value;

        if (ignored.indexOf(inputType) != -1) {
            continue;
        } else if (inputType == 'checkbox') {
            if (!input[i].checked) {
                inputValue = null;
            }
            formData.append(inputName, inputValue);
        } else if (inputType == 'radio') {
            inputValue = $('input[name="' + inputName + '"]:checked').val();
            formData.append(inputName, inputValue);
        } else if (inputType == 'file') {
            files = input[i].files;
            for (j = 0; j < files.length; j++) {
                file = files[j];
                formData.append(inputName, file, file.name);
            }
        } else {
            formData.append(inputName, inputValue);
        }
    }

    for (i = 0; i < select.length; i++) {
        inputName = select[i].getAttribute('name');
        inputValue = select[i].value;
        formData.append(inputName, inputValue);
    }

    for (i = 0; i < textarea.length; i++) {
        inputName = textarea[i].getAttribute('name');
        inputValue = textarea[i].value;
        formData.append(inputName, inputValue);
    }

    return formData;
}