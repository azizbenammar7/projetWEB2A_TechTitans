<?php
class user
{
    private ?int $idJoueur = null;
    private ?string $nom = null;
    private ?string $prenom = null;
    private ?string $email = null;
    private ?string $tel = null;
    private ?int $diplome_id = null;
    private ?string $CIN = null; 
    private ?int $typeDiabete = null;

    public function __construct($id = null, $n, $p, $a, $d, $diplome_id = null, $CIN = null, $type_diabete = null)
    {
        $this->idJoueur = $id;
        $this->nom = $n;
        $this->prenom = $p;
        $this->email = $a;
        $this->tel = $d;
        $this->diplome_id = $diplome_id;
        $this->CIN = $CIN;
        $this->type_diabete = $type_diabete;
    }

    public function getIdJoueur()
    {
        return $this->idJoueur;
    }


    public function getNom()
    {
        return $this->nom;
    }


    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }


    public function getPrenom()
    {
        return $this->prenom;
    }


    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    public function getTel()
    {
        return $this->tel;
    }


    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    public function getDiplomeId()
    {
        return $this->diplome_id;
    }

    public function setDiplomeId($diplome_id)
    {
        $this->diplome_id = $diplome_id;
        return $this;
    }

    public function getCIN()
    {
        return $this->CIN;
    }

    public function setCIN($CIN)
    {
        $this->CIN = $CIN;
        return $this;
    }
    public function getTypeDiabete()
    {
        return $this->typeDiabete;
    }

    public function setTypeDiabete($typeDiabete)
    {
        $this->typeDiabete = $typeDiabete;
        return $this;
    }
    public function setRole($role)
{
    $this->role = $role;
    return $this;
}
public function getRole()
{
    return $this->role;
}
}



