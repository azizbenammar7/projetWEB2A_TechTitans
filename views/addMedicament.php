<?php

include '../controller/medicament.php';
include '../model/medicament.php';

$error = "";

// create an instance of the controller
$medicamentController = new MedicamentController();

if (
    isset($_POST["nom"]) &&
    isset($_POST["typ"]) &&
    isset($_POST["lieu"]) &&
    isset($_POST["dispon"]) &&
    isset($_POST["date_ajout"])
) {
    $nom = $_POST['nom'];
    $typ = $_POST['typ'];
    $lieu = $_POST['lieu'];
    $dispon = $_POST['dispon'];
    $date_ajout = $_POST['date_ajout'];

    // Validation de la saisie
    if (empty($nom) || empty($typ) || empty($lieu) || empty($dispon) || empty($date_ajout)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        // create medicament
        $medicament = new Medicament(
            null,
            $nom,
            $typ,
            $lieu,
            $dispon,
            $date_ajout  // Utilisez la date sélectionnée par l'utilisateur
        );

        // use the controller to add the medicament
        $medicamentController->addMedicament($medicament);
        header('Location: listMedicament.php');
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicament</title>
</head>

<body>
    <a href="listMedicament.php">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST">
        <table>
            <!-- Champ pour le nom -->
            <tr>
                <td><label for="nom">Nom:</label></td>
                <td><input type="text" id="nom" name="nom" required /></td>
            </tr>
            <!-- Champ pour le type -->
            <tr>
                <td><label for="typ">Type:</label></td>
                <td><input type="text" id="typ" name="typ" required /></td>
            </tr>
            <!-- Champ pour le lieu -->
            <tr>
                <td><label for="lieu">Lieu:</label></td>
                <td><input type="text" id="lieu" name="lieu" required /></td>
            </tr>
            <!-- Champ pour la disponibilité -->
            <tr>
                <td><label for="dispon">Disponibilité:</label></td>
                <td><input type="text" id="dispon" name="dispon" required /></td>
            </tr>
            <!-- Champ pour la date d'ajout -->
            <tr>
                <td><label for="date_ajout">Date d'ajout :</label></td>
                <td><input type="date" id="date_ajout" name="date_ajout" required /></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>
