<?php
include '../controller/commentaireC.php';

$commentaireC = new CommentaireC();
$commentaires = $commentaireC->listCommentaires();  


// Retrieve the IDpublication from the URL
$IDpublication = isset($_GET['IDpublication']) ? $_GET['IDpublication'] : null;

// List comments based on the IDpublication
$commentaires = $commentaireC->listCommentairesByPublication($IDpublication);
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
    <div id="comment-list-container">

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
                        <input class="update-button" type="submit" name="update" value="Update">
                        <input type="hidden" value="<?= $commentaire['IDcommentaire']; ?>" name="IDcommentaire">
                    </form>
                </td>
                <td>
                    <a class="delete-button" href="deletecommentaire.php?IDcommentaire=<?= $commentaire['IDcommentaire']; ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    </div>
</body>

</html>


<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

table {
    border-collapse: collapse;
    width: 70%;
    margin: 20px auto;
}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #4caf50;
    color: white;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f5f5f5;
}

.delete-button {
    background-color: #e74c3c;
    color: #fff;
    border: none;
    padding: 5px 10px;
    text-decoration: none;
    cursor: pointer;
}

.update-button {
    background-color: #2ecc71;
    color: #fff;
    border: none;
    padding: 5px 10px;
    text-decoration: none;
    cursor: pointer;
}
</style>