<?php

include '../controller/Medicament.php';
include '../model/Medicament.php';

$error = "";

// Créez une instance du contrôleur
$medicamentController = new MedicamentController();

// Créez une instance de la classe Medicament
$medicament = null;

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

        // Vérifiez si le type est valide
        $typesAutorises = ['pilule', 'piqur', 'appareillage'];
        if (!in_array($typ, $typesAutorises)) {
            $error = "Le type doit être l'un des suivants : pilule, piqûre, appareillage.";
        } else {
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
        }
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
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
        .table-responsive {
            margin: 30px 0;
        }

        table.table {
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-radius: 8px;
        }

        table.table thead th {
            text-align: center;
            font-weight: bold;
            border-bottom: 2px solid #ddd;
            background-color: #5bc0de;
            color: #fff;
            padding: 12px;
        }

        table.table tbody td {
            text-align: center;
            padding: 10px;
        }

        table.table tbody tr {
            transition: background-color 0.3s;
        }

        table.table tbody tr:hover {
            background-color: #f5f5f5;
        }

        input[type="submit"],
        a.delete-link {
            display: inline-block;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            background-color: #5bc0de;
            color: #fff;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        a.delete-link:hover {
            background-color: #31b0d5;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Diazen</a>
            </div>
            <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                Last access : 30 May 2014 &nbsp; <a href="#" class="btn btn-danger square-btn-adjust">Logout</a>
            </div>
        </nav>
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="assets/img/find_user.png" class="user-image img-responsive" />
                    </li>
                    <li>
                        <a href="addMedicament.php">
                            <i class="fa fa-plus-circle fa-3x"></i> Add Medicament
                        </a>
                    </li>
                    <li>
                        <a href="listMedicament.php">
                            <i class="fa fa-list fa-3x"></i> List Medicaments
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper">
            <div id="page-inner">
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
                                <option value="pilule" <?php echo ($medicament['typ'] == 'pilule') ? 'selected' : ''; ?>>Pilule</option>
                                <option value="piqur" <?php echo ($medicament['typ'] == 'piqur') ? 'selected' : ''; ?>>Piqûre</option>
                                <option value="appareillage" <?php echo ($medicament['typ'] == 'appareillage') ? 'selected' : ''; ?>>Appareillage</option>
                            </select>
                            <span id="erreurTyp" style="color: red"></span>

                            <label for="lieu">Lieu :</label>
                            <input type="text" id="lieu" name="lieu" value="<?php echo $medicament['lieu'] ?>" />
                            <span id="erreurLieu" style="color: red"></span>

                            <label for="dispon">Disponibilité :</label>
                            <input type="text" id="dispon" name="dispon" value="<?php echo $medicament['dispon'] ?>" />
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
            </div>
        </div>
    </div>
</body>

</html>
