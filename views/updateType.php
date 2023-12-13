<?php

include '../controller/typecontroller1.php';
include '../model/typemodel1.php';

$error = "";

$typeController = new TypeController1();
$type = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des champs obligatoires
    if (empty($_POST["typ"])) {
        $error = "Le champ 'Type' est obligatoire.";
    } else {
        $idType = $_POST['idType'];
        $typ = $_POST['typ'];

        $type = new Type1($idType, $typ);
        $typeController->updateType($type, $idType);
        header('Location: listType.php');
        exit();
    }
}

if (isset($_POST['idType'])) {
    $type = $typeController->showType($_POST['idType']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Type Update</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
        /* Ajoutez ici le CSS pour le leftside et le haut */
        .navbar-default {
            background-color: #2e3236;
            border-color: #2e3236;
        }

        .navbar-default .navbar-brand,
        .navbar-default .navbar-brand:hover {
            color: #ffffff;
        }

        .navbar-default .navbar-toggle {
            border-color: #ffffff;
        }

        .navbar-default .navbar-toggle:hover,
        .navbar-default .navbar-toggle:focus {
            background-color: #ffffff;
        }

        .navbar-default .navbar-collapse,
        .navbar-default .navbar-form {
            border-color: #2e3236;
        }

        .navbar-default .navbar-link {
            color: #ffffff;
        }

        .navbar-default .navbar-link:hover {
            color: #ffffff;
        }

        .navbar-default .navbar-nav > .active > a,
        .navbar-default .navbar-nav > .active > a:hover,
        .navbar-default .navbar-nav > .active > a:focus {
            background-color: #4f5359;
            color: #ffffff;
        }

        .navbar-default .navbar-nav > li > a {
            color: #ffffff;
        }

        .navbar-default .navbar-nav > li > a:hover,
        .navbar-default .navbar-nav > li > a:focus {
            background-color: #4f5359;
            color: #ffffff;
        }

        .navbar-default .navbar-nav > .open > a,
        .navbar-default .navbar-nav > .open > a:hover,
        .navbar-default .navbar-nav > .open > a:focus {
            background-color: #4f5359;
            color: #ffffff;
        }

        .navbar-default .navbar-nav > .open > a,
        .navbar-default .navbar-nav > .open > a:hover,
        .navbar-default .navbar-nav > .open > a:focus {
            background-color: #4f5359;
            color: #ffffff;
        }

        .navbar-default .navbar-nav > .dropdown > a .caret {
            border-top-color: #ffffff;
            border-bottom-color: #ffffff;
        }

        .navbar-default .navbar-nav > .dropdown > a:hover .caret,
        .navbar-default .navbar-nav > .dropdown > a:focus .caret {
            border-top-color: #ffffff;
            border-bottom-color: #ffffff;
        }

        .navbar-default .navbar-nav > .open > a .caret,
        .navbar-default .navbar-nav > .open > a:hover .caret,
        .navbar-default .navbar-nav > .open > a:focus .caret {
            border-top-color: #ffffff;
            border-bottom-color: #ffffff;
        }

        .navbar-default .navbar-toggle {
            background-color: #4f5359;
        }

        .navbar-default .navbar-toggle:hover,
        .navbar-default .navbar-toggle:focus {
            background-color: #4f5359;
        }

        .navbar-default .navbar-toggle .icon-bar {
            background-color: #ffffff;
        }

        .navbar-default .navbar-collapse {
            background-color: #2e3236;
        }

        .navbar-default .navbar-nav > .dropdown > a:hover,
        .navbar-default .navbar-nav > .dropdown > a:focus {
            background-color: #4f5359;
            color: #ffffff;
        }

        .navbar-default .navbar-nav > .open > a,
        .navbar-default .navbar-nav > .open > a:hover,
        .navbar-default .navbar-nav > .open > a:focus {
            background-color: #4f5359;
            color: #ffffff;
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
                        <!-- Ajoutez ici le lien souhaité pour ajouter des types -->
                        <a href="listType.php">
                            <i class="fa fa-plus-circle fa-3x"></i> Annuler
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
                            Type Update
                        </h1>
                    </div>
                </div>
                <hr>

                <div id="error">
                    <?php echo $error; ?>
                </div>

                <?php
                if ($type) {
                ?>
                    <form action="" method="POST">
                        <label for="idType">Id Type :</label>
                        <input type="text" id="idType" name="idType" value="<?php echo $type['id']; ?>" readonly />

                        <label for="typ">Type :</label>
                        <input type="text" id="typ" name="typ" value="<?php echo $type['typ']; ?>" />
                        <input type="submit" value="Save">
                        <input type="reset" value="Reset">
                    </form>
                <?php
                }
                ?>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
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
