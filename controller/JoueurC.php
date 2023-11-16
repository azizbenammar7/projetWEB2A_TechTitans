<?php

require '../config.php';

class FichepatientC
{

    public function listFichepatient()
    {
        $sql = "SELECT * FROM fichepatient";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteFichepatient($ide)
    {
        $sql = "DELETE FROM fichepatient WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addFichepatient($fichepatient)
    {
        $sql = "INSERT INTO fichepatient  
        VALUES (NULL, :nom,:prenom, :type_de_diabete,:valeur_hemoglobine_A1C, :valeur_glycemie_postprondiale,:valeur_creatinine_serique, :valeur_glycemie_a_jeun,:valeur_cholesterol, :valeur_hdl,:valeur_ldl, :valeur_trigleceride,:date_d_ajout_d_analyse)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $fichepatient->getNom(),
                'prenom' => $fichepatient->getPrenom(),
                'type_de_diabete' => $fichepatient->getType_de_diabete(),
                'valeur_hemoglobine_A1C' => $fichepatient->getValeur_hemoglobine_A1C(),
                'valeur_glycemie_postprondiale' => $fichepatient->getValeur_glycemie_postprondiale(),
                'valeur_creatinine_serique' => $fichepatient->getValeur_creatinine_serique(),
                'valeur_glycemie_a_jeun' => $fichepatient->getValeur_glycemie_a_jeun(),
                'valeur_cholesterol' => $fichepatient->getvaleur_cholesterol(),
                'valeur_hdl' => $fichepatient->getValeur_hdl(),
                'valeur_ldl' => $fichepatient->getValeur_ldl(),
                'valeur_trigleceride' => $fichepatient->getValeur_trigleceride(),
                'date_d_ajout_d_analyse' => $fichepatient->getDate_d_ajout_d_analyse(),     
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showFichepatient($id)
    {
        $sql = "SELECT * from fichepatient where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $fichepatient = $query->fetch();
            return $fichepatient;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateFichepatient($fichepatient, $id)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE fichepatient SET 
                    nom = :nom, 
                    prenom = :prenom, 
                    type_de_diabete = :type_de_diabete, 
                    valeur_hemoglobine_A1C = :valeur_hemoglobine_A1C,
                    valeur_glycemie_postprondiale = :valeur_glycemie_postprondiale, 
                    valeur_creatinine_serique = :valeur_creatinine_serique, 
                    valeur_glycemie_a_jeun = :valeur_glycemie_a_jeun,
                    valeur_cholesterol = :valeur_cholesterol, 
                    valeur_hdl = :valeur_hdl, 
                    valeur_ldl = :valeur_ldl,
                    valeur_triglecerideom = :valeur_trigleceride, 
                    date_d_ajout_d_analyse = :date_d_ajout_d_analyse 
                WHERE id= :id'
            );
            
            $query->execute([
                'id' => $id,
                'nom' => $fichepatient->getNom(),
                'prenom' => $fichepatient->getPrenom(),
                'type_de_diabete' => $fichepatient->getType_de_diabete(),
                'valeur_hemoglobine_A1C' => $fichepatient->getValeur_hemoglobine_A1C(),
                'valeur_glycemie_postprondiale' => $fichepatient->getValeur_glycemie_postprondiale(),
                'valeur_creatinine_serique' => $fichepatient->getValeur_creatinine_serique(),
                'valeur_glycemie_a_jeun' => $fichepatient->getValeur_glycemie_a_jeun(),
                'valeur_cholesterol' => $fichepatient->getvaleur_cholesterol(),
                'valeur_hdl' => $fichepatient->getValeur_hdl(),
                'valeur_ldl' => $fichepatient->getValeur_ldl(),
                'valeur_trigleceride' => $fichepatient->getValeur_trigleceride(),
                'date_d_ajout_d_analyse' => $fichepatient->getDate_d_ajout_d_analyse(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
