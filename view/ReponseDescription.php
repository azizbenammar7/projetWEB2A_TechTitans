<?php
// Inclure les fichiers nécessaires pour les réponses
include '../model/reponse.php';
include '../controller/reponse.php';
include '../controller/reclamation.php';

$error = "";
$reclamationController = new ReclamationController();

// Vérifier si l'ID de la réclamation est fourni dans l'URL
if (isset($_GET['id'])) {
    $reclamation = $_GET['id'];

    try {
        // Récupérer les informations de la réponse associée à la réclamation
        $reponseController = new ReponseController();
        $selectedReponses = $reponseController->getReponsesByReclamation($reclamation);

        // Mettre à jour l'état de la réclamation en fonction du nombre de réponses
        $nouvelEtat = $reclamationController->updateEtatIfResponsesExist($reclamation);

        // Afficher la nouvelle valeur de l'état
        echo "Nouvel état : " . $nouvelEtat;

        // Mise à jour de l'état de la réclamation

    } catch (Exception $e) {
        // Gérer les erreurs
        echo "Erreur : " . $e->getMessage();
    }

    // ... autres codes ...
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