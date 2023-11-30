<?php

class idfichee
{
    private ?int $id = null;
    private ?string $idfiche = null;
    private ?string $email = null;
    private ?string $tel = null;
    private ?string $sexe = null;

    public function __construct($id = null, $idfiche, $email, $tel, $sexe)
    {
        $this->id = $id;
        $this->idfiche = $idfiche;
        $this->email = $email;
        $this->tel = $tel;
        $this->sexe = $sexe;
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
}
