<?php

include '../controller/PackC.php';
include '../model/Pack.php';

$error = "";

// Créez un objet Pack
$pack = null;
// Créez une instance du contrôleur PackC
$packC = new PackC();

if (
    isset($_POST["nompack"]) &&
    isset($_POST["description"]) &&
    isset($_POST["prix"]) &&
    isset($_POST["type"]) &&
    isset($_POST["disponibilite"]) &&
    isset($_POST["datedebut"]) &&
    isset($_POST["datefin"])
) {
    if (
        !empty($_POST['nompack']) &&
        !empty($_POST["description"]) &&
        !empty($_POST["prix"]) &&
        !empty($_POST["type"]) &&
        isset($_POST["disponibilite"]) &&
        !empty($_POST["datedebut"]) &&
        !empty($_POST["datefin"])
    ) {
        // Convertissez le champ disponibilite en entier (0 ou 1) en fonction de la case cochée
        $disponibilite = isset($_POST['disponibilite']) ? 1 : 0;

        // Créez un objet Pack avec les données du formulaire
        $pack = new Pack(
            $_POST['idPack'],
            $_POST['nompack'],
            $_POST['description'],
            $_POST['prix'],
            $_POST['type'],
            $disponibilite,
            $_POST['datedebut'],
            $_POST['datefin']
        );

        // Mettez à jour le pack en utilisant la méthode appropriée
        $packC->updatePack($pack, $_POST['idPack']);

        header('Location: listPacks.php');
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
    <title>Update Pack</title>
</head>

<body>
    <a href="listPacks.php">Back to list</a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_GET['id'])) {
        // Obtenez les détails du pack pour l'affichage initial dans le formulaire
        $pack = $packC->showPack($_GET['id']);
    ?>

        <form action="" method="POST">
            <input type="hidden" name="idPack" value="<?php echo $pack['IDpack']; ?>">
            <table>
                <tr>
                    <td><label for="nompack">Nom du Pack :</label></td>
                    <td>
                        <input type="text" id="nompack" name="nompack" value="<?php echo $pack['nompack']; ?>" />
                        <span id="erreurNomPack" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="description">Description :</label></td>
                    <td>
                        <textarea id="description" name="description" rows="10" cols="50"><?php echo $pack['description']; ?></textarea>
                        <span id="erreurDescription" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="prix">Prix :</label></td>
                    <td>
                        <input type="text" id="prix" name="prix" value="<?php echo $pack['prix']; ?>" />
                        <span id="erreurPrix" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="type">Type :</label></td>
                    <td>
                        <input type="text" id="type" name="type" value="<?php echo $pack['type']; ?>" />
                        <span id="erreurType" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="disponibilite">Disponibilité :</label></td>
                    <td>
                        <input type="checkbox" id="disponibilite" name="disponibilite" <?php echo ($pack['disponibilite'] == 1) ? 'checked' : ''; ?> />
                        <span id="erreurDisponibilite" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="datedebut">Date de début :</label></td>
                    <td>
                        <input type="date" id="datedebut" name="datedebut" value="<?php echo $pack['date_debut']; ?>" />
                        <span id="erreurDateDebut" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="datefin">Date de fin :</label></td>
                    <td>
                        <input type="date" id="datefin" name="datefin" value="<?php echo $pack['date_fin']; ?>" />
                        <span id="erreurDateFin" style="color: red"></span>
                    </td>
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
    <?php
    }
    ?>
</body>

</html>
