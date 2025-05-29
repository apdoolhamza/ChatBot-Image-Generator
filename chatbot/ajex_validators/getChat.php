<?php
session_start(); 
require_once('../admin/include/config.php');

$chatId = $_GET['id']; // Chat ID from the button
$stmt = $con->prepare("SELECT full_chat FROM chat_history WHERE id = ?");
$stmt->bind_param("i", $chatId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

echo $row['full_chat']; // Display the full chat

?>