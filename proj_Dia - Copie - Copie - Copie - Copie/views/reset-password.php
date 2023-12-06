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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

    <h1>Reset Password</h1>

    <form method="post" action="process-reset-password.php">

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <label for="motdepasse">New password</label>
        <input type="password" name="motdepasse" id="motdepasse" required>

        <label for="password_confirmation">Repeat password</label>
        <input type="password" id="password_confirmation"
               name="password_confirmation">

        <button>Send</button>
    </form>

</body>
</html>
