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
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script type="text/javascript" src="js/main1.js"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            
        }

        h1, p {
            text-align: center;
        }

        img {
            max-width: 30%; /* Adjust the percentage to make it smaller */
            height: auto;
            margin-bottom: 20px;
        }

        .btn {
            padding: 8px 16px; /* Adjust padding to make the button smaller */
                   }
    </style>
</head>
<body>
<img src="img/image-removebg-preview (15) (1).png" alt="Your Photo">

    <h1>Compte activé</h1>

    <p>Nous sommes ravis de vous informer que votre compte est désormais actif sur notre site DiaZen ! Merci infiniment d'avoir choisi DiaZen. Nous sommes impatients de vous offrir une expérience exceptionnelle
       <a href="login.php">Je vous invite à vous connecter maintenant</a>.</p>


</body>
</html>
