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

    function deleteMedicament($id)
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

    function addMedicament($medicament)
    {
        $sql = "INSERT INTO medicament (nom, typ, lieu, dispon, date_ajout, piece_jointe)  
                VALUES (:nom, :typ, :lieu, :dispon, :date_ajout, :piece_jointe)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $medicament->getNom(),
                'typ' => $medicament->getTyp(),
                'lieu' => $medicament->getLieu(),
                'dispon' => $medicament->getDispon(),
                'date_ajout' => $medicament->getDateAjout(),
                'piece_jointe' => $medicament->getPieceJointe(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function showMedicament($id)
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

    function updateMedicament($medicament, $id)
{
    try {
        $db = Config::getConnexion();

        // Si une nouvelle pièce jointe est fournie, mettez à jour la colonne piece_jointe
        $updatePieceJointe = '';
        if ($medicament->getPieceJointe() !== null) {
            $updatePieceJointe = ', piece_jointe = :piece_jointe';
        }

        $query = $db->prepare(
            'UPDATE medicament SET 
                nom = :nom,
                typ = :typ, 
                lieu = :lieu, 
                dispon = :dispon,
                date_ajout = :date_ajout' . $updatePieceJointe . '
            WHERE id = :id'
        );

        $params = [
            'id' => $id,
            'nom' => $medicament->getNom(),
            'typ' => $medicament->getTyp(),
            'lieu' => $medicament->getLieu(),
            'dispon' => $medicament->getDispon(),
            'date_ajout' => $medicament->getDateAjout(),
        ];

        // Ajoutez la pièce jointe aux paramètres s'il y en a une
        if ($medicament->getPieceJointe() !== null) {
            $params['piece_jointe'] = $medicament->getPieceJointe();
        }

        $query->execute($params);

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
// Ajouter cette fonction dans la classe MedicamentController
public function searchMedicament($searchTerm)
{
    $sql = "SELECT * FROM medicament WHERE nom LIKE :searchTerm";
    $stmt = $this->connexion->prepare($sql);
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}
