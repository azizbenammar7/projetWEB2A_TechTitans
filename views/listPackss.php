<?php
session_start();
include '../controller/PackC.php';
include '../controller/UserC.php';
include '../model/User.php';

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
    <title>Klinik - Clinic Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="frontoffice/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="frontoffice/lib/animate/animate.min.css" rel="stylesheet">
    <link href="frontoffice/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="frontoffice/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="frontoffice/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="frontoffice/css/style.css" rel="stylesheet">
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
                echo '<img  src="' . $_SESSION['user_details']['pdp'] . '" alt="pdp" style="width: 100%; height: 100%; object-fit: cover;">';
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
            <h1 class="display-3 text-white mb-3 animated slideInDown">Packs</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Packs</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

<!-------------------------------------------------------------------------------------------------------------->
<?php
//include '../controller/PackC.php';
$packC = new PackC(); 
$list = $packC->listPacks();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nompack = $_POST['nompack'] ?? null;
    $prixMax = $_POST['prixMax'] ?? null;
    $dateFin = $_POST['dateFin'] ?? null;

   // Filtrez la liste des packs en fonction des critères
   if (!empty($nompack) && empty($prixMax) && empty($dateFin)) {
    // Filtrer par nom seulement
    $list = $packC->filterPacksByName($nompack);
} elseif (empty($nompack) && !empty($prixMax) && empty($dateFin)) {
    // Filtrer par prix seulement
    $list = $packC->filterPacksByPrice($prixMax);
} elseif (empty($nompack) && empty($prixMax) && !empty($dateFin)) {
    // Filtrer par date de fin seulement
    $list = $packC->filterPacksByDateFin($dateFin);
}
elseif (empty($nompack) && empty($prixMax) && empty($dateFin)) {
    
    $list = $packC->listPacks();
} else {
    // Si le formulaire n'est pas soumis, affichez tous les packs
    $list = $packC->listPacks();
}}


?>
<html>
<body>
    <!-- Titre de la page -->
    <h1 class="text-center">List of packs</h1>

    <!-- Lien pour ajouter un pack -->
    <h2 class="text-center">
        <a href="addPack.php" target="_blank">Add pack</a>
        <!-- Modifiez le lien pour ajouter un pack -->
    </h2>

 <!-- Formulaire de recherche et filtre -->
 <form method="post" class="text-center mt-3">
        <label for="nompack">Search by name:</label>
        <input type="text" name="nompack" id="nompack">

        <label for="prixMax">Filter by Price (Max): </label>
        <input type="text" name="prixMax">

        <label for="dateFin">Filter by End Date: </label>
        <input type="date" name="dateFin">

        <button type="submit" class="btn btn-primary">Search and Filter</button>
    </form>


    <!-- Liste des packs -->
    <div class="row g-4 d-flex justify-content-center">
        <?php foreach ($list as $pack) {
            // Obtenez la moyenne de note pour ce pack
        $averageRating = $packC->getAverageRating($pack['IDpack']); 

        $currentDate = date('Y-m-d'); // Date système

        // Vérifier si la date de début du pack est à venir
        $comingSoon = strtotime($pack['date_debut']) > strtotime($currentDate);
            ?>
            
            
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item position-relative rounded overflow-hidden">

                    <!-- Ajouter la bande en haut du cadre -->
                    <div class="overflow-hidden">
                        <!-- Bloc de texte du pack -->
                        <div class="team-text bg-light text-center p-4">
                        <!-- Bouton pour ajouter un avis -->
                        <a href="addAvis.php?idPack=<?php echo $pack['IDpack']; ?>" class="btn btn-primary mt-2">Ajouter un avis</a>
                        <a href="avisparpack.php?idPack=<?php echo $pack['IDpack']; ?>" class="btn btn-primary mt-2">Voir les avis</a>
 <!-- Afficher "Top Rated" si la moyenne de note est élevée -->
 <?php if ($averageRating >= 4.5) { ?>
                        <p class="text-success">Top Rated</p>
                    <?php } ?>
                    <?php if ($comingSoon) { ?>
    <p class="text-warning">Coming Soon</p>
<?php } ?>

                        </div>

                        <!-- Afficher l'image du pack -->
                        <img class="img-fluid" src="<?php echo $pack['image']; ?>" alt="Pack Image">
                    </div>

                    <!-- Deuxième bloc de texte du pack -->
                    <div class="team-text bg-light text-center p-4">
                        <!-- Afficher le nom du pack avec une icône pour les détails -->
                        <h5 class="team-name">
                                <?php echo $pack['nompack']; ?>
                                <span data-toggle="tooltip" data-placement="top" title="<?php echo $pack['description']; ?>">
                                    <i class="fas fa-info-circle ml-2" style="cursor: pointer;"></i>
                                </span>
                            </h5>
                        


                        <!-- Afficher le type et le prix dans la même ligne -->
                        <p class="text-primary"><?php echo $pack['type'] . ' - ' . $pack['prix'] . ' $'; ?></p>

                        <!-- Bouton pour s'abonner -->
                        <div class="team-social text-center">
                        <a class="favorite styled" href="payment.php?idPack=<?php echo $pack['IDpack']; ?>">S'abonner</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
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

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="frontoffice/lib/wow/wow.min.js"></script>
    <script src="frontoffice/lib/easing/easing.min.js"></script>
    <script src="frontoffice/lib/waypoints/waypoints.min.js"></script>
    <script src="frontoffice/lib/counterup/counterup.min.js"></script>
    <script src="frontoffice/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="frontoffice/lib/tempusdominus/js/moment.min.js"></script>
    <script src="frontoffice/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="frontoffice/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="frontoffice/js/main.js"></script>
</html>
