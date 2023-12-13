<?php
include '../controller/Medicament.php';
include '../model/Medicament.php';
include '../controller/TypeController.php';

$error = "";
// Créer une instance du contrôleur de idfichees
$TypeController = new TypeController();

// Récupérer la liste des idfichees cholibles
$idfichees = $TypeController->listidfichee();



// create an instance of the controller
$medicamentController = new MedicamentController();

if (
    isset($_POST["nom"]) &&
    isset($_POST["idfiche"]) &&
    isset($_POST["glyc"]) &&
    isset($_POST["chol"])
) {
    $nom = $_POST['nom'];
    $idfiche = $_POST['idfiche'];
    $glyc = $_POST['glyc'];
    $chol = $_POST['chol'];

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
    if (empty($nom) || empty($idfiche) || empty($glyc) || empty($chol)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        // create medicament
        $medicament = new Medicament(
            null,
            $nom,
            $idfiche,
            $glyc,
            $chol,
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
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' idfichee='text/css' />

    <!-- STYLE CSS -->
    <style>
        body {
            background-color: #E2E2E2;
        }

        .form-style {
            background-color: #D9EDF7;
            /* Couleur bleu ciel */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            width: 60%;
            /* Largeur du formulaire */
            margin: auto;
            /* Centrer le formulaire */
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
            background-color: #5BC0DE;
            /* Couleur bleu ciel plus foncée */
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
                <a class="navbar-brand" href="admin.php">Diazen</a>
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
                        <img src="backoffice/img/find_user.png" class="user-image img-responsive" />
                    </li>

                    <li>
                        <a href="listusers.php"><i class="fa fa-sitemap fa-3x"></i> users</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> Medicament<span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="addTypes.php">Ajouter un type de medicament</a>
                            </li>
                            <li>
                                <a href="listType.php">Liste des type de medicament</a>
                            </li>
                            <li>
                                <a href="addMedicament1.php">Ajouter un medicament</a>
                            </li>
                            <li>
                                <a href="listMedicament1.php">Liste des medicaments</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="listpublication.php"><i class="fa fa-sitemap fa-3x"></i> Publication des patients<span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="listpublication.php">liste des publications</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> Reclamation des patients<span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="backoffice.php">liste des reclamation</a>
                            </li>
                            <li>
                                <a href="listreponse.php">liste reponses</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> Fiche des patients<span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="addidfichees.php">Ajouter une fiche </a>
                            </li>
                            <li>
                                <a href="listidfichee.php">liste des fiches</a>
                            </li>
                            <li>
                                <a href="addMedicament.php">Ajouter une analyse </a>
                            </li>
                            <li>
                                <a href="listMedicament.php">liste des analyses des patients</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="listPacks.php"><i class="fa fa-sitemap fa-3x"></i> Packs<span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="addPack.php">Ajouter un pack </a>
                            </li>
                            <li>
                                <a href="listPacks.php">liste des packs</a>
                            </li>
                        </ul>
                    </li>

                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->

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


                        <label for="idfiche">idfichee :</label>
                        <select id="idfiche" name="idfiche" required>
                            <?php foreach ($idfichees as $idfichee) { ?>
                                <option value="<?php echo $idfichee['id']; ?>">
                                    <?php echo $idfichee['idfiche']; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <label for="nom">Creatinine Serique :</label>
                        <input type="number" id="nom" name="nom" min="1" max="40" />

                        <label for="glyc">glycemie :</label>
                        <input type="number" id="glyc" name="glyc" min="1" max="40" />

                        <label for="chol">cholesterol :</label>
                        <input type="number" id="chol" name="chol" min="1" max="40" />
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