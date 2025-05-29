<?php
session_start();
$_SESSION['adminId'] = "";
unset($_SESSION['adminId']);
header('location: index.php');
?>