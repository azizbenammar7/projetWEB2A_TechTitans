
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

table {
    border-collapse: collapse;
    width: 70%;
    margin: 20px auto;
}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #4caf50;
    color: white;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f5f5f5;
}

.delete-button {
    background-color: #e74c3c;
    color: #fff;
    border: none;
    padding: 5px 10px;
    text-decoration: none;
    cursor: pointer;
}

.update-button {
    background-color: #2ecc71;
    color: #fff;
    border: none;
    padding: 5px 10px;
    text-decoration: none;
    cursor: pointer;
}
</style>

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
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Blank Page</h2>

                    </div>
                </div>
                <!-- /. ROW  -->

                <hr />
                <!------------------------------------------------------------------------------------------------------------------->
                <?php
include '../controller/commentaireC.php';

$commentaireC = new CommentaireC();
$commentaires = $commentaireC->listCommentaires();  


// Retrieve the IDpublication from the URL
$IDpublication = isset($_GET['IDpublication']) ? $_GET['IDpublication'] : null;

// List comments based on the IDpublication
$commentaires = $commentaireC->listCommentairesByPublication($IDpublication);
?>



<html>

<head>
    <title>List of Comments</title>
</head>

<body>
    <h1>List of Comments</h1>
    <h2>
        <a href="addcommentaire.php">Add Comment</a>
    </h2>
    <div id="comment-list-container">

    <table border="1" align="center" width="70%">
        <tr>
            <th>ID Comment</th>
            <th>Text of Comment</th>
            <th>Publication ID</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>

        <?php 
        foreach ($commentaires as $commentaire) {
        ?>
            <tr>
                <td><?= $commentaire['IDcommentaire']; ?></td>
                <td><?= $commentaire['text_of_commentaire']; ?></td>
                <td><?= $commentaire['publication']; ?></td>
                <td align="center">
                    <form method="POST" action="updatecommentaire.php">
                        <input class="update-button" type="submit" name="update" value="Update">
                        <input type="hidden" value="<?= $commentaire['IDcommentaire']; ?>" name="IDcommentaire">
                    </form>
                </td>
                <td>
                    <a class="delete-button" href="deletecommentaire.php?IDcommentaire=<?= $commentaire['IDcommentaire']; ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    </div>
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