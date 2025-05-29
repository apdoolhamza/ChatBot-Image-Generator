<?php
session_start();
$_SESSION['email'] = "";
unset($_SESSION['email']);
header('location:index.php');
?>