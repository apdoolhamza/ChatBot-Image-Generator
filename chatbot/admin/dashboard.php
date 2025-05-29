<?php
session_start();
// import configuration file
require_once('include/config.php');

if(empty($_SESSION['adminId']) && strlen($_SESSION['adminId']) == 0) {
    header("location:index.php");
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ChatBot AI | Dashboard</title>
<meta name="description" content="2FA...">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- fav icon -->
<link rel="apple-touch-icon" href="../assets/img/logo.png">
<link rel="icon" href="../assets/img/logo.png">
<!-- icons file -->
<link rel="stylesheet" href="../assets/fontawesome/all.css">
<!-- css files -->
<link rel="stylesheet" href="../assets/css/asycRequest.css">
<link rel="stylesheet" href="../assets/css/popUp.css">
<link rel="stylesheet" href="./assets/css/dashboard.css">
</head>
<body>
<!-- header -->
<?php
include_once('./components/header.php');
?>
<!-- Spinner loader -->
<div class="asycRequest">
<div class="bounce1"></div>
<div class="bounce2"></div>
<div class="bounce3"></div>
</div>

<div class="mainContainer">

<div class="head">
<h3>Dashboard<span>*</span></h3>
</div>

<div class="cards-container center">
<div class="card-box center">
        <i id="box-icon" class="fas fa-users"></i>
        <div class="desc">
            <?php $result = mysqli_query($con, "SELECT * FROM users");
            ?>
            <p class="views"><?php echo htmlentities(mysqli_num_rows($result)); ?></p>
            <a href="users.php"><p>Registered Users <i class="fas fa-link"></i></p></a>
        </div>
    </div>

    <div class="card-box center">
        <i id="box-icon" class="fas fa-history"></i>
        <div class="desc">
            <?php $query = mysqli_query($con, "SELECT * FROM chat_history");
            ?>
            <p class="views"><?php echo htmlentities(mysqli_num_rows($query));?></p>
            <p>Chats History</p>
        </div>
    </div>

</div>
</div>

<!-- js files -->
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/asycRequest.js"></script>
</body>
</html>
