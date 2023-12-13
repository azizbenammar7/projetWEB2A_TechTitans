<?php

require_once '../config.php';

class ReponseController
{
    private $db;

    public function __construct()
    {
        $this->db = Config::getConnexion();
    }
    

    public function listReponse()
{
    $sql = "SELECT * FROM reponse";
    try {
        $liste = $this->db->query($sql);
        return $liste;
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération de la liste des réponses: ' . $e->getMessage());
    }

}


public function addReponse($reponse)
{
    try {
        // Validation de la description
        $description = $reponse->getDescription();
        if ($description === null || trim($description) === '') {
            throw new Exception('La description ne peut pas être vide.');
        }

        // Ajout de la réponse dans la base de données
        $sql = "INSERT INTO reponse (description, etat, reclamation)  
                VALUES (:description, :etat, :reclamation)";

        $query = $this->db->prepare($sql);
        $query->execute([
            'description' => $description,
            'etat' => $reponse->getEtat(),
            'reclamation' => $reponse->getReclamation(),
        ]);
        

        // Redirection après l'ajout de la réponse
        header('Location: listreponse.php');
        exit();

    } catch (Exception $e) {
        // Gestion de l'erreur
        throw new Exception('Erreur lors de l\'ajout de la réponse: ' . $e->getMessage());
    }
}
public function updateReponse($reponse, $idReponse)
{
    $sql = "UPDATE reponse 
            SET description = :description, etat = :etat, reclamation = :reclamation 
            WHERE idreponse = :idreponse"; // Correction du nom de la colonne
    try {
        $query = $this->db->prepare($sql);
        $query->execute([
            'description' => $reponse->getDescription(),
            'etat' => $reponse->getEtat(),
            'reclamation' => $reponse->getReclamation(),
            'idreponse' => $idReponse,
        ]);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour de la réponse: ' . $e->getMessage());
    }
}

public function deleteReponse($idReponse)
{
    $sql = "DELETE FROM reponse WHERE idreponse = :id_reponse"; // Correction du nom de la colonne
    $req = $this->db->prepare($sql);
    $req->bindValue(':id_reponse', $idReponse, PDO::PARAM_INT);

    try {
        $req->execute();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression de la réponse: ' . $e->getMessage());
    }
}


    public function getReponseById($idReponse)
    {
        $sql = "SELECT * FROM reponse WHERE idreponse = :idreponse";
        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(':idreponse', $idReponse, PDO::PARAM_INT);
            $query->execute();
            $reponse = $query->fetch();
            return $reponse;
        } catch (Exception $e) {
            throw new Exception('Erreur lors de la récupération de la réponse: ' . $e->getMessage());
        }
    }

    public function getReponsesByReclamation($reclamation)
    {
        $sql = "SELECT * FROM reponse WHERE reclamation = :reclamation";
        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(':reclamation', $reclamation, PDO::PARAM_INT);
            $query->execute();
            $reponses = $query->fetchAll();
            return $reponses;
        } catch (Exception $e) {
            throw new Exception('Erreur lors de la récupération des réponses: ' . $e->getMessage());
        }
    }
    // Dans la classe ReponseController

public function getnotesByReclamation($reclamation)
{
    $sql = "SELECT note_satisfaction FROM reponse WHERE reclamation = :reclamation";
    try {
        $query = $this->db->prepare($sql);
        $query->bindValue(':reclamation', $reclamation, PDO::PARAM_INT);
        $query->execute();
        $notes = $query->fetchAll(PDO::FETCH_COLUMN);
        return $notes;
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des notes de satisfaction: ' . $e->getMessage());
    }
}
public function updateSatisfaction($idReponse, $satisfaction)
{
    $sql = "UPDATE reponse SET `Voir Notes` = :satisfaction WHERE idreponse = :idReponse";

    try {
        // Préparation de la requête
        $stmt = $this->db->prepare($sql);

        // Liaison des paramètres
        $stmt->bindParam(':satisfaction', $satisfaction, PDO::PARAM_STR);
        $stmt->bindParam(':idReponse', $idReponse, PDO::PARAM_INT);

        // Exécution de la requête
        $stmt->execute();

        // Retourne l'ID de la réponse mis à jour
        return $idReponse;
    } catch (Exception $e) {
        // Gérer les erreurs de la base de données ici
        echo "Erreur : " . $e->getMessage();
        return null; // Ou une valeur spéciale pour indiquer une erreur
    }
}

public function generateText($idReponse) {
    require_once '../view/mail.php';
    // Créez le contenu du texte avec l'id de la réponse
    $textContent = "Vous avez reçu une réponse avec l'identifiant : " . $idReponse . "\n";

    // Retournez le contenu du texte
    return $textContent;
}
public function listReponsePagination($page, $limit)
{
    // Calculer l'offset en fonction de la page actuelle
    $offset = ($page - 1) * $limit;

    // Requête SQL avec LIMIT et OFFSET
    $sql = "SELECT * FROM reponse LIMIT :limit OFFSET :offset";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function countReponses()
{
    $sql = "SELECT COUNT(*) as total FROM reponse";
    $stmt = $this->db->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total'];
}












   

    







}
?>
