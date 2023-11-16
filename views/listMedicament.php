<?php
include "../controller/medicament.php";

$medicamentController = new MedicamentController();
$medicaments = $medicamentController->listMedicament();

?>

<center>
    <h1>List of Medicaments</h1>
    <h2>
        <a href="addMedicament.php">Add Medicament</a>
    </h2>
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>Id Medicament</th>
        <th>Nom</th>
        <th>Type</th>
        <th>Lieu</th>
        <th>Disponibilité</th>
        <th>Date d'Ajout</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>

    <?php foreach ($medicaments as $medicament) { ?>
        <tr>
            <td><?= $medicament['id']; ?></td>
            <td><?= $medicament['nom']; ?></td>
            <td><?= $medicament['typ']; ?></td>
            <td><?= $medicament['lieu']; ?></td>
            <td><?= $medicament['dispon']; ?></td>
            <td><?= $medicament['date_ajout']; ?></td>
            <td align="center">
                <form method="POST" action="updateMedicament.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value="<?= $medicament['id']; ?>" name="idMedicament">
                </form>
            </td>
            <td>
                <a href="deleteMedicament.php?id=<?= $medicament['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
