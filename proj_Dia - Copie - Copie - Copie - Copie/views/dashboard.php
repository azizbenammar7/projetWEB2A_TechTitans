<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DiaZen</title>
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
    <!-- Spinner Start -->
    <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>-->
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-light p-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small>123 Street, Ariana , TN</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small>24h/24 7j/7</small>
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
                <a href="index.html" class="nav-item nav-link">Acceuil</a>
                <a href="about.html" class="nav-item nav-link">À propos</a>
                <a href="service.html" class="nav-item nav-link">Forum</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Services</a>
                    <div class="dropdown-menu rounded-0 rounded-bottom m-0">
                        <a href="feature.html" class="dropdown-item">Abonnement</a>
                        <a href="team.html" class="dropdown-item">Chercher un médicament</a>
                        <a href="Ajout_analyses.html" class="dropdown-item ">Ajout d'analyses</a>
                        <a href="historique_analyses.html" class="dropdown-item active">Historique d'analyses</a>
                        <a href="reclamation.html" class="dropdown-item">Réclamation</a>
                    </div>
                </div>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
            <a href="" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Ajout d'analyses<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">espace personnel</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Acceuil</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">profil</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">espace personnel</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Service Start -->
   <!-- Service Start -->
<div class="container-xxl py-5">
    <div class="analysis-entry">
        <?php

        // Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php");
            exit();
        }

        // Inclure le fichier de configuration de la base de données et le fichier utilisateur
        include "../controller/userC.php";

        // Récupérer les informations de l'utilisateur à partir de la base de données
        $userC = new UserC();
        $user = $userC->showUser($_SESSION['user_id']);
        $_SESSION['user_details'] = $user;

        ?>

        <div id="text"></div>

        <script>
            const textEl = document.getElementById('text');
            const text = '<h2>Bienvenue sur votre espace personnel, <?= $user["prenom"]; ?>!</h2>';
            let idx = 0;
            const speed = 100;

            writeText();

            function writeText() {
                textEl.innerHTML = text.slice(0, idx);

                idx++;

                if (idx <= text.length) {
                    setTimeout(writeText, speed);
                }
            }
        </script>
         <p style="color: black; font-size: 18px;">Voici quelques informations sur votre profil :</p>
        <ul style="color: black; font-size: 18px;">
       
        <style>
    ul li {
        margin-bottom: 10px; /* Adjust the value to control the space between lines */
    }
</style>

<ul>
<li><?php
                       if (!empty($user['pdp'])) {
                        echo '<div style="width: 150px; height: 150px; overflow: hidden; border-radius: 50%;">';
                        echo '<img src="' . $user['pdp'] . '" alt="pdp" style="width: 100%; height: 100%; object-fit: cover;">';
                        echo '</div>';
                    } else {
                        echo '<div style="width: 150px; height: 150px; overflow: hidden; border-radius: 50%;">';
                        echo '<img src="img/other.png" alt="other" style="width: 100%; height: 100%; object-fit: cover;">';
                        echo '</div>';
                    }?>
    <li><strong>Nom:</strong> <?= $user['nom']; ?></li>
    <li><strong>Prénom:</strong> <?= $user['prenom']; ?></li>
    <li><strong>Email:</strong> <?= $user['email']; ?></li>
    <li><strong>Téléphone:</strong> <?= $user['tel']; ?></li>
    <li><strong>Rôle: </strong><?= $user['role_user']; ?></li>
    <li><strong>Type de diabète:</strong> <?= $user['typeDiabete']; ?></li>
    <li><strong>Ville: </strong><?= $user['ville']; ?></li>
    <li><strong>Diplôme: </strong><?php
                            if (!empty($user['diplome'])) {
                                echo '<img src="' . $user['diplome'] . '" alt="Diplome" style="max-width: 200px; max-height: 200px;">';
                            } else {
                                echo 'Aucun diplôme';
                            }
                            ?></li>
            <!-- Ajoutez d'autres informations si nécessaire -->
        </ul>
        <a class="btn" href="logout.php">Se déconnecter</a>
        <a class="btn" href="updateuser1.php">Mettre à jour profil</a>
 

    </div>
</div>
<!-- Service End -->

    <!-- Service End -->

        

 <!-- Footer Start -->
 <div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h5 class="text-light mb-4">Address</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, Ariana, TN</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@esprit.tn</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="text-light mb-4">Services</h5>
                <a class="btn btn-link" href="">Abonnement</a>
                <a class="btn btn-link" href="">Chercher un médicament</a>
                <a class="btn btn-link" href="">Ajout d'analyses</a>
                <a class="btn btn-link" href="">Historique d'analyses</a>
                <a class="btn btn-link" href="">Réclamation</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="text-light mb-4">Quick Links</h5>
                <a class="btn btn-link" href="">À propos</a>
                <a class="btn btn-link" href="">Contact </a>
                <a class="btn btn-link" href="">Services</a>
                <a class="btn btn-link" href="">Forum</a>
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
                    &copy; <a class="border-bottom" href="#">DiaZen</a>, All Right Reserved.
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
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>