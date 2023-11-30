<?php
include '../controller/TypeController.php';
include '../model/typemodel.php';

$error = "";
$TypeController = new TypeController();
$idfichees = $TypeController->listidfichee();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification du champ obligatoire
    if (empty($_POST["idfiche"])) {
        $error = "Le champ 'idfiche' est obligatoire.";
    } else {
        // Assuming you have other form fields like email, tel, and sexe
        $idfiche = $_POST['idfiche'];
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $tel = isset($_POST['tel']) ? $_POST['tel'] : null;
        $sexe = isset($_POST['sexe']) ? $_POST['sexe'] : null;

        // Assuming the existence of the 'idFichee' class and 'addidfichee' method
        $idfichee = new idFichee(null, $idfiche, $email, $tel, $sexe);
        $TypeController->addidfichee($idfichee);
        header('Location: listidfichee.php');
    }
}
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add idfichee</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' idfichee='text/css' />

    <!-- STYLE CSS -->
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
                <button idfichee="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
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
                        <!-- Replace the link with your desired link for adding idfichees -->
                        <a href="listidfichee.php">
                            <i class="fa fa-plus-circle fa-3x"></i> Liste des idfichees 
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
                        <h2>Add idfichee</h2>
                        <h5>Welcome to our Diazen site</h5>
                    </div>
                </div>
                <hr />
                <div id="error">
                    <?php echo $error; ?>
                </div>
                <div class="form-style">
                    <form action="" method="POST">
                        <label for="idfiche">Nom:</label>
                        <input type="text" id="idfiche" name="idfiche" />
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" />
                        <label for="tel">Tel:</label>
                        <input type="text" id="tel" name="tel" />
                        <label for="sexe">Sexe:</label>
                        <input type="text" id="sexe" name="sexe" />
                        <input type="submit" value="Save">
                        <input type="reset" value="Reset">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
