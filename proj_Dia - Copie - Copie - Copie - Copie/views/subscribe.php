<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Include necessary files and classes
include "../controller/userC.php";
$userC = new UserC();

// Update the user's subscription status to 1 (subscribed)
$userId = $_SESSION['user_id'];
$userC->subscribeUser($userId);

// Redirect back to the user interface
header("Location: dashboard.php");
exit();
?>
