<?php
  $db= mysqli_connect("localhost", "username", "password");
  if($db) 
  	mysqli_select_db($db, "my_projectwork5ai");
   else
  	die("Connection failed: " . mysqli_connect_error());
?>