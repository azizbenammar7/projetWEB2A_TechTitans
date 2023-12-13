<?php
include "../controller/reclamation.php";

$reclamationController = new ReclamationController();
$reclamations = $reclamationController->listReclamation();

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liste des Réclamations</title>
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

        /* Styles pour les boutons Update et Delete */
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
                        <img src="assets/img/find_user.png" class="user-image img-responsive" />
                    </li>
                    <li>
                        <a href="addReclamation.php">
                            <i class="fa fa-plus-circle fa-3x"></i> Ajouter une Réclamation
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
                        <h1 class="page-header">
                            Liste des Réclamations
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- TABLE -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Table des Réclamations
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID Réclamation</th>
                                                <th>Type</th>
                                                <th>Description</th>
                                                <th>Pièce Jointe</th>
                                                <th>Date d'Ajout</th>
                                                <th>État</th>
                                                <th>Mise à Jour</th>
                                                <th>Supprimer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($reclamations as $reclamation) { ?>
                                                <tr>
                                                    <td><?= $reclamation['id']; ?></td>
                                                    <td><?= $reclamation['typ']; ?></td>
                                                    <td><?= $reclamation['description']; ?></td>
                                                    <td>
                                                        <?php
                                                        // Afficher le nom du fichier de la pièce jointe
                                                        echo $reclamation['piece_jointe_nom'];
                                                        ?>
                                                    </td>
                                                    <td><?= $reclamation['date_ajout']; ?></td>
                                                    <td><?= $reclamation['etat']; ?></td>
                                                    <td align="center">
                                                        <form method="POST" action="updateReclamation.php">
                                                            <input type="submit" name="update" value="Mise à Jour">
                                                            <input type="hidden" value="<?= $reclamation['id']; ?>" name="idReclamation">
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <a href="deleteReclamation.php?id=<?= $reclamation['id']; ?>">Supprimer</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END TABLE -->
                    </div>
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