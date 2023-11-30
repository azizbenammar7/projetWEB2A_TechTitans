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
                    <input class="update-button" type="submit" name="update" value="Update">
                    <input type="hidden" value="<?= $publication['IDpub']; ?>" name="IDpublication">
                </form>
            </td>
                <td>
                <a class="delete-button"  href="delete_pub.php?IDpublication=<?= $publication['IDpub']; ?>">Delete</a>
                </td>
            </tr>
            <?php
    }
    ?>

    </table>
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
