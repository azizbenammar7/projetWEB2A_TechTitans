<?php

include '../controller/commentaireC.php';  
$commentaireC = new commentaireC();
$commentaireC->deleteCommentaire($_GET["IDcommentaire"]);
header('Location: listcommentaire.php');