<?php
    session_start(); // Start session to access stored data

    if (isset($_GET['itemId'])) {
        $itemId = $_GET['itemId']; // Get the div ID
        echo "You are viewing: " . htmlspecialchars($itemId); // Echo the div ID
    } else {
        echo "No ID was sent!";
    }
?>