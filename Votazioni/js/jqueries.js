$(document).ready(function () {
    $("[type='number']").keypress(function (evt) {
        evt.preventDefault();
    });

    $("#openInvite").click(function () {
        $("#myForm").show();
    });

    $("#closeInvite").click(function () {
        $("#myForm").hide();
    });
});
