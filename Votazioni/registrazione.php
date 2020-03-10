<html>
  <head>
  	<meta charset="utf-8">
    <title>Registrazione</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/registrazione.css"/>
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
      <h1 class="col-sm">Registrazione</h1>	
      <form method="POST" action="#">	  
          <span class="row"><label class="col-xl-4">Nome:</label><br><input class="col-xl-8" type="text" name="nome" required><br></span>
          <span class="row"><label class="col-xl-4">Cognome:</label><br><input class="col-xl-8" type="text" name="cognome" required><br></span>
          <span class="row"><label class="col-xl-4">C.F.:</label><br><input class="col-xl-8" type="text" name="CF" required><br></span>
          <span class="row"><label class="col-xl-4">Email:</label><br><input class="col-xl-8" type="text" name="email" required><br></span>
          <span class="row"><label class="col-xl-4">Password:</label><br><input class="col-xl-8" type="password" name="password" required><br></span>
          <span class="row"><label class="col-xl-4">Codice:</label><br><input class="col-xl-8" type="password" name="codice" required><br></span>
          <input class="btn btn-info" type="submit" name="registrati" value="Registrati"><br>
       </form>
       <p>Ti sei giá registrato? <a href="accesso.php">Clicca qui!</a></p>
    </div>
    <?php
    if(isset($_POST["registrati"]))
      {
      require_once("commonFunctions.php");
      $CF=$_POST['CF'];
      $nome=$_POST['nome'];
      $cognome=$_POST['cognome'];
      $password=md5($_POST['password']);
      $email=$_POST['email'];
      $codice=$_POST['codice'];
      $table=mysqli_query($db, "SELECT * FROM Utente WHERE codice='$codice' AND nome IS NULL");
      if($table)
        {
        $row = mysqli_fetch_array($table, MYSQLI_ASSOC);  	
        mysqli_query($db, "UPDATE Utente 
                                 SET CF='$CF', nome = '$nome', cognome = '$cognome', password = '$password', email = '$email'
                                 WHERE codice='$codice' ");
        header("Location:accesso.php");
        echo "<script type='text/javascript'>alert('Registrazione avvenuta con successo');</script>";
        }
       else
        echo "<script type='text/javascript'>alert('Codice errato');</script>";
      }
    ?>
  </body>
</html>
