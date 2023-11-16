<?php

require '../config.php';

class ReclamationController
{
    public function listReclamation()
    {
        $sql = "SELECT * FROM reclamation";
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function deleteReclamation($id)
    {
        $sql = "DELETE FROM reclamation WHERE id = :id";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addReclamation($reclamation)
    {
        $sql = "INSERT INTO reclamation (typ, description, piece_jointe, date_ajout, etat)  
                VALUES (:typ, :description, :piece_jointe, :date_ajout, :etat)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'typ' => $reclamation->getTyp(),
                'description' => $reclamation->getDescription(),
                'piece_jointe' => $reclamation->getPieceJointe(),
                'date_ajout' => date('Y-m-d'),
                'etat' => $reclamation->getEtat(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function showReclamation($id)
    {
        $sql = "SELECT * FROM reclamation WHERE id = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $reclamation = $query->fetch();
            return $reclamation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateReclamation($reclamation, $id)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE reclamation SET 
                    typ = :typ, 
                    description = :description, 
                    piece_jointe = :piece_jointe,
                    date_ajout = :date_ajout,
                    etat = :etat
                WHERE id = :id'
            );

            $query->execute([
                'id' => $id,
                'typ' => $reclamation->getTyp(),
                'description' => $reclamation->getDescription(),
                'piece_jointe' => $reclamation->getPieceJointe(),
                'date_ajout' => $reclamation->getDateAjout(),
                'etat' => $reclamation->getEtat(),
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
