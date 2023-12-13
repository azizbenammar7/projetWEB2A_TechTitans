<?php
include '../model/reponse.php';
include '../controller/reponse.php';

// Récupérer l'ID de la réclamation depuis l'URL
$reclamation = $_GET['id'] ?? null;
// Initialiser les variables
$error = "";
$reponseController = new ReponseController();
