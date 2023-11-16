<?php

require '../config.php';

class MedicamentController
{
    public function listMedicament()
    {
        $sql = "SELECT * FROM medicament";
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function deleteMedicament($id)
    {
        $sql = "DELETE FROM medicament WHERE id = :id";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addMedicament($medicament)
    {
        $sql = "INSERT INTO medicament (typ, lieu, dispon, nom, date_ajout)  
                VALUES (:typ, :lieu, :dispon, :nom, :date_ajout)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'typ' => $medicament->getTyp(),
                'lieu' => $medicament->getLieu(),
                'dispon' => $medicament->getDispon(),
                'nom' => $medicament->getNom(),
                'date_ajout' => $medicament->getDateAjout(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function showMedicament($id)
    {
        $sql = "SELECT * from medicament where id = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $medicament = $query->fetch();
            return $medicament;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateMedicament($medicament, $id)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE medicament SET 
                    typ = :typ, 
                    lieu = :lieu, 
                    dispon = :dispon,
                    nom = :nom,
                    date_ajout = :date_ajout 
                WHERE id = :id'
            );

            $query->execute([
                'id' => $id,
                'typ' => $medicament->getTyp(),
                'lieu' => $medicament->getLieu(),
                'dispon' => $medicament->getDispon(),
                'nom' => $medicament->getNom(),
                'date_ajout' => $medicament->getDateAjout(),
            ]);

            // Commentez la ligne suivante si vous ne voulez pas afficher de message de réussite
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
