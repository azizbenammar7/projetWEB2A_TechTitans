<?php

require '../config.php';

class AvisC
{
    public function listAvis()
    {
        $sql = "SELECT * FROM avis";
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function addAvis($avis)
    {
        $sql = "INSERT INTO avis (avis, note, pack) 
                VALUES (:avis, :note, :pack)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'avis' => $avis->getAvis(),
                'note' => $avis->getNote(),
                'pack' => $avis->getPack(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deleteAvis($idAvis)
    {
        $sql = "DELETE FROM avis WHERE IDavis = :id";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $idAvis);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function showAvis($id)
    {
        $sql = "SELECT * FROM avis WHERE IDavis = $id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $avis = $query->fetch();
            return $avis;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateAvis($avis, $id)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE avis SET 
                    avis = :avis, 
                    note = :note, 
                    pack = :pack
                WHERE IDavis = :id'
            );

            $query->execute([
                'id' => $id,
                'avis' => $avis->getAvis(),
                'note' => $avis->getNote(),
                'pack' => $avis->getPack(),
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function afficheAvisParPack($idPack) {
        try {
            $pdo = Config::getConnexion();
            $query = $pdo->prepare("SELECT * FROM avis WHERE pack = :id");
            $query->execute(['id' => $idPack]);
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function affichePacks() {
        try {
            $pdo = Config::getConnexion();
            $query = $pdo->prepare("SELECT * FROM pack");
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
}

?>
