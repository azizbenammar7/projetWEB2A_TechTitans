<?php

require_once '../config.php';

class TypeController
{
    public function listType()
    {
        $sql = "SELECT * FROM type";
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addType($type)
    {
        $sql = "INSERT INTO type (typ) VALUES (:typ)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['typ' => $type->getTyp()]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function showType($id)
    {
        $sql = "SELECT * FROM type WHERE id = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $type = $query->fetch();
            return $type;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateType($type, $id)
    {
        $sql = "UPDATE type SET typ = :typ WHERE id = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'typ' => $type->getTyp(),
                'id' => $id,
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deleteType($id)
    {
        $sql = "DELETE FROM type WHERE id = :id";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
}
