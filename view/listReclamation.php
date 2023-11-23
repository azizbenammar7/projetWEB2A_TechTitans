<?php
include "../controller/reclamation.php";

$reclamationController = new ReclamationController();
$reclamations = $reclamationController->listReclamation();
?>

<?php include '../view/header.php'; ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List of Reclamations</title>
    <!-- Ajoutez ces styles -->
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        header {
            text-align: center;
            padding: 20px;
        }

        main {
            flex: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Reclamations</title>
    <!-- Ajoutez vos liens vers les fichiers CSS ici -->
</head>

<body>
    <header>
        <h1>List of Reclamations</h1>
        <h2><a href="addReclamation.php">Add Reclamation</a></h2>
    </header>

    <main>
        <table border="1" align="center">
            <tr>
                <th>Id Reclamation</th>
                <th>Type</th>
                <th>Description</th>
                <th>Piece Jointe</th>
                <th>Date d'Ajout</th>
                <th>Etat</th>
                <th>Update</th>
                <th>Delete</th>
                <th>Réponse</th> <!-- Nouvelle colonne pour la Réponse -->
            </tr>
            <?php foreach ($reclamations as $reclamation) { ?>
                <tr>
                    <td><?= $reclamation['id']; ?></td>
                    <td><?= $reclamation['typ']; ?></td>
                    <td><?= $reclamation['description']; ?></td>
                    <td>
                        <a href="../view/download.php?filename=<?= rawurlencode($reclamation['piece_jointe']); ?>" download="<?= $reclamation['piece_jointe']; ?>">
                            <?= $reclamation['piece_jointe']; ?>
                        </a>
                    </td>
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
                    <td>
                            <a href="ReponseDescription.php?id=<?= $reclamation['id']; ?>">Voir la Réponse</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </main>
</body>

</html>

<?php include '../view/footer.php'; ?>