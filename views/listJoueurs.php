<?php
include "../controller/JoueurC.php";

$FichepatientC = new FichepatientC();
$fichepatients = $FichepatientC->listFichepatient();

?>

<center>
    <h1>Liste des fiches patients </h1>
    <h2>
        <a href="addJoueur.php">Ajouter une fiche</a>
    </h2>
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>Id fiche patient</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>type_de_diabete</th>
        <th>valeur_hemoglobine_A1C</th>
        <th>valeur_glycemie_postprondiale</th>
        <th>valeur_creatinine_serique</th>
        <th>valeur_glycemie_a_jeun</th>
        <th>valeur_cholesterol</th>
        <th>valeur_hdl</th>
        <th>valeur_ldl</th>
        <th>valeur_trigleceride</th>
        <th>date_d_ajout_d_analyse</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>


    <?php
    foreach ($fichepatients as $fichepatient) {
    ?>




        <tr>
            <td><?= $fichepatient['id']; ?></td>
            <td><?= $fichepatient['nom']; ?></td>
            <td><?= $fichepatient['prenom']; ?></td>
            <td><?= $fichepatient['type_de_diabete']; ?></td>
            <td><?= $fichepatient['valeur_hemoglobine_A1C']; ?></td>
            <td><?= $fichepatient['valeur_glycemie_postprondiale']; ?></td>
            <td><?= $fichepatient['valeur_creatinine_serique']; ?></td>
            <td><?= $fichepatient['valeur_glycemie_a_jeun']; ?></td>
            <td><?= $fichepatient['valeur_cholesterol']; ?></td>
            <td><?= $fichepatient['valeur_hdl']; ?></td>
            <td><?= $fichepatient['valeur_ldl']; ?></td>
            <td><?= $fichepatient['valeur_trigleceride']; ?></td>
            <td><?= $fichepatient['date_d_ajout_d_analyse']; ?></td>
            <td align="center">
                <form method="POST" action="updateJoueur.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value="<?= $fichepatient['id']; ?>" name="id">                </form>
            </td>
            <td>
                <a href="deleteJoueur.php?id=<?= $fichepatient['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>