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
<?php
include '../controller/PackC.php'; // Utilisez le contrôleur PackC au lieu de JoueurC
$packC = new PackC(); // Utilisez PackC au lieu de JoueurC
$list = $packC->listPacks(); // Utilisez listPacks au lieu de listjoueurs
?>
<html>
<body>
    <h1>List of packs</h1>
    <h2>
        <a href="addPack.php" target="_blank">Add pack</a> <!-- Modifiez le lien pour ajouter un pack -->
    </h2>

    <table border="1" align="center" width="70%">
        <tr>
            <th>Id Pack</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Type</th>
            <th>Disponibilite</th>
            <th>Date Debut</th>
            <th>Date Fin</th>
            <th>Image</th>
            <th>Action</th>
            <th>Delete</th>
        </tr>

        <?php foreach ($list as $pack) { ?>
            <tr>
                <td><?php echo $pack['IDpack'] ?></td>
                <td><?php echo $pack['nompack'] ?></td>
                <td><?php echo $pack['description'] ?></td>
                <td><?php echo $pack['prix'] ?></td>
                <td><?php echo $pack['type'] ?></td>
                <td><?php echo $pack['disponibilite'] ?></td>
                <td><?php echo $pack['date_debut'] ?></td>
                <td><?php echo $pack['date_fin'] ?></td>
                <td>
                <?php
                if (!empty($pack['image'])) {
                    echo '<img src="' . $pack['image'] . '" alt="image" style="max-width: 100px; max-height: 100px;">';
                } else {
                    echo 'Aucune pièce jointe';
                }
                ?>
            </td>
                <td>
                    <!-- Ajoutez ici le lien pour mettre à jour un pack -->
                     <!-- Formulaire pour la mise à jour du pack -->
    <form action="updatePack.php" method="GET">
        <input type="hidden" name="id" value="<?php echo $pack['IDpack']; ?>">
    </form>
    <a href="updatePack.php?id=<?php echo $pack['IDpack']; ?>" class="btn btn-primary">
    <i class="fa fa-edit"></i> Edit
</a>

                </td>
                <td>
                <a href="deletePack.php?id=<?php echo $pack['IDpack']; ?>" class="btn btn-danger">
    <i class="fa fa-pencil"></i> Delete
</a>

                </td>
            </tr>
        <?php } ?>
    </table>
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
