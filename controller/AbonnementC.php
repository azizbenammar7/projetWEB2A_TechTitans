<?php

require_once '../config.php';

class AbonnementC
{
    public function listAbonnements()
    {
        $sql = "SELECT * FROM abonnement";
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function addAbonnement($abonnement)
    {
        $sql = "INSERT INTO abonnement (IDuser, IDpackuser, dateabonnement, payed) 
                VALUES (:IDuser, :IDpackuser, :dateabonnement, :payed)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'IDuser' => $abonnement->getIDuser(),
                'IDpackuser' => $abonnement->getIDpackuser(),
                'dateabonnement' => $abonnement->getDateAbonnement(),
                'payed' => $abonnement->getPayed(),
            ]);

            echo "Abonnement ajouté avec succès!";
        } catch (Exception $e) {
            echo 'Erreur lors de l\'ajout de l\'abonnement: ' . $e->getMessage();
        }
    }

    public function deleteAbonnement($IDuser, $IDpackuser)
    {
        $sql = "DELETE FROM abonnement WHERE IDuser = :IDuser AND IDpackuser = :IDpackuser";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':IDuser', $IDuser);
        $req->bindValue(':IDpackuser', $IDpackuser);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function showAbonnement($IDuser, $IDpackuser)
    {
        $sql = "SELECT * FROM abonnement WHERE IDuser = :IDuser AND IDpackuser = :IDpackuser";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':IDuser', $IDuser);
            $query->bindValue(':IDpackuser', $IDpackuser);
            $query->execute();
            $abonnement = $query->fetch();
            return $abonnement;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateAbonnement($abonnement, $IDuser, $IDpackuser)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE abonnement SET 
                    dateabonnement = :dateabonnement, 
                    payed = :payed
                WHERE IDuser = :IDuser AND IDpackuser = :IDpackuser'
            );

            $query->execute([
                'IDuser' => $IDuser,
                'IDpackuser' => $IDpackuser,
                'dateabonnement' => $abonnement->getDateAbonnement(),
                'payed' => $abonnement->getPayed(),
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

?>
