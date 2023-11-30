<?php
include '../controller/Medicament.php';
include '../model/Medicament.php';
include '../controller/typecontroller.php';

$error = "";
// Créer une instance du contrôleur de types
$typeController = new TypeController();

// Récupérer la liste des types disponibles
$types = $typeController->listType();

// create an instance of the controller
$medicamentController = new MedicamentController();

if (
    isset($_POST["nom"]) &&
    isset($_POST["typ"]) &&
    isset($_POST["lieu"]) &&
    isset($_POST["dispon"])
) {
    $nom = $_POST['nom'];
    $typ = $_POST['typ'];
    $lieu = $_POST['lieu'];
    $dispon = $_POST['dispon'];

    // Vérification et traitement de l'upload de l'image
    $piece_jointe = null;
    if ($_FILES['piece_jointe']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!file_exists($uploadDir) && !mkdir($uploadDir, 0777, true)) {
            die('Failed to create upload directory');
        }

        $uploadFile = $uploadDir . basename($_FILES['piece_jointe']['name']);

        if (move_uploaded_file($_FILES['piece_jointe']['tmp_name'], $uploadFile)) {
            $piece_jointe = $uploadFile;
        } else {
            $error = "Erreur lors de l'upload de la pièce jointe.";
        }
    }

    // Validation de la saisie
    if (empty($nom) || empty($typ) || empty($lieu) || empty($dispon)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        // create medicament
        $medicament = new Medicament(
            null,
            $nom,
            $typ,
            $lieu,
            $dispon,
            date("Y-m-d"), // Date actuelle
            $piece_jointe
        );

        // use the controller to add the medicament
        $medicamentController->addMedicament($medicament);
        header('Location: listMedicament.php');
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ajout Medicament</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <!-- STYLE CSS -->
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
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">DiaZen</a>
            </div>
            <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                Last access : 30 May 2014 &nbsp; <a href="#" class="btn btn-danger square-btn-adjust">Logout</a>
            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="assets/img/find_user.png" class="user-image img-responsive" />
                    </li>
                    <li>
                        <a href="listMedicament.php">
                            <i class="fa fa-list fa-3x"></i> List Medicament
                        </a>
                    </li>
                    <li>
                        <a href="addTypes.php">
                            <i class="fa fa-plus-circle fa-3x"></i> Add Type
                        </a>
                    </li>
                    <li>
                        <a href="listType.php">
                            <i class="fa fa-list fa-3x"></i> List Types
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Ajout Medicament</h2>
                        <h5>bienvenue Mr le pharmacien à notre site Diazen</h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <div id="error">
                    <?php echo $error; ?>
                </div>

                <div class="form-style">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="nom">Nom :</label>
                        <input type="text" id="nom" name="nom" />

                        <label for="typ">Type :</label>
                        <select id="typ" name="typ" required>
                            <?php foreach ($types as $type) { ?>
                                <option value="<?php echo $type['id']; ?>"><?php echo $type['typ']; ?></option>
                            <?php } ?>
                        </select>

                        <label for="lieu">Lieu :</label>
                        <select id="lieu" name="lieu">
                        <option value="Gbeli">Gbeli</option>
                        <option value="gafsa">Gafsa</option>
                        <option value="jandouba">Jandouba</option>
                        <option value="Bizerte">Bizerte</option>
                        <option value="Beja">Beja</option>
                        <option value="kairaoun">kairaoun</option>
                        <option value="sidiBouzid">sidiBouzid</option>
                        <option value="sfax">sfax</option>
                        <option value="gabes">gabes</option>
                        <option value="mednin">mednin</option>
                        <option value="mestir">mestir</option>
                        <option value="soussa">soussa</option>
                     </select>

                        <label for="dispon">Disponibilité :</label>
                        <select id="dispon" name="dispon">
                        <option value="disponible">disponible</option>
                        <option value="Epuisée">Epuisée</option>
                        </select>

                        <label for="piece_jointe">Pièce jointe :</label>
                        <input type="file" id="piece_jointe" name="piece_jointe" accept="image/*" />

                        <input type="submit" value="Save">
                        <input type="reset" value="Reset">
                    </form>
                </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
