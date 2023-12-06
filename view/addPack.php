<?php
include '../controller/PackC.php';
include '../model/Pack.php';

$packC = new PackC();
$erreur = null;

if (
    isset($_POST['nom']) && isset($_POST['description'])
    && isset($_POST['prix']) && isset($_POST['type'])
    && isset($_POST['disponibilite']) && isset($_POST['datedebut'])
    && isset($_POST['datefin']) && isset($_FILES['image'])
) {
    if (
        !empty($_POST['nom']) && !empty($_POST['description'])
        && !empty($_POST['prix']) && !empty($_POST['type'])
        && isset($_POST['disponibilite']) && !empty($_POST['datedebut'])
        && !empty($_POST['datefin']) && !empty($_FILES['image']['name'])
    ) {
        // Convertissez le champ disponibilite en entier (0 ou 1) en fonction de la case cochée
        $disponibilite = isset($_POST['disponibilite']) ? 1 : 0;

        // Vérification du champ "prix" pour s'assurer qu'il ne contient que des nombres et des points
        if (preg_match("/^[0-9.]+$/", $_POST['prix'])) {
            // Vérification et traitement de l'upload de l'image
            $image = null;
            if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                if (!file_exists($uploadDir) && !mkdir($uploadDir, 0777, true)) {
                    die('Failed to create upload directory');
                }

                $uploadFile = $uploadDir . basename($_FILES['image']['name']);

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $image = $uploadFile;
                } else {
                    $erreur = "Erreur lors de l'upload de l'image.";
                }
            }

            $pack = new Pack(
                null,
                $_POST['nom'],
                $_POST['description'],
                $_POST['prix'],
                $_POST['type'],
                $disponibilite,
                $_POST['datedebut'],
                $_POST['datefin'],
                $image
            );
            $packC->addPack($pack);
            header('Location: listPacks.php');
            exit();
        } else {
            $erreur = "Le champ Prix doit contenir uniquement des chiffres.";
        }
    } else {
        $erreur = "Toutes les informations sont obligatoires.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Pack</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="backoffice/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="backoffice/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="backoffice/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <!-- STYLE CSS -->
    <style>
        body {
            background-color: #E2E2E2;
        }

        .form-style {
            background-color: #D9EDF7;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            width: 60%;
            margin: auto;
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
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="backoffice/img/find_user.png" class="user-image img-responsive" />
                    </li>
                    <li>
                        <a href="listPacks.php">
                            <i class="fa fa-list fa-3x"></i> List Packs
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Ajout Pack</h2>
                        
                    </div>
                </div>
                <hr />

                <div id="error">
                    <?php echo $erreur; ?>
                </div>

                <div class="form-style">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="nom">Nom du Pack :</label>
                        <input type="text" id="nom" name="nom" />

                        <label for="description">Description :</label>
                        <textarea id="description" name="description" rows="10" cols="50"></textarea>

                        <label for="prix">Prix :</label>
                        <input type="text" id="prix" name="prix" />

                        <label for="type">Type :</label>
                        <input type="text" id="type" name="type" />

                        <label for="disponibilite">Disponibilité :</label>
                        <input type="checkbox" id="disponibilite" name="disponibilite" />

                        <label for="datedebut">Date de début :</label>
                        <input type="date" id="datedebut" name="datedebut" />

                        <label for="datefin">Date de fin :</label>
                        <input type="date" id="datefin" name="datefin" />

                        <label for="image">Image :</label>
                        <input type="file" id="image" name="image" accept="image/*" />

                        <input type="submit" value="Save">
                        <input type="reset" value="Reset">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="backoffice/js/jquery-1.10.2.js"></script>
    <script src="backoffice/js/bootstrap.min.js"></script>
    <script src="backoffice/js/jquery.metisMenu.js"></script>
    <script src="backoffice/js/custom.js"></script>
</body>

</html>