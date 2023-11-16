<?php
include '../Controller/JoueurC.php';
$FichepatientC = new FichepatientC();
$FichepatientC->deleteFichepatient($_GET["id"]);
header('Location:listJoueurs.php');
