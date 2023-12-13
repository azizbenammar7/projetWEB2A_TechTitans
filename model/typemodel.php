<?php

class idfichee
{
    private ?int $id = null;
    private ?string $idfiche = null;
    private ?string $email = null;
    private ?string $tel = null;
    private ?string $sexe = null;
    private ?string $description = null;
    private ?string $user = null;

    public function __construct($id = null, $idfiche, $email, $tel, $sexe , $description,$user)
    {
        $this->id = $id;
        $this->idfiche = $idfiche;
        $this->email = $email;
        $this->tel = $tel;
        $this->sexe = $sexe;
        $this->description = $description;
        $this->user = $user;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getidfiche()
    {
        return $this->idfiche;
    }
    public function setidfiche($idfiche)
    {
        $this->idfiche = $idfiche;
        return $this;
    }
    public function getdescription()
    {
        return $this->description;
    }
    public function setdescription($description)
    {
        $this->description = $description;
        return $this;
    }


    public function getemail()
    {
        return $this->email;
    }

    public function setemail($email)
    {
        $this->email = $email;
        return $this;
    }
    public function gettel()
    {
        return $this->tel;
    }

    public function settel($tel)
    {
        $this->tel = $tel;
        return $this;
    }
    public function getsexe()
    {
        return $this->sexe;
    }

    public function setsexe($sexe)
    {
        $this->sexe = $sexe;
        return $this;
    }
    public function getuser()
    {
        return $this->user;
    }

    public function setuser($user)
    {
        $this->user = $user;
        return $this;
    }
}