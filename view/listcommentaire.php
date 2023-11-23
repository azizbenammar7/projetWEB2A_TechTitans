<?php
include '../controller/commentaireC.php';

$commentaireC = new CommentaireC();
$commentaires = $commentaireC->listCommentaires();  
?>

<html>

<head>
    <title>List of Comments</title>
</head>

<body>
    <h1>List of Comments</h1>
    <h2>
        <a href="addcommentaire.php">Add Comment</a>
    </h2>

    <table border="1" align="center" width="70%">
        <tr>
            <th>ID Comment</th>
            <th>Text of Comment</th>
            <th>Publication ID</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>

        <?php 
        foreach ($commentaires as $commentaire) {
        ?>
            <tr>
                <td><?= $commentaire['IDcommentaire']; ?></td>
                <td><?= $commentaire['text_of_commentaire']; ?></td>
                <td><?= $commentaire['publication']; ?></td>
                <td align="center">
                    <form method="POST" action="updatecommentaire.php">
                        <input type="submit" name="update" value="Update">
                        <input type="hidden" value="<?= $commentaire['IDcommentaire']; ?>" name="IDcommentaire">
                    </form>
                </td>
                <td>
                    <a href="deletecommentaire.php?IDcommentaire=<?= $commentaire['IDcommentaire']; ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>
