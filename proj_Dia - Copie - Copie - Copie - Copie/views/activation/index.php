<?php

include '../../config.php';


if (isset($_GET['token'])  && $_GET['token'] != '') {
    $sql = 'SELECT email FROM user WHERE token = ? ';
    $statement = $connection->prepare($sql);
    $statement->execute([$_GET['token']]);
    $email = $statement->fetchColumn();

    if ($email) {
        //update statut 
        $sql = "UPDATE user SET statut = 1 , token = NULL WHERE email = ? " ;
        $statement = $connection->prepare($sql);
        $statement->execute([$email]);
        header('Location: ../');

        //redirection to login


    }

}

?>