<?php

require '../config.php';

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
}
?>
