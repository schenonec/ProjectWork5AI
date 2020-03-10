function hidShow(admin, user) {
    var amministratore = document.getElementsByClassName("amministratore");
    var utente = document.getElementsByClassName("utente");
    for (var i = 0; i < amministratore.length; i++)
        amministratore[i].style.display = admin;
    for (var i = 0; i < utente.length; i++)
        utente[i].style.display = user;
}

function openForm() {
    document.getElementById("myForm").style.display = "block";
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}




