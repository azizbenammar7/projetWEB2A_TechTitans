<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login diazen</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script type="text/javascript" src="js/main1.js"></script>
</head>
<body>
    <img class="wave" src="img/wave.png">
    <div class="container">
        <div class="img">
            <img src="img/bg.png">
        </div>
        <div class="login-content">
            <?php
            session_start();
            include "../controller/userC.php";

      // ... (existing code)

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST["email"]);
        $motdepasse = $_POST["motdepasse"];
    
        $userC = new UserC();
        if (!$userC->isAccountActivated($email)) {
            $loginError = "Votre compte n'est pas activé. Veuillez vérifier votre e-mail pour l'activation.";
        } else {
        $user = $userC->loginUser($email, md5($motdepasse));
    
    
        if ($user && isset($user['is_banned']) && $user['is_banned']) {
            $loginError = "Your account is banned. Please contact support for assistance.";}
          elseif ($user) {
            if (isset($user['is_admin']) && $user['is_admin']) {
                // Admin login logic (if needed)
                header("Location: listusers.php");
                exit();
            } elseif (isset($user['motdepasse']) && md5($motdepasse) === $user['motdepasse']) {
                // Normal user login logic
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];

                header("Location: dashboard.php");
                exit();
            }
        } else {
            // If no valid login is detected
            $loginError = "Invalid email or mot de passe";
        }}
    }
    ?>

            <!-- Your HTML fo the login form -->
            <form method="POST" action="">
                <h2 class="title">Bonjour!</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input type="text" class="input" name="email" required>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i"> 
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Mot de passe</h5>
                        <input type="password" class="input" name="motdepasse" required>
                    </div>
                </div>
                <a href="forgot_password.php">Mot de passe oublié</a>
                <br>
                <a href="adduser.php">Créer un compte</a>
                <input type="submit" class="btn" value="Login">
            </form>

            <?php
            if (isset($loginError)) {
                echo "<p>$loginError</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
