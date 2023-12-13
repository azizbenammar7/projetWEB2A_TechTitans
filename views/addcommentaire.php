<?php

// Inclure les fichiers nécessaires
include '../model/commentaire.php';
include '../controller/commentaireC.php';

// Initialiser les variables
$error = "";
$commentaireC = new commentaireC();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $text_of_commentaire = $_POST['text_of_commentaire'];
    $publication = $_POST['publication'];

    // Vérifier si tous les champs sont remplis
    if (empty($text_of_commentaire) || empty($publication)) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        // Si tous les champs sont remplis, procédez à la création de l'instance de Commentaire
        // et à l'ajout à la base de données
        $commentaire = new Commentaire(
            null,
            $text_of_commentaire,
            (int)$publication
        );

        try {
            // Ajouter le commentaire à la base de données
            $commentaireC->addcommentaire($commentaire);

            // Redirection après l'ajout du commentaire
            header('Location: listcommentaire.php');
            exit();
        } catch (Exception $e) {
            // Gestion de l'erreur
            $error = "Erreur lors de l'ajout du commentaire : " . $e->getMessage();
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un commentaire</title>
</head>

<body>
    <h2>Ajouter une Réponse</h2>

    <?php if (!empty($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="addcommentaire.php" method="POST">
        <label for="text_of_commentaire">text of commentaire :</label>
        <textarea id="text_of_commentaire" name="text_of_commentaire" rows="4" cols="50"></textarea>
        



        <label for="publication">Publication :</label>
        <input type="number" id="publication" name="publication">
        <br>

        <input type="submit" value="Ajouter la commentaire">
        <input type="reset" value="Réinitialiser" >
    </form>
</body>

</html>