<?php
include "../controller/Medicament1.php";

$medicamentController = new MedicamentController1();

// Vérifier si une date de filtrage est fournie (par exemple, via un formulaire)
if (isset($_GET['filter_date']) && !empty($_GET['filter_date'])) {
    // Récupérer la date de filtrage depuis la requête GET
    $filterDate = $_GET['filter_date'];

    // Appeler la fonction de filtrage avec la date
    $medicaments = $medicamentController->filterMedicamentByDateAjout($filterDate);
} elseif (isset($_GET['disponibiliteFilter']) && !empty($_GET['disponibiliteFilter'])) {
    // Si une disponibilité de filtrage est fournie, filtrer par disponibilité
    $disponibiliteFilter = $_GET['disponibiliteFilter'];
    $medicaments = $medicamentController->filterMedicamentByDisponibilite($disponibiliteFilter);
} else {
    // Si aucune date de filtrage ni disponibilité n'est fournie, afficher tous les médicaments normalement
    $medicaments = $medicamentController->listMedicament();
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List of Medicaments</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <!-- Styles CSS pour le tableau -->
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
                <a class="navbar-brand" href="admin.php">Diazen admin</a>
            </div>
            <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Last access : 30 May 2014 &nbsp; <a href="#" class="btn btn-danger square-btn-adjust">Logout</a>
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

        <!-- PAGE WRAPPER -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            List of Medicaments
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Medicaments Table
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <!-- Formulaire de filtrage par date -->
                                    <form action="" method="GET" class="d-flex">
                                        <label for="filter_date" style="margin-right: 5px;">Filter by Date:</label>
                                        <input type="date" name="filter_date" class="form-control" style="height: 40px; font-size: 16px; margin-right: 5px;">
                                        <input type="submit" value="Apply Filter" class="btn btn-primary" style="height: 40px; background-color: #87CEEB;">
                                    </form>

                                    <!-- Formulaire de filtrage par disponibilité -->
                                    <form action="" method="GET" class="d-flex">
                                        <label for="disponibiliteFilter" style="margin-right: 5px;">Filter by Disponibilite:</label>
                                        <select name="disponibiliteFilter" class="form-select" style="height: 30px; font-size: 14px; margin-right: 5px;">
                                            <option value="" disabled selected>Choose</option>
                                            <option value="Disponible">Disponible</option>
                                            <option value="Epuisee">Epuisee</option>
                                        </select>
                                        <input type="submit" value="Apply Filter" class="btn btn-primary" style="height: 30px;">
                                    </form>

                                    <!-- Tableau de médicaments -->
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Id Medicament</th>
                                                <th>Nom</th>
                                                <th>Type</th>
                                                <th>Lieu</th>
                                                <th>Disponibilité</th>
                                                <th>Date d'Ajout</th>
                                                <th>Piece Jointe</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($medicaments as $medicament) { ?>
                                                <tr>
                                                    <td><?= $medicament['id']; ?></td>
                                                    <td><?= $medicament['nom']; ?></td>
                                                    <td><?= $medicament['type_nom']; ?></td>
                                                    <td><?= $medicament['lieu']; ?></td>
                                                    <td><?= $medicament['dispon']; ?></td>
                                                    <td><?= $medicament['date_ajout']; ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($medicament['piece_jointe'])) {
                                                            echo '<img src="' . $medicament['piece_jointe'] . '" alt="Piece Jointe" style="max-width: 100px; max-height: 100px;">';
                                                        } else {
                                                            echo 'Aucune pièce jointe';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td align="center">
                                                        <form method="POST" action="updateMedicament.php">
                                                            <input type="submit" name="update" value="Update">
                                                            <input type="hidden" value="<?= $medicament['id']; ?>" name="idMedicament">
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <a href="deleteMedicament1.php?id=<?= $medicament['id']; ?>">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPTS - AT THE BOTTOM TO REDUCE THE LOAD TIME -->
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
