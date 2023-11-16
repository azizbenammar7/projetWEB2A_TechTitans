<?php

require '../config.php';

class userC
{

    public function listusers()
    {
        $sql = "SELECT * FROM user";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function deleteuser($ide)
    {
        $sql = "DELETE FROM user WHERE idJoueur = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);
    
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function adduser($user)
    {
        $sql = "INSERT INTO user  
        VALUES (NULL, :nom,:prenom, :email,:tel)";
        $db = config::getConnexion();
        try {
            switch ($user->getRole()) {
                case 'medecin':
                    $sql = "INSERT INTO medecin (nom, prenom, email, tel, diplome_id) VALUES (:nom, :prenom, :email, :tel, :diplome_id)";
                    break;
                case 'pharmacien':
                    $sql = "INSERT INTO pharmacien (nom, prenom, email, tel, CIN) VALUES (:nom, :prenom, :email, :tel, :CIN)";
                    break;
                case 'patient':
                    $sql = "INSERT INTO patient (nom, prenom, email, tel, type_diabete) VALUES (:nom, :prenom, :email, :tel, :type_diabete)";
                    break;
                default:
                    $sql = "INSERT INTO user (nom, prenom, email, tel) VALUES (:nom, :prenom, :email, :tel)";
                    break;
            }
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'tel' => $user->getTel(),
                'CIN' => $user->getCIN(),  
                'diplome_id' => $user->getDiplomeId(),
                'type_diabete' => $user->getTypeDiabete(), 
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showuser($id)
    {
        $sql = "SELECT * from user where idJoueur = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateuser($user, $id)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE user SET 
                    nom = :nom, 
                    prenom = :prenom, 
                    email = :email, 
                    tel = :tel
                WHERE id= :idJoueur'
            );
            
            $query->execute([
                'idJoueur' => $id,
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'tel' => $user->getTel(),
                'diplome_id' => $user->getDiplomeId(),
                'CIN' => $user->getCIN(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
