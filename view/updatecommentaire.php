<?php


include '../model/commentaire.php';
include '../controller/commentaireC.php';


$error = "";
$commentaireC= new commentaireC();


if (isset($_GET['IDcommentaire'])) {
    $IDcommentaire = $_GET['IDcommentaire'];

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $text_of_commentaire = $_POST['text_of_commentaire'];
       
        $publication = $_POST['publication'];

        
        if (empty($text_of_commentaire) || empty($publication)) {
            $error = "Veuillez remplir tous les champs.";
        } else {
            
            if (empty($text_of_commentaire)) {
                $error = "Veuillez saisir un commentaire.";
            }

           
            if (empty($publication)) {
                $error = "Veuillez saisir une valeur pour la publication.";
            } elseif (!ctype_digit($publication)) { 
                $error = "La publication doit être un nombre entier.";
            }

            
            if (empty($error)) {
                
                $commentaire = new commentaire(
                    $text_of_commentaire,
                    
                    (int)$publication
                );

                try {
                    
                    $commentaireC->updateCommentaire($commentaire, $IDcommentaire);

                    
                    header('Location: listcommentaire.php');
                    exit();
                } catch (Exception $e) {
                    
                    $error = "Erreur lors de la mise à jour de la commentaire : " . $e->getMessage();
                }
            }
        }
    }

    
    $selectedCommentaire = $commentaireC->getReponseById($IDcommentaire);

    if (!$selectedCommentaire) {
        
        header('Location: listcommentaire.php');
        exit();
    }
} else {
    header('Location: listcommentaire.php');
    exit();
}

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update commentaire</title>
</head>

<body>
    <h2>Update Commentaire</h2>

    <?php if (!empty($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="updatecommentaire.php?id=<?= IDcommentaire; ?>" method="POST">
        <label for="text_of_commentaire">text of comment :</label>
        <textarea id="text_of_commentaire" name="text_of_commentaire" rows="4" cols="50"><?php echo $selectedCommentaire['text_of_commentaire']; ?></textarea>


        <label for="publication">publication :</label>
        <input type="number" id="publication" name="publication" value="<?php echo $selectedCommentaire['publication']; ?>">
        <br>

        <input type="submit" value="Update Comment">
        <input type="reset" value="Réinitialiser" >
    </form>
</body>

</html>