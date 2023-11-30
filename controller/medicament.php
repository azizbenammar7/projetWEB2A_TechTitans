<?php

require_once '../config.php';

class MedicamentController {
    private $connexion;

    public function __construct() {
        $this->connexion = Config::getConnexion();
    }

    public function listMedicament() {
        $sql = "SELECT m.*, t.idfiche as idfichee_nom FROM medicament m
                LEFT JOIN idfichee t ON m.idfiche = t.id";
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:'.$e->getMessage());
        }
    }
    public function filterMedicaments($dateAjoutFilter, $patientNameFilter) {
        // Adjust the query based on the provided filters
        $sql = "SELECT m.*, t.idfiche as idfichee_nom FROM medicament m
                LEFT JOIN idfichee t ON m.idfiche = t.id
                WHERE (:dateAjoutFilter IS NULL OR m.date_ajout = :dateAjoutFilter)
                OR (:patientNameFilter IS NULL OR t.idfiche = :patientNameFilter)";

        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':dateAjoutFilter', $dateAjoutFilter, PDO::PARAM_STR);
        $stmt->bindValue(':patientNameFilter', $patientNameFilter, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function listhistoriquebyidfiche($idfiche) {
        $sql = "SELECT m.*, t.idfiche as idfichee_nom FROM medicament m
                LEFT JOIN idfichee t ON m.idfiche = t.id
                WHERE m.idfiche = :idfiche";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':idfiche', $idfiche, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function gethistoriqueCount() {
        $sql = "SELECT COUNT(*) as count FROM medicament";
        $db = config::getConnexion();
        try {
            $result = $db->query($sql);
            $count = $result->fetch(PDO::FETCH_ASSOC)['count'];
            return $count;
        } catch (Exception $e) {
            die('Error:'.$e->getMessage());
        }
    }

    public function getHistoriqueCountForToday() {
        // Get the current date in the format 'YYYY-MM-DD'
        $currentDate = date('Y-m-d');

        $sql = "SELECT COUNT(*) as count FROM medicament WHERE date_ajout = :currentDate";
        $db = Config::getConnexion();

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':currentDate', $currentDate, PDO::PARAM_STR);
            $stmt->execute();

            $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
            return $count;
        } catch (Exception $e) {
            die('Error:'.$e->getMessage());
        }
    }
    public function getHistoriqueCountByDay($day) {
        $sql = "SELECT COUNT(*) as count FROM medicament WHERE date_ajout = :day";
        $db = Config::getConnexion();

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':day', $day, PDO::PARAM_STR);
            $stmt->execute();

            $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
            return $count;
        } catch (Exception $e) {
            die('Error:'.$e->getMessage());
        }
    }


    public function getHistoricalData() {
        $sql = "SELECT DATE(date_ajout) AS date, COUNT(*) AS num_records FROM medicament GROUP BY DATE(date_ajout)";
        $stmt = $this->connexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }





    public function deleteMedicament($id) {
        $sql = "DELETE FROM medicament WHERE id = :id";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:'.$e->getMessage());
        }
    }

    public function addMedicament($medicament) {
        $sql = "INSERT INTO medicament (nom, idfiche, glyc, chol, date_ajout, piece_jointe)  
                VALUES (:nom, :idfiche, :glyc, :chol, :date_ajout, :piece_jointe)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $medicament->getNom(),
                'idfiche' => $medicament->getidfiche(),
                'glyc' => $medicament->getglyc(),
                'chol' => $medicament->getchol(),
                'date_ajout' => $medicament->getDateAjout(),
                'piece_jointe' => $medicament->getPieceJointe(),
            ]);
        } catch (Exception $e) {
            echo 'Error: '.$e->getMessage();
        }
    }

    public function showMedicament($id) {
        $sql = "SELECT * FROM medicament WHERE id = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $medicament = $query->fetch();
            return $medicament;
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }

    public function updateMedicament($medicament, $id) {
        try {
            $db = Config::getConnexion();

            // Si une nouvelle pièce jointe est fournie, mettez à jour la colonne piece_jointe
            $updatePieceJointe = '';
            if($medicament->getPieceJointe() !== null) {
                $updatePieceJointe = ', piece_jointe = :piece_jointe';
            }

            $query = $db->prepare(
                'UPDATE medicament SET 
                    nom = :nom,
                    idfiche = :idfiche, 
                    glyc = :glyc, 
                    chol = :chol,
                    date_ajout = :date_ajout'.$updatePieceJointe.'
                WHERE id = :id'
            );

            $params = [
                'id' => $id,
                'nom' => $medicament->getNom(),
                'idfiche' => $medicament->getidfiche(),
                'glyc' => $medicament->getglyc(),
                'chol' => $medicament->getchol(),
                'date_ajout' => $medicament->getDateAjout(),
            ];

            // Ajoutez la pièce jointe aux paramètres s'il y en a une
            if($medicament->getPieceJointe() !== null) {
                $params['piece_jointe'] = $medicament->getPieceJointe();
            }

            $query->execute($params);

            echo $query->rowCount()." records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
    }
    public function generatePDF1($medicament) {
        // Include the PDFGenerator class
        require_once '../view/PDFGenerator1.php';

        // Create an instance of the PDFGenerator class
        $pdfGenerator1 = new PDFGenerator1();

        // Generate the PDF with patient data
        $pdfGenerator1->generatePDF1($medicament);
    }





}
