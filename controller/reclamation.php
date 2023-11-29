<?php

require_once '../config.php';

class ReclamationController
{
    private $db;

    public function __construct()
    {
        $this->db = Config::getConnexion();
    }

    public function listReclamation()
    {
        $sql = "SELECT * FROM reclamation";
        try {
            $liste = $this->db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function deleteReclamation($id)
    {
        $sql = "DELETE FROM reclamation WHERE id = :id";
        $req = $this->db->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addReclamation($reclamation)
    {
        $piece_jointe_path = $this->uploadPieceJointe($reclamation);

        $sql = "INSERT INTO reclamation (typ, description, piece_jointe, date_ajout, etat)  
                VALUES (:typ, :description, :piece_jointe, :date_ajout, :etat)";
        try {
            $query = $this->db->prepare($sql);
            $query->execute([
                'typ' => $reclamation->getTyp(),
                'description' => $reclamation->getDescription(),
                'piece_jointe' => $reclamation->getPieceJointePath(),
                'date_ajout' => date('Y-m-d'),
                'etat' => $reclamation->getEtat(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function updateReclamation($reclamation, $id)
    {
        $piece_jointe_path = $this->uploadPieceJointe($reclamation);

        $sql = "UPDATE reclamation 
                SET typ = :typ, description = :description, piece_jointe = :piece_jointe 
                WHERE id = :id";
        try {
            $query = $this->db->prepare($sql);
            $query->execute([
                'typ' => $reclamation->getTyp(),
                'description' => $reclamation->getDescription(),
                'piece_jointe' => $reclamation->getPieceJointePath(),
                'id' => $id,
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function showReclamation($id)
    {
        $sql = "SELECT * FROM reclamation WHERE id = :id";
        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $reclamation = $query->fetch();
            return $reclamation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    private function uploadPieceJointe($reclamation)
    {
        $uploadDir = "upload"; // Remplacez par le chemin de votre choix
        $piece_jointe= null;

        if (isset($_FILES['piece_jointe']) && $_FILES['piece_jointe']['error'] == UPLOAD_ERR_OK) {
            $tempName = $_FILES['piece_jointe']['tmp_name'];
            $fileName = $_FILES['piece_jointe']['name'];
            $piece_jointe = $fileName;

            move_uploaded_file($tempName, $uploadDir . '/' . $fileName);
        }

        $reclamation->setPieceJointePath($piece_jointe);

        return $piece_jointe;
    }
    public function filterReclamationByDateAjout($date_ajout)
{
    // Construction de la requête SQL
    $sql = "SELECT * FROM reclamation WHERE DATE(date_ajout) = :date_ajout";
    
    // Préparation de la requête
    $stmt = $this->db->prepare($sql);
    
    // Liaison du paramètre
    $stmt->bindParam(':date_ajout', $date_ajout, PDO::PARAM_STR);
    
    // Exécution de la requête
    $stmt->execute();
    
    // Récupération des résultats
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Dans votre classe ReclamationController
// Dans votre classe ReclamationController
public function getReclamationsByEtat($etat)
{
    try {
        $stmt = $this->db->prepare("SELECT * FROM reclamation WHERE etat = :etat");
        $stmt->bindParam(':etat', $etat, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // Gérez les erreurs
        throw new Exception("Erreur lors de la récupération des réclamations par état : " . $e->getMessage());
    }
}

public function listReclamationByType($searchTyp = null) {
    // Construction de la requête SQL de base
    $sql = "SELECT * FROM reclamation";
    
    // Initialisation des conditions
    $conditions = [];
    $params = [];
    
    // Ajout de la condition en fonction du type de recherche
    if ($searchTyp !== null) {
        $validTypes = ['médecin', 'pharmacien', 'médicament', 'patient', 'autre'];
        // Vérifier si le type est valide
        if (in_array($searchTyp, $validTypes)) {
            $conditions[] = "typ = :searchTyp";
            $params[':searchTyp'] = $searchTyp;
        }
    }
    
    // Ajout des conditions à la requête si nécessaire
    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }
    
    // Préparation et exécution de la requête avec des paramètres de liaison si nécessaire
    $stmt = $this->db->prepare($sql);
    
    // Liaison des paramètres
    foreach ($params as $paramName => $paramValue) {
        $stmt->bindParam($paramName, $paramValue);
    }
    
    $stmt->execute();
    
    // Récupération des résultats
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Retour des résultats
    return $results;
}
// Ajoutez cette méthode à votre classe ReclamationController
public function countReponsesByReclamation($reclamation)
{
    try {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM reponse WHERE reclamation = :reclamation");
        $stmt->bindParam(':reclamation', $reclamation, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    } catch (Exception $e) {
        // Gérez les erreurs
        throw new Exception("Erreur lors du comptage des réponses de la réclamation : " . $e->getMessage());
    }
}
// Modifiez cette partie de votre méthode hasReponses
public function hasReponses($reclamation) {
    $reclamationController = new ReclamationController();  // Utilisez le bon contrôleur ici
    $nombreReponses = $reclamationController->countReponsesByReclamation($reclamation);
    return $nombreReponses > 0;
}

// Dans votre classe ReclamationController

// Dans votre classe ReclamationController
// Dans votre classe ReclamationController
// Dans votre classe ReclamationController
public function updateEtatIfResponsesExist($reclamation)
{
    try {
        // Vérifiez si la réclamation a au moins une réponse
        $hasResponses = $this->hasReponses($reclamation);

        // Mettez à jour l'état en fonction de la présence de réponses
        $etat = $hasResponses ? 1 : 0;

        // Préparez la requête
        $stmt = $this->db->prepare("UPDATE reclamation SET etat = :etat WHERE id = :reclamationId");

        // Liaison des paramètres
        $stmt->bindParam(':etat', $etat, PDO::PARAM_INT);
        $stmt->bindParam(':reclamationId', $reclamation, PDO::PARAM_INT);

        // Exécutez la requête
        $stmt->execute();

        // Retournez la nouvelle valeur de l'état
        return $etat;
    } catch (Exception $e) {
        // Gérez les erreurs
        throw new Exception("Erreur lors de la mise à jour de l'état de la réclamation : " . $e->getMessage());
    }
}






public function updateReclamationEtatOnReponseAdded($reclamation)
{
    try {
        // Comptez le nombre de réponses associées à la réclamation
        $nombreReponses = $this->countReponsesByReclamation($reclamation);

        // Mettez à jour l'état en fonction du nombre de réponses
        $etat = ($nombreReponses > 0) ? 1 : 0;

        // Préparez la requête
        $stmt = $this->db->prepare("UPDATE reclamation SET etat = :etat WHERE id = :reclamationId");

        // Liaison des paramètres
        $stmt->bindParam(':etat', $etat, PDO::PARAM_INT);
        $stmt->bindParam(':reclamationId', $reclamation, PDO::PARAM_INT);

        // Exécutez la requête
        $stmt->execute();
    } catch (Exception $e) {
        // Gérez les erreurs
        throw new Exception("Erreur lors de la mise à jour de l'état de la réclamation : " . $e->getMessage());
    }
}
public function updateReclamationEtat($reclamation, $etat)
{
    try {
        $stmt = $this->db->prepare("UPDATE reclamation SET etat = :etat WHERE id = :reclamationId");
        $stmt->bindParam(':etat', $etat, PDO::PARAM_INT);
        $stmt->bindParam(':reclamationId', $reclamation, PDO::PARAM_INT);
        $stmt->execute();
        echo "Mise à jour de l'état - Réclamation : $reclamation, Nouvel état : $etat";
    } catch (Exception $e) {
        // Gérer les erreurs
        throw new Exception("Erreur lors de la mise à jour de l'état de la réclamation : " . $e->getMessage());
    }
}















}





?>
