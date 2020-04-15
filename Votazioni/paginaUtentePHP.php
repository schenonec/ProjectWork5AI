<!--Work in progress-->
<?php
session_start();
require_once("commonFunctions.php");

/*Codice che permette di inviare l'email d'invito*/
if(isset($_POST["inviaEmail"]))
    {
    $email=$_POST["email"];
    $characters= '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $codice=substr(str_shuffle($characters),0, 10);

    $utenti=mysqli_query($db, "SELECT *
                               FROM utente
                               WHERE email='$email'");
            
    $utentiR=mysqli_fetch_array($utenti);
            
    if($utentiR==NULL)
        {
        mysqli_query($db, "INSERT INTO Utente (codice)
                           VALUES ('$codice')");

        $subject='Invito a ProjectWork5AI';
        $message="Sei stato invitato a partecipare alla piattaforma di votazioni ProjectWork5AI, inserisci il codice $codice nella pagina di registrazione per poter iniziare a votare!
                    Il link al sito é il seguente:  https://projectwork5ai.altervista.org/votazioni/home.php";
        $headers='From: ProjectWork5AInoreply @ company . com';
        mail($email,$subject,$message,$headers);
        }

    header("Location: paginaUtente.php");
    }

/*codice che permette di inserire i dati relativi ad una votazione nel db*/        
if(isset($_POST["votCreation"]))
    {
    $titolo=$_POST["titolo"];
    $testo=$_POST["testo"];
    $percMin=$_POST["percenMin"];
    $nOp=$_POST["nOpzioni"];
    $expDate=$_POST["expireDate"];
    $opzioni=$_POST["opzioni"];
    $credenziali=$_SESSION["credenziali"];
    $CF=$credenziali["CF"];
    $state="in_corso";

    if(isset($_POST["astensione"]))
        $ast=true;
       else
        $ast=false;

    if(isset($_POST["chiaro"]))
        $votVisible=true;
       else
        $votVisible=false;

    $codiceT=mysqli_query($db, "SELECT amministratore.codice
                                FROM utente JOIN amministratore
                                            ON utente.codice=amministratore.codice
                                WHERE CF='$CF'");

    $codiceR=mysqli_fetch_array($codiceT);
    $codice=$codiceR[0];

    mysqli_query($db, "INSERT INTO crea(codice, testoQ)
                       VALUES('$codice', '$testo')");

    mysqli_query($db, "INSERT INTO quesito(testoQ, titolo, scadenza, percMinima, stato, astensione, votoChiaro)
                        VALUES('$testo', '$titolo' ,'$expDate', '$percMin', '$state', '$ast', '$votVisible')");


    $utentiT=mysqli_query($db, "SELECT codice
                                FROM utente");

    for($utentiR=mysqli_fetch_assoc($utentiT);$utentiR!=NULL;$utentiR=mysqli_fetch_assoc($utentiT))
        {
        $codice=$utentiR['codice'];
        mysqli_query($db, "INSERT INTO partecipa(codice, testoQ)
                           VALUES('$codice', '$testo')");
        }
    
    for($i=0, $j=0;$i<strlen($opzioni);$i++)
        {
        if($opzioni{$i}==";")
            {
            $opzione=trim(substr($opzioni,$j, $i-$j));

            mysqli_query($db, "INSERT INTO risposta(testoR, testoQ)
                               VALUES('$opzione', '$testo')");                         
            $j=$i+1;
            }
        } 

    header("Location: paginaUtente.php");                
    }

if(isset($_POST["eraseAccount"]))
    {
        
    $codice=$_POST["choosenUser"];

    mysqli_query($db, "UPDATE utente
                       SET cancellato=1
                       WHERE codice='$codice'");
   
    header("Location: paginaUtente.php");
    }
?>