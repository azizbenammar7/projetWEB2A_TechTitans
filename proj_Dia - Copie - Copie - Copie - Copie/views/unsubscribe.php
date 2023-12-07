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

// Update the user's subscription status to 0 (unsubscribed)
$userId = $_SESSION['user_id'];
$userC->unsubscribeUser($userId);

// Redirect back to the user interface
header("Location: dashboard.php");
exit();
?>
