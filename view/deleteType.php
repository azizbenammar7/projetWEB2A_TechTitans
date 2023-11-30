<?php

include '../controller/typecontroller.php';

$typeController = new TypeController();
$typeController->deleteType($_GET["id"]);
header('Location: listType.php');
