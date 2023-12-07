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
        $styles = '
        <style>
        @font-face {
            font-family: "Poppins";
            src: url("views/font/poppins-bold-webfont.woff2") format("woff2");
            font-weight: bold;
        }
        
        body {
                font-family: "Poppins", "Helvetica Neue", Helvetica, Arial, sans-serif;
                background-color: #f4f4f4;
                color: #333;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .reset-link {
                color: #007bff;
                text-decoration: none;
            }
        </style>
    ';

    // Email body with inline CSS
    $message = "
        <html>
        <head>
            <title>Password Reset</title>
            <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap'>

            {$styles}
        </head>
        <body>
            <div class='container'>
                <p>Click <a href='http://localhost/proj_Dia%20-%20Copie%20-%20Copie%20-%20Copie%20-%20Copie/views/reset-password.php?token={$token}' class='reset-link'>here</a> to reset your password.</p>
            </div>
        </body>
        </html>
    ";
        $headers = "From: noreply@example.com\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        if (mail($to, $subject, $message, $headers)) {
            echo "Message envoyé, veuillez vérifier votre boîte de réception.";
        } else {
            echo "Message could not be sent.";
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
