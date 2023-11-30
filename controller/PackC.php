<?php

require '../config.php';

class PackC
{
    private $connexion;

    public function __construct()
    {
        $this->connexion = Config::getConnexion();
    }

    public function listPacks()
    {
        $sql = "SELECT * FROM pack"; // Utilisez le nom de votre table pour les packs
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addPack($pack)
    {
        $sql = "INSERT INTO pack (nompack, description, prix, type, disponibilite, date_debut, date_fin, image) 
                VALUES (:nompack, :description, :prix, :type, :disponibilite, :date_debut, :date_fin, :image)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nompack' => $pack->getNomPack(),
                'description' => $pack->getDescription(),
                'prix' => $pack->getPrix(),
                'type' => $pack->getType(),
                'disponibilite' => $pack->getDisponibilite(),
                'date_debut' => $pack->getDateDebut(),
                'date_fin' => $pack->getDateFin(),
                'image' => $pack->getImage(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deletePack($idpack)
    {
        $sql = "DELETE FROM pack WHERE IDpack = :id"; // Utilisez le nom de votre table pour les packs
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $idpack);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function showPack($id)
    {
        $sql = "SELECT * FROM pack WHERE IDpack = $id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $pack = $query->fetch();
            return $pack;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updatePack($pack, $id)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE pack SET 
                    nompack = :nompack, 
                    description = :description, 
                    prix = :prix, 
                    type = :type, 
                    disponibilite = :disponibilite, 
                    date_debut = :date_debut, 
                    date_fin = :date_fin,
                    image = :image
                WHERE IDpack = :id'
            );

            $query->execute([
                'id' => $id,
                'nompack' => $pack->getNomPack(),
                'description' => $pack->getDescription(),
                'prix' => $pack->getPrix(),
                'type' => $pack->getType(),
                'disponibilite' => $pack->getDisponibilite(),
                'date_debut' => $pack->getDateDebut(),
                'date_fin' => $pack->getDateFin(),
                'image' => $pack->getImage(),
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function filterPacksByName($nompack)
    {
        // Construction de la requête SQL
        $sql = "SELECT * FROM pack WHERE nompack LIKE :nompack";
    
        // Préparation de la requête
        $stmt = $this->connexion->prepare($sql);

    
        // Liaison du paramètre
        $nompackParam = "%$nompack%"; // Utilisation du joker % pour correspondre à n'importe quelle partie du nom
        $stmt->bindParam(':nompack', $nompackParam, PDO::PARAM_STR);
    
        // Exécution de la requête
        $stmt->execute();
    
        // Récupération des résultats
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function filterPacksByPrice($prixMax)
    {
    // Construction de la requête SQL
    $sql = "SELECT * FROM pack WHERE prix <= :prixMax";

    // Préparation de la requête
    $stmt = $this->connexion->prepare($sql);

    // Liaison du paramètre de prix
    $stmt->bindParam(':prixMax', $prixMax, PDO::PARAM_INT);

    // Exécution de la requête
    $stmt->execute();

    // Récupération des résultats
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getAverageRating($idPack)
    {
        try {
            $pdo = Config::getConnexion();
            $query = $pdo->prepare("SELECT AVG(note) AS avg_rating FROM avis WHERE pack = :idPack");
            $query->execute(['idPack' => $idPack]);
            $result = $query->fetch();
            return $result['avg_rating'] ?: 0;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
}

?>
