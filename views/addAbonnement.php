<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../controller/AbonnementC.php';
include '../model/Abonnement.php';

$abonnementC = new AbonnementC();
$erreur = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $IDuser = $_POST['IDuser'] ?? null;
    $IDpackuser = $_POST['IDpackuser'] ?? null;
    $dateabonnement = $_POST['dateabonnement'] ?? null;
    $payed = $_POST['payed'] ?? null;

    // Validez les entrées si nécessaire

    if (!empty($IDuser) && !empty($IDpackuser) && !empty($dateabonnement) && isset($payed)) {
        $abonnement = new Abonnement($IDuser, $IDpackuser, $dateabonnement, $payed);

        try {
            $abonnementC->addAbonnement($abonnement);
            header('Location: listAbonnements.php');
            exit();
        } catch (Exception $e) {
            $erreur = 'Erreur lors de l\'ajout de l\'abonnement : ' . $e->getMessage();
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
        <input type="number" id="IDuser" name="IDuser" required />
        <br>

        <label for="IDpackuser">ID Pack User :</label>
        <input type="number" id="IDpackuser" name="IDpackuser" required />
        <br>

        <label for="dateabonnement">Date Abonnement :</label>
        <input type="date" id="dateabonnement" name="dateabonnement" required />
        <br>

        <label for="payed">Payed :</label>
        <input type="checkbox" id="payed" name="payed" value="1" />
        <br>

        <input type="submit" value="Save">
        <input type="reset" value="Reset">
    </form>
</body>

</html>
