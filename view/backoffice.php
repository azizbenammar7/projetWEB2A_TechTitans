<?php
include "../controller/pubC.php";

$pubC = new pubC();
$publications = $pubC->listPublications();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List of Publications</title>
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
                <a class="navbar-brand" href="#">Diazen</a>
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
                        <a href="listpublication.php">
                            <i class="fa fa-plus-circle fa-3x"></i> Liste des Publications
                        </a>
                    </li>
                    <li>
                        <a href="addpublication.php">
                            <i class="fa fa-plus-circle fa-3x"></i> Ajouter une publication
                        </a>
                    </li>
                    <li>
                        <a href="update_pub.php">
                            <i class="fa fa-plus-circle fa-3x"></i> Update Publication
                        </a>
                    </li>
                    <li>
                        <a href="delete_pub.php">
                            <i class="fa fa-plus-circle fa-3x"></i> supprimer une Publication
                        </a>
                    </li>
                    <li>
                        <a href="listcommentaire.php">
                            <i class="fa fa-plus-circle fa-3x"></i> Liste des commentaires 
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
                    Liste des Publications
                </h1>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="row">
            <div class="col-md-12">
                <form method="GET">
                    <label for="search">Search</label>
                    <input type="text" id="search" name="search" placeholder="Enter ID Publication...">
                    <input type="submit" value="Search">
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- TABLE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Table des Publications
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id Publication</th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Email</th>
                                        <th>text of publication</th>
                                        <th>date of publication</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($publications as $publication) {
                                        // Filter publications based on search criteria
                                        if (isset($_GET['search']) && $_GET['search'] != '' && strpos($publication['IDpub'], $_GET['search']) === false) {
                                            continue; // Skip this row if it doesn't match the search criteria
                                        }
                                    ?>
                                        <tr>
                                            <td><?= $publication['IDpub']; ?></td>
                                            <td><?= $publication['nom']; ?></td>
                                            <td><?= $publication['prenom']; ?></td>
                                            <td><?= $publication['email']; ?></td>
                                            <td><?= $publication['text_of_pub']; ?></td>
                                            <td><?= $publication['date_pub']; ?></td>
                                            <td>
                                                <form method="POST" action="update_pub.php">
                                                    <input type="submit" name="update" value="Update">
                                                    <input type="hidden" value="<?= $publication['IDpub']; ?>" name="IDpublication">
                                                </form>
                                            </td>
                                            <td>
                                                <a href="delete_pub.php?IDpublication=<?= $publication['IDpub']; ?>">Delete</a>
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