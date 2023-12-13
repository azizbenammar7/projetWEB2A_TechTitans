<?php

require_once '../config.php';

class TypeController {
    public function listidfichee() {
        $sql = "SELECT * FROM idfichee";
        $db = Config::getConnexion();
        
        try {
            $stmt = $db->query($sql);
            $liste = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $liste;
        } catch (Exception $e) {
            die('Error:'.$e->getMessage());
        }
    }
    

    public function addidfichee($idfichee) {
        $sql = "INSERT INTO idfichee (idfiche,email,tel,sexe,description,user) VALUES (:idfiche,:email,:tel,:sexe, :description, :user)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'idfiche' => $idfichee->getidfiche(),
                'email' => $idfichee->getemail(),
                'tel' => $idfichee->gettel(),
                'sexe' => $idfichee->getsexe(),
                'description' => $idfichee->getdescription(),
                'user' => $idfichee->getuser()

            ]);
        } catch (Exception $e) {
            echo 'Error: '.$e->getMessage();
        }
    }
    // Add this method to the TypeController class
    public function searchidfichee($search) {
        $sql = "SELECT * FROM idfichee WHERE idfiche LIKE :search OR email LIKE :search OR tel LIKE :search OR sexe LIKE :search OR description LIKE :search";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':search', "%$search%", PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }

    public function showidfichee($id) {
        $sql = "SELECT * FROM idfichee WHERE id = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $idfichee = $query->fetch();
            return $idfichee;
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }


    public function updateidfichee($idfichee, $id) {
        $sql = "UPDATE `idfichee` SET 
                    `idfiche` = :idfiche,
                    `email` = :email,
                    `tel` = :tel,
                    `sexe` = :sexe,
                    `description` = :description,
                    'user' = :user
                WHERE `id` = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'idfiche' => $idfichee->getidfiche(),
                'email' => $idfichee->getemail(),
                'tel' => $idfichee->gettel(),
                'sexe' => $idfichee->getsexe(),
                'description' => $idfichee->getdescription(),
                'user' => $idfichee->getuser(),
                'id' => $id,
            ]);
        } catch (Exception $e) {
            echo 'Error: '.$e->getMessage();
        }
    }
    


    public function deleteidfichee($id) {
        $sql = "DELETE FROM idfichee WHERE id = :id";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:'.$e->getMessage());
        }
    }

    // Add this method to the TypeController class

public function generatePDF($idfichee) {
    // Include the PDFGenerator class
    require_once '../view/PDFGenerator.php';

    // Create an instance of the PDFGenerator class
    $pdfGenerator = new PDFGenerator();

    // Generate the PDF with patient data
    $pdfGenerator->generatePDF($idfichee);
}
    
}