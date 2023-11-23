<?php

// Inclure les fichiers nécessaires
include '../model/reponse.php';
include '../controller/reponse.php';

// Initialiser les variables
$error = "";
$reponseController = new ReponseController();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $description = $_POST['description'];
    $etat = $_POST['etat'];
    $reclamation = $_POST['reclamation'];

    // Vérifier si tous les champs sont remplis
    if (empty($description) || empty($reclamation)) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        // Si tous les champs sont remplis, procédez à la création de l'instance de Reponse
        // et à l'ajout à la base de données
        $reponse = new Reponse(
            $description,
            (int)$etat,
            (int)$reclamation
        );

        try {
            // Ajouter la réponse à la base de données
            $reponseController->addReponse($reponse);

            // Redirection après l'ajout de la réponse
            header('Location: listreponse.php');
            exit();
        } catch (Exception $e) {
            // Gestion de l'erreur
            $error = "Erreur lors de l'ajout de la réponse : " . $e->getMessage();
        }
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
                <a class="navbar-brand" href="index.html">Diazen</a> 
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
                        <img src="assets/img/find_user.png" class="user-image img-responsive" />
                    </li>
                    <li>
                        <a href="listreponse.php">
                            <i class="fa fa-plus-circle fa-3x"></i> Liste Reponse
                        </a>
                    </li>
                    <li>
                        <a href="addReponse.php">
                            <i class="fa fa-plus-circle fa-3x"></i> Ajouter Reponse
                        </a>
                    </li>
                    <li>
                        <a href="updateReponse.php">
                            <i class="fa fa-plus-circle fa-3x"></i> Update Reponse
                        </a>
                    </li>
                    <li>
                        <a href="deleteReponse.php">
                            <i class="fa fa-plus-circle fa-3x"></i> Delete Reponse
                        </a>
                    </li>
                    <li>
                        <a href="backoffice.php">
                            <i class="fa fa-plus-circle fa-3x"></i> Liste Reclamation
                        </a>
                    </li>
                </ul>
            </div>
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                      
                        
                    </div>
                </div>
                 <!-- /. ROW  -->
                 
                 <hr />
<!------------------------------------------------------------------------------------------------------------------->

<?php include '../view/headerback.php';?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Réponse</title>
</head>

<body>
    <h2>Ajouter une Réponse</h2>

    <?php if (!empty($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="addreponse.php" method="POST">
        <label for="description">Description :</label>
        <textarea id="description" name="description" rows="4" cols="50"></textarea>
        <br>

        <input type="hidden" name="etat" value="1">
        <br>

        <label for="reclamation">Réclamation :</label>
        <input type="number" id="reclamation" name="reclamation">
        <br>

        <input type="submit" value="Ajouter la Réponse">
        <input type="reset" value="Réinitialiser" >
    </form>
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