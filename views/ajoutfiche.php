<?php
session_start();
include '../controller/TypeController.php';
include '../model/typemodel.php';
include '../controller/UserC.php';
include '../model/User.php';
$error = "";
$TypeController = new TypeController();
$idfichees = $TypeController->listidfichee();


// Créez une instance du contrôleur
$userC = new UserC();

// Créez une instance de la classe User
$user = null;
$user = $_SESSION['user_details'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification du champ obligatoire
    if (empty($_POST["idfiche"])) {
        $error = "Le champ 'idfiche' est obligatoire.";
    } else {
        // Assuming you have other form fields like email, tel, and sexe
        $idfiche = $user['nom'];
        $email = isset($_POST['email']) ? $user['email'] : null;
        $tel = isset($_POST['tel']) ? $user['tel'] : null;
        $sexe = isset($_POST['sexe']) ? $_POST['sexe'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $user = isset($_POST['user']) ? $user['id'] : null;



        // Assuming the existence of the 'idFichee' class and 'addidfichee' method
        $idfichee = new idFichee(null, $idfiche, $email, $tel, $sexe, $description , $user);
        // Assuming you have successfully added a patient's record
        $TypeController->addidfichee($idfichee);



        // Redirect to the list page
        header('Location: ajoutfiche.php');
        // Generate and download the PDF
        $TypeController->generatePDF($idfichee);

    }
}
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
    <link href="../img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="stylenotif.css" type="text/css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>

<body>
    <a href="listidfichee.php">Back to list </a>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
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
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href=""><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href=""><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href=""><i
                            class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-0" href=""><i
                            class="fab fa-instagram"></i></a>
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
                <a href="listPackss.php" class="nav-item nav-link">Packs</a>
                <a href="frontofficemed.php" class="nav-item nav-link">pharmacie</a>

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
            <h1 class="display-3 text-white mb-3 animated slideInDown">Ajouter une fiche</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Acceuil</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Service</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Ajouter une fiche</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Appointment Start -->
    <div id="error">
        <?php echo $error; ?>
    </div>
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Ajout d'analyses</p>
                    <h1 class="mb-4">Ajouter un nouvelle fiche</h1>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et
                        eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet
                    </p>
                    <div class="bg-light rounded d-flex align-items-center p-5 mb-4">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white"
                            style="width: 55px; height: 55px;">
                            <i class="fa fa-phone-alt text-primary"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-2">Call Us Now</p>
                            <h5 class="mb-0">+012 345 6789</h5>
                        </div>
                    </div>
                    <div class="bg-light rounded d-flex align-items-center p-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white"
                            style="width: 55px; height: 55px;">
                            <i class="fa fa-envelope-open text-primary"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-2">Mail Us Now</p>
                            <h5 class="mb-0">info@esprit.tn</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-light rounded h-100 d-flex align-items-center p-5">
                        <form action="" method="POST">
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" id="idfiche" name="idfiche"
                                        placeholder="Nom & Prenom" style="height: 55px;"value="<?php echo $user['nom']; ?>" readonly />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" id="user" name="user"
                                        placeholder="id_user" style="height: 55px;"value="<?php echo $user['id']; ?>" readonly />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" class="form-control border-0" id="email" name="email"
                                        placeholder="email" style="height: 55px;"value="<?php echo $user['email']; ?>" readonly />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="number" class="form-control border-0" id="tel" name="tel"
                                        placeholder="tel" style="height: 55px;" value="<?php echo $user['tel']; ?>" readonly />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" id="sexe" name="sexe"
                                        placeholder="male ou female" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" id="descrition" name="description"
                                        placeholder="Avez vous des Antécédents Médicaux  ou des Allergies ?"
                                        style="height: 55px;">
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit"
                                        onclick="saveAndNotify()">Sauvegarder les analyses</button>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="reset">réinitialiser les
                                        analyses</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->


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
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i
                                class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i
                                class="fab fa-linkedin-in"></i></a>
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
                        <button type="button"
                            class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
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
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/counterup/counterup.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
    <script>
        window.embeddedChatbotConfig = {
            chatbotId: "1WmNU86yEAFPv_8Pe8lq0",
            domain: "www.chatbase.co"
        }
    </script>
    <script src="https://www.chatbase.co/embed.min.js" chatbotId="1WmNU86yEAFPv_8Pe8lq0" domain="www.chatbase.co" defer>
    </script>
    <script>
        function saveAndNotify() {
            // enable this if you want to make only one call and not repeated calls automatically
            pushNotify();
        }

        // Function to check if today is Monday
        function isMonday() {
            const today = new Date();
            return today.getDay() === 4; // Sunday is 0, Monday is 1, and so on
        }

        // Call pushNotify() only on Mondays
        if (isMonday()) {
            pushNotify();
        }


        // following makes an AJAX call to PHP to get notification every 10 secs
        //setInterval(function(){pushNotify();}, 10000);

        function pushNotify() {
            if (!("Notification" in window)) {
                // checking if the user's browser supports web push Notification
                alert("Web browser does not support desktop notification");
            }
            if (Notification.permission !== "granted")
                Notification.requestPermission();
            else {
                $.ajax({
                    url: "push-notify.php",
                    type: "POST",
                    success: function (data, textStatus, jqXHR) {
                        // if PHP call returns data process it and show notification
                        // if nothing returns then it means no notification available for now
                        if ($.trim(data)) {
                            var data = jQuery.parseJSON(data);
                            console.log(data);
                            notification = createNotification(data.title, data.icon, data.body, data.url);

                            // closes the web browser notification automatically after 5 secs
                            setTimeout(function () {
                                notification.close();
                            }, 5000);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) { }
                });
            }
        };

        function createNotification(title, icon, body, url) {
            var notification = new Notification(title, {
                icon: icon,
                body: body,
            });
            // url that needs to be opened on clicking the notification
            // finally everything boils down to click and visits right
            notification.onclick = function () {
                window.open(url);
            };
            return notification;
        }

    </script>
</body>

</html>