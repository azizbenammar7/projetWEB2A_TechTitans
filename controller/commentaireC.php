<?php

require '../config.php';

class CommentaireC
{
    public function listCommentaires()
    {
        $sql = "SELECT * FROM commentaire"; 
        $db = Config::getConnexion(); 
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function deleteCommentaire($IDcommentaire)
    {
        $sql = "DELETE FROM commentaire WHERE IDcommentaire = :IDcommentaire";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':IDcommentaire', $IDcommentaire);

        try {
            $req->execute();
        } catch (Exception $e) 
        {
            die('Error:' . $e->getMessage());
        }
    }
    

    public function addcommentaire($commentaire)
    {
        $sql = "INSERT INTO commentaire (text_of_commentaire, publication)  
                VALUES (:text_of_commentaire, :publication)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'text_of_commentaire' => $commentaire->getTextOfCommentaire(),
                'publication' => $commentaire->getPublication(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function showCommentaire($IDcommentaire)
    {
        $sql = "SELECT * FROM commentaire WHERE IDcommentaire = $IDcommentaire";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $commentaire = $query->fetch();
            return $commentaire;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    
    public function updateCommentaire($commentaire, $IDcommentaire)
    {   
        try {

            $db = Config::getConnexion();
           
            echo $IDcommentaire;
            $query = $db->prepare(
                'UPDATE commentaire SET 
                    text_of_commentaire = :text_of_commentaire, 
                    publication = :publication
                WHERE IDcommentaire = :IDcommentaire'
            );
            
            $query->execute([
                'IDcommentaire' => $IDcommentaire,
                'text_of_commentaire' => $commentaire->getTextOfCommentaire(),
                'publication' => $commentaire->getPublicationId(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'error: ' . $e->getMessage();
        }
    }
}
?>
