<?php
include '../controller/Medicament.php';
include '../model/Medicament.php';
include '../controller/TypeController.php';

$error = "";

// Créez une instance du contrôleur
$medicamentController = new MedicamentController();

// Créez une instance de la classe Medicament
$medicament = null;

// Créez une instance du contrôleur de idfichees
$TypeController = new TypeController();

// Récupérez la liste des idfichees cholibles
$idfichees = $TypeController->listidfichee();

// Vérifiez si le formulaire a été soumis
if (
    isset($_POST["idMedicament"]) &&
    isset($_POST["nom"]) &&
    isset($_POST["idfiche"]) &&
    isset($_POST["glyc"]) &&
    isset($_POST["chol"]) &&
    isset($_POST["date_ajout"])
) {
    // Vérifiez si des champs obligatoires sont vides
    if (
        !empty($_POST["nom"]) &&
        !empty($_POST['idfiche']) &&
        !empty($_POST["glyc"]) &&
        !empty($_POST["chol"]) &&
        !empty($_POST["date_ajout"])
    ) {
        // Récupérez les valeurs du formulaire
        $idMedicament = $_POST['idMedicament']; // Garder l'ID d'origine
        $nom = $_POST['nom'];
        $idfiche = $_POST['idfiche'];
        $glyc = $_POST['glyc'];
        $chol = $_POST['chol'];
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
            $idfiche,
            $glyc,
            $chol,
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
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' idfichee='text/css' />
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

                <label for="idfiche">idfichee :</label>
                <select id="idfiche" name="idfiche">
                    <?php foreach ($idfichees as $idfichee) { ?>
                        <option value="<?php echo $idfichee['id']; ?>" <?php echo ($medicament['idfiche'] == $idfichee['id']) ? 'selected' : ''; ?>>
                            <?php echo $idfichee['idfiche']; ?>
                        </option>
                    <?php } ?>
                </select>
                <span id="erreuridfiche" style="color: red"></span>

                <label for="glyc">glyc :</label>
                <input type="text" id="glyc" name="glyc" value="<?php echo $medicament['glyc'] ?>" />
                <span id="erreurglyc" style="color: red"></span>

                <label for="chol">cholibilité :</label>
                <input type="text" id="chol" name="chol" value="<?php echo $medicament['chol'] ?>" />
                <span id="erreurchol" style="color: red"></span>

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
