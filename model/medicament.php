<?php

class Medicament
{
    private ?int $id = null;
    private ?string $nom = null;
    private ?string $idfiche = null;
    private ?string $glyc = null;
    private ?string $chol = null;
    private ?string $date_ajout = null;
    private ?string $piece_jointe = null; // Nouvelle colonne pour la pièce jointe

    public function __construct(
        $id = null,
        $nom,
        $idfiche,
        $glyc,
        $chol,
        $date_ajout = null,
        $piece_jointe = null
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->idfiche = $idfiche;
        $this->glyc = $glyc;
        $this->chol = $chol;
        $this->date_ajout = $date_ajout;
        $this->piece_jointe = $piece_jointe;
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

    public function getidfiche()
    {
        return $this->idfiche;
    }

    public function setidfiche($idfiche)
    {
        $this->idfiche = $idfiche;
        return $this;
    }

    public function getglyc()
    {
        return $this->glyc;
    }

    public function setglyc($glyc)
    {
        $this->glyc = $glyc;
        return $this;
    }

    public function getchol()
    {
        return $this->chol;
    }

    public function setchol($chol)
    {
        $this->chol = $chol;
        return $this;
    }

    public function getDateAjout()
    {
        return $this->date_ajout;
    }

    public function setDateAjout($date_ajout)
    {
        $this->date_ajout = $date_ajout;
        return $this;
    }

    public function getPieceJointe()
    {
        return $this->piece_jointe;
    }

    public function setPieceJointe($piece_jointe)
    {
        $this->piece_jointe = $piece_jointe;
        return $this;
    }
}
