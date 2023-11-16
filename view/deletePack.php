<?php
include '../controller/PackC.php'; // Utilisez le contrôleur PackC au lieu de JoueurC
$packC = new PackC(); // Utilisez PackC au lieu de JoueurC
$packC->deletePack($_GET['id']);
header('Location: listPacks.php'); // Redirigez vers la liste des packs au lieu de la liste des joueurs
?>
