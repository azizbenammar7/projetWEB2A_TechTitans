
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
                        <a href="backoffice.php">
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

                 <?php
include "../controller/reponse.php";

// Initialiser les compteurs pour les trois types de satisfaction
$nonSatisfaisanteCount = 0;
$moyennementSatisfaisanteCount = 0;
$satisfaisanteCount = 0;

session_start(); // Assurez-vous de démarrer la session

$reponseController = new ReponseController();

// Récupérer l'ID de la réclamation depuis l'URL
$idReclamation = $_GET['idReclamation'] ?? null;

// Vérifier si l'ID de la réclamation est présent
if ($idReclamation !== null) {
    // Récupérer les réponses liées à la réclamation spécifiée
    $reponses = $reponseController->getReponsesByReclamation($idReclamation);

    // Ajouter des informations à la session (par exemple, la satisfaction)
    $_SESSION['satisfaction'] = $votreDonneeDeSatisfaction;

    // Sauvegarder les informations de session
    session_write_close();
} else {
    // Rediriger si l'ID de la réclamation n'est pas spécifié
    header('Location: listreponse.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réponses pour une Réclamation</title>

    <!-- Bootstrap Styles -->
    <link href="backoffice/css/bootstrap.css" rel="stylesheet" />

    <!-- Font Awesome Styles -->
    <link href="backoffice/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom Styles -->
    <link href="backoffice/css/custom.css" rel="stylesheet" />

    <style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    header {
        text-align: center;
        padding: 20px;
    }

    main {
        flex: 1;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #007bff; /* Couleur de la bordure */
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #007bff; /* Couleur de fond pour les cellules d'en-tête */
        color: #fff; /* Couleur du texte pour les cellules d'en-tête */
    }

    /* Container Styles */
    .container {
        margin: 20px;
    }
</style>

</head>

<body>
    <!-- Your existing HTML content here -->

    <h1>Liste des Réponses pour une Réclamation</h1>

    <table border="1" align="center">
        <tr>
            <th>Id Réponse</th>
            <th>Description</th>
            <th>État</th>
            <th>Voir Notes</th>
            <!-- ... Autres colonnes si nécessaire ... -->
        </tr>
        <?php foreach ($reponses as $reponse) { ?>
            <tr>
                <td><?= $reponse['idreponse']; ?></td>
                <td><?= $reponse['description']; ?></td>
                <td>
                    <?php echo ($reponse['etat'] == 1) ? 'État Traité' : 'État non Traité'; ?>
                </td>
                <td>
                    <?php
                    // Vérifier si la satisfaction est définie dans la session
                    if (isset($_SESSION['satisfaction'][$reponse['idreponse']])) {
                        echo $_SESSION['satisfaction'][$reponse['idreponse']];
                    } else {
                        echo 'N/A';
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
    </table>

    <!-- ... (Autres éléments HTML si nécessaire) ... -->

</body>

</html>

