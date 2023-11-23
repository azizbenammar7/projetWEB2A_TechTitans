<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>DiaZen</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap"
      rel="stylesheet"
    />

    <!-- Icon Font Stylesheet -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet" />
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link
      href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css"
      rel="stylesheet"
    />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- Spinner Start -->
    <div
      id="spinner"
      class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
    >
      <div
        class="spinner-grow text-primary"
        style="width: 3rem; height: 3rem"
        role="status"
      >
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
            <a
              class="btn btn-sm-square rounded-circle bg-white text-primary me-1"
              href=""
              ><i class="fab fa-facebook-f"></i
            ></a>
            <a
              class="btn btn-sm-square rounded-circle bg-white text-primary me-1"
              href=""
              ><i class="fab fa-twitter"></i
            ></a>
            <a
              class="btn btn-sm-square rounded-circle bg-white text-primary me-1"
              href=""
              ><i class="fab fa-linkedin-in"></i
            ></a>
            <a
              class="btn btn-sm-square rounded-circle bg-white text-primary me-0"
              href=""
              ><i class="fab fa-instagram"></i
            ></a>
          </div>
        </div>
      </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav
      class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn"
      data-wow-delay="0.1s"
    >
      <a
        href="index.html"
        class="navbar-brand d-flex align-items-center px-4 px-lg-5"
      >
        <h1 class="m-0 text-primary">
          <i class="far fa-hospital me-3"></i>DiaZen
        </h1>
      </a>
      <button
        type="button"
        class="navbar-toggler me-4"
        data-bs-toggle="collapse"
        data-bs-target="#navbarCollapse"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
          <a href="index.html" class="nav-item nav-link">Acceuil</a>
          <a href="about.html" class="nav-item nav-link">À propos</a>
          <div class="nav-item dropdown">
            <a
              href="#"
              class="nav-link dropdown-toggle active"
              data-bs-toggle="dropdown"
              >Forum</a
            >
            <div class="dropdown-menu rounded-0 rounded-bottom m-0">
              <a href="forum.html" class="dropdown-item active"
                >Créer une publication</a
              >
              <a href="mes_pubs.html" class="dropdown-item">Mes publications</a>
              <a href="accueil_forum.html" class="dropdown-item"
                >Tous les publications</a
              >
            </div>
          </div>
          <div class="nav-item dropdown">
            <a
              href="#"
              class="nav-link dropdown-toggle"
              data-bs-toggle="dropdown"
              >Services</a
            >
            <div class="dropdown-menu rounded-0 rounded-bottom m-0">
              <a href="feature.html" class="dropdown-item">Abonnement</a>
              <a href="team.html" class="dropdown-item"
                >Chercher un médicament</a
              >
              <a href="Ajout_analyses.html" class="dropdown-item"
                >Ajout d'analyses</a
              >
              <a href="testimonial.html" class="dropdown-item"
                >Historique d'analyses</a
              >
              <a href="reclamation.html" class="dropdown-item">Réclamation</a>
            </div>
          </div>
          <a href="contact.html" class="nav-item nav-link">Contact</a>
        </div>
        <a
          href=""
          class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block"
          >Ajout d'analyses<i class="fa fa-arrow-right ms-3"></i
        ></a>
      </div>
    </nav>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div
      class="container-fluid page-header py-5 mb-5 wow fadeIn"
      data-wow-delay="0.1s"
    >
      <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Forum</h1>
        <nav aria-label="breadcrumb animated slideInDown">
          <ol class="breadcrumb text-uppercase mb-0">
            <li class="breadcrumb-item">
              <a class="text-white" href="#">Acceuil</a>
            </li>
            <li class="breadcrumb-item">
              <a class="text-white" href="#">Forum</a>
            </li>
            <li class="breadcrumb-item text-primary active" aria-current="page">
              Créer une publication
            </li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- Page Header End -->
