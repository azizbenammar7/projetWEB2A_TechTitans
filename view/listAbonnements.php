<?php
include '../controller/AbonnementC.php';
$abonnementC = new AbonnementC();
$list = $abonnementC->listAbonnements();
?>

<html>
<body>
    <h1>List of Abonnements</h1>
    <h2>
        <a href="addAbonnement.php" target="_blank">Add Abonnement</a>
    </h2>

    <table border="1" align="center" width="70%">
        <tr>
            <th>ID User</th>
            <th>ID Pack User</th>
            <th>Date Abonnement</th>
            <th>Payed</th>
            <th>Action</th>
            <th>Delete</th>
        </tr>

        <?php foreach ($list as $abonnement) { ?>
            <tr>
                <td><?php echo $abonnement['IDuser']; ?></td>
                <td><?php echo $abonnement['IDpackuser']; ?></td>
                <td><?php echo $abonnement['dateabonnement']; ?></td>
                <td><?php echo $abonnement['payed']; ?></td>
                <td>
                    <a href="updateAbonnement.php?id=<?php echo $abonnement['IDabonnement']; ?>">Update</a>
                </td>
                <td>
                    <a href="deleteAbonnement.php?id=<?php echo $abonnement['IDabonnement']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
