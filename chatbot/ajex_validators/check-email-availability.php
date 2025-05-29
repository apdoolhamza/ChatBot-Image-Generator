<?php 
require_once('../admin/include/config.php');

if(!empty($_POST["email"])) {
$result = mysqli_query($con,"SELECT count(*) FROM users WHERE email='" . $_POST["email"] . "'");
$row = mysqli_fetch_row($result);
if($row[0] > 0) {
    echo "<h3 style='color:black;margin-bottom:-10px;font-size:18px;'>Error</h3><br>User already exist!";
}
};
?>
