<?php

include '../controller/reponse.php';  // Utiliser le bon nom de classe
$reponseController = new ReponseController();
$reponseController->deleteReponse($_GET["id"]);
header('Location: listreponse.php');