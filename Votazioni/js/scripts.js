function hidShow(admin, user) {
    var amministratore = document.getElementsByClassName("amministratore");
    var utente = document.getElementsByClassName("utente");
    for (var i = 0; i < amministratore.length; i++)
        amministratore[i].style.display = admin;
    for (var i = 0; i < utente.length; i++)
        utente[i].style.display = user;
}

function showLink(class_, id) {
    var hide = document.getElementsByClassName(class_);
    for (var i = 0; i < hide.length; i++)
        hide[i].style.display = "none";
    document.getElementById(id).style.display = "block";
}

function openForm() {
    document.getElementById("myForm").style.display = "block";
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}




