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

    echo "Password updated. You can now login.";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
