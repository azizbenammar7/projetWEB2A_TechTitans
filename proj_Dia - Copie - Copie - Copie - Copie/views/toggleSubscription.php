<?php
// toggleSubscription.php

require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];

    // Check the current subscription status and toggle it
    $user = getUserById($userId);  // Implement a function to retrieve user information from the database

    if ($user['subscribe'] == 1) {
        unsubscribeUser($userId);
        echo "User with ID $userId has been unsubscribed successfully.";
    } else {
        subscribeUser($userId);
        echo "User with ID $userId has been subscribed successfully.";
    }
} else {
    echo "Invalid request method.";
}
?>
