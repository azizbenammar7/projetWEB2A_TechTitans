<?php
include '../controller/reclamation.php';
include '../model/reclamation.php';

$error = "";
$reclamationController = new ReclamationController();

if (
    isset($_POST["typ"]) &&
    isset($_POST["description"]) &&
    isset($_FILES["piece_jointe"])
) {
    $typ = $_POST['typ'];
    $description = $_POST['description'];

    // Vérification de la nouvelle pièce jointe
    if (empty($_FILES["piece_jointe"]["name"])) {
        $error = '<p style="color: blue; font-size: 1.5em; text-align: left; margin-left: 150px; margin-top: 100px;">Tous les champs sont obligatoires</p>';
    }
    
     else {
        $uploadDir = __DIR__ . "/upload";
        $piece_jointe = null;
        $etat = 0;

        if ($_FILES['piece_jointe']['error'] == UPLOAD_ERR_OK) {
            $originalFilename = basename($_FILES['piece_jointe']['name']);
            $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);
            $uniqueFilename = uniqid() . '.' . $extension;
            $piece_jointe = $uniqueFilename;

            // Chemin du fichier dans le dossier "upload"
            $piece_jointe = $uploadDir . '/' . $uniqueFilename;

            if (move_uploaded_file($_FILES['piece_jointe']['tmp_name'], $piece_jointe)) {
                // Le déplacement a réussi
            } else {
                $error = "Erreur lors de l'upload de la pièce jointe.";
            }
        } else {
            $error = "Erreur lors du téléchargement du fichier.";
            // Affichez des détails supplémentaires si nécessaire
            $error .= 'Code d\'erreur : ' . $_FILES['piece_jointe']['error'];
        }

        $date_ajout = date('Y-m-d');

        $reclamation = new Reclamation(
            null,
            $typ,
            $description,
            basename($piece_jointe),
            $date_ajout,
            $etat
        );

        // Utilisez l'ID de la réclamation à mettre à jour
        $idReclamation = $_POST['idReclamation'];
        $reclamationController->updateReclamation($reclamation, $idReclamation);

        header('Location: listReclamation.php');
        exit();
    }
}
?>
<?php include '../view/header.php';?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclamation Update</title>
</head>

<body>
    <button><a href="listReclamation.php">Retour à la liste</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-light rounded p-5">
                        <a href="contact.html" class="btn btn-primary d-inline-block border rounded-pill py-1 px-4">Contactez nous</a>
                        <h1 class="mb-4">Vous rencontrez un problème ? Réclamez le !</h1>

                        <!-- Intégration de la partie "Reclamation Update" -->
                        <?php
                        if (isset($_POST['idReclamation'])) {
                            $reclamation = $reclamationController->showReclamation($_POST['idReclamation']);
                        ?>
                            <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                                <table>
                                    <tr>
                                        <td><label for="idReclamation">Id Reclamation :</label></td>
                                        <td>
                                            <input type="text" id="idReclamation" name="idReclamation" value="<?php echo $_POST['idReclamation'] ?>" readonly />
                                            <span id="erreurIdReclamation" style="color: red"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="typ">Type :</label></td>
                                        <td>
                                            <select id="typ" name="typ">
                                                <option value="">Sélectionnez un type</option>
                                                <option value="médecin" <?php echo ($reclamation['typ'] === 'médecin') ? 'selected' : ''; ?>>Médecin</option>
                                                <option value="pharmacien" <?php echo ($reclamation['typ'] === 'pharmacien') ? 'selected' : ''; ?>>Pharmacien</option>
                                                <option value="patient" <?php echo ($reclamation['typ'] === 'patient') ? 'selected' : ''; ?>>Patient</option>
                                                <option value="autre" <?php echo ($reclamation['typ'] === 'autre') ? 'selected' : ''; ?>>Autre</option>
                                            </select>
                                            <span id="erreurTyp" style="color: red"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td><label for="description">Description :</label></td>
<td>
    <textarea id="description" name="description" class="form-control" rows="3"><?php echo $reclamation['description']; ?></textarea>
    <span id="erreurDescription" style="color: red"></span>
</td>
                                    </tr>
                                    <tr>
                                        <td><label for="piece_jointe">Pièce Jointe actuelle :</label></td>
                                        <td>
                                            <?php if (!empty($reclamation['piece_jointe'])) { ?>
                                                <label><?= $reclamation['piece_jointe']; ?></label>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="piece_jointe">Nouvelle Pièce Jointe :</label></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <label for="update_piece_jointe" style="margin-right: 10px;"></label>
                                                <input type="file" id="update_piece_jointe" name="piece_jointe" accept=".pdf, .doc, .docx, .png, .jpg, .jpeg" />
                                            </div>
                                            <span id="erreurPieceJointe" style="color: red"></span>
                                        </td>
                                    </tr>
                                </table>
                                <div class="row mt-3">
                <div class="col-12">
                    <input type="submit" value="Enregistrer" class="btn btn-primary">
                    <input type="reset" value="Réinitialiser" class="btn btn-secondary">
                </div>
            </div>
                            </form>
                        <?php
                        }
                        ?>
                        <!-- Fin de la partie "Reclamation Update" -->
                    </div>
                </div>
                <!-- Partie droite : Signalement d'incident -->
                <div class="col-lg-6">
                    <div class="bg-light p-5 no-border">
                        <h1 class="mb-4">Signalement d'incident</h1>
                        <p class="mb-4">
                            Bienvenue dans notre formulaire de signalement d'incident. Votre contribution est essentielle pour maintenir un environnement sûr et respectueux pour tous les utilisateurs. Veuillez remplir le formulaire ci-dessous avec autant de détails que possible. Toutes les informations fournies seront traitées de manière confidentielle.
                        </p>
                        <img src="../view/img/signalmentbleu.png" alt="Description de l'image" style="width: 200px; position: relative; top: -200px; display: block; margin-left: auto; margin-right: auto;">
                    </div>
                </div>
                <!-- Fin de la partie "Signalement d'incident" -->
            </div>
        </div>
    </div>
</body>

</html>
<?php include '../view/footer.php'; ?>

