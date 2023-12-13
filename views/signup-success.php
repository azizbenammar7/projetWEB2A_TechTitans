<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
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
            max-width:100%;
            height: auto;
            margin-bottom: 20px;
        }

        .btn {
            padding: 8px 16px; /* Adjust padding to make the button smaller */
                   }
    </style>
    <script>
        function redirectToGmail() {
            window.location.href = "https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox";
        }
    </script>
</head>
<body>
<img src="img/activation.png" alt="Your Photo">

    <h1>Inscription</h1>
    
    <p>Inscription réussie.
Veuillez vérifier votre e-mail pour activer votre compte.</p>
<input type="submit" class="btn" value="email" onclick="redirectToGmail()">

    
</body>
</html>
