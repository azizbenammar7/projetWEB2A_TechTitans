<?php
include '../Controller/userC.php';
$clientC = new UserC();
$clientC->deleteUser($_GET["id"]);
header('Location:listusers.php');
