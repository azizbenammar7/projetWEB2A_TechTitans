<?php

class Avis
{
    private $IDavis;
    private $avis;
    private $note;
    private $pack;

    public function __construct($IDavis, $avis, $note, $pack)
    {
        $this->IDavis = $IDavis;
        $this->avis = $avis;
        $this->note = $note;
        $this->pack = $pack;
    }

    // Getters
    public function getIDavis()
    {
        return $this->IDavis;
    }

    public function getAvis()
    {
        return $this->avis;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function getPack()
    {
        return $this->pack;
    }

    // Setters
    public function setIDavis($IDavis)
    {
        $this->IDavis = $IDavis;
    }

    public function setAvis($avis)
    {
        $this->avis = $avis;
    }

    public function setNote($note)
    {
        $this->note = $note;
    }

    public function setPack($pack)
    {
        $this->pack = $pack;
    }
}
