<?php
include '../controller/Medicament.php';
include '../model/Medicament.php';
include '../controller/TypeController.php';

$error = "";

// Créez une instance du contrôleur
$medicamentController = new MedicamentController();

// Créez une instance de la classe Medicament
$medicament = null;

// Créez une instance du contrôleur de types
$typeController = new TypeController();

// Récupérez la liste des types disponibles
$types = $typeController->listType();

// Vérifiez si le formulaire a été soumis
if (
    isset($_POST["idMedicament"]) &&
    isset($_POST["nom"]) &&
    isset($_POST["typ"]) &&
    isset($_POST["lieu"]) &&
    isset($_POST["dispon"]) &&
    isset($_POST["date_ajout"])
) {
    // Vérifiez si des champs obligatoires sont vides
    if (
        !empty($_POST["nom"]) &&
        !empty($_POST['typ']) &&
        !empty($_POST["lieu"]) &&
        !empty($_POST["dispon"]) &&
        !empty($_POST["date_ajout"])
    ) {
        // Récupérez les valeurs du formulaire
        $idMedicament = $_POST['idMedicament']; // Garder l'ID d'origine
        $nom = $_POST['nom'];
        $typ = $_POST['typ'];
        $lieu = $_POST['lieu'];
        $dispon = $_POST['dispon'];
        $date_ajout = $_POST['date_ajout'];

        // Vérifiez si une nouvelle pièce jointe a été fournie
        $newPieceJointe = null;
        if ($_FILES['new_piece_jointe']['error'] == UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . basename($_FILES['new_piece_jointe']['name']);

            if (move_uploaded_file($_FILES['new_piece_jointe']['tmp_name'], $uploadFile)) {
                $newPieceJointe = $uploadFile;
            } else {
                $error = "Erreur lors de l'upload de la nouvelle pièce jointe.";
            }
        }

        // Créez une instance de la classe Medicament
        $medicament = new Medicament(
            $idMedicament,
            $nom,
            $typ,
            $lieu,
            $dispon,
            $date_ajout,
            $newPieceJointe
        );

        // Utilisez le contrôleur pour mettre à jour le médicament
        $medicamentController->updateMedicament($medicament, $idMedicament);

        // Redirigez directement vers la liste des médicaments
        header('Location: listMedicament.php');
        exit(); // Assurez-vous de quitter l'exécution après la redirection
    } else {
        $error = "Veuillez renseigner tous les champs obligatoires.";
    }
}

// Récupérez les informations du médicament à afficher dans le formulaire
if (isset($_POST['idMedicament'])) {
    $medicament = $medicamentController->showMedicament($_POST['idMedicament']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicament Update</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
        body {
            background-color: #E2E2E2;
        }

        .form-style {
            background-color: #D9EDF7; /* Couleur bleu ciel */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            width: 60%; /* Largeur du formulaire */
            margin: auto; /* Centrer le formulaire */
        }

        .form-style label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-style input[type="text"],
        .form-style select {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-style input[type="submit"],
        .form-style input[type="reset"] {
            background-color: #5BC0DE; /* Couleur bleu ciel plus foncée */
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <button><a href="listMedicament.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if ($medicament) {
    ?>

        <div class="form-style">
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="idMedicament">Id Medicament :</label>
                <input type="text" id="idMedicament" name="idMedicament" value="<?php echo $medicament['id']; ?>" readonly />
                <span id="erreurIdMedicament" style="color: red"></span>

                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?php echo $medicament['nom']; ?>" />
                <span id="erreurNom" style="color: red"></span>

                <label for="typ">Type :</label>
                <select id="typ" name="typ">
                    <?php foreach ($types as $type) { ?>
                        <option value="<?php echo $type['id']; ?>" <?php echo ($medicament['typ'] == $type['id']) ? 'selected' : ''; ?>>
                            <?php echo $type['typ']; ?>
                        </option>
                    <?php } ?>
                </select>
                <span id="erreurTyp" style="color: red"></span>

                <label for="lieu">Lieu :</label>
<select id="lieu" name="lieu">
    <option value="Gbeli" <?php echo ($medicament['lieu'] == 'Gbeli') ? 'selected' : ''; ?>>Gbeli</option>
    <option value="Gafsa" <?php echo ($medicament['lieu'] == 'Gafsa') ? 'selected' : ''; ?>>Gafsa</option>
    <option value="Jandouba" <?php echo ($medicament['lieu'] == 'Jandouba') ? 'selected' : ''; ?>>Jandouba</option>
    <option value="Bizerte" <?php echo ($medicament['lieu'] == 'Bizerte') ? 'selected' : ''; ?>>Bizerte</option>
    <option value="Beja" <?php echo ($medicament['lieu'] == 'Beja') ? 'selected' : ''; ?>>Beja</option>
    <option value="Kairouan" <?php echo ($medicament['lieu'] == 'kairaoun') ? 'selected' : ''; ?>>Kairouan</option>
    <option value="Sidi Bouzid" <?php echo ($medicament['lieu'] == 'Sidi Bouzid') ? 'selected' : ''; ?>>Sidi Bouzid</option>
    <option value="Sfax" <?php echo ($medicament['lieu'] == 'Sfax') ? 'selected' : ''; ?>>Sfax</option>
    <option value="Gabes" <?php echo ($medicament['lieu'] == 'Gabes') ? 'selected' : ''; ?>>Gabes</option>
    <option value="Medenine" <?php echo ($medicament['lieu'] == 'Medenine') ? 'selected' : ''; ?>>Medenine</option>
    <option value="Monastir" <?php echo ($medicament['lieu'] == 'Monastir') ? 'selected' : ''; ?>>Monastir</option>
    <option value="Sousse" <?php echo ($medicament['lieu'] == 'Sousse') ? 'selected' : ''; ?>>Sousse</option>
</select>
<span id="erreurLieu" style="color: red"></span>


                <label for="dispon">Disponibilité :</label>
<select id="dispon" name="dispon">
    <option value="disponible" <?php echo ($medicament['dispon'] === 'disponible') ? 'selected' : ''; ?>>disponible</option>
    <option value="Epuisée" <?php echo ($medicament['dispon'] === 'Epuisée') ? 'selected' : ''; ?>>Epuisée</option>
</select>
<span id="erreurDispon" style="color: red"></span>


                <label for="date_ajout">Date d'ajout :</label>
                <input type="text" id="date_ajout" name="date_ajout" value="<?php echo $medicament['date_ajout'] ?>" readonly />
                <span id="erreurDateAjout" style="color: red"></span>

                <label for="new_piece_jointe">Nouvelle Pièce jointe :</label>
                <input type="file" id="new_piece_jointe" name="new_piece_jointe" accept="image/*" />
                <span id="erreurNewPieceJointe" style="color: red"></span>

                <input type="submit" value="Save">
                <input type="reset" value="Reset">
            </form>
        </div>

    <?php } ?>
</body>

</html>
