<?php

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

try {
    // Include your config file
    require '../config.php';

    // Get PDO instance from config
    $pdo = config::getConnexion();

    $sql = "UPDATE user
            SET reset_token_hash = :token_hash,
                reset_token_expires_at = :expiry
            WHERE email = :email";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(":token_hash", $token_hash, PDO::PARAM_STR);
    $stmt->bindParam(":expiry", $expiry, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);

    $stmt->execute();

    if ($stmt->rowCount()) {

        $to = $email;
        $subject = "Password Reset";
        $message = "Click http://localhost/proj_Dia%20-%20Copie%20-%20Copie%20-%20Copie%20-%20Copie/views/reset-password.php?token=$token to reset your password.";
        $headers = "From: noreply@example.com\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        if (mail($to, $subject, $message, $headers)) {
            echo "Message envoyé, veuillez vérifier votre boîte de réception.";
        } else {
            echo "Message could not be sent.";
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
