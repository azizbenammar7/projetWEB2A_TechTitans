<?php
include '../Controller/medicament1.php'; // Utiliser le bon nom de classe
$medicamentController = new MedicamentController1();
$medicamentController->deleteMedicament($_GET["id"]);
header('Location: listMedicament1.php');
