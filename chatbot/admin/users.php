<?php
session_start();
// import configuration file
require_once('./include/config.php');

if(empty($_SESSION['adminId']) && strlen($_SESSION['adminId']) == 0) {
    header("location:index.php");
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ChatBot AI | Registered Users</title>
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
<style>
  .usersList{
    width:100%;
    height:calc(100vh - 10.5rem);
    margin-top:10px;
    justify-content:start;
  }
  .scrollable{
    height:calc(100vh - 14rem);
    overflow-y: scroll;
  }
  table, td{
    border:1px solid #e3e3e3;
    padding:10px;
  }
  table p{
    font-size:18px;
  }
  th{
    text-align:left;
  }
  tr:nth-child(even){
    background-color:#dddddd;
  }
  .user{
    flex-direction:row;
  }
  .user i{
    font-size:15px;
  }
  .user table{
    width:27rem;
  }
.head{
  width:100%;
  margin:-1rem 0 30px 3rem;
}
</style>
</head>
<body>
<!-- header -->
<?php
include_once('./components/header.php');
?>

<!-- main -->
<main class="usersList center">
<div class="head">
<h3>Registered Users<span>*</span></h3>
</div>
<div class="scrollable autoscroll">
  <?php 
  $query = mysqli_query($con, "SELECT * FROM users");

  if (mysqli_num_rows($query) > 0) {
    
    while ($row = mysqli_fetch_assoc($query)) {

  ?>
<div class="user center">
  <table>
    <tr>
    <td><p class="username"><?php echo htmlentities($row['username']); ?></p></td>
    <td><p class="userPone" style="font-size:15px;"><?php echo htmlentities($row['email']); ?></p></td>
    <td><div class="delete center"><a data-id='<?php echo htmlentities($row['id']);?>'><i style="color:brown;" class="fas fa-trash-alt"></i></a></div></td>
  </tr>
        
</table>
</div>
<?php }} else {?>
<div style="font-size:17px;"><span style="color:#6e74e5;">Users</span> is empty!</div>
<?php } ?>
</div>
</main>

<!-- js files -->
<script src="../assets/js/popUp.js"></script>
<script src="../assets/js/autoScroll.js"></script>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/asycRequest.js"></script>
<script>
     // iterate over all deleteBtn element
     const deleteBtns = document.querySelectorAll('.delete a');
    for (let deleteBtn of deleteBtns) {
        deleteBtn.onclick = function(){
        let userid = $(this).data('id');
        $.ajax({
        type: "POST",
		    url: "ajex_validators/delete-user.php",
        data: {
            id: userid
        },
		success:function(){
      // prevent browser history change
      window.location.href = "users.php";          
    }
    })
}
}
</script>
</body>
</html>
