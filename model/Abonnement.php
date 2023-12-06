<?php

class Abonnement
{
    private $IDuser;
    private $IDpackuser;
    private $dateabonnement;
    private $payed;

    public function __construct($IDuser, $IDpackuser, $dateabonnement, $payed)
    {
        $this->IDuser = $IDuser;
        $this->IDpackuser = $IDpackuser;
        $this->dateabonnement = $dateabonnement;
        $this->payed = $payed;
    }

    // Getters
    public function getIDuser()
    {
        return $this->IDuser;
    }

    public function getIDpackuser()
    {
        return $this->IDpackuser;
    }

    public function getDateAbonnement()
    {
        return $this->dateabonnement;
    }

    public function getPayed()
    {
        return $this->payed;
    }

    // Setters
    public function setIDuser($IDuser)
    {
        $this->IDuser = $IDuser;
    }

    public function setIDpackuser($IDpackuser)
    {
        $this->IDpackuser = $IDpackuser;
    }

    public function setDateAbonnement($dateabonnement)
    {
        $this->dateabonnement = $dateabonnement;
    }

    public function setPayed($payed)
    {
        $this->payed = $payed;
    }
}
