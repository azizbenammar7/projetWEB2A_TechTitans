<?php
include "../controller/userC.php";

$c = new userC();
$tab = $c->listusers();

?>

<center>
    <h1>List of users</h1>
    <h2>
        <a href="adduser.php">Add user</a>
    </h2>
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>Id user</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Email</th>
        <th>Tel</th>
        <th>Role</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>


    <?php
    foreach ($tab as $user) {
    ?>




        <tr>
            <td><?= $user['idJoueur']; ?></td>
            <td><?= $user['nom']; ?></td>
            <td><?= $user['prenom']; ?></td>
            <td><?= $user['email']; ?></td>
            <td><?= $user['tel']; ?></td>
            <td><?= $user['role']; ?></td>
            <td align="center">
                <form method="POST" action="updateuser.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $user['idJoueur']; ?> name="idJoueur">
                </form>
            </td>
            <td>
            <a href="deleteuser.php?id=<?= $user['idJoueur'] ?>">Delete</a>

            </td>
        </tr>
    <?php
    }
    ?>
</table>