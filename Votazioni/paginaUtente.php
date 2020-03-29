<?php
	session_start();
?>
<html>
  <head>
  	<meta charset="utf-8">
    <title>Sito votazioni</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script type="text/javascript" src="js/jqueries.js"></script>   
  	<link rel="stylesheet" type="text/css" href="css/paginaUtente.css"/>
    <link rel="stylesheet" type="text/css" href="css/accesso.css"/>
  </head>

  <body class="container-fluid back text-center">
  	 <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <a class="navbar-brand" href="#">Sito votazioni</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Votazioni
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#" onclick="showLink('links','availableVot')">Votazioni disponibili</a>
              <a class="dropdown-item" href="#" onclick="showLink('links','endedVot')">Votazioni concluse</a>
              <a class="dropdown-item" href="#" onclick="showLink('links','currentVot')">Votazioni in corso</a>
              <div class="utente">
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" onclick="showLink('links','proposeVot')">Proponi votazione</a>
              </div>
              <div class="amministratore">
              	<div class="dropdown-divider"></div>
              	<a class="dropdown-item" href="#" onclick="showLink('links','createVot')">Crea votazione</a>
                <a id="openInvite" class="dropdown-item"  href="#">Invita nuovo utente</a>   
              </div>
            </div>
          </li>
          <li class="nav-item active amministratore">
            <a class="nav-link" href="#" onclick="showLink('links','showUser')">Utenti</a>
          </li>
        </ul>
      </div>
    </nav>
    <br><br><br>

    <div class="links" id="showUser">
      <?php 
      require_once("commonFunctions.php");
        $queryUtente=mysqli_query($db, "SELECT nome, cognome, email 
                                        FROM Utente");
        
        if($queryUtente)
          {?>
          <table class="table table-striped table-dark votTable">
            <tr>
              <th onclick="sortTable(0,0)">Nome<img src="css/arrows.png"></th>
              <th onclick="sortTable(1,0)">Cognome<img src="css/arrows.png"></th>
              <th onclick="sortTable(2,0)">Email<img src="css/arrows.png"></th>
            </tr>
          <?php
            for($row=mysqli_fetch_array(($queryUtente), MYSQLI_ASSOC);$row!=null;$row=mysqli_fetch_assoc($queryUtente))
              {
              ?>
              <tr>
                <td>
                <?php echo $row["nome"];?>
                </td>
                <td>
                <?php echo $row["cognome"];?>
                </td>
                <td>
                <?php echo $row["email"];?>
                </td>
              </tr>
              <?php
              }
              ?>
          </table>
        <?php
          }
         else
          echo "no";
        ?>


    </div> 
    <!--Form che permette di inserire i dati relativi alla creazione di una votazione-->
    <div class="links text-center exactCenter" id="createVot">
        <form method="POST" action="#">
            <div class="form-group">
              <label for="Titolo">Titolo:</label>
              <input type="text" class="form-control" id="Titolo" name="titolo" required>
            </div>
            <div class="form-group">
              <label for="Testo">Testo:</label>
              <textarea class="form-control" id="Testo" name="testo" rows="3" required></textarea>
            </div>
            <div class="form-group">
              <label for="percMin">Percentuale minima:</label>
              <input type="number" class="form-control" id="percMin" name="percenMin" min="0" max="100" step="5" onKeyDown="return false" required>
            </div>
            <div class="form-group">
                <label for="n_Opzioni">Numero opzioni:</label>
                <select class="custom-select custom-select-lg mb-3" id="n_Opzioni" name="nOpzioni">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
            </div>
            <div class="form-group">
                <label for="expire_Date">Data di scadenza:</label>
                <input class="form-control" type="datetime-local" id="expire_Date" name="expireDate" required>
            </div>
            <div class="form-group">
              <label for="Opzioni">Opzioni:</label>
              <textarea class="form-control" id="Opzioni" name="opzioni" rows="3" placeholder="opzione1;&#x0a;opzione2;&#x0a;...;" required></textarea>  
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="astensione_" name="astensione" value="true">
              <label class="custom-control-label" for="astensione_">Possibilitá di astensione</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="chiaro_" name="chiaro" value="true">
              <label class="custom-control-label" for="chiaro_">Voto in chiaro</label>
            </div>
            <br>
            <input class="btn btn-info" type="submit" name="votCreation" value="Crea votazione">
        </form>  
    </div>
    
    <!--Parte in cui viene creata la tabella con le votazioni disponibili a cui si puó partecipare-->
    <!--WORK IN PROGRESS-->
    <div class="links" id="availableVot">
        <input type="text" class="form-control searchInput" onkeyup="myFunction(0)" placeholder="Search for names..">
        <div style="overflow-x:auto;">
            <table class="table-info votTable">
              <tr class="header">
                    <th onclick="sortTable(0,0)">Titolo <img src="css/arrows.png"></th>
                    <th onclick="sortTable(1,0)">Scadenza <img src="css/arrows.png"></th>
                    <th onclick="sortTable(2,0)">Percentuale minima <img src="css/arrows.png"></th>
                    <th>Partecipa</th>
              </tr>
              <tr>
              <?php
              require_once("commonFunctions.php");
              $dateTime=date('Y-m-d H:i:s', time());
              $table=mysqli_query($db, "SELECT *
                            		    FROM quesito
                                        WHERE scadenza>'$dateTime'");
              if($table)
                {
                $row=mysqli_fetch_assoc($table);
                for(;$row!=null;$row=mysqli_fetch_assoc($table))
                    {
                    echo "<td>".$row["titolo"]."</td>";
                    echo "<td>".$row["scadenza"]."</td>";
                    echo "<td>".$row["percMinima"]."</td>";
                    ?>
                    <td>
                        <form class="prova" method="POST" action="#"><!--action="votazione.php"-->
                            <input type="hidden" name="choosenQ" value="<?php echo $row['testoQ']; ?>"/>
                            <input class="btn btn-success" type="submit" name="partecipa" value="Partecipa"/>
                        </form>
                    </td>
                    </tr><?php
                    }
                }
               else
                echo "Non sono disponibili nuove votazioni";
                 ?>
            </table>
        </div>
    </div>

    <p class="links" id="proposeVot">Ora propongo una votazione eh!</p>

    <!--Parte in cui viene creata la tabella con le votazioni concluse-->
    <!--WORK IN PROGRESS-->
    <div class="links" id="endedVot">
        <input type="text" class="form-control searchInput" onkeyup="myFunction(1)" placeholder="Cerca la votazione che ti interessa">
        <div style="overflow-x:auto;">
            <table class="table-info votTable">
              <tr class="header">
                    <th onclick="sortTable(0,1)">Titolo <img src="css/arrows.png"></th>
                    <th onclick="sortTable(1,1)">Scadenza <img src="css/arrows.png"></th>
                    <th onclick="sortTable(2,1)">Opzione vincente <img src="css/arrows.png"></th>
              </tr>
              <tr>
              <?php
              require_once("commonFunctions.php");
              $credenziali=$_SESSION["credenziali"];
              $CF=$credenziali["CF"];
              $dateTime=date('Y-m-d H:i:s', time());
              $table1=mysqli_query($db, "SELECT *
                             		     FROM Utente JOIN Amministratore 
                                       			     ON Utente.codice=Amministratore.codice AND CF='$CF'"); 
              $row1=mysqli_fetch_array($table1, MYSQLI_ASSOC);
              $table2;
              if($row1!==NULL)
                {
                $table2=mysqli_query($db, "SELECT *
                            		       FROM quesito
                                           WHERE scadenza<'$dateTime'");
                }
               else
                {
                $table2=mysqli_query($db, "SELECT *
                            		       FROM quesito JOIN partecipa
                                                        ON partecipa.CF='$CF' AND  
                                                           quesito.testoQ=partecipa.testoQ AND 
                                                           scadenza<'$dateTime'");
                }
              if($table2)
                {
                $row2=mysqli_fetch_assoc($table2);
                for(;$row2!=null;$row2=mysqli_fetch_assoc($table2))
                    {
                    echo "<td>".$row2["titolo"]."</td>";
                    echo "<td>".$row2["scadenza"]."</td>";
                    echo "<td>"."<i>opzione vincente</i>"."</td>";
                    ?>
                    </tr><?php
                    }
                }
               else
                echo "Non sono disponibili votazioni concluse";
                 ?>
            </table>
        </div>
    </div>

    <p class="links" id="currentVot">Votazioni in corso</p>

    <!--Form che permette di invitare nuovi utenti tramite l'inserimento del loro indirizzo email-->
    <div class="form-popup" id="myForm">
        <form action="#" method="POST" class="form-container">
            <p>Inserisci l'email dell'utente che vuoi invitare e gli verrá inviata un'email con tutte le istruzioni per poter partecipare</p>
            <div class="form-group">
              <label for="Email">Email:</label>
              <input type="email" class="form-control" id="Email" name="email" placeholder="Inserisci email" required>
            </div>
            <button type="submit" name="inviaEmail" class="btn">Invia</button>
            <button type="submit" id="closeInvite" class="btn cancel">Chiudi</button>
        </form>
    </div>    
      
    <?php
        require_once("commonFunctions.php");

        /*Codice che controlla le controlla le credenziali inserite, se l'utente é amministratore ecc*/
    	if(isset($_SESSION["credenziali"]))
        	{
            $credenziali=$_SESSION["credenziali"];
            $CF=$credenziali["CF"];
            $password=$credenziali["password"];
            $table=mysqli_query($db, "SELECT nome, cognome
                            		  FROM Utente
                           		      WHERE CF='$CF' AND password='$password'"); 
            $row=mysqli_fetch_array($table, MYSQLI_ASSOC);  
            $nome=$row['nome'];
            $cognome=$row['cognome'];
            echo "<h1 class='col-sm links' style='display:block;'>Benvenuto/a $nome $cognome!";
            $table2=mysqli_query($db, "SELECT *
                             		   FROM Utente JOIN Amministratore 
                                       			   ON Utente.codice=Amministratore.codice AND CF='$CF'"); 
            $row2=mysqli_fetch_array($table2, MYSQLI_ASSOC);  
            if($row2!==NULL)
              {
        	  ?><script>hidShow('block', 'none');</script><?php
              }
             else
              {
        	  ?><script>hidShow('none', 'block');</script><?php
              }
            }
           else
            header("Location:accesso.php");

        /*Codice che permette di inviare l'email d'invito*/
        if(isset($_POST["inviaEmail"]))
            {
            $email=$_POST["email"];
            $characters= '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $codice=substr(str_shuffle($characters),0, 10);
            $table=mysqli_query($db, "INSERT INTO Utente (codice)
                                      VALUES ('$codice')");
            $subject='Invito a ProjectWork5AI';
            $message="Sei stato invitato a partecipare alla piattaforma di votazioni ProjectWork5AI, inserisci il codice $codice nella pagina di registrazione per poter iniziare a votare!
                      Il link al sito é il seguente:  https://projectwork5ai.altervista.org/votazioni/home.php";
            $headers='From: ProjectWork5AInoreply @ company . com';
            mail($email,$subject,$message,$headers);
            }

        /*codice che permette di inserire i dati relativi ad una votazione nel db*/        
        if(isset($_POST["votCreation"]))
            {
            require_once("commonFunctions.php");
            $titolo=$_POST["titolo"];
            $testo=$_POST["testo"];
            $percMin=$_POST["percenMin"];
            $nOp=$_POST["nOpzioni"];
            $expDate=$_POST["expireDate"];
            $opzioni=$_POST["opzioni"];
            if(isset($_POST["astensione"]))
                $ast=true;
               else
                $ast=false;
            if(isset($_POST["chiaro"]))
                $votVisible=true;
               else
                $votVisible=false;
            $credenziali=$_SESSION["credenziali"];
            $CF=$credenziali["CF"];
            $codiceT= mysqli_query($db, "SELECT amministratore.codice
                                         FROM utente JOIN amministratore
                                                    ON utente.codice=amministratore.codice
                                         WHERE CF='$CF'");
            $codiceR=mysqli_fetch_array($codiceT);
            $codice=$codiceR[0];
            mysqli_query($db, "INSERT INTO crea(codice, testoQ)
                               VALUES('$codice', '$testo')");

            mysqli_query($db, "INSERT INTO quesito(testoQ, titolo, scadenza, percMinima, stato, astensione, votoChiaro)
                               VALUES('$testo', '$titolo' ,'$expDate', '$percMin', '1', '$ast', '$votVisible')");

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
            }
    ?> 
  </body>
</html>
