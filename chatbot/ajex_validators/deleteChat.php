<?php
session_start(); 
require_once('../admin/include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $chatId = intval($_POST['id']); // Get the chat ID from the request

    // Delete the chat with the specified ID
    $stmt = $con->prepare("DELETE FROM chat_history WHERE id = ?");
    $stmt->bind_param("i", $chatId);

    if ($stmt->execute()) {
        echo "Chat deleted successfully!";
    } else {
        echo "Error deleting chat: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>