<?php
include '../Controller/medicament.php'; // Utiliser le bon nom de classe
$medicamentController = new MedicamentController();
$medicamentController->deleteMedicament($_GET["id"]);
header('Location: listMedicament.php');
