<?php

include '../controller/reclamation.php';  // Inclure le bon contrôleur
include '../model/reclamation.php';  // Inclure le bon modèle

$error = "";

// Créer une instance du contrôleur
$reclamationController = new ReclamationController();

if (
    isset($_POST["typ"]) &&
    isset($_POST["description"]) &&
    isset($_POST["piece_jointe"]) &&
    isset($_POST["date_ajout"]) &&
    isset($_POST["etat"])
) {
    $typ = $_POST['typ'];
    $description = $_POST['description'];
    $piece_jointe = $_POST['piece_jointe'];
    $date_ajout = $_POST['date_ajout'];
    $etat = $_POST['etat'];

    // Validation de la saisie
    if (empty($typ) || empty($description) || empty($piece_jointe) || empty($date_ajout) || empty($etat)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        // Créer une réclamation
        $reclamation = new Reclamation(
            null,
            $typ,
            $description,
            $piece_jointe,
            $date_ajout,
            $etat
        );

        // Utiliser le contrôleur pour ajouter la réclamation
        $reclamationController->addReclamation($reclamation);
        header('Location: listReclamation.php');
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclamation</title>
</head>

<body>
    <a href="listReclamation.php">Retour à la liste</a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST">
        <table>
            <tr>
                <td><label for="typ">Type :</label></td>
                <td><input type="text" id="typ" name="typ" required /></td>
            </tr>
            <tr>
                <td><label for="description">Description :</label></td>
                <td><textarea id="description" name="description" required></textarea></td>
            </tr>
            <tr>
                <td><label for="piece_jointe">Pièce jointe :</label></td>
                <td><input type="text" id="piece_jointe" name="piece_jointe" required /></td>
            </tr>
            <tr>
                <td><label for="date_ajout">Date d'ajout :</label></td>
                <td><input type="date" id="date_ajout" name="date_ajout" required /></td>
            </tr>
            <tr>
                <td><label for="etat">État :</label></td>
                <td><input type="number" id="etat" name="etat" required /></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Enregistrer">
                </td>
                <td>
                    <input type="reset" value="Réinitialiser">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>
