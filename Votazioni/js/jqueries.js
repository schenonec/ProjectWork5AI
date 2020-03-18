$("a.proposeVot").click(function () {
   /* if ($('p.proposeVot').length)
        $("p.proposeVot").show();
    else {
        $("body").append("<p class='links proposeVot'>Ora propongo una votazione eh!</p>");
        $("p.proposeVot").show();
    }*/
});

$("[type='number']").keypress(function (evt) {
    evt.preventDefault();
});
