<?php

require_once '../config.php';

class UserC
{

    public function listUsers($searchTerm = '')
{
    $db = config::getConnexion();

    // Base SQL query with last_login column
    $sql = "SELECT id, nom, prenom, email, motdepasse, tel, role_user, typeDiabete, ville, diplome, pdp, last_login FROM user WHERE is_banned = 0";

    // If a search term is provided, add a WHERE clause
    if (!empty($searchTerm)) {
        $sql .= " AND (nom LIKE :searchTerm OR prenom LIKE :searchTerm)";
    }

    try {
        // Prepare the SQL statement
        $stmt = $db->prepare($sql);

        // If a search term is provided, bind the parameter
        if (!empty($searchTerm)) {
            $searchTerm = '%' . $searchTerm . '%';
            $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
        }

        // Execute the query
        $stmt->execute();

        // Fetch all rows
        $liste = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the result
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
        if ($this->emailExists($user->getEmail())) {
            // Email already exists, show a message or throw an exception
            echo "L'adresse e-mail existe déjà. Veuillez choisir une adresse e-mail différente.";
            return;
        }
        $sql = "INSERT INTO user  
            VALUES (NULL, :nom, :prenom, :email, :tel, :role_user, :typeDiabete, :ville, :diplome, :motdepasse, :pdp, CURRENT_TIMESTAMP, 0,NULL,NULL,:account_activation_hash)";
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
                'pdp' => $user->getPdp(), 
                'account_activation_hash' => $user->getAccountActivationHash(),

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
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            // User not found, you can handle this case as needed (throw an exception, return null, etc.)
            return null;
        }

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
                    motdepasse = :motdepasse,
                    pdp = :pdp' // Add pdp property
                . ' WHERE id = :idUser'
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
                'motdepasse' => $user->getMotdepasse(),
                'pdp' => $user->getPdp(), 
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
    $sql = "SELECT id, nom, prenom, email, motdepasse, tel, role_user, typeDiabete, ville, diplome, pdp, is_banned FROM user WHERE email = :email AND motdepasse = :motdepasse";
    $db = Config::getConnexion();

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':motdepasse', $motdepasse);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row['is_banned']) {
                return ['is_banned' => true];
            }
            if ($row['account_activation_hash'] !== null) {
                // Le compte n'est pas activé, retournez une erreur ou gérez comme nécessaire
                return ['account_not_activated' => true, 'message' => 'Votre compte n\'est pas activé. Veuillez activer votre compte pour vous connecter.'];
            }
            // Update last_login in the database
            $this->updateLastLogin($row['id']);

            return $row;
        } else {
            return false;
        }
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

    public function listUsersByRole($role)
    {
        $sql = "SELECT * FROM user WHERE role_user = :role";
        $db = config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':role', $role, PDO::PARAM_STR);
            $query->execute();
    
            // Fetch users from the database
            $users = $query->fetchAll(PDO::FETCH_ASSOC);
    
            return $users;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    private function updateLastLogin($userId)
{
    $sql = "UPDATE user SET last_login = CURRENT_TIMESTAMP WHERE id = :userId";
    $db = Config::getConnexion();

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
    } catch (Exception $e) {
        die('Error updating last login: ' . $e->getMessage());
    }
}
public function banUser($id)
{
    $sql = "UPDATE user SET is_banned = 1 WHERE id = :id";
    $db = config::getConnexion();

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        echo "User with ID $id has been banned successfully.";
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

public function unbanUser($id)
{
    $sql = "UPDATE user SET is_banned = 0 WHERE id = :id";
    $db = config::getConnexion();

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        echo "User with ID $id has been unbanned successfully.";
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

public  function emailExists($email)
{
    $sql = "SELECT COUNT(*) FROM user WHERE email = :email";
    $db = config::getConnexion();
    $query = $db->prepare($sql);
    $query->execute(['email' => $email]);

    // If the count is greater than 0, the email already exists
    return $query->fetchColumn() > 0;
}
public function isAccountActivated($email) {
    $pdo = config::getConnexion();
    $sql = "SELECT account_activation_hash FROM user WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return empty($result['account_activation_hash']);
}


}
