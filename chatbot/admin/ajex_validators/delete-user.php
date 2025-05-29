<?php 
 session_start();
 // import configuration file
 require_once('../include/config.php');

  $id = $_POST["id"];
  
  $result = mysqli_query($con, "DELETE FROM users WHERE id='$id'");
?>