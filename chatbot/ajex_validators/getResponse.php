<?php
session_start(); 
require_once('../admin/include/config.php');
$apiKey = require_once('../api/apikey.php');
include('../api/bunch.php');


// check if the browser has an active internet connection
function isConnected() {
    $connected = @fsockopen("www.google.com", 80); // Try to connect to Google on port 80
    if ($connected) {
        fclose($connected);
        return true; // Internet connection is available
    } else {
        return false; // No internet connection
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if (connection_aborted()) {
        exit;
    }
		$message = $_POST['message'];
		$isImage = $_POST['isImage'];
            
		if (isConnected()) {     
            if ($isImage === 'yes') {
                echo generateImage($message, $apiKey);
            } else {
                echo conversation($message, $apiKey);
            } 
		} else {
			echo "Network error. Please check your internet!";
		}
}

?>