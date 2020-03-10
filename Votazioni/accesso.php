<?php
	session_start();
?>
<html>
  <head>
  	<meta charset="utf-8">
    <title>ProjectWork5AI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/votazioni/js/scripts.js"></script>
    <link rel="stylesheet" type="text/css" href="css/accesso.css"/>
  </head>
  <body class="container-fluid back">
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
        </ul>
      </div>
    </nav>
    <div class="text-center exactCenter">
      <h1 class="col-sm">Accesso</h1> 	
      <form method="POST" action="#">
          <span class="row"><label class="col-xl-4">CF:</label><input class="col-xl" type="text" name="CF" required></span><br>
          <span class="row"><label class="col-xl-4">Password:</label><input class="col-xl" type="password" name="password" required></span><br>
          <input class="btn btn-info" type="submit" name="accedi" value="Accedi">
      </form>
      <a class="openForm" href="#" onclick="openForm()">Hai dimenticato la password?</a>
      <div class="form-popup" id="myForm">
        <form action="#" method="POST" class="form-container">
          <p>Inserisci il tuo CF e ti verrá inviata un'email all'indirizzo di posta elettronica registrato</p>
          <label for="CF"><b>CF</b></label>
          <input type="text" placeholder="Inserisci il CF" name="CF" required>
          <button type="submit" name="inviaEmail" class="btn">Invia</button>
          <button type="submit" class="btn cancel" onclick="closeForm()">Chiudi</button>
        </form>
      </div>
      <p>
      	Ti devi ancora registrare? <a href="registrazione.php">Clicca qui!</a>
      </p>
     </div>
    <?php
    if(isset($_POST["accedi"]))
    	{
        require_once("commonFunctions.php");
      	$CF=$_POST['CF'];
        $password=md5($_POST['password']);
        $checkTable=mysqli_query($db, "SELECT *
                                       FROM Utente
                                       WHERE CF='$CF' AND password='$password'");
        $row=mysqli_fetch_array($checkTable, MYSQLI_ASSOC); 
        if($row!==NULL)
          {
          $_SESSION["credenziali"]=array("CF"=>$CF, "password"=>$password);
          header("Location:paginaUtente.php");
          }
         else
          echo "<script type='text/javascript'>alert('Nome utente e/o password errati');</script>";
      	}
      if(isset($_POST["inviaEmail"]))
      	{
        require_once("commonFunctions.php");
        $CF=$_POST['CF'];
        $table=mysqli_query($db, "SELECT email
                                  FROM Utente
                                  WHERE CF='$CF'"); 
        $row = mysqli_fetch_array($table, MYSQLI_ASSOC); 
        if($row!==NULL)
          {
          $to_email=$row['email'];
          $subject='Richiesta di modifica password';
          $message='Cliccare sul link che segue per modificare la password: https://projectwork5ai.altervista.org/votazioni/accesso/dimenticatoPasswd.php';
          $headers='From: ProjectWork5AInoreply @ company . com';
          mail($to_email,$subject,$message,$headers);
          $_SESSION["CF"]=$CF;
          }
        }
    ?>
  </body>
</html>
