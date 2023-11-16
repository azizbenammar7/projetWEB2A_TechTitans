<?php
include '../controller/PackC.php'; // Utilisez le contrôleur PackC au lieu de JoueurC
$packC = new PackC(); // Utilisez PackC au lieu de JoueurC
$list = $packC->listPacks(); // Utilisez listPacks au lieu de listjoueurs
?>
<html>
<body>
    <h1>List of packs</h1>
    <h2>
        <a href="addPack.php" target="_blank">Add pack</a> <!-- Modifiez le lien pour ajouter un pack -->
    </h2>

    <table border="1" align="center" width="70%">
        <tr>
            <th>Id Pack</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Type</th>
            <th>Disponibilite</th>
            <th>Date Debut</th>
            <th>Date Fin</th>
            <th>Action</th>
            <th>Delete</th>
        </tr>

        <?php foreach ($list as $pack) { ?>
            <tr>
                <td><?php echo $pack['IDpack'] ?></td>
                <td><?php echo $pack['nompack'] ?></td>
                <td><?php echo $pack['description'] ?></td>
                <td><?php echo $pack['prix'] ?></td>
                <td><?php echo $pack['type'] ?></td>
                <td><?php echo $pack['disponibilite'] ?></td>
                <td><?php echo $pack['date_debut'] ?></td>
                <td><?php echo $pack['date_fin'] ?></td>
                <td>
                    <!-- Ajoutez ici le lien pour mettre à jour un pack -->
                     <!-- Formulaire pour la mise à jour du pack -->
    <form action="updatePack.php" method="GET">
        <input type="hidden" name="id" value="<?php echo $pack['IDpack']; ?>">
    </form>
                    <a href="updatePack.php?id=<?php echo $pack['IDpack']; ?>">Update</a>
                </td>
                <td>
                    <a href="deletePack.php?id=<?php echo $pack['IDpack']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
