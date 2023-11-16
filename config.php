<?php

class Config
{
    private static $pdo = null;

    private function __construct() {}

    public static function getConnexion()
    {
        if (!isset(self::$pdo)) {
            try {
                // Modifier les informations de connexion selon votre configuration
                $host = 'localhost';
                $dbname = 'reclamation';
                $user = 'root';
                $password = '';

                self::$pdo = new PDO(
                    "mysql:host=$host;dbname=$dbname",
                    $user,
                    $password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
                //echo "connected successfully";
            } catch (PDOException $e) {
                die('Erreur de connexion à la base de données: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}

// Vous pouvez appeler Config::getConnexion() chaque fois que vous avez besoin d'une connexion à la base de données
// config::getConnexion(); // Cette ligne ne semble pas nécessaire et peut être supprimée
