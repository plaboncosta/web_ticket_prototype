$("input[type='number']").keyup(function () {
    if ($(this).val() < 0) {
        $(this).val('');
    }
});

$("input[type='number']").change(function () {
    if ($(this).val() < 0) {
        $(this).val('');
    }
});