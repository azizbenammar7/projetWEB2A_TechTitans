<!DOCTYPE html>
<html>
<head>
    <title>Mot de passe oublié</title>
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

    <form method="post" action="send-password-reset.php">
    <h2 class="title">Mot de passe oublié</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input type="text" class="input" name="email" required>
                    </div>
                </div>

                <button class="btn">Envoyer</button>

    </form>

</body>
</html>