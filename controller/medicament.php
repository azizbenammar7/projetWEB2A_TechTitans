<?php

require_once '../config.php';

class MedicamentController
{
    private $connexion;

    public function __construct()
    {
        $this->connexion = Config::getConnexion();
    }

    public function listMedicament()
    {
        $sql = "SELECT m.*, t.typ as type_nom FROM medicament m
                LEFT JOIN type t ON m.typ = t.id";
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function searchMedicamentByName($searchTerm)
    {
        $sql = "SELECT * FROM medicament WHERE nom LIKE :searchTerm";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Dans MedicamentController.php
 // Dans MedicamentController.php

 public function filterMedicamentByType($type)
 {
     $sql = "SELECT m.*, t.typ as type_nom FROM medicament m
             LEFT JOIN type t ON m.typ = t.id
             WHERE t.typ = :type";
 
     $stmt = $this->connexion->prepare($sql);
     $stmt->bindValue(':type', $type, PDO::PARAM_STR);
     $stmt->execute();
 
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function showMedicament($id)
    {
        $sql = "SELECT * FROM medicament WHERE id = :id";
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

    public function searchMedicament($searchTerm)
    {
        $sql = "SELECT * FROM medicament WHERE nom LIKE :searchTerm";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function filterMedicamentByDateAjout($date_ajout)
{
    // Modifiez la requête SQL en fonction de vos besoins
    // Dans cet exemple, on suppose que vous voulez les médicaments ajoutés à une date spécifique.
    $sql = "SELECT m.*, t.typ as type_nom FROM medicament m
    LEFT JOIN type t ON m.typ = t.id
    WHERE m.date_ajout = :date_ajout";


    // Utilisation d'un objet DateTime pour la sécurité
    $dateTime = new DateTime($date_ajout);
    $formattedDate = $dateTime->format('Y-m-d');

    $stmt = $this->connexion->prepare($sql);
    $stmt->bindValue(':date_ajout', $formattedDate, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function filterMedicamentByDisponibilite($disponibilite)
{
    $sql = "SELECT m.*, t.typ as type_nom FROM medicament m
    LEFT JOIN type t ON m.typ = t.id WHERE dispon = :disponibilite";

    $stmt = $this->connexion->prepare($sql);
    $stmt->bindValue(':disponibilite', $disponibilite, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Dans MedicamentController.php
public function filterMedicamentByLieu($lieu)
{
    $sql = "SELECT m.*, t.typ as type_nom FROM medicament m
    LEFT JOIN type t ON m.typ = t.id WHERE lieu = :lieu";

    $stmt = $this->connexion->prepare($sql);
    $stmt->bindValue(':lieu', $lieu, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function listMedicamentPagination($offset, $limit)
{
    $sql = "SELECT m.*, t.typ as type_nom FROM medicament m
            LEFT JOIN type t ON m.typ = t.id
            LIMIT :offset, :limit";
    $stmt = $this->connexion->prepare($sql);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function countMedicaments()
{
    $sql = "SELECT COUNT(*) as total FROM medicament";
    $stmt = $this->connexion->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total'];
}

public function filterMedicamentByNameAndLieu($nom, $lieu)
{
    try {
        // Utilisez la table correcte (medicament au lieu de medicaments)
        $query = "SELECT * FROM medicament WHERE nom = :nom AND lieu = :lieu";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":lieu", $lieu);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Gérer les erreurs de base de données
        echo 'Error: ' . $e->getMessage();
    }
}
// Dans votre contrôleur de médicaments (medicament.php) ou là où vous définissez vos fonctions

public function searchMedicamentByNameAndLieu($nom, $lieu) {
    // Mettez en œuvre la logique pour rechercher les médicaments par nom et lieu
    // Utilisez une requête SQL ou tout autre mécanisme que vous utilisez pour récupérer les données filtrées
    $query = "SELECT * FROM medicaments WHERE nom = :nom AND lieu = :lieu";
    $stmt = $this->connexion->prepare($query);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":lieu", $lieu);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function filterMedicamentByTypeInList($selectedType, $medicaments) {
    // Mettez en œuvre la logique pour filtrer les médicaments par type dans la liste existante
    $filteredMedicaments = array();

    foreach ($medicaments as $medicament) {
        if ($medicament['type'] == $selectedType) {
            $filteredMedicaments[] = $medicament;
        }
    }

    return $filteredMedicaments;
}
// Dans la classe MedicamentController
public function checkAvailabilityInOtherPlaces($medicamentName, $currentLieu)
{
    // Votre logique pour vérifier la disponibilité du médicament dans d'autres lieux
    // Retourne true si le médicament est disponible ailleurs, sinon retourne false
    // Vous devrez adapter cela à votre logique et à votre structure de base de données

    // Exemple simplifié :
    $query = "SELECT COUNT(*) AS count FROM medicaments WHERE nom = :nom AND lieu != :currentLieu AND dispon = 'disponible'";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':nom', $medicamentName, PDO::PARAM_STR);
    $stmt->bindParam(':currentLieu', $currentLieu, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['count'] > 0;
}


    
}
