<?php
class publication
{
    private ?int $IDpub = null;
    private ?string $nom = null;
    private ?string $prenom = null;
    private ?string $email = null;
    private ?string $role = null;
    private ?string $text_of_pub = null;
    private ?string $date_pub = null; 

    public function __construct(int $IDpub=null, string $nom, string $prenom, string $email,string $role, string $text_of_pub, string $date_pub)
    {
        $this->IDpub = $IDpub;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->role = $role;
        $this->text_of_pub = $text_of_pub;
        $this->date_pub = $date_pub;
    }

    

    public function getIDpub()
    {
        return $this->IDpub;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function getRole()
    {
        return $this->role;
    }

    public function getTextOfPub()
    {
        return $this->text_of_pub;
    }

    public function getDatePub()
    {
        return $this->date_pub;
    }

    public function setIDpub($IDpub)
    {
        $this->IDpub = $IDpub;
        return $this;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    public function setTextOfPub($text_of_pub)
    {
        $this->text_of_pub = $text_of_pub;
        return $this;
    }

    public function setDatePub($date_pub)
    {
        $this->date_pub = $date_pub;
        return $this;
    }
}
?>