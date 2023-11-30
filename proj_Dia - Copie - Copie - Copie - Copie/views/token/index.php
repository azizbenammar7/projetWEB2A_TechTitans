<?php

include '../../config.php';


if (isset($_GET['token'])  && $_GET['token'] != '') {
    $sql = 'SELECT email FROM user WHERE token = ? ';
    $pdo = config::getConnexion();
    $statement = $pdo->prepare($sql);
    $statement->execute([$_GET['token']]);
    $email = $statement->fetchColumn();

    if ($email) {
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupérer votre mot de passe</title>
</head>
<body>
    <form method="post">
        <label>Nouveaux mot de passe : </label>
        <input type="password" name="newPassword">
       <!--  <input type="password" name="ConfirmNewPassword"> -->
        <input type="submit" value="Confirme">
    </form>
    
</body>
</html>

<?php

    }
}


?>
<?php
if (isset($_POST['newPassword'])) {
    $hashedPassword = md5($_POST['newPassword']);
    $sql = "UPDATE user SET motdepasse = ?, token = NULL WHERE email = ?";
    $pdo = config::getConnexion();
    $statement = $pdo->prepare($sql);
    $statement->execute([$hashedPassword, $email]);
    echo 'Mot de passe modifié avec succès';
}
?>