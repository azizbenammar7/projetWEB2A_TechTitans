<?php

require '../config.php';

class UserC
{
    public function listUsers()
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

    public function deleteUser($id)
    {
        $sql = "DELETE FROM user WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addUser(User $user)
    {
      
    
        $sql = "INSERT INTO user  
            VALUES (NULL, :nom, :prenom, :email, :tel, :role_user, :typeDiabete, :ville, :diplome, :motdepasse)";
        $db = config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'tel' => $user->getTel(),
                'role_user' => $user->getRoleUser(),
                'typeDiabete' => $user->getTypeDiabete(),
                'ville' => $user->getVille(),
                'diplome' => $user->getDiplome(),
                'motdepasse' => $user->getMotdepasse(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function showUser($id)
    {
        $sql = "SELECT * FROM user WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateUser(User $user, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE user SET 
                    nom = :nom, 
                    prenom = :prenom, 
                    email = :email, 
                    tel = :tel,
                    role_user = :role_user,
                    typeDiabete = :typeDiabete,
                    ville = :ville,
                    diplome = :diplome,
                    motdepasse = :motdepasse
                WHERE id = :idUser'
            );
    
            $query->execute([
                'idUser' => $id,
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'tel' => $user->getTel(),
                'role_user' => $user->getRoleUser(),
                'typeDiabete' => $user->getTypeDiabete(),
                'ville' => $user->getVille(),
                'diplome' => $user->getDiplome(),
                'motdepasse' => $user->getMotdepasse(), // Ajout du mot de passe
            ]);
    
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
 
    public function loginUser($email, $motdepasse)
    {
        // Check if the provided credentials are for the admin
        if ($email === 'admin@admin.tn' && $motdepasse === md5('admin123')) {
            // If it's the admin, return a special flag or data
            return ['is_admin' => true];
        }
    
        // If it's not the admin, proceed with the normal login logic
        $sql = "SELECT * FROM user WHERE email = :email AND motdepasse = :motdepasse";
        $db = Config::getConnexion();
        
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':motdepasse', $motdepasse);
            $stmt->execute();
    
            if ($stmt->rowCount() === 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
}
    
    
