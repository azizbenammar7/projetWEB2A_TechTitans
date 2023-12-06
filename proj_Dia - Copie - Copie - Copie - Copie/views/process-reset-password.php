<?php

$token = $_POST["token"];

$token_hash = hash("sha256", $token);

try {
  

    require '../config.php';
    $pdo = config::getConnexion();

    $sqlSelect = "SELECT * FROM user
                  WHERE reset_token_hash = :token_hash";

    $stmtSelect = $pdo->prepare($sqlSelect);

    $stmtSelect->bindParam(":token_hash", $token_hash, PDO::PARAM_STR);

    $stmtSelect->execute();

    $user = $stmtSelect->fetch(PDO::FETCH_ASSOC);

    if ($user === false) {
        die("Token not found");
    }

    if (strtotime($user["reset_token_expires_at"]) <= time()) {
        die("Token has expired");
    }

    if (strlen($user["motdepasse"]) < 8) {
        die("Password must be at least 8 characters");
    }

    if (!preg_match("/[a-z]/i", $user["motdepasse"])) {
        die("Password must contain at least one letter");
    }

    if (!preg_match("/[0-9]/", $user["motdepasse"])) {
        die("Password must contain at least one number");
    }

    if ($_POST["motdepasse"] !== $_POST["password_confirmation"]) {
        die("Passwords must match");
    }

$motdepasse = md5($_POST["motdepasse"]);

    $sqlUpdate = "UPDATE user
                  SET motdepasse = :motdepasse,
                      reset_token_hash = NULL,
                      reset_token_expires_at = NULL
                  WHERE id = :user_id";

    $stmtUpdate = $pdo->prepare($sqlUpdate);

    $stmtUpdate->bindParam(":motdepasse", $motdepasse, PDO::PARAM_STR);
    $stmtUpdate->bindParam(":user_id", $user["id"], PDO::PARAM_INT);

    $stmtUpdate->execute();

    $stmtUpdate->execute();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Password Updated</title>
        <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script type="text/javascript" src="js/main1.js"></script>
    <style>
      

        p {
            margin-top: 250px; /* Adjust the margin as needed */
            font-size: 20px; /* Adjust the font size as needed */
            cursor: pointer; /* Add pointer cursor to indicate clickability */
           
        }
    </style>
    </head>
    <body>
        <!-- Add your image here -->
        <div class="container">
        <div class="img">
            <img src="img/success.png">
        </div>
        <p id="successMessage">Le mot de passe a été mis à jour. Vous pouvez maintenant vous connecter.</p>

<!-- JavaScript to redirect to login.php when the paragraph is clicked -->
<script>
    // Function to redirect when the paragraph is clicked
    function redirectToLogin() {
        window.location.href = "login.php";
    }

    // Add an event listener to the paragraph
    document.getElementById("successMessage").addEventListener("click", redirectToLogin);

    // Optionally, you can still have the automatic redirection after a delay
    setTimeout(redirectToLogin, 15000); // Redirect after 5 seconds (adjust as needed)
</script>
    </body>
    </html>
    <?php
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
