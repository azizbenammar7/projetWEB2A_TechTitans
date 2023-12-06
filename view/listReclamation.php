<?php
include "../controller/reclamation.php";

$reclamationController = new ReclamationController();

// Récupérer la valeur du champ de saisie du type
$searchTyp = isset($_GET['searchTyp']) ? $_GET['searchTyp'] : null;

// Utilisez la fonction listReclamationByType avec le type comme paramètre
$reclamations = $reclamationController->listReclamationByType($searchTyp);

// Récupérer la valeur du champ de filtre d'état
$etat = isset($_GET['etat']) ? $_GET['etat'] : null;

if (!is_null($etat)) {
    // Utilisez la fonction getReclamationsByEtat avec l'état comme paramètre
    $reclamations = $reclamationController->getReclamationsByEtat($etat);
} else {
    // Si l'état n'est pas sélectionné, utilisez la fonction listReclamationByType
    $reclamations = $reclamationController->listReclamationByType($searchTyp);
}

// Vérifier si la requête est de type POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer la valeur du champ de saisie de la date
    $dateAjoutFilter = $_POST["dateAjoutFilter"];
    
    // Utilisez la fonction filterReclamationByDateAjout avec la date comme paramètre
    $reclamations = $reclamationController->filterReclamationByDateAjout($dateAjoutFilter);
    
}
?>


<?php include '../view/header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Reclamations</title>
    <!-- Ajoutez vos liens vers les fichiers CSS ici -->
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

        .container {
            margin: 50px; /* Ajustez la marge selon vos préférences */
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
        <style>
    .container {
        margin: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    form {
        display: flex;
        align-items: center;
        margin-right: 20px;
    }

    label {
        margin-right: 10px;
    }

    select, input[type="date"] {
        padding: 8px;
        margin-right: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        padding: 8px 15px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>

    </style>
</head>

<body>
    <header>
        <h1>List of Reclamations</h1>
        <h2><a href="addReclamation.php">Add Reclamation</a></h2>
    </header>

    <main>
        <!-- Conteneur pour les formulaires de filtrage -->
        <div class="container">
            <form action="" method="GET">
                <label for="searchTyp">Search by Type:</label>
                <select id="searchTyp" name="searchTyp">
                    <option value="">All</option>
                    <option value="médecin">Médecin</option>
                    <option value="pharmacien">Pharmacien</option>
                    <option value="patient">Patient</option>
                    <option value="médicament">Médicament</option>
                    <option value="autre">Autre</option>
                </select>
                <input type="submit" name="typeSubmit" value="Filter by Type">
            </form>

            <form method="post" action="">
                <label for="dateAjoutFilter">Filter by Date:</label>
                <input type="date" name="dateAjoutFilter">
                <input type="submit" value="Apply Filter">
            </form>

            <form action="" method="GET">
                <label for="etat">Filter by Etat:</label>
                <select id="etat" name="etat">
                    <option value="">All</option>
                    <option value="1">Etat Traite</option>
                    <option value="0">Etat non Traite</option>
                </select>
                <input type="submit" name="etatSubmit" value="Filter by Etat">
            </form>
        </div>

        <!-- Conteneur pour la liste des réclamations -->
        <div class="container">
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
                        <td>
                            <?php echo ($reclamation['etat'] == 1) ? 'Etat Traité' : 'Etat non Traité'; ?>
                        </td>
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
        </div>
    </main>
</body>

</html>

<?php include '../view/footer.php'; ?>
