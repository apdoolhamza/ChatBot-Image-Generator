<?php 
session_start(); 
require_once('../admin/include/config.php');

// Check if form 'submit' button clicked, and Check if its 'Inputs' are not empty
if(isset($_POST['submit']) || !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["newpassword"])) {

	$username = mysqli_real_escape_string($con, $_POST["username"]);
	$email = mysqli_real_escape_string($con, $_POST["email"]);
	$newpassword = mysqli_real_escape_string($con, $_POST["newpassword"]);

	$result = mysqli_query($con,"SELECT email FROM users WHERE email = '$email' AND username = '$username' LIMIT 1");

	if (mysqli_num_rows($result) > 0) {

	// ecryp the user password
	$encryptPassword = password_hash($newpassword, PASSWORD_DEFAULT);

	// update user password
	$query = mysqli_query($con, "UPDATE users SET userpassword='$encryptPassword' WHERE email='$email'");

	if($query) {
	echo "user-sign.php";
	} else {
	echo "<h3 style='color:black;margin-bottom:-10px;font-size:15px;'>Error</h3><br>Fail to Update!";
	}
} else {
	echo "<h3 style='color:black;margin-bottom:-10px;font-size:15px;'>Error</h3><br>User not found!";
}
}
mysqli_close($con);
?>
