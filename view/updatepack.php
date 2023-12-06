<?php

include '../controller/PackC.php';
include '../model/Pack.php';

$error = "";
$packC = new PackC();

// Créez un objet Pack
$pack = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idPack = $_POST['idPack'] ?? '';
    $nompack = $_POST['nompack'] ?? '';
    $description = $_POST['description'] ?? '';
    $prix = $_POST['prix'] ?? '';
    $type = $_POST['type'] ?? '';
    $disponibilite = isset($_POST['disponibilite']) ? 1 : 0;
    $datedebut = $_POST['datedebut'] ?? '';
    $datefin = $_POST['datefin'] ?? '';

    if (
        !empty($idPack) &&
        !empty($nompack) &&
        !empty($description) &&
        !empty($prix) &&
        !empty($type) &&
        isset($_POST['disponibilite']) &&
        !empty($datedebut) &&
        !empty($datefin)
    ) {
        // Vérification du champ "prix" pour s'assurer qu'il ne contient que des nombres et des points
        if (preg_match("/^[0-9.]+$/", $prix)) {
            // Vérification et traitement de l'upload de la nouvelle image
            $newImage = null;

            if ($_FILES['newImage']['error'] == UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';

                if (!file_exists($uploadDir) && !mkdir($uploadDir, 0777, true)) {
                    die('Failed to create upload directory');
                }

                $uploadFile = $uploadDir . basename($_FILES['newImage']['name']);

                if (move_uploaded_file($_FILES['newImage']['tmp_name'], $uploadFile)) {
                    $newImage = $uploadFile;
                } else {
                    $error = "Erreur lors de l'upload de la nouvelle image.";
                }
            }

            // Créez un objet Pack avec les données du formulaire
            $pack = new Pack($idPack, $nompack, $description, $prix, $type, $disponibilite, $datedebut, $datefin, $newImage);

            // Mettez à jour le pack en utilisant la méthode appropriée
            $packC->updatePack($pack, $idPack);

            header('Location: listPacks.php');
            exit(); // Assurez-vous de quitter l'exécution après la redirection
        } else {
            $error = "Le champ Prix doit contenir uniquement des chiffres.";
        }
    } else {
        $error = "Toutes les informations sont obligatoires.";
    }
}

?>






<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Binary Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="backoffice/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="backoffice/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="backoffice/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Binary admin</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Last access : 30 May 2014 &nbsp; <a href="#" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="backoffice/img/find_user.png" class="user-image img-responsive"/>
					</li>
				
					
                    <li>
                        <a  href="index.html"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                      <li>
                        <a  href="ui.html"><i class="fa fa-desktop fa-3x"></i> UI Elements</a>
                    </li>
                    <li>
                        <a  href="tab-panel.html"><i class="fa fa-qrcode fa-3x"></i> Tabs & Panels</a>
                    </li>
						   <li  >
                        <a  href="chart.html"><i class="fa fa-bar-chart-o fa-3x"></i> Morris Charts</a>
                    </li>	
                      <li  >
                        <a  href="table.html"><i class="fa fa-table fa-3x"></i> Table Examples</a>
                    </li>
                    <li  >
                        <a  href="form.html"><i class="fa fa-edit fa-3x"></i> Forms </a>
                    </li>				
					
					                   
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>
                               
                            </li>
                        </ul>
                      </li>  
                  <li  >
                        <a class="active-menu"  href="blank.html"><i class="fa fa-square-o fa-3x"></i> Blank Page</a>
                    </li>	
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Blank Page</h2>   
                        
                    </div>
                </div>
                 <!-- /. ROW  -->
                 
                 <hr />
<!------------------------------------------------------------------------------------------------------------------->


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pack</title>
    <style>
        body {
            background-color: #E2E2E2;
        }

        form {
            background-color: #D9EDF7;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            width: 60%;
            margin: auto;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="checkbox"],
        input[type="file"],
        select {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"],
        input[type="reset"] {
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
    <a href="listPacks.php">Back to list</a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_GET['id'])) {
        // Obtenez les détails du pack pour l'affichage initial dans le formulaire
        $pack = $packC->showPack($_GET['id']);
    ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="idPack" value="<?php echo $pack['IDpack']; ?>">
            <label for="nompack">Nom du Pack :</label>
            <input type="text" id="nompack" name="nompack" value="<?php echo $pack['nompack']; ?>" />
            <span id="erreurNomPack" style="color: red"></span>

            <label for="description">Description :</label>
            <textarea id="description" name="description" rows="10" cols="50"><?php echo $pack['description']; ?></textarea>
            <span id="erreurDescription" style="color: red"></span>

            <label for="prix">Prix :</label>
            <input type="text" id="prix" name="prix" value="<?php echo $pack['prix']; ?>" />
            <span id="erreurPrix" style="color: red"></span>

            <label for="type">Type :</label>
            <input type="text" id="type" name="type" value="<?php echo $pack['type']; ?>" />
            <span id="erreurType" style="color: red"></span>

            <label for="disponibilite">Disponibilité :</label>
            <input type="checkbox" id="disponibilite" name="disponibilite" <?php echo ($pack['disponibilite'] == 1) ? 'checked' : ''; ?> />
            <span id="erreurDisponibilite" style="color: red"></span>

            <label for="datedebut">Date de début :</label>
            <input type="date" id="datedebut" name="datedebut" value="<?php echo $pack['date_debut']; ?>" />
            <span id="erreurDateDebut" style="color: red"></span>

            <label for="datefin">Date de fin :</label>
            <input type="date" id="datefin" name="datefin" value="<?php echo $pack['date_fin']; ?>" />
            <span id="erreurDateFin" style="color: red"></span>

            <label for="newImage">Nouvelle image :</label>
            <input type="file" id="newImage" name="newImage" accept="image/*" />
            <span id="erreurNewImage" style="color: red"></span>

            <input type="submit" value="Save">
            <input type="reset" value="Reset">
        </form>
    <?php
    }
    ?>
</body>

</html>
<!------------------------------------------------------------------------------------------------------------------->

    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="backoffice/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="backoffice/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="backoffice/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="backoffice/js/custom.js"></script>
    
   
</body>
</html>