<?php

include '../controller/TypeController.php';

$TypeController = new TypeController();
$TypeController->deleteidfichee($_GET["id"]);
header('Location: listidfichee.php');
