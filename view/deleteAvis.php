<?php
include '../controller/AvisC.php';
$avisC = new AvisC();
$avisC->deleteAvis($_GET['id']);
header('Location: listAvis.php');
?>
