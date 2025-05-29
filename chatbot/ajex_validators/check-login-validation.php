<?php 
session_start(); 
require_once('../admin/include/config.php');

// Check if form 'login' button exist, and Check if its 'Inputs' are not empty
if(isset($_POST['login']) || !empty($_POST["email"]) && !empty($_POST["password"])) {

	$email = mysqli_real_escape_string($con, $_POST["email"]);
	$password = mysqli_real_escape_string($con, $_POST["password"]);

	$result = mysqli_query($con,"SELECT * FROM users WHERE email = '$email' LIMIT 1");

	$row = mysqli_fetch_assoc($result);
	if($row > 0) {
	if(password_verify($password, $row['userpassword'])) {

	// store user id & 'email' in SESSION
	$_SESSION['email'] = $row['email'];
	$_SESSION['id'] = $row['id'];

    // Redirect the user to the Home page
	 echo "index.php"; 
	 exit();
	} else {
	 echo "<h3 style='color:black;margin-bottom:-10px;font-size:18px;'>Error</h3><br>User not found!";
	}
	} else {
	 echo "<h3 style='color:black;margin-bottom:-10px;font-size:18px;'>Error</h3><br>User not found!";
	}
}
mysqli_close($con);
?>
