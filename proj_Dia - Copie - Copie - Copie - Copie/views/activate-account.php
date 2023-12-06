<?php

$token = $_GET["token"];
echo "Token: $token";



try {
    require '../config.php';

    $pdo = config::getConnexion();


$sql = "SELECT * FROM user
        WHERE account_activation_hash = :token";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':token', $token, PDO::PARAM_STR);
$stmt->execute();

$user = $stmt->fetch();

if ($user === false) {
    die("Token not found");
}

$sql = "UPDATE user
        SET account_activation_hash = NULL
        WHERE id = :user_id";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $user["id"], PDO::PARAM_INT);
$stmt->execute();
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Account Activated</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

    <h1>Account Activated</h1>

    <p>Account activated successfully. You can now
       <a href="login.php">log in</a>.</p>

</body>
</html>
