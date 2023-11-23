<?php
include '../Controller/pubC.php';

$pubC = new pubC();
//print_r($_GET);
$pubC->deletePublication($_GET["IDpublication"]);
header('Location: listpublication.php');
?>