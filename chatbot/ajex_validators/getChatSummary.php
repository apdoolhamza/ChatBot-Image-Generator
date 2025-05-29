<?php
session_start(); 
require_once('../admin/include/config.php');


    if (isset($_SESSION['email']) && strlen($_SESSION['email']) != 0) {
        $currUser = $_SESSION['id'];

        $Chathistory = mysqli_query($con,"SELECT * FROM chat_history WHERE user_id = '$currUser' ORDER BY create_at DESC");
        if (mysqli_num_rows($Chathistory) > 0) {
        while ($row = mysqli_fetch_array($Chathistory)) {

            $summaryText =  $row['chat_summary'];

            $ellip = substr($summaryText, 0, 19);
            $ellips = strlen($summaryText) > 19 ? $ellip.'...' : $ellip;
           echo "<li class='nav-item mb-2 d-flex align-items-center mr-2 w-100' style='justify-content:space-between margin-top:-5px;'> <button class='pl-0 pr-0 bg-transparent w-100 text-left' style='color:white;white-space:nowrap;' onclick='loadChat({$row['id']});'> <span class='nav-link link-body-emphasis' style='font-size:15px;'> $ellips </span></button> <a href='#' class='btn border-0 p-1 ml-2 mr-1 deleteBtn text-link' onclick='deleteChat({$row['id']});'><svg class='bi pe-none' width='15' height='15'><use xlink:href='#trash' /></svg></a></li>";
   
        }
        } else {
        echo "<li class='nav-item mb-2' style='margin-top:-5px;'> <span class='nav-link text-center text-body'> <svg class='bi pe-none me-2 mb-1' width='20' height='20'> <use xlink:href='#nohistory' /></svg> <br> No history found! </span></li>";
    }}
    
    ?>