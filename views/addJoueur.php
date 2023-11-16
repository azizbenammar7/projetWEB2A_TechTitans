<?php

include '../Controller/JoueurC.php';
include '../model/Joueur.php';

$error = "";

// create client
$fichepatient = null;

// create an instance of the controller
$FichepatientC = new FichepatientC();
if (
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["type_de_diabete"]) &&
    isset($_POST["valeur_hemoglobine_A1C"]) &&
    isset($_POST["valeur_glycemie_postprondiale"]) &&
    isset($_POST["valeur_creatinine_serique"]) &&
    isset($_POST["valeur_glycemie_a_jeun"]) &&
    isset($_POST["valeur_cholesterol"]) &&
    isset($_POST["valeur_hdl"]) &&
    isset($_POST["valeur_ldl"]) &&
    isset($_POST["valeur_trigleceride"]) &&
    isset($_POST["date_d_ajout_d_analyse"])
) {
    if (
        !empty($_POST["nom"]) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["type_de_diabete"]) &&
        !empty($_POST["valeur_hemoglobine_A1C"]) &&
        !empty($_POST["valeur_glycemie_postprondiale"]) &&
        !empty($_POST["valeur_creatinine_serique"]) &&
        !empty($_POST["valeur_glycemie_a_jeun"]) &&
        !empty($_POST["valeur_cholesterol"]) &&
        !empty($_POST["valeur_hdl"]) &&
        !empty($_POST["valeur_ldl"]) &&
        !empty($_POST["valeur_trigleceride"]) &&
        !empty($_POST["date_d_ajout_d_analyse"])
    ) {
        $fichepatient = new fichepatient(
            null,
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['type_de_diabete'],
            $_POST['valeur_hemoglobine_A1C'],
            $_POST['valeur_glycemie_postprondiale'],
            $_POST['valeur_creatinine_serique'],
            $_POST['valeur_glycemie_a_jeun'],
            $_POST['valeur_cholesterol'],
            $_POST['valeur_hdl'],
            $_POST['valeur_ldl'],
            $_POST['valeur_trigleceride'],
            $_POST['date_d_ajout_d_analyse']

        );
        $FichepatientC->addFichepatient($fichepatient);
        header('Location:listJoueurs.php');
    } else
        $error = "Missing information";
}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FichePatient </title>
</head>

<body>
    <a href="listJoueurs.php">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST">
        <table>
            <tr>
                <td><label for="nom">Nom :</label></td>
                <td>
                    <input type="text" id="nom" name="nom" />
                    <span id="erreurNom" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="prenom">Prénom :</label></td>
                <td>
                    <input type="text" id="prenom" name="prenom" />
                    <span id="erreurPrenom" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="type_de_diabete">Type de Diabète :</label></td>
                <td>
                    <input type="text" id="type_de_diabete" name="type_de_diabete" />
                </td>
            </tr>
            <tr>
                <td><label for="valeur_hemoglobine_A1C">Hémoglobine A1C :</label></td>
                <td>
                    <input type="number" id="valeur_hemoglobine_A1C" name="valeur_hemoglobine_A1C" />
                </td>
            </tr>
            <tr>
                <td><label for="valeur_glycemie_postprondiale">Glycémie Postprandiale :</label></td>
                <td>
                    <input type="number" id="valeur_glycemie_postprondiale" name="valeur_glycemie_postprondiale" />
                </td>
            </tr>
            <tr>
                <td><label for="valeur_creatinine_serique">Créatinine Sérique :</label></td>
                <td>
                    <input type="number" id="valeur_creatinine_serique" name="valeur_creatinine_serique" />
                </td>
            </tr>
            <tr>
                <td><label for="valeur_glycemie_a_jeun">Glycémie à Jeun :</label></td>
                <td>
                    <input type="number" id="valeur_glycemie_a_jeun" name="valeur_glycemie_a_jeun" />
                </td>
            </tr>
            <tr>
                <td><label for="valeur_cholesterol">Cholestérol :</label></td>
                <td>
                    <input type="number" id="valeur_cholesterol" name="valeur_cholesterol" />
                </td>
            </tr>
            <tr>
                <td><label for="valeur_hdl">HDL :</label></td>
                <td>
                    <input type="number" id="valeur_hdl" name="valeur_hdl" />
                </td>
            </tr>
            <tr>
                <td><label for="valeur_ldl">LDL :</label></td>
                <td>
                    <input type="number" id="valeur_ldl" name="valeur_ldl" />
                </td>
            </tr>
            <tr>
                <td><label for="valeur_trigleceride">Triglycérides :</label></td>
                <td>
                    <input type="number" id="valeur_trigleceride" name="valeur_trigleceride" />
                </td>
            </tr>
            <tr>
                <td><label for="date_d_ajout_d_analyse">Date d'ajout d'analyse :</label></td>
                <td>
                    <input type="date" id="date_d_ajout_d_analyse" name="date_d_ajout_d_analyse" />
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
</body>

</html>