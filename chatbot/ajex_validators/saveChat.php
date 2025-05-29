<?php 
session_start(); 
require_once('../admin/include/config.php');
date_default_timezone_set('Africa/Lagos');

// Get the formatted date and time
$currTime = date("M - D");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

if (isset($_SESSION['email']) && strlen($_SESSION['email']) != 0) {

    $user_id = $_SESSION['id'];

    $data =  $_POST['data'];
    $esc_data = mysqli_real_escape_string($con,$data);

    $decodedChat = json_decode($data, true);
    $summary =  $currTime." , ".$decodedChat['user'][0];

    $qeury = mysqli_query($con,"INSERT INTO chat_history(user_id,chat_summary,full_chat) VALUES('$user_id','$summary','$esc_data')");
} else {
     // Redirect the user to login page
     echo "user-sign.php";
}
mysqli_close($con);
}
?>
