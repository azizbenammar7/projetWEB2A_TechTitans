<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include '../controller/AbonnementC.php';
include '../model/Abonnement.php';


include '../controller/UserC.php';
include '../model/User.php';


// Créez une instance du contrôleur
$userC = new UserC();

// Créez une instance de la classe User
$user = null;
$user = $_SESSION['user_details'];


$abonnementC = new AbonnementC();
$erreur = null;

// Obtenir la date actuelle
$dateActuelle = date("Y-m-d");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $IDuser = $_POST['IDuser'] ?? null;
    $IDpackuser = $_POST['IDpackuser'] ?? null;
    $payed = $_POST['payed'] ?? null;

    // Validez les entrées si nécessaire

    if (!empty($IDuser) && !empty($IDpackuser) && isset($payed)) {
        $abonnement = new Abonnement($user['id'], $IDpackuser, $dateActuelle, $payed);

        try {
            $abonnementC->addAbonnement($abonnement);

            // Envoyer un e-mail de confirmation
            $mail = new PHPMailer(true);
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';                // Définir le serveur SMTP Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'calfados22@gmail.com';
            $mail->Password = 'gryztkkxaxvszbos';
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS


            $mail->setFrom('calfados22@gmail.com', 'karim');
            $mail->addAddress('mellouli.youssef11@gmail.com'); // Adresse e-mail de l'utilisateur

            $mail->Subject = 'Confirmation d\'abonnement';
            $mail->Body = "Vous avez souscrit à l'abonnement.\n\nID du Pack: $IDpackuser\n";

            $mail->send();

            header('Location: listAbonnements.php');
            exit();
           

        } catch (Exception $e) {
            $erreur = 'Erreur lors de l\'ajout de l\'abonnement : ' . $e->getMessage();
            $mail->SMTPDebug = 2; // Active le débogage SMTP détaillé
            $mail->Debugoutput = 'html'; // Affiche les informations de débogage dans le format HTML
        }
    } else {
        $erreur = 'Toutes les informations sont obligatoires.';
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonnement</title>
</head>

<body>
    <a href="listAbonnements.php">Back to list</a>
    <hr>

    <p><?php echo $erreur; ?></p>

    <form action="" method="POST">
        <label for="IDuser">ID User :</label>
        <input type="number" id="IDuser" name="IDuser" value="<?php echo $user['id']; ?>" readonly />
        <br>

        <?php
        $IDpackuser = $_GET['idPack'] ?? null;
        if ($IDpackuser) {
            echo '<input type="hidden" id="IDpackuser" name="IDpackuser" value="' . $IDpackuser . '" />';
        } else {
            echo '<label for="IDpackuser">ID Pack User :</label>';
            echo '<input type="number" id="IDpackuser" name="IDpackuser" required />';
        }
        ?>
        <br>

        <label for="dateabonnement">Date Abonnement :</label>
        <input type="text" id="dateabonnement" name="dateabonnement" value="<?php echo $dateActuelle; ?>" readonly />
        <br>

        <input type="hidden" id="payed" name="payed" value="1" />
        <br>

        <input type="submit" value="Save">
        <input type="reset" value="Reset">
    </form>
</body>

</html>
