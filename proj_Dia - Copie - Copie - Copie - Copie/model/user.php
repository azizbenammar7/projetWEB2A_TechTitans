<?php

class User
{
    private ?int $id = null;
    private ?string $nom = null;
    private ?string $prenom = null;
    private ?string $email = null;
    private ?string $tel = null;
    private ?string $roleUser = null;
    private ?int $typeDiabete = null;
    private ?string $ville = null;
    private ?string $diplome = null;
    private ?string $motdepasse = null;
    private ?string $pdp = null;
    private ?string $accountActivationHash = null;






    public function __construct(
        ?int $id = null,
        ?string $nom = null,
        ?string $prenom = null,
        ?string $email = null,
        ?string $tel = null,
        ?string $roleUser = null,
        ?int $typeDiabete = null,
        ?string $ville = null,
        ?string $diplome = null,
        ?string $motdepasse = null,
        ?string $pdp = null,
        ?string $accountActivationHash = null

    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->tel = $tel;
        $this->roleUser = $roleUser;
        $this->typeDiabete = $typeDiabete;
        $this->ville = $ville;
        $this->diplome = $diplome;
        $this->motdepasse = $motdepasse;
        $this->pdp = $pdp;
        $this->accountActivationHash = $accountActivationHash;


    }

    public function getId()
    {
        return $this->id;
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

    public function getRoleUser()
    {
        return $this->roleUser;
    }

    public function setRoleUser($roleUser)
    {
        $this->roleUser = $roleUser;
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

    public function getVille()
    {
        return $this->ville;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;
        return $this;
    }

    public function getDiplome()
    {
        return $this->diplome;
    }

    public function setDiplome($diplome)
    {
        $this->diplome = $diplome;
        return $this;
    }
    public function getMotdepasse()
    {
        return $this->motdepasse;
    }

    public function setMotdepasse( $motdepasse)
    {
        $this->motdepasse = $motdepasse;
        return $this;
    }
    public function getPdp()
    {
        return $this->pdp;
    }

    public function setPdp($pdp)
    {
        $this->pdp = $pdp;
        return $this;
    }
    public function getAccountActivationHash()
    {
        return $this->accountActivationHash;
    }
    
    public function setAccountActivationHash($accountActivationHash)
    {
        $this->accountActivationHash = $accountActivationHash;
        return $this;
    }
    
}

