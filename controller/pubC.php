<?php

require '../config.php';

class PubC
{
    private $db; // Add this property

    public function __construct()
    {
        $this->db = Config::getConnexion(); // Initialize the $db property
    }

    public function listPublications()
{
    $sql = "SELECT * FROM publication";
    $db = Config::getConnexion();
    
    try {
        $stmt = $db->query($sql);
        $liste = $stmt->fetchAll(PDO::FETCH_ASSOC);
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


    public function filterPublicationByDate($date_pub)
    {
        // Construction de la requête SQL
        $sql = "SELECT * FROM publication WHERE DATE(date_pub) = :date_pub";
        
        // Préparation de la requête
        $stmt = $this->db->prepare($sql);
        
        // Liaison du paramètre
        $stmt->bindParam(':date_pub', $date_pub, PDO::PARAM_STR);
        
        // Exécution de la requête
        $stmt->execute();
        
        // Récupération des résultats
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function likePublication($IDpublication)
{
    $sql = "UPDATE publication SET nbr_like = nbr_like + 1 WHERE IDpub = :IDpub";
    $this->updateCount($IDpublication, $sql);
}

public function dislikePublication($IDpublication)
{
    $sql = "UPDATE publication SET nbr_dislike = nbr_dislike + 1 WHERE IDpub = :IDpub";
    $this->updateCount($IDpublication, $sql);
}

private function updateCount($IDpublication, $sql)
{
    $db = Config::getConnexion();
    $req = $db->prepare($sql);
    $req->bindValue(':IDpub', $IDpublication);

    try {
        $req->execute();
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}


public function getPublicationsWithMoreThanLikes($minLikes)
{
    $sql = "SELECT * FROM publication WHERE nbr_like > :minLikes";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':minLikes', $minLikes, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function filterByLikes($minLikes)
{
    $sql = "SELECT * FROM publication WHERE nbr_like > :minLikes";
    $db = Config::getConnexion();
    
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':minLikes', $minLikes, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}


public function filterByMostLikes()
{
    $sql = "SELECT * FROM publication ORDER BY nbr_like DESC LIMIT 3";
    $db = Config::getConnexion();

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}

}
?>
