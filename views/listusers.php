<?php
include "../controller/UserC.php";

$c = new UserC();

$users = $c->listUsers();
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$roleFilter = isset($_GET['role_user']) ? $_GET['role_user'] : '';

if (!empty($roleFilter)) {
    $users = $c->listUsersByRole($roleFilter);
} else {
    $users = $c->listUsers($searchTerm);
}


?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>list users</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                <div class="row">
    <div class="col-md-6">
        <form method="GET" action="">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for users..." name="search">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
    </div>
</div>

<div class="row">
        <div class="col-md-6">
            <form method="GET" action="">
                <div class="input-group">
                    <select class="form-control" name="role_user">
                        <option value="">Select Role</option>
                        <option value="patient">Patient</option>
                        <option value="medecin">Medecin</option>
                        <option value="pharmacien">Pharmacien</option>
                    </select>
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Filter by Role</button>
                    </span>
                </div>
            </form>
        </div>
    </div>

                <!-- USER TABLE -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            list de d'utilisateurs                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Id User</th>
                                                <th>photo de profil</th>
                                                <th>Nom</th>
                                                <th>Prenom</th>
                                                <th>Last Login</th>
                                                <th>Email</th>
                                                <th>mot de passe</th>
                                                <th>Tel</th>
                                                <th>Is Banned</th>
                                                <th>Role</th>
                                                <th>Type de Diabete</th>
                                                <th>Ville</th>
                                                <th>Diplome</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($users as $user) {
                                            ?>
                                                <tr>
                                                    <td><?= $user['id']; ?></td>
                                                    <td>
    <?php
    if (!empty($user['pdp'])) {
        echo '<div style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%;"><img src="' . $user['pdp'] . '" alt="pdp" style="width: 100%; height: 100%; object-fit: cover;"></div>';
    } else {
        echo 'Aucune photo de profil';
    }
    ?>
</td>
                                                    <td><?= $user['nom']; ?></td>
                                                    <td><?= $user['prenom']; ?></td>
                                                    <td><?= $user['last_login']; ?></td>
                                                    <td><?= $user['email']; ?></td>
                                                    <td><?= $user['motdepasse']; ?></td>
                                                    <td><?= $user['tel']; ?></td>
                                                    <td>
    <?php if (isset($user['is_banned']) && $user['is_banned']): ?>
        <form method="POST" action="unbanUser.php">
            <input type="submit" name="unban" value="Unban">
            <input type="hidden" value="<?= $user['id']; ?>" name="userId">
        </form>
    <?php else: ?>
        <form method="POST" action="banUser.php">
            <input type="submit" name="ban" value="Ban">
            <input type="hidden" value="<?= $user['id']; ?>" name="userId">
        </form>
    <?php endif; ?>
</td>
                                                    <td><?= $user['role_user']; ?></td>
                                                    <td><?= $user['typeDiabete']; ?></td>
                                                    <td><?= $user['ville']; ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($user['diplome'])) {
                                                            echo '<img src="' . $user['diplome'] . '" alt="Diplome" style="max-width: 100px; max-height: 100px;">';
                                                        } else {
                                                            echo 'Aucun diplôme';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td align="center">
                                                        <form method="POST" action="updateuser.php">
                                                            <input type="submit" name="update" value="Update">
                                                            <input type="hidden" value="<?= $user['id']; ?>" name="idUser">
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <a href="deleteUser.php?id=<?= $user['id']; ?>">Delete</a>
                                                    </td>
                                                
                                                </tr>
                                           
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /. ROW  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

    <!-- SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>
</body>
</html>