<?php

include '../controller/typecontroller1.php';

$typeController = new TypeController1();
$typeController->deleteType($_GET["id"]);
header('Location: listType.php');
