<?php

include '../controller/medicament.php';
include '../model/medicament.php';

$error = "";

// create medicament
$medicament = null;
// create an instance of the controller
$medicamentController = new MedicamentController();

if (
    isset($_POST["idMedicament"]) &&
    isset($_POST["nom"]) &&
    isset($_POST["typ"]) &&
    isset($_POST["lieu"]) &&
    isset($_POST["dispon"]) &&
    isset($_POST["date_ajout"])
) {
    if (
        !empty($_POST['idMedicament']) &&
        !empty($_POST["nom"]) &&
        !empty($_POST['typ']) &&
        !empty($_POST["lieu"]) &&
        !empty($_POST["dispon"]) &&
        !empty($_POST["date_ajout"])
    ) {
        $medicament = new Medicament(
            $_POST['idMedicament'],
            $_POST['nom'],
            $_POST['typ'],
            $_POST['lieu'],
            $_POST['dispon'],
            $_POST['date_ajout']
        );

        $medicamentController->updateMedicament($medicament, $_POST['idMedicament']);

        header('Location: listMedicament.php');
        exit(); // Assurez-vous de quitter l'exécution après la redirection
    } else {
        $error = "Missing information";
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicament Update</title>
</head>

<body>
    <button><a href="listMedicament.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['idMedicament'])) {
        $medicament = $medicamentController->showMedicament($_POST['idMedicament']);
    ?>

        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="idMedicament">Id Medicament :</label></td>
                    <td>
                        <input type="text" id="idMedicament" name="idMedicament" value="<?php echo $_POST['idMedicament'] ?>" readonly />
                        <span id="erreurIdMedicament" style="color: red"></span>
                    </td>
                </tr>
                <!-- Ajout du champ "nom" -->
                <tr>
                    <td><label for="nom">Nom :</label></td>
                    <td>
                        <input type="text" id="nom" name="nom" value="<?php echo $medicament['nom']; ?>" />
                        <span id="erreurNom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="typ">Type :</label></td>
                    <td>
                        <input type="text" id="typ" name="typ" value="<?php echo $medicament['typ'] ?>" />
                        <span id="erreurTyp" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="lieu">Lieu :</label></td>
                    <td>
                        <input type="text" id="lieu" name="lieu" value="<?php echo $medicament['lieu'] ?>" />
                        <span id="erreurLieu" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="dispon">Disponibilité :</label></td>
                    <td>
                        <input type="text" id="dispon" name="dispon" value="<?php echo $medicament['dispon'] ?>" />
                        <span id="erreurDispon" style="color: red"></span>
                    </td>
                </tr>
                <!-- Ajout du champ "date_ajout" -->
                <tr>
                    <td><label for="date_ajout">Date d'ajout :</label></td>
                    <td>
                        <input type="date" id="date_ajout" name="date_ajout" value="<?php echo $medicament['date_ajout']; ?>" />
                        <span id="erreurDateAjout" style="color: red"></span>
                    </td>
                </tr>

                <td>
                    <input type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </table>

        </form>
    <?php
    }
    ?>
</
