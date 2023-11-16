<?php

include '../Controller/PubC.php';

$pubC = new PubC();

if (isset($_GET['IDpub'])) {
    $idPublication = $_GET['IDpub'];
    $pubC->deletePublication($idPublication);
    
    header('Location: listpublication.php');
} else {
    echo "Invalid publication ID.";
}

?>

