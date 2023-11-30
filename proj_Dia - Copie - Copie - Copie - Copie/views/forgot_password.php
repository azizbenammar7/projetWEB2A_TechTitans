<?php
require '../config.php';

$message="";
$messagee="";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- Intégration du CSS du deuxième code -->
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <!-- Intégration du JS du deuxième code -->
    <script type="text/javascript" src="js/main1.js"></script>
</head>

<body>
   
    <img class="wave" src="img/wave.png">
    <div class="container">
        <div class="img">
            <img src="img/image-removebg-preview (12) (1).png">
        </div>
        <form method="post" action="">
        <input type="email" name="email">
        <button type="submit">Send me a token</button>
    </div>
    </form>
</body>
</html>



<?php
                            //Oublier mot de passe 
                            if (isset($_POST['email'])) {
                               $token = uniqid(); //genere code token 
                               $url = "https://localhost:4433/proj_Dia%20-%20Copie%20-%20Copie%20-%20Copie%20-%20Copie/token?token=$token";
                               $subject = 'Mot de passe oublié';
                                $message = "Bonjour , voici votre lien pour la réinitialisation du mot de passe : $url";
                                $headers = 'Content-Type: text/plain; charset="utf-8"' . "";
                                $headers = "From:diazen194@gmail.com";
                      
                                if (mail($_POST['email'], $subject, $message, $headers)) {
                                    $sql = "UPDATE user SET token = ? WHERE email = ?";
                                    $pdo = config::getConnexion();
                                    $statement = $pdo->prepare($sql);
                                    $statement->execute([$token, $_POST['email']]);
                                    
                                    echo "Mail envoyer ";

                                }else{
                                    echo 'Une erreur';
                                }


                            }
                            ?>
