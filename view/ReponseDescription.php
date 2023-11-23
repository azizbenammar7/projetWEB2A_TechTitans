<?php
// Inclure les fichiers nécessaires pour les réponses
include '../model/reponse.php';
include '../controller/reponse.php';

// Vérifier si l'ID de la réclamation est fourni dans l'URL
if (isset($_GET['id'])) {
    $idReclamation = $_GET['id'];

    // Récupérer les informations de la réponse associée à la réclamation
    $reponseController = new ReponseController();
    $selectedReponses = $reponseController->getReponsesByReclamation($idReclamation);

    // Vérifier si la réponse existe et afficher la description
    /*if (!empty($selectedReponses)) {
        echo '<h2>Réponses associées à la Réclamation</h2>';

        foreach ($selectedReponses as $selectedReponse) {
            echo '<p><strong>Description :</strong> ' . $selectedReponse['description'] . '</p>';
            // Ajoutez d'autres détails de la réponse ici
        }
    } else {
        echo '<p style="color: red;">Aucune réponse trouvée pour cette réclamation.</p>';
    }*/

    // Reste du code pour afficher les détails de la réponse
    // ...
} else {
    // Redirection si l'ID de la réclamation n'est pas fourni
    header('Location: listReclamation.php');
    exit();
}
?>

<?php include '../view/header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reponse Description</title>
</head>

<body>
    <!-- Placez le contenu directement ici pour qu'il apparaisse dans le corps de la page -->
    <?php if (!empty($selectedReponses)) : ?>
        <h2>Réponses associées à la Réclamation</h2>

        <?php foreach ($selectedReponses as $selectedReponse) : ?>
            <p><strong>Description :</strong> <?= $selectedReponse['description']; ?></p>
            <!-- Ajoutez d'autres détails de la réponse ici -->
        <?php endforeach; ?>

    <?php else : ?>
        <h2>Réponses associées à la Réclamation</h2>
        <p style="color: red;">Aucune réponse trouvée pour cette réclamation.</p>
    <?php endif; ?>

</body>

</html>

<?php include '../view/footer.php'; ?>
