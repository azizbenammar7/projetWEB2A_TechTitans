<?php
session_start();

include '../controller/UserC.php';
include '../model/User.php';
include "../controller/medicament1.php";
include "../controller/typecontroller1.php";
$error = "";

// Créez une instance du contrôleur
$userC = new UserC();

// Créez une instance de la classe User
$user = null;
$user = $_SESSION['user_details'];
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Diazen - Clinic Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<!-- Spinner Start 
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
   Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-light p-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small>123 Street, New York, USA</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small>Mon - Fri : 09.00 AM - 09.00 PM</small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>+012 345 6789</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-0" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h1 class="m-0 text-primary"><i class="far fa-hospital me-3"></i>DiaZen</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="acceuil.php" class="nav-item nav-link">Acceuil</a>
                <a href="listPackss.php" class="nav-item nav-link">Packs</a>
                <a href="frontoffice1.php" class="nav-item nav-link">pharmacie</a>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Forum</a>
                    <div class="dropdown-menu rounded-0 rounded-bottom m-0">
                        <a href="addpublication.php" class="dropdown-item ">Créer une publication</a>                       
                        <a href="accueil_forum.php" class="dropdown-item ative">accueil forum</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Services</a>
                    <div class="dropdown-menu rounded-0 rounded-bottom m-0">                      
                        <a href="ajouthistorique.php" class="dropdown-item ">Ajout d'analyses</a>
                        <a href="ajoutfiche.php" class="dropdown-item active">Ajouter une fiche</a>
                        <a href="historique_analyses.php" class="dropdown-item">Historique d'analyses</a>                        
                    </div>
                </div>
                <a href="addReclamation.php" class="nav-item nav-link">reclamation</a>
                <?php
if (isset($_SESSION['user_id'])) {
    // User is logged in
    ?>
    <div class="d-flex align-items-center p-2 bg-primary text-white rounded">
        <?php
        if (isset($_SESSION['user_details']) && !empty($_SESSION['user_details'])) {
            if (!empty($_SESSION['user_details']['pdp'])) {
                echo '<div style="width: 40px; height: 40px; overflow: hidden; border-radius: 50%; margin-right: 10px;">';
                echo '<img src="' . $_SESSION['user_details']['pdp'] . '" alt="pdp" style="width: 100%; height: 100%; object-fit: cover;">';
                echo '</div>';
            } else {
                echo '<div style="width: 40px; height: 40px; overflow: hidden; border-radius: 50%; margin-right: 10px;">';
                echo '<img src="img/other.png" alt="other" style="width: 100%; height: 100%; object-fit: cover;">';
                echo '</div>';
            }
            ?>
            <p class="m-0"><?php echo $_SESSION['user_details']['prenom'] . ' ' . $_SESSION['user_details']['nom']; ?></p>
            <?php
        } 
        ?>
    </div>
    <?php
} else {
    // User is not logged in, display login button or other content
    ?>
    <a href="login.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Login<i class="fa fa-arrow-right ms-3"></i></a>
    <?php
}
?>


    </nav>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Doctors</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Doctors</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
    <?php


$medicamentController = new MedicamentController1();
$typesController = new TypeController1();
$articlesParPage = isset($_GET['articlesParPage']) ? (int)$_GET['articlesParPage'] : 4;

// Récupérer tous les médicaments sous forme de tableau
$medicaments = $medicamentController->listMedicament()->fetchAll(PDO::FETCH_ASSOC);
$types = $typesController->listType();

// Appliquer les filtres de recherche
if (isset($_GET['q']) && !empty($_GET['q'])) {
    $searchTerm = $_GET['q'];
    $medicaments = $medicamentController->searchMedicamentByName($searchTerm);
}

// Ne pas réinitialiser $medicaments à la liste complète ici
// ...

if (isset($_GET['type_medicament']) && !empty($_GET['type_medicament'])) {
    $selectedType = $_GET['type_medicament'];
    $medicaments = $medicamentController->filterMedicamentByType($selectedType);
}

// Ne pas réinitialiser $medicaments à la liste complète ici
// ...

if (isset($_GET['lieu']) && !empty($_GET['lieu'])) {
    $selectedLieu = $_GET['lieu'];
    $medicaments = $medicamentController->filterMedicamentByLieu($selectedLieu);
}

// Ne pas réinitialiser $medicaments à la liste complète ici
// ...

if (isset($_GET['q']) && !empty($_GET['q']) && isset($_GET['lieu']) && !empty($_GET['lieu'])) {
    $searchTerm = $_GET['q'];
    $selectedLieu = $_GET['lieu'];
    $medicaments = $medicamentController->filterMedicamentByNameAndLieu($searchTerm, $selectedLieu);
}

