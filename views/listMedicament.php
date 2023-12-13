<?php
include "../controller/Medicament.php";

$medicamentController = new MedicamentController();
// Number of records per page
$recordsPerPage = 5;
// Updated code for filtering by date_ajout
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $dateAjoutFilter = $_POST["dateAjoutFilter"];
    $patientNameFilter = $_POST["patientNameFilter"];

    // Use the new filter in the query
    $filteredMedicaments = $medicamentController->filterMedicaments($dateAjoutFilter, $patientNameFilter);
} else {
    $filteredMedicaments = $medicamentController->listMedicament();
}
$historicalData = [];
for($i = 6; $i >= 0; $i--) {
    $day = date('Y-m-d', strtotime("-$i days"));
    $count = $medicamentController->getHistoriqueCountByDay($day);
    $historicalData[] = $count;
}
// Calculate the total number of pages

// Get the current page or set it to 1 if not set
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset for the SQL query
$offset = ($page - 1) * $recordsPerPage;

// Retrieve only the records for the current page
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
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' idfichee='text/css' />

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
    <a href="ajouthistorique.php">Back to Add </a>
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
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Historique des patients
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- TABLE -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                historic Table
                            </div>
                            <div class="panel-body">
                                <form method="post" action="">
                                    <label for="dateAjoutFilter">Filter by Date:</label>
                                    <input type="date" name="dateAjoutFilter">

                                    <label for="patientNameFilter">Filter by Patient:</label>
                                    <input type="text" name="patientNameFilter">

                                    <input type="submit" value="Apply Filter">
                                    <button type="button" onclick="window.location.href='listMedicament.php'">Reset Filter</button>
                                    <br>
                                    <label for="">Sort by: </label>
                                    <button type="button" onclick="window.location.href='listglyc.php'">Glycemie: croissant</button>
                                    <button type="button" onclick="window.location.href='listglyc.php'">Glycemie: decroissant</button>
                                    <button type="button" onclick="window.location.href='listglyc.php'">Cholesterol: croissant</button>
                                    <button type="button" onclick="window.location.href='listglyc.php'">Cholesterol: decroissant</button>
                                    <button type="button" onclick="window.location.href='listglyc.php'">Creatinine: croissant</button>
                                    <button type="button" onclick="window.location.href='listglyc.php'">Creatinine: decroissant</button>


                                </form>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Id </th>
                                                <th>Patient</th>
                                                <th>Creatinine Serique</th>
                                                <th>Glycemie</th>
                                                <th>Cholesterol</th>
                                                <th>Date d'Ajout</th>
                                                <th>Piece Jointe</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($filteredMedicaments as $medicament) { ?>
                                                <tr>
                                                    <td>
                                                        <?= $medicament['id']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $medicament['idfichee_nom']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $medicament['nom']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $medicament['glyc']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $medicament['chol']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $medicament['date_ajout']; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if(!empty($medicament['piece_jointe'])) {
                                                            echo '<img src="'.$medicament['piece_jointe'].'" alt="Piece Jointe" style="max-width: 100px; max-height: 100px;">';
                                                        } else {
                                                            echo 'Aucune pièce jointe';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td align="center">
                                                        <form method="POST" action="updateMedicament.php">
                                                            <input type="submit" name="update" value="Update">
                                                            <input type="hidden" value="<?= $medicament['id']; ?>"
                                                                name="idMedicament">
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <a
                                                            href="deleteMedicament.php?id=<?= $medicament['id']; ?>">Delete</a>
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
                <!-- /. ROW  -->
                <hr />
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <!-- Add a canvas element for the chart -->

                    <canvas id="historiqueChart" width="150" height="100"></canvas>

                    <!-- Include Chart.js library -->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <!-- JavaScript code to initialize and render the chart -->
                    <script>
                        var ctx = document.getElementById('historiqueChart').getContext('2d');
                        var historicalData = <?php echo json_encode($historicalData); ?>;

                        // Function to format the date in 'DD/MM/YYYY' format
                        function formatDate(date) {
                            var day = date.getDate();
                            var month = date.getMonth() + 1;
                            var year = date.getFullYear();
                            return day + '/' + month + '/' + year;
                        }

                        // Generate labels for the last 7 days including today
                        var labels = [];
                        for (var i = 6; i >= 0; i--) {
                            var currentDate = new Date();
                            currentDate.setDate(currentDate.getDate() - i);
                            labels.push(formatDate(currentDate));
                        }
                        labels.push('');

                        var chart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Historique Count',
                                    data: historicalData,
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1,
                                    fill: false
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Evolution du nombres des analyses par jour',
                                        font: {
                                            size: 16
                                        }
                                    }
                                }
                            }
                        });
                    </script>


                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-red set-icon">
                                <i class="fa fa-envelope-o"></i>
                            </span>
                            <div class="text-box">
                                <?php
                                $medicamentC = new MedicamentController();
                                $historiqueCount = $medicamentC->gethistoriqueCount();
                                ?>
                                <p class="main-text">
                                    <?php echo $historiqueCount; ?> Analyses
                                </p>
                                <p class="text-muted">en total</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-red set-icon">
                                <i class="fa fa-envelope-o"></i>
                            </span>
                            <div class="text-box">
                                <?php
                                $medicamentC1 = new MedicamentController();
                                $historiqueCount1 = $medicamentC1->getHistoriqueCountForToday();
                                ?>
                                <p class="main-text">
                                    <?php echo $historiqueCount1; ?> Analyses
                                </p>
                                <p class="text-muted">ajoutés aujourd'hui</p>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /. ROW  -->
                <hr />
            </div>
        </div>
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