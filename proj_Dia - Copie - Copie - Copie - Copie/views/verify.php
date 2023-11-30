<?php
include '../Controller/userC.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Verify the user by the verification code
    $userC = new UserC();
    $isVerified = $userC->verifyUser($code);

    if ($isVerified) {
        echo "Your account has been successfully verified. You can now log in.";
    } else {
        echo "Invalid verification code. Please try again.";
    }
} else {
    echo "Invalid request. Please use the verification link provided in your email.";
}
?>