// Pagination
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startIndex = ($currentPage - 1) * $articlesParPage;
$pagedMedicaments = array_slice($medicaments, $startIndex, $articlesParPage);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Liste des médicaments</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="votre_style.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background-color: #87CEEB;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .form-container select,
        .form-container input {
            height: 40px;
            font-size: 16px;
            margin-right: 5px;
        }

        .form-container select {
            flex-basis: calc(33.333% - 5px);
        }

        .form-container input {
            flex-basis: calc(66.666% - 5px);
        }

        .form-container button {
            height: 40px;
            background-color: #87CEEB;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container a {
            height: 40px;
            background-color: #87CEEB;
            color: #fff;
            text-decoration: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .results-container {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .result-item {
            flex-basis: calc(25% - 20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .result-item img {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #ddd;
        }

        .result-item .result-info {
            padding: 10px;
        }

        .result-item h5 {
            margin: 0;
        }

        .result-item p {
            margin: 5px 0;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #fff;
            padding: 10px;
            text-decoration: none;
            margin: 0 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            background-color: #87CEEB;
        }

        .pagination a:hover {
            background-color: #6495ED;
        }

        .navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .navigation a {
            color: #fff;
            padding: 10px;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #87CEEB;
        }

        .navigation a:hover {
            background-color: #6495ED;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Liste des médicaments</h1>
    </div>

    <div class="container form-container">
        <form action="" method="GET">
            <div id="lieuSection">
                <select name="lieu" id="lieu" class="form-select" style="height: 50px; font-size: 16px; margin-right: 5px;">
                    <option value="" disabled selected>Choix du lieu</option>
                    <?php
                    // Liste des lieux à afficher dans le menu déroulant
                    $lieux = ["Gbeli", "Gafsa", "Jandouba", "Bizerte", "Beja", "Kairouan", "Sidi Bouzid", "Sfax", "Gabes", "Medenine", "Monastir", "Sousse"];
                    foreach ($lieux as $lieu) : ?>
                        <option value="<?= $lieu; ?>" <?= (isset($_GET['lieu']) && $_GET['lieu'] == $lieu) ? 'selected' : '' ?>><?= $lieu; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Barre de type (affichée par défaut) -->
            <div id="typeSection">
                <select name="type_medicament" id="type_medicament">
                    <option value="" disabled selected>Choix</option>
                    <?php foreach ($types as $type) : ?>
                        <option value="<?= $type['typ']; ?>" <?= (isset($_GET['type_medicament']) && $_GET['type_medicament'] == $type['typ']) ? 'selected' : '' ?>><?= $type['typ']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Barre de lieu (initialement cachée) -->
            <div id="lieuSection" style="display: none;">
                <select name="lieu" id="lieu">
                    <option value="" disabled selected>Choix du lieu</option>
                    <?php foreach ($lieux as $lieu) : ?>
                        <option value="<?= $lieu; ?>" <?= (isset($_GET['lieu']) && $_GET['lieu'] == $lieu) ? 'selected' : '' ?>><?= $lieu; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Deuxième barre de choix (barre de recherche par nom) -->
            <div style="flex-basis: 100%; margin-top: 10px;">
                <input type="text" id="searchInput" name="q" placeholder="Rechercher par nom..." class="form-control" style="width: 100%;" value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>">
            </div>

            <button type="submit">Rechercher</button>
            <a href="frontoffice.php">Home</a>
        </form>
    </div>

    <div class="container results-container">
        <?php foreach ($pagedMedicaments as $medicament) : ?>
            <div class="result-item">
                <img src="<?= $medicament['piece_jointe']; ?>" alt="Image du médicament">
                <div class="result-info">
                    <h5><?= $medicament['nom']; ?></h5>
                    <?php if ($medicament['dispon'] === 'disponible') : ?>
                        <p style="color: green;"><?= $medicament['dispon']; ?></p>
                    <?php else : ?>
                        <p style="color: red;"><?= $medicament['dispon']; ?></p>
                    <?php endif; ?>
                    <p>Lieu: <?= $medicament['lieu']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    

    <ul class="pagination">
        <?php
        $totalPages = ceil(count($medicaments) / $articlesParPage);

        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<li><a href='frontoffice.php?page=$i&articlesParPage=$articlesParPage'>$i</a></li>";
        }
        ?>
    </ul>

    <div class="navigation">
        <a href='frontoffice.php?page=1&articlesParPage=<?= $articlesParPage; ?>'>&lt;&lt; Première page</a>
        <?php
        if ($currentPage > 1) {
            $prevPage = $currentPage - 1;
            echo "<a href='frontoffice.php?page=$prevPage&articlesParPage=$articlesParPage'>&lt; Page précédente</a>";
        }
        ?>
        <?php
        if ($currentPage < $totalPages) {
            $nextPage = $currentPage + 1;
            echo "<a href='frontoffice.php?page=$nextPage&articlesParPage=$articlesParPage'>Page suivante &gt;</a>";
        }
        ?>
        <a href='frontoffice.php?page=<?= $totalPages; ?>&articlesParPage=<?= $articlesParPage; ?>'>Dernière page &gt;&gt;</a>
    </div>

    <!-- Ajoutez vos scripts JavaScript ici -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var filterBy1 = document.getElementById("filterBy1");
            var typeSection = document.getElementById("typeSection");
            var lieuSection = document.getElementById("lieuSection");

            filterBy1.addEventListener("change", function () {
                typeSection.style.display = "none";
                lieuSection.style.display = "none";

                if (filterBy1.value === "type_medicament") {
                    typeSection.style.display = "block";
                } else if (filterBy1.value === "lieu") {
                    lieuSection.style.display = "block";
                }
            });
        });
    </script>
</body>

</html>


























    <!-- Ajoutez les liens vers vos scripts JavaScript ici -->



<!-------------------------------------------------------------------------------------------------------------->
<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Address</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Services</h5>
                    <a class="btn btn-link" href="">Cardiology</a>
                    <a class="btn btn-link" href="">Pulmonary</a>
                    <a class="btn btn-link" href="">Neurology</a>
                    <a class="btn btn-link" href="">Orthopedics</a>
                    <a class="btn btn-link" href="">Laboratory</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Quick Links</h5>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Newsletter</h5>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
<!-------------------------------------------------------------------------------------------------------------->

</html>