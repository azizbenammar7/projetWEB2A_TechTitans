<?php
include "../controller/reclamation.php";

$reclamationController = new ReclamationController();
$reclamations = $reclamationController->listReclamation();

?>

<center>
    <h1>List of Reclamations</h1>
    <h2>
        <a href="addReclamation.php">Add Reclamation</a>
    </h2>
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>Id Reclamation</th>
        <th>Type</th>
        <th>Description</th>
        <th>Piece Jointe</th>
        <th>Date d'Ajout</th>
        <th>Etat</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>

    <?php foreach ($reclamations as $reclamation) { ?>
        <tr>
            <td><?= $reclamation['id']; ?></td>
            <td><?= $reclamation['typ']; ?></td>
            <td><?= $reclamation['description']; ?></td>
            <td><?= $reclamation['piece_jointe']; ?></td>
            <td><?= $reclamation['date_ajout']; ?></td>
            <td><?= $reclamation['etat']; ?></td>
            <td align="center">
                <form method="POST" action="updateReclamation.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value="<?= $reclamation['id']; ?>" name="idReclamation">
                </form>
            </td>
            <td>
                <a href="deleteReclamation.php?id=<?= $reclamation['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
