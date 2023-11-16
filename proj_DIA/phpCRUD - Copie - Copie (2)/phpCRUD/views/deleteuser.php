<?php
include '../Controller/userC.php';
$clientC = new userC();
$clientC->deleteuser($_GET["idJoueur"]);
header('Location:listusers.php');
