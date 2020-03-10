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
  	<link rel="stylesheet" type="text/css" href="css/paginaUtente.css"/>
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
              <a class="dropdown-item" href="#">Votazioni disponibili</a>
              <a class="dropdown-item" href="#">Votazioni concluse</a>
              <a class="dropdown-item" href="#">Votazioni in corso</a>
              <div class="utente">
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Vuoi proporre una votazione?</a>
              </div>
              <div class="amministratore">
              	<div class="dropdown-divider"></div>
              	<a class="dropdown-item"  href="#">Vuoi creare una votazione?</a>
              </div>
            </div>
          </li>
          <li class="nav-item active amministratore">
            <a class="nav-link" href="#">Utenti</a>
          </li>
        </ul>
      </div>
    </nav>
    <?php
    	if(isset($_SESSION["credenziali"]))
        	{
            require_once("commonFunctions.php");
            $credenziali=$_SESSION["credenziali"];
            $CF=$credenziali["CF"];
            $password=$credenziali["password"];
            $table=mysqli_query($db, "SELECT nome, cognome
                            		  FROM Utente
                           		      WHERE CF='$CF' AND password='$password'"); 
            $row = mysqli_fetch_array($table, MYSQLI_ASSOC);  
            $nome=$row['nome'];
            $cognome=$row['cognome'];
            echo "<h1 class='col-sm'>Benvenuto/a $nome $cognome!";
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
    ?>                    
  </body>
</html>
