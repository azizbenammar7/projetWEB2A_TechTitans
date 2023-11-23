<?php

require '../config.php';

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
}
?>
