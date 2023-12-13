<?php
include "../controller/UserC.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['unban'])) {
    $userId = $_POST['userId'];
    $c = new UserC();
    $c->unbanUser($userId);
    
    // Redirect back to the user list page after unbanning
    header("Location: listusers.php");
    exit();
} else {
    // Handle invalid requests or direct access to the script
    // Redirect to an error page or perform other actions as needed
    header("Location: listusers.php");
    exit();
}
?>
