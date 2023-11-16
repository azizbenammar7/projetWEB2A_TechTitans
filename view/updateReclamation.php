<?php

include '../controller/reclamation.php';
include '../model/reclamation.php';

$error = "";

// create reclamation
$reclamation = null;
// create an instance of the controller
$reclamationController = new ReclamationController();

if (
    isset($_POST["typ"]) &&
    isset($_POST["description"]) &&
    isset($_POST["piece_jointe"]) &&
    isset($_POST["date_ajout"]) &&
    isset($_POST["etat"])
) {
    if (
        !empty($_POST['typ']) &&
        !empty($_POST["description"]) &&
        !empty($_POST["piece_jointe"]) &&
        !empty($_POST["date_ajout"]) &&
        !empty($_POST["etat"])
    ) {
        $reclamation = new Reclamation(
            $_POST['idReclamation'],
            $_POST['typ'],
            $_POST['description'],
            $_POST['piece_jointe'],
            $_POST['date_ajout'],
            $_POST['etat']
        );

        $reclamationController->updateReclamation($reclamation, $_POST['idReclamation']);

        header('Location: listReclamation.php');
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
    <title>Reclamation Update</title>
</head>

<body>
    <button><a href="listReclamation.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['idReclamation'])) {
        $reclamation = $reclamationController->showReclamation($_POST['idReclamation']);
    ?>

        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="idReclamation">Id Reclamation :</label></td>
                    <td>
                        <input type="text" id="idReclamation" name="idReclamation" value="<?php echo $_POST['idReclamation'] ?>" readonly />
                        <span id="erreurIdReclamation" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="typ">Type :</label></td>
                    <td>
                        <input type="text" id="typ" name="typ" value="<?php echo $reclamation['typ'] ?>" />
                        <span id="erreurTyp" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="description">Description :</label></td>
                    <td>
                        <input type="text" id="description" name="description" value="<?php echo $reclamation['description'] ?>" />
                        <span id="erreurDescription" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="piece_jointe">Pièce Jointe :</label></td>
                    <td>
                        <input type="text" id="piece_jointe" name="piece_jointe" value="<?php echo $reclamation['piece_jointe'] ?>" />
                        <span id="erreurPieceJointe" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="date_ajout">Date d'Ajout :</label></td>
                    <td>
                        <input type="date" id="date_ajout" name="date_ajout" value="<?php echo $reclamation['date_ajout'] ?>" />
                        <span id="erreurDateAjout" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="etat">État :</label></td>
                    <td>
                        <input type="text" id="etat" name="etat" value="<?php echo $reclamation['etat'] ?>" />
                        <span id="erreurEtat" style="color: red"></span>
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
</body>

</html>
