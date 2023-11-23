<?php
include '../controller/pubC.php';


$pubC = new pubC();
$publications = $pubC->listpublications();  


?>


<html>

<head>
    <title>List of Publications</title>
</head>

<body>
    <h1>List of Publications</h1>
    <h2>
        <a href="addpublication.php">Add Publication</a>
    </h2>

    <table border="1" align="center" width="70%">
        <tr>
            <th>ID Publication</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Email</th>
            <th>Role</th>
            <th>Text of Publication</th>
            <th>Date of Publication</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>

        <?php 
        foreach ($publications as $publication) 
    {
            
        ?>



            <tr>
                <td><?= $publication['IDpub']; ?></td>
                <td><?= $publication['nom']; ?></td>
                <td><?= $publication['prenom']; ?></td>
                <td><?= $publication['email']; ?></td>
                <td><?= $publication['role']; ?></td>
                <td><?= $publication['text_of_pub']; ?></td>
                <td><?= $publication['date_pub']; ?></td>
                <td align="center">
                <form method="POST" action="update_pub.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value="<?= $publication['IDpub']; ?>" name="IDpublication">
                </form>
            </td>
                <td>
                <a href="delete_pub.php?IDpublication=<?= $publication['IDpub']; ?>">Delete</a>
                </td>
            </tr>
            <?php
    }
    ?>

    </table>
</body>

</html>
