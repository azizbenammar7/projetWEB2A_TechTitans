<?php

require '../config.php';

class PubC
{
    public function listPublications()
    {
        $sql = "SELECT * FROM publication"; 
        $db = Config::getConnexion(); 
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deletePublication($ide)
    {
        $sql = "DELETE FROM publication WHERE IDpub = :id";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addPublication($publication)
    {
        $sql = "INSERT INTO publication (nom, prenom, email, role, text_of_pub, date_pub)  
                VALUES (:nom, :prenom, :email, :role, :text_of_pub, :date_pub)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $publication->getNom(),
                'prenom' => $publication->getPrenom(),
                'email' => $publication->getEmail(),
                'role' => $publication->getRole(),
                'text_of_pub' => $publication->getTextOfPub(),
                'date_pub' => $publication->getDatePub(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function showPublication($id)
    {
        $sql = "SELECT * FROM publication WHERE IDpub = $id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $publication = $query->fetch();
            return $publication;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updatePublication($publication, $id)
    {   
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE publication SET 
                    nom = :nom, 
                    prenom = :prenom, 
                    email = :email, 
                    role = :role,
                    text_of_pub = :text_of_pub,
                    date_pub = :date_pub
                WHERE IDpub = :idPublication'
            );
            
            $query->execute([
                'idPublication' => $id,
                'nom' => $publication->getNom(),
                'prenom' => $publication->getPrenom(),
                'email' => $publication->getEmail(),
                'role' => $publication->getRole(),
                'text_of_pub' => $publication->getTextOfPub(),
                'date_pub' => $publication->getDatePub(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
?>
