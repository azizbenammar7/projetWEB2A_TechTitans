<?php
// Inclure les fichiers nécessaires pour les réponses
include '../model/reponse.php';
include '../controller/reponse.php';
include '../controller/reclamation.php';

// Démarrer la session
session_start();

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

    } catch (Exception $e) {
        // Gérer les erreurs
        echo "Erreur : " . $e->getMessage();
    }
}

// Utilisez la fonction et stockez l'ID de la réponse mis à jour
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['satisfaction']) && is_array($_POST['satisfaction'])) {
    foreach ($_POST['satisfaction'] as $idReponse => $satisfactions) {
        // Enregistrez la satisfaction dans la session
        $_SESSION['satisfaction'][$idReponse] = $satisfactions;

        // Enregistrez également la satisfaction dans la base de données
        if (is_array($satisfactions)) {
            $satisfaction = implode(", ", $satisfactions); // Convertir le tableau en chaîne

            // Instancier l'objet ReponseController
            $reponseController = new ReponseController();


// Appeler la fonction updateSatisfaction et stocker l'ID mis à jour
$idReponseMisAJour = $reponseController->updateSatisfaction($idReponse, $satisfaction);

// Stocker la satisfaction dans la session
if ($idReponseMisAJour !== null) {
    $_SESSION['satisfaction'][$idReponse] = $satisfaction;
    echo "ID de la réponse mise à jour : " . $idReponseMisAJour;
} else {
    echo "Erreur lors de la mise à jour de la satisfaction pour la réponse d'ID : " . $idReponse;
}
        }
    }
}
?>



<?php include '../view/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
    <style>
/* Styles pour les boutons radio de satisfaction */
/* Styles pour le conteneur de la description et de la satisfaction */
/* Styles pour la description */
.description-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 10px;
}

/* Styles pour la satisfaction radio group */
.satisfaction-radio-group {
    display: flex;
    gap: 10px;
}

.satisfaction-radio-label {
    font-weight: bold;
    margin-right: 5px;
}

.satisfaction-radio {
    appearance: none;
    border: 2px solid #007bff;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    margin: 0;
    cursor: pointer;
}

.satisfaction-radio:checked {
    background-color: #007bff;
}

</style>

</style>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reponse Description</title>
</head>

<body>
    <!-- Placez le contenu directement ici pour qu'il apparaisse dans le corps de la page -->
    <?php if (!empty($selectedReponses)) : ?>
        <h2>Réponses associées à la Réclamation</h2>

        <form method="post" action="">
        <form action="traiterSatisfaction.php" method="post">
        
        <?php foreach ($selectedReponses as $selectedReponse) : ?>
            <div class="description-container">
    <p><strong>Description :</strong> <?= $selectedReponse['description']; ?></p>

    <!-- Utiliser des boutons radio pour la satisfaction -->
    <div class="satisfaction-radio-group">
        <label class="satisfaction-radio-label" for="satisfaction<?= $selectedReponse['idreponse']; ?>">Satisfaction :</label>
        <input class="satisfaction-radio" type="radio" name="satisfaction[<?= $selectedReponse['idreponse']; ?>]" value="Non satisfaisante" <?php echo (isset($_SESSION['satisfaction'][$selectedReponse['idreponse']]) && $_SESSION['satisfaction'][$selectedReponse['idreponse']] == 'Non satisfaisante') ? 'checked' : ''; ?>>Non satisfaisante
        <input class="satisfaction-radio" type="radio" name="satisfaction[<?= $selectedReponse['idreponse']; ?>]" value="Moyennement satisfaisante" <?php echo (isset($_SESSION['satisfaction'][$selectedReponse['idreponse']]) && $_SESSION['satisfaction'][$selectedReponse['idreponse']] == 'Moyennement satisfaisante') ? 'checked' : ''; ?>>Moyennement satisfaisante
        <input class="satisfaction-radio" type="radio" name="satisfaction[<?= $selectedReponse['idreponse']; ?>]" value="Satisfaisante" <?php echo (isset($_SESSION['satisfaction'][$selectedReponse['idreponse']]) && $_SESSION['satisfaction'][$selectedReponse['idreponse']] == 'Satisfaisante') ? 'checked' : ''; ?>>Satisfaisante
    </div>
</div>

    <!-- Ajoutez d'autres détails de la réponse ici -->
    <br><br>
<?php endforeach; ?>


            <!-- Ajouter un bouton de soumission pour traiter la satisfaction -->
            <input type="submit" value="Traiter Satisfaction">
        </form>

    <?php else : ?>
        <h2>Réponses associées à la Réclamation</h2>
        <p style="color: red;">Aucune réponse trouvée pour cette réclamation.</p>
    <?php endif; ?>

</body>

</html>

<?php include '../view/footer.php'; ?>