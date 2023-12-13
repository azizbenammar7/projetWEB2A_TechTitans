<?php
session_start();
include "../controller/pubC.php";


include '../controller/UserC.php';
include '../model/User.php';

$error = "";

// Créez une instance du contrôleur
$userC = new UserC();

// Créez une instance de la classe User
$user = null;
$user = $_SESSION['user_details'];
$pubC = new pubC();

// Default: list all publications
$publications = $pubC->listPublications();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Filter by date if the date filter is set
    if (isset($_POST["datePubFilter"])) {
        $datePubFilter = $_POST["datePubFilter"];
        $publications = $pubC->filterPublicationByDate($datePubFilter);
    }

    // Filter by likes if the likes filter is set
    if (isset($_POST["filterByLikes"])) {
        $publications = $pubC->filterByLikes(10);
    }

    // Filter by most likes if the most likes filter is set
    if (isset($_POST["filterByMostLikes"])) {
        $publications = $pubC->filterByMostLikes();
    }
}
?>
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
    <!-- <link href="css/style_acceuil.css" rel="stylesheet" /> -->
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
              Acceuil forum
            </li>
          </ol>
        </nav>
      </div>
    </div>
    
    <!-- Page Header End -->
    <link href="https://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
    






  </body>
</html>

<!-- Accueil Start -->
<div class="search-bar">
    <form method="GET">
        <input type="text" id="search" name="search" placeholder="Enter text...">
        <input type="submit" value="Search">
    </form>

  
    <form method="post" action="">
        <label for="datePubFilter"></label>
        <input type="date" name="datePubFilter">
        <input type="submit" value="Apply Filter">
    </form>

    <form method="post" action="">
        <input type="hidden" name="filterByLikes" value="1">
        <input type="submit" value="Hot publications">
    </form>

    <form method="post" action="">
      <input type="hidden" name="filterByMostLikes" value="1">
      <input type="submit" class="btn btn-primary" value="Most Liked Publications">
    </form>
</div>





<div class="acceuil">
    <div class="container">

        <!-- Loop through publications and display them -->
        <?php foreach ($publications as $publication) : ?>
            <?php
            // Filter publications based on search criteria
            if (isset($_GET['search']) && $_GET['search'] != '' && strpos($publication['text_of_pub'], $_GET['search']) === false) {
                continue; // Skip this row if it doesn't match the search criteria
            }
            ?>

            <div class="acceuil">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="media g-mb-30 media-comment">
                                <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Image Description">
                                <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                                    <div class="g-mb-15">
                                        <h5 class="h5 g-color-gray-dark-v1 mb-0"><?php echo $publication['nom'] . ' ' . $publication['prenom']; ?></h5>
                                        <span class="g-color-gray-dark-v4 g-font-size-12"><?php echo $publication['date_pub']; ?></span>
                                    </div>
                                    <p><?php echo $publication['text_of_pub']; ?></p>
                                    <ul class="list-inline d-sm-flex my-0">
                                    <li class="list-inline-item g-mr-20">
    <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover like-btn" href="#!" data-publication-id="<?= $publication['IDpub']; ?>">
        <i class="fa fa-thumbs-up g-pos-rel g-top-1 g-mr-3"></i>
        <span class="like-count"><?= $publication['nbr_like']; ?></span>
        
    </a>
</li>

<!-- Dislike button -->
<li class="list-inline-item g-mr-20">
    <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover dislike-btn" href="#!" data-publication-id="<?= $publication['IDpub']; ?>">
        <i class="fa fa-thumbs-down g-pos-rel g-top-1 g-mr-3"></i>
        <span class="dislike-count"><?= $publication['nbr_dislike']; ?></span>
    </a>
</li>
                                        <li class="list-inline-item ml-auto">
                                                                 <!-- Link to show all comments -->
                        <a href="comments.php?IDpublication=<?= $publication['IDpub']; ?>" class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover">
                            See All Comments
                        </a>
                                            <!-- Link to show/hide comment section -->
                                            <a href="#" class="comment-link" data-publication-id="<?= $publication['IDpub']; ?>">Comment</a>

                                            <!-- Comment section (initially hidden) -->
                                            <div class="comment-section" id="comment-section-<?= $publication['IDpub']; ?>" style="display: none;">
                                                <textarea rows="4" cols="50" placeholder="Write your comment" id="comment-text-<?= $publication['IDpub']; ?>"></textarea>
                                                <div id="bad-word-message-<?= $publication['IDpub']; ?>" class="bad-word-message" style="color: red;"></div>
                                                <button class="submit-comment" data-publication-id="<?= $publication['IDpub']; ?>">Submit</button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
    
 

    <!-- Accueil End -->

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Add event listeners to all comment links
        var commentLinks = document.querySelectorAll(".comment-link");
        commentLinks.forEach(function (link) {
            link.addEventListener("click", function (event) {
                event.preventDefault();
                var publicationId = this.getAttribute("data-publication-id");
                toggleCommentSection(publicationId);
            });
        });

        // Add event listeners to all submit comment buttons
        var submitCommentButtons = document.querySelectorAll(".submit-comment");
        submitCommentButtons.forEach(function (button) {
            button.addEventListener("click", function (event) {
                console.log("hey")
                event.preventDefault();
                var publicationId = this.getAttribute("data-publication-id");
                submitComment(publicationId);
            });
        });

        // Add event listeners to like buttons
        var likeButtons = document.querySelectorAll(".like-btn");
        likeButtons.forEach(function (button) {
            button.addEventListener("click", function (event) {
                event.preventDefault();
                var publicationId = this.getAttribute("data-publication-id");
                handleLikeDislike(publicationId, 'like');
            });
        });
        
        // Add event listeners to dislike buttons
        var dislikeButtons = document.querySelectorAll(".dislike-btn");
        dislikeButtons.forEach(function (button) {
            button.addEventListener("click", function (event) {
                event.preventDefault();
                var publicationId = this.getAttribute("data-publication-id");
                handleLikeDislike(publicationId, 'dislike');
            });
        });

        // Function to toggle comment section visibility
        function toggleCommentSection(publicationId) {
            var commentSection = document.getElementById("comment-section-" + publicationId);
            commentSection.style.display = commentSection.style.display === "none" ? "block" : "none";
        }
        async function censorText(text) {
  const url = 'https://neutrinoapi-bad-word-filter.p.rapidapi.com/bad-word-filter';
  const options = {
    method: 'POST',
    headers: {
      'content-type': 'application/x-www-form-urlencoded',
      'X-RapidAPI-Key': '39a6765db3mshbd64869623b1471p152334jsn16ba0c85fb16',
      'X-RapidAPI-Host': 'neutrinoapi-bad-word-filter.p.rapidapi.com'
    },
    body: new URLSearchParams({
      content: text,
      'censor-character': '*'
    })
  };

  try {
    const response = await fetch(url, options);
    const result = await response.json();
    return result; // Return the response
  } catch (error) {
    console.error(error);
    return null; // Return null in case of an error
  }
}

// Function to handle comment submission using AJAX
// Function to handle comment submission using AJAX
async function submitComment(publicationId) {
  var commentText = document.getElementById("comment-text-" + publicationId).value;
  var badWordMessage = document.getElementById("bad-word-message-" + publicationId);

  // Check if bad words are present
  const hasBadWords = await censorText(commentText);
  if (hasBadWords['is-bad']) {
    console.log('Bad words detected. Comment not submitted.');
    badWordMessage.innerText = 'Your comment contains inappropriate language.';
    document.getElementById("comment-text-" + publicationId).innerText='';
    return;
  }
  // Clear the bad word message if there are no bad words
  badWordMessage.innerText = '';

  toggleCommentSection(publicationId);
  var formData = new FormData();
  formData.append('text_of_commentaire', commentText);
  formData.append('publication', publicationId);

  // Use fetch API to send data to the server
  fetch('addcommentaire.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    console.log(data);
    if (data.message === "Comment submitted successfully") {
      updateCommentList();
    } else {
      console.error('Error:', data.message);
    }
  })
  .catch(error => {
    console.error('Error:', error);
  });
}

        // Function to handle like/dislike actions using AJAX
        function handleLikeDislike(publicationId, action) {
            // Create a new FormData object to send data to the server
            var formData = new FormData();
            formData.append('action', action);
            formData.append('publication_id', publicationId);

            // Use fetch API to send data to the server
            fetch('like_dislike_handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Check if the server response contains a "success" property
                if (data.success) {
                    // Update like or dislike count on the frontend
                    var countElement;
                    if (action === 'like') {
                        countElement = document.querySelector('.like-count-' + publicationId);
                    } else if (action === 'dislike') {
                        countElement = document.querySelector('.dislike-count-' + publicationId);
                    }

                    if (countElement) {
                        countElement.innerText = data.newCount;
                    }
                } else {
                    // Handle the case where the server response indicates an error
                    console.error('Error:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        // Function to update the comment list using AJAX
        function updateCommentList() {
            // Use fetch API to get the updated comments list from the server
            fetch('listcommentaire.php')
            .then(response => response.text())
            .then(data => {
                // Replace the existing comments list with the updated one
                document.getElementById('comment-list-container').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        
    });
</script>


<style>
    .search-bar {
        text-align: center;
        margin-bottom: 20px;
    }

    .search-bar form {
        display: inline-block;
    }

    .search-bar label {
        margin-right: 10px;
    }

    .search-bar input[type="text"] {
        padding: 8px;
        font-size: 14px;
    }

    .search-bar input[type="submit"] {
        padding: 8px 12px;
        background-color: #4caf50; /* Green */
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .search-bar input[type="submit"]:hover {
        background-color: #45a049;
    }

    /* Style for the comment section */
.comment-section {
    background-color: #f7f7f7;
    padding: 15px;
    margin-top: 10px;
    border-radius: 5px;
}

/* Style for the comment text area */
.comment-section textarea {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    resize: vertical; /* Allow vertical resizing of the textarea */
}

/* Style for the comment submit button */
.comment-section button.submit-comment {
    background-color: #4caf50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.comment-section button.submit-comment:hover {
    background-color: #45a049;
}

/* Additional styling for the entire comment area */
.comment-area {
    background-color: #f7f7f7;
    padding: 15px;
    margin-top: 10px;
    border-radius: 5px;
}

.comment-area textarea {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    resize: vertical; /* Allow vertical resizing of the textarea */
}

.comment-area input[type="submit"] {
    background-color: #4caf50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.comment-area input[type="submit"]:hover {
    background-color: #45a049;
}
</style>

  <!-- Footer Start -->
  <div
  class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn"
  data-wow-delay="0.1s"
>
  <div class="container py-5">
    <div class="row g-5">
      <div class="col-lg-3 col-md-6">
        <h5 class="text-light mb-4">Address</h5>
        <p class="mb-2">
          <i class="fa fa-map-marker-alt me-3"></i>123 Street, Ariana, TN
        </p>
        <p class="mb-2">
          <i class="fa fa-phone-alt me-3"></i>+012 345 67890
        </p>
        <p class="mb-2">
          <i class="fa fa-envelope me-3"></i>info@esprit.tn
        </p>
        <div class="d-flex pt-2">
          <a class="btn btn-outline-light btn-social rounded-circle" href=""
            ><i class="fab fa-twitter"></i
          ></a>
          <a class="btn btn-outline-light btn-social rounded-circle" href=""
            ><i class="fab fa-facebook-f"></i
          ></a>
          <a class="btn btn-outline-light btn-social rounded-circle" href=""
            ><i class="fab fa-youtube"></i
          ></a>
          <a class="btn btn-outline-light btn-social rounded-circle" href=""
            ><i class="fab fa-linkedin-in"></i
          ></a>
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
        <div class="position-relative mx-auto" style="max-width: 400px">
          <input
            class="form-control border-0 w-100 py-3 ps-4 pe-5"
            type="text"
            placeholder="Your email"
          />
          <button
            type="button"
            class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2"
          >
            SignUp
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="copyright">
      <div class="row">
        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
          &copy; <a class="border-bottom" href="#">DiaZen</a>, All Right
          Reserved.
        </div>
        <div class="col-md-6 text-center text-md-end">
          <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
          Designed By
          <a class="border-bottom" href="https://htmlcodex.com"
            >HTML Codex</a
          >
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Footer End -->

<!-- Back to Top -->
<a
  href="#"
  class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"
  ><i class="bi bi-arrow-up"></i
></a>

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
<script>
    function showComment() {
        console.log('hey')
    var commentArea = document.getElementById("comment-area");
    commentArea.classList.toggle("hide");
  }
function showReply(){
    var replyArea = document.getElementById("reply-area");
    replyArea.classList.toggle("hide");
}
</script>
</body>
</html>

<style type="text/css">
    	body{
    margin-top:20px;
    background:#eee;
}
@media (min-width: 0) {
    .g-mr-15 {
        margin-right: 1.07143rem !important;
    }
}
@media (min-width: 0){
    .g-mt-3 {
        margin-top: 0.21429rem !important;
    }
}

.g-height-50 {
    height: 50px;
}

.g-width-50 {
    width: 50px !important;
}

@media (min-width: 0){
    .g-pa-30 {
        padding: 2.14286rem !important;
    }
}

.g-bg-secondary {
    background-color: #fafafa !important;
}

.u-shadow-v18 {
    box-shadow: 0 5px 10px -6px rgba(0, 0, 0, 0.15);
}

.g-color-gray-dark-v4 {
    color: #777 !important;
}

.g-font-size-12 {
    font-size: 0.85714rem !important;
}

.media-comment {
    margin-top:20px
}

    </style>
