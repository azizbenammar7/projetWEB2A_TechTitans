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
            //$liste = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function deletePublication($IDpublication)
    {
        $sql = "DELETE FROM publication WHERE IDpub = :IDpub";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':IDpub', $IDpublication);

        try {
            $req->execute();
        } catch (Exception $e) 
        {
            die('Error:' . $e->getMessage());
        }
    }
    

    public function addPublication($publication)
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

    public function showPublication($IDpub)
    {
        $sql = "SELECT * FROM publication WHERE IDpub = $IDpub";
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

    
    public function updatePublication($publication, $IDpub)
    {   
        try {

            $db = Config::getConnexion();
           
            echo $IDpub;
            $query = $db->prepare(
                'UPDATE publication SET 
                    nom = :nom, 
                    prenom = :prenom, 
                    email = :email, 
                    role = :role,
                    text_of_pub = :text_of_pub,
                    date_pub = :date_pub
                WHERE IDpub = :IDpub'
            );
            
            $query->execute([
                'IDpub' => $IDpub,
                'nom' => $publication->getNom(),
                'prenom' => $publication->getPrenom(),
                'email' => $publication->getEmail(),
                'role' => $publication->getRole(),
                'text_of_pub' => $publication->getTextOfPub(),
                'date_pub' => $publication->getDatePub(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'error: ' . $e->getMessage();
        }
    }
}
?>
