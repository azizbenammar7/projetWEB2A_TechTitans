<?php
include '../model/reclamation.php';
include '../controller/reclamation.php';

session_start();

include '../controller/UserC.php';
include '../model/User.php';

$error = "";

// Créez une instance du contrôleur
$userC = new UserC();

// Créez une instance de la classe User
$user = null;
$user = $_SESSION['user_details'];

$reclamationController = new ReclamationController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $typ = $_POST['typ'];
    $description = $_POST['description'];
    $user1=$user['id'];

    // Initialiser la variable à null en dehors de la condition
    $piece_jointe_path = null;

    // Traitement de la pièce jointe si elle est fournie
    if (isset($_FILES["piece_jointe"]) && $_FILES["piece_jointe"]["error"] == UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . "/upload";
        $piece_jointe_path = $uploadDir . '/' . basename($_FILES["piece_jointe"]["name"]);
        move_uploaded_file($_FILES["piece_jointe"]["tmp_name"], $piece_jointe_path);
    }

    // Vérification des champs obligatoires seulement si un fichier n'est pas joint
    if (empty($typ) || empty($description) || empty($piece_jointe_path)) {
        $error = '<p style="color: blue; font-size: 1.5em; text-align: left; margin-left: 150px; margin-top: 100px;">Tous les champs sont obligatoires</p>';
    } else {
        // Création de la réclamation
        $date_ajout = date('Y-m-d');
        $etat = 0;
        $reclamation = new Reclamation(
            null, // L'id sera généré automatiquement
            $typ,
            $description,
            basename($piece_jointe_path), // Utilisez le nom du fichier uniquement, pas le chemin complet
            $date_ajout,
            $etat,
            $user1,
        );

        // Ajout de la réclamation
        $reclamationController->addReclamation($reclamation);

        // Redirection vers la liste des réclamations
        header('Location: addReclamation.php');
    }
}
?>
<?php include '../views/header.php';?>




<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclamation</title>
</head>

<style>
    #backToList {
        font-size: 18px; /* Modifiez la taille de la police selon vos préférences */
        /* Ajoutez d'autres styles si nécessaire, par exemple, la couleur, le soulignement, etc. */
    }
</style>

<body>
<button><a href="listReclamation.php">Retour à la liste</a></button>
    <hr>
    

    <div id="error">
        <?php echo $error; ?>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="bg-light rounded p-5">
                        <a href="contact.html" class="btn btn-primary d-inline-block border rounded-pill py-1 px-4">Contactez nous</a>
                        <h1 class="mb-4">Vous rencontrez un problème ? Réclamez le !</h1>
                        <div>
                            <label for="typ">Type :</label>
                            <select name="typ" id="typ" class="form-select mb-3" style="width: 100%;">
                                <option value="">Sélectionnez un type</option>
                                <option value="médecin">Médecin</option>
                                <option value="pharmacien">Pharmacien</option>
                                <option value="médicament">Médicament</option>
                                <option value="patient">Patient</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description">Description :</label>
                            <textarea id="description" name="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
    <label for="piece_jointe" class="form-label">Pièce jointe :</label>
    <input type="file" id="piece_jointe" name="piece_jointe" accept=".pdf, .doc, .docx, .png, .jpg, .jpeg" class="form-control">
    
</div>

                    </div>
                </div>
                <div class="col-lg-6">
                <div class="bg-light p-5 no-border">
    <h1 class="mb-4">Signalement d'incident</h1>
    <p class="mb-4">
        Bienvenue dans notre formulaire de signalement d'incident. Votre contribution est essentielle pour maintenir un environnement sûr et respectueux pour tous les utilisateurs. Veuillez remplir le formulaire ci-dessous avec autant de détails que possible. Toutes les informations fournies seront traitées de manière confidentielle.
    </p>






</div>

</div>

            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <input type="submit" value="Enregistrer" class="btn btn-primary">
                    <input type="reset" value="Réinitialiser" class="btn btn-secondary">
                </div>
            </div>
        </div>
    </div>
</form>

</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</body>

</html>



<?php include '../views/footer.php'; ?>