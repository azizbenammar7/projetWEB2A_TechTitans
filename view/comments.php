<?php


include '../view/header.php';
include '../controller/commentaireC.php';

$commentaireC = new CommentaireC();

// Retrieve the IDpublication from the URL
$IDpublication = isset($_GET['IDpublication']) ? $_GET['IDpublication'] : null;

// List comments based on the IDpublication
$commentaires = $commentaireC->listCommentairesByPublication($IDpublication);


?>

<html>
<head>
    <title>Comments</title>
    <style>
      img {
        width: 50px;
        border-radius: 50px;
        float: left;
        margin-right: 10px;
      }
      p.username {
        font-weight: bold;
      }
    </style>
</head>
<body>
    <h1>Comments for Publication</h1>
    <div id="comment-list-container">
        <?php foreach ($commentaires as $commentaire) : ?>
            <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Image Description">
            <p class="username">anonyumous</p>
            <p><?= $commentaire['text_of_commentaire']; ?></p>
                
            
        <?php endforeach; ?>
    </div>
</body>
</html>


<?php include '../view/footer.php' ?>