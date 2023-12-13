<?php
include "../controller/reclamation.php";

$reclamationController = new ReclamationController();

// Récupérer la valeur du champ de saisie du type
$searchTyp = isset($_GET['searchTyp']) ? $_GET['searchTyp'] : null;

// Utilisez la fonction listReclamationByType avec le type comme paramètre
$reclamations = $reclamationController->listReclamationByType($searchTyp);

// Récupérer la valeur du champ de filtre d'état
$etat = isset($_GET['etat']) ? $_GET['etat'] : null;

if (!is_null($etat)) {
    // Utilisez la fonction getReclamationsByEtat avec l'état comme paramètre
    $reclamations = $reclamationController->getReclamationsByEtat($etat);
} else {
    // Si l'état n'est pas sélectionné, utilisez la fonction listReclamationByType
    $reclamations = $reclamationController->listReclamationByType($searchTyp);
}

// Vérifier si la requête est de type POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer la valeur du champ de saisie de la date
    $dateAjoutFilter = $_POST["dateAjoutFilter"];
    
    // Utilisez la fonction filterReclamationByDateAjout avec la date comme paramètre
    $reclamations = $reclamationController->filterReclamationByDateAjout($dateAjoutFilter);
    
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Reclamations</title>
    <!-- Ajoutez vos liens vers les fichiers CSS ici -->
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

        .container {
            margin: 50px; /* Ajustez la marge selon vos préférences */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        <style>
    .container {
        margin: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    form {
        display: flex;
        align-items: center;
        margin-right: 20px;
    }

    label {
        margin-right: 10px;
    }

    select, input[type="date"] {
        padding: 8px;
        margin-right: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        padding: 8px 15px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>

    </style>
</head>

<body>
    <header>
        <h1>Liste des Reclamations</h1>
        
    </header>

    <main>
        <!-- Conteneur pour les formulaires de filtrage -->
        <div class="container">
            <form action="" method="GET">
                <label for="searchTyp">Search by Type:</label>
                <select id="searchTyp" name="searchTyp">
                    <option value="">All</option>
                    <option value="médecin">Médecin</option>
                    <option value="pharmacien">Pharmacien</option>
                    <option value="patient">Patient</option>
                    <option value="médicament">Médicament</option>
                    <option value="autre">Autre</option>
                </select>
                <input type="submit" name="typeSubmit" value="Filter by Type">
            </form>

            <form method="post" action="">
                <label for="dateAjoutFilter">Filter by Date:</label>
                <input type="date" name="dateAjoutFilter">
                <input type="submit" value="Apply Filter">
            </form>

            <form action="" method="GET">
                <label for="etat">Filter by Etat:</label>
                <select id="etat" name="etat">
                    <option value="">All</option>
                    <option value="1">Etat Traite</option>
                    <option value="0">Etat non Traite</option>
                </select>
                <input type="submit" name="etatSubmit" value="Filter by Etat">
            </form>
        </div>

        <!-- Conteneur pour la liste des réclamations -->
        <div class="container">
            <table border="1" align="center">
                <tr>
                    <th>Id Reclamation</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Piece Jointe</th>
                    <th>Date d'Ajout</th>
                    <th>Etat</th>
                    <th>Réponse</th> <!-- Nouvelle colonne pour la Réponse -->
                </tr>
                <?php foreach ($reclamations as $reclamation) { ?>
                    <tr>
                        <td><?= $reclamation['id']; ?></td>
                        <td><?= $reclamation['typ']; ?></td>
                        <td><?= $reclamation['description']; ?></td>
                        <td>
                            <a href="../view/download.php?filename=<?= rawurlencode($reclamation['piece_jointe']); ?>" download="<?= $reclamation['piece_jointe']; ?>">
                                <?= $reclamation['piece_jointe']; ?>
                            </a>
                        </td>
                        <td><?= $reclamation['date_ajout']; ?></td>
                        <td>
                            <?php echo ($reclamation['etat'] == 1) ? 'Etat Traité' : 'Etat non Traité'; ?>
                        </td>
                        <td>
    <a href="voirReponses.php?idReclamation=<?= $reclamation['id']; ?>">Voir Réponses</a>
</td>



                            <td>
                            <a href="addReponse.php?id=<?= $reclamation['id']; ?>" class="btn btn-primary mt-2">Ajouter une réponse</a>

                            </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </main>
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
