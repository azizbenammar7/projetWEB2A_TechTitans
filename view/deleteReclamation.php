<?php

include '../controller/reclamation.php';  // Utiliser le bon nom de classe
$reclamationController = new ReclamationController();
$reclamationController->deleteReclamation($_GET["id"]);
header('Location: listReclamation.php');
