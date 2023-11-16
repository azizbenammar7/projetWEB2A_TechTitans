<?php
include '../controller/PackC.php'; // Utilisez le contrôleur PackC au lieu de JoueurC
include '../model/Pack.php'; // Utilisez le modèle Pack au lieu de Joueur

$packC = new PackC();
$erreur = null;

if (
    isset($_POST['nom']) && isset($_POST['description'])
    && isset($_POST['prix']) && isset($_POST['type'])
    && isset($_POST['disponibilite']) && isset($_POST['datedebut'])
    && isset($_POST['datefin'])
) {
    if (
        !empty($_POST['nom']) && !empty($_POST['description'])
        && !empty($_POST['prix']) && !empty($_POST['type'])
        && isset($_POST['disponibilite']) && !empty($_POST['datedebut'])
        && !empty($_POST['datefin'])
    ) {
        
        // Convertissez le champ disponibilite en entier (0 ou 1) en fonction de la case cochée
        $disponibilite = isset($_POST['disponibilite']) ? 1 : 0;

        $pack = new pack(
            null,
            $_POST['nom'],
            $_POST['description'],
            $_POST['prix'],
            $_POST['type'],
            $disponibilite,
            $_POST['datedebut'],
            $_POST['datefin']
        );
        $packC->addPack($pack);
        header('Location: listPacks.php');
    } else {
        $erreur = "Missing information";
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pack</title>
</head>

<body>
    <a href="listPacks.php">Back to list</a>
    <hr>

    <p><?php echo $erreur; ?></p>

    <form action="" method="POST">
        <table>
            <tr>
                <td><label for="nom">Nom du Pack :</label></td>
                <td>
                    <input type="text" id="nom" name="nom" required />
                    <span id="erreurNom" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="description">Description :</label></td>
                <td>
                    <textarea id="description" name="description" rows="10" cols="50"></textarea>
                    <span id="erreurDescription" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="prix">Prix :</label></td>
                <td>
                    <input type="text" id="prix" name="prix" required/>
                    <span id="erreurPrix" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="type">Type :</label></td>
                <td>
                    <input type="text" id="type" name="type" required/>
                    <span id="erreurType" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="disponibilite">Disponibilité :</label></td>
                <td>
                    <input type="checkbox" id="disponibilite" name="disponibilite" required/>
                    <span id="erreurDisponibilite" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="datedebut">Date de début :</label></td>
                <td>
                    <input type="date" id="datedebut" name="datedebut" required/>
                    <span id="erreurDateDebut" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="datefin">Date de fin :</label></td>
                <td>
                    <input type="date" id="datefin" name="datefin" required/>
                    <span id="erreurDateFin" style="color: red"></span>
                </td>
            </tr>

            <td>
                <input type="submit" value="ajouter">
            </td>
            <td>
                <input type="reset" value="Reset">
            </td>
        </table>

    </form>
</body>

</html>
