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
    <!-- logo a ajouteer  -->
    </a>
        <button idfichee="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.html" class="nav-item nav-link">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="service.html" class="nav-item nav-link">Service</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu rounded-0 rounded-bottom m-0">
                        <a href="feature.html" class="dropdown-item">Feature</a>
                        <a href="team.html" class="dropdown-item active">Our Doctor</a>
                        <a href="appointment.html" class="dropdown-item">Appointment</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </div>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
            <a href="" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Appointment<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
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
include "../controller/medicament.php";
include "../controller/TypeController.php";

$medicamentController = new MedicamentController();
$idficheesController = new TypeController();
$medicaments = $medicamentController->listMedicament();
$idfichees = $idficheesController->listidfichee();

// Si une recherche par nom est effectuée
if (isset($_GET['q']) && !empty($_GET['q'])) {
    $searchTerm = $_GET['q'];
    $medicaments = $medicamentController->searchMedicamentByName($searchTerm);
}

// Si un idfichee est sélectionné dans le menu déroulant
if (isset($_GET['idfichee_medicament']) && !empty($_GET['idfichee_medicament'])) {
    $selectedidfichee = $_GET['idfichee_medicament'];
    $medicaments = $medicamentController->filterMedicamentByidfichee($selectedidfichee);
}
?>

<!DOCidficheE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Liste des médicaments</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Ajoutez les liens vers vos feuilles de style CSS ici -->
    <link href="votre_style.css" rel="stylesheet">
</head>

<body>
    <center>
        <h1>Liste des médicaments</h1>
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <div id="pharmacie_cadre">
                        <form action="" method="GET" class="d-flex">
                            <select name="idfichee_medicament" id="idfichee_medicament" class="form-select" style="height: 50px; font-size: 16px; margin-right: 5px;">
                                <option value="" disabled selected>Choix</option>
                                <?php foreach ($idfichees as $idfichee) : ?>
                                    <option value="<?= $idfichee['idfiche']; ?>"><?= $idfichee['idfiche']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input idfichee="text" id="searchInput" name="q" placeholder="Rechercher..." class="form-control" style="width: 400px; height: 40px; font-size: 16px; margin-right: 5px;">
                            <input idfichee="submit" value="Rechercher" class="btn btn-primary" style="height: 40px; background-color: #87CEEB; margin-right: 5px;">
                            <a href="frontoffice.php" class="btn btn-primary" style="height: 40px; background-color: #87CEEB;">Home</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </center>
    <div class="row g-4">
        <?php foreach ($medicaments as $medicament) : ?>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item position-relative rounded overflow-hidden" data-idfichee="<?= strtolower($medicament['idfiche']); ?>">
                    <div class="overflow-hidden">
                        <!-- Afficher l'image du médicament -->
                        <img class="img-fluid" src="<?= $medicament['piece_jointe']; ?>" alt="Image du médicament">
                    </div>
                    <div class="team-text bg-light text-center p-4">
                        <!-- Afficher le nom du médicament sans le idfichee -->
                        <h5><?= $medicament['nom']; ?></h5>

                        <!-- Condition pour changer la couleur en fonction de la cholibilité -->
                        <?php if ($medicament['chol'] === 'cholible') : ?>
                            <p class="texte-vert"><?= $medicament['chol']; ?></p>
                        <?php else : ?>
                            <p class="texte-rouge"><?= $medicament['chol']; ?></p>
                        <?php endif; ?>

                        <div class="team-social text-center">
                            <!-- Bouton pour acheter -->
                            <input class="favorite styled" idfichee="button" value="Acheter" />
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
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
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" idfichee="text" placeholder="Your email">
                        <button idfichee="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
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