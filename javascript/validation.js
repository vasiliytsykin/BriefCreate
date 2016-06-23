$(document).ready(function () {

    $.validator.addClassRules("required", {
        required: true
    });

    $.validator.messages.required = "обязательное поле!";

    $("form").validate();
});
