<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

try {
    // Include your config file
    require '../config.php';

    // Get PDO instance from config
    $pdo = config::getConnexion();

    $sql = "SELECT * FROM user
            WHERE reset_token_hash = :token_hash";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(":token_hash", $token_hash, PDO::PARAM_STR);

    $stmt->execute();

    $user = $stmt->fetch();

    if ($user === false) {
        die("Token not found");
    }

    if (strtotime($user["reset_token_expires_at"]) <= time()) {
        die("Token has expired");
    }

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script type="text/javascript" src="js/main1.js"></script></head>


    <body>
    <img class="wave" src="img/wave.png">
    <div class="container">
        <div class="img">
            <img src="img/bg.png">
        </div>
        <div class="login-content">

            <form method="post" action="process-reset-password.php">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                <h2 class="title">Mot de passe oublié</h2>
                <div class="input-div">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Nouveau mot de passe</h5>
                        <input type="password" class="input" name="motdepasse" id="motdepasse" required>
                    </div>
                </div>
                <div class="input-div">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Répéter le mot de passe</h5>
                        <input type="password" class="input" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
                <button class="btn">Send</button>
            </form>

        </div>
    </div>
</body>
</html>
