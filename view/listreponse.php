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
<?php
include "../controller/reponse.php";

$reponseController = new ReponseController();
$reponses = $reponseController->listReponse();
?>

<?php include '../view/headerback.php';?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List of Reponses</title>
    <!-- Ajoutez ces styles -->
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
    </style>
</head>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List of Reponses</title>
    <!-- Ajoutez vos styles et scripts ici si nécessaire -->
</head>

<body>
    <header>
        <h1>List of Reponses</h1>
        <h2><a href="addReponse.php">Add Reponse</a></h2>
    </header>

    <main>
        <table border="1" align="center">
            <tr>
                <th>Id Reponse</th>
                <th>Description</th>
                <th>Etat</th>
                <th> id Reclamation</th>
                <th> Update</th>
                <th> Delete</th>
                <!-- Ajoutez d'autres colonnes si nécessaire -->
            </tr>
            <?php foreach ($reponses as $reponse) { ?>
                <tr>
                    <td><?= $reponse['idreponse']; ?></td>
                    <td><?= $reponse['description']; ?></td>
                    <td><?= $reponse['etat']; ?></td>
                    <td><?= $reponse['reclamation']; ?></td>
                    <td><a href="updateReponse.php?id=<?= $reponse['idreponse']; ?>">Update</a></td>
                    <td><a href="deleteReponse.php?id=<?= $reponse['idreponse']; ?>">Delete</a></td>
                    <!-- Ajoutez d'autres colonnes si nécessaire -->
                </tr>
            <?php } ?>
        </table>
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