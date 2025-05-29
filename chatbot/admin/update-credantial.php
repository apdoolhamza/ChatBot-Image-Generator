<?php 
session_start(); 
//Import configuration file
require_once('./include/config.php');

if(empty($_SESSION['adminId']) && strlen($_SESSION['adminId']) == 0) {
    header("location:index.php");
} 

// Check if form 'Update' button clicked, and Check if its 'Inputs' are not empty
if(isset($_POST['submit']) || !empty($_POST["username"]) && !empty($_POST["useremail"]) && !empty($_POST["password"])) {

$username = mysqli_real_escape_string($con, $_POST["username"]);
$email = mysqli_real_escape_string($con, $_POST["useremail"]);
$password = mysqli_real_escape_string($con, $_POST["password"]);

$encryptPassword = password_hash($password, PASSWORD_DEFAULT);

$qeury = mysqli_query($con,"UPDATE admin SET username='$username',email='$email',password='$encryptPassword'");

if($qeury) {
header("location: dashboard.php");
exit();
} else {
 echo "<script>alert('Error!');</script>";
}
}
mysqli_close($con);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ChatBot AI | Update Credentials</title>
<meta name="description" content="2FA...">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- fav icon -->
<link rel="apple-touch-icon" href="../assets/img/logo.png">
<link rel="icon" href="../assets/img/logo.png">
<!-- icons file -->
<link rel="stylesheet" href="../assets/fontawesome/all.css">
<!-- css files -->
<link rel="stylesheet" href="../assets/css/asycRequest.css">
<link rel="stylesheet" href="./assets/css/dashboard.css">
<link rel="stylesheet" href="../assets/css/popUp.css">
<!-- internal style -->
<style>
main{
    text-align:center;
}
main img{
    margin:-60px 0 7px 0;
    border-radius:50%;
    box-shadow:0 0 20px #00000010;
}
form{
    margin:0 auto;
    border-radius:10px;
}
form .pssInput{
margin-right:6px;
}
form div{
letter-spacing:-1px;
}
 form button[type="submit"],
 form input{
      outline:none;
      color:inherit;
      border:none;
      border-radius:5px;
      font-size:16px;
      font-family: inherit;
  }
form input{
    width:14.5rem;
    height:40px;
    padding:0 15px;
    border:1px solid silver;
    box-shadow:0 0 4px #d7d7d7;
    margin-top:5vh;
    cursor:default;
    font-size:16px;
    background-color:#f9f9f9;
  }
form input::placeholder{
    color:#c1c1c1;
    font-size:14px;
}
form input:focus{
    box-shadow:0 0 3px #6e74e5;
}
form #PassVisibility{
  font-size:13px;
  background-color:#cdcff3;
  width:48px;
  height:28px;
  line-height:28px;
  margin-left:-55.5px;
  margin-top:0;
  cursor:pointer;
  border-radius:5px;
  padding-top:2px;
}
form .fa-eye-slash{
    color:#717171;
}
form .fa-eye{
    color:#494949;
}
form button[type="submit"]{
    width:16.5rem;
    height:45px;
    background-color: #6e74e5;
    margin-top:30px;
    color:#f9f9f9;
  }
form button[type="submit"]:active{
    background-color: #6e74e5;
    transform: scale(.9);
 }
</style>
</head>
<body>
<!-- header -->
<?php
include_once('./components/header.php');
?>
<div class="head position-fixed left-0" style="position: fixed; left:20px;top:7.6rem">
<h3>Update Credentials<span>*</span></h3>
</div>
<main >
<img src="../assets/img/admin.png" width="100" alt="Admin Avatar">
<form method="post" novalidate>
        
        <input type="text" name="username" maxlength="25" placeholder="Enter UserName"><br>
        <input type="email" name="useremail" id="useremail" maxlength="40" placeholder="Enter E-Mail">
        <div class="pssInput">
        <input type="password" name="password" maxlength="10" placeholder="Enter Password"><i title="See Password" id="PassVisibility" class="fas togglePassVisibility fa-eye-slash"></i>
        </div>
        <button type="submit" name="submit" title="Update">Update</button>
    </form>
</main>

<!-- js files -->
<script src="../assets/js/popUp.js"></script>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/asycRequest.js"></script>
<script src="./assets/js/verify.js"></script>
<script>
const Inputs = document.querySelectorAll('form input');
document.querySelector('form').addEventListener('submit', () => {
    for (let input of Inputs) {
    if (input.value == "") {
        popUp('','Inputs should not be empty!');
        event.preventDefault();
}
}
})
</script>
</body>
</html>
