<?php

require '../config.php';

class PackC
{
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

    
}

?>
