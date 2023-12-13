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
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                      
                        
                    </div>
                </div>
                 <!-- /. ROW  -->
                 
                 <hr />
<!------------------------------------------------------------------------------------------------------------------->
<?php
include "../controller/reponse.php";
include "../controller/reclamation.php";
// Initialiser les compteurs pour les trois types de satisfaction
$nonSatisfaisanteCount = 0;
$moyennementSatisfaisanteCount = 0;
$satisfaisanteCount = 0;

session_start(); // Assurez-vous de démarrer la session

$reponseController = new ReponseController();
$reponses = $reponseController->listReponse();
/// Définir la page actuelle (par défaut à 1 si non spécifié dans l'URL)
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Définir le nombre d'éléments par page
$limit = 20;

// Récupérer la liste des réponses pour la page actuelle
$reponses = $reponseController->listReponsePagination($page, $limit);
?>


<?php include '../views/headerback.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réponses</title>
    <!-- Ajoutez d'autres balises meta ou liens vers des fichiers CSS si nécessaire -->
    <link href="backoffice/css/bootstrap.css" rel="stylesheet" />
    <link href="backoffice/css/font-awesome.css" rel="stylesheet" />
    <link href="backoffice/css/custom.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <style>
        /* Ajoutez vos styles CSS ici */
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

        /* Ajoutez ces styles pour espacer et styliser les boutons de pagination */
        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pagination a {
            margin: 0 5px;
            padding: 8px 15px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .pagination a.current {
            background-color: #0056b3;
        }

        .pagination a:hover {
            background-color: #0056b3;
        }

        /* Ajoutez le style du conteneur */
        .container {
            margin: 20px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Liste des Réponses</h1>
    </header>

    <main>
        <!-- Ajouter le conteneur à la liste des réponses -->
        <div class="container">
            <table border="1" align="center">
                <tr>
                    <th>Id Reponse</th>
                    <th>Description</th>
                    <th>Etat</th>
                    <th>Id Reclamation</th>
                    <th>Update</th>
                    <th>Delete</th>
                    <th>Voir Notes</th>
                    <!-- Ajoutez d'autres colonnes si nécessaire -->
                </tr>
                <?php foreach ($reponses as $reponse) { ?>
                    <tr>
                        <td><?= $reponse['idreponse']; ?></td>
                        <td><?= $reponse['description']; ?></td>
                        <td>
                            <?php echo ($reponse['etat'] == 1) ? 'Etat Traité' : 'Etat non Traité'; ?>
                        </td>
                        <td><?= $reponse['reclamation']; ?></td>
                        <td><a href="updateReponse.php?id=<?= $reponse['idreponse']; ?>">Update</a></td>
                        <td><a href="deleteReponse.php?id=<?= $reponse['idreponse']; ?>">Delete</a></td>
                        <td>
                            <?php
                            // Vérifier si la satisfaction est définie dans la session
                            if (isset($_SESSION['satisfaction'][$reponse['idreponse']])) {
                                echo $_SESSION['satisfaction'][$reponse['idreponse']];

                                // Mettre à jour les compteurs en fonction de la satisfaction
                                switch ($_SESSION['satisfaction'][$reponse['idreponse']]) {
                                    case 'Non satisfaisante':
                                        $nonSatisfaisanteCount++;
                                        break;
                                    case 'Moyennement satisfaisante':
                                        $moyennementSatisfaisanteCount++;
                                        break;
                                    case 'Satisfaisante':
                                        $satisfaisanteCount++;
                                        break;
                                }
                            } else {
                                echo 'N/A';
                            }
                            ?>
                        </td>
                        <!-- Ajoutez d'autres colonnes si nécessaire -->
                    </tr>
                <?php } ?>
            </table>

            <!-- Ajouter le bloc de liens de pagination ici -->
            <div class="pagination">
                <?php
                $totalPages = ceil($reponseController->countReponses() / $limit);

                // Afficher le bouton "Previous" s'il y a une page précédente
                if ($page > 1) {
                    echo "<a href='?page=" . ($page - 1) . "'>Previous</a> ";
                }

                // Afficher les liens de pagination avec les numéros de page
                for ($i = 1; $i <= $totalPages; $i++) {
                    // Ajouter une classe CSS différente pour la page actuelle
                    $class = ($i == $page) ? 'current' : '';
                    echo "<a class='$class' href='?page=$i'>$i</a> ";
                }

                // Afficher le bouton "Next" s'il y a une page suivante
                if ($page < $totalPages) {
                    echo "<a href='?page=" . ($page + 1) . "'>Next</a> ";
                }
                ?>
            </div>
            <!-- Ajouter la balise div pour le graphique CanvasJS -->
            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
        </div>
    </main>

    <footer>
        <!-- Ajouter le contenu du pied de page si nécessaire -->
    </footer>

    <script>
        window.onload = function () {
            var totalReponses = <?= count($reponses) ?>;

            // Calculer les pourcentages réels
            var nonSatisfaisante = (<?= $nonSatisfaisanteCount ?> / totalReponses) * 100;
            var moyennementSatisfaisante = (<?= $moyennementSatisfaisanteCount ?> / totalReponses) * 100;
            var satisfaisante = (<?= $satisfaisanteCount ?> / totalReponses) * 100;

            var dataPoints = [
                { label: "Non satisfaisante", y: nonSatisfaisante },
                { label: "Moyennement satisfaisante", y: moyennementSatisfaisante },
                { label: "Satisfaisante", y: satisfaisante }
            ];

            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "light2",
                animationEnabled: true,
                title: {
                    text: "Taux de Satisfaction"
                },
                axisY: {
                    title: "Pourcentage",
                    interval: 10,
                    suffix: "%"
                },
                data: [{
                    type: "line",
                    dataPoints: dataPoints
                }]
            });

            chart.render();
        }
    </script>
</body>

</html>
