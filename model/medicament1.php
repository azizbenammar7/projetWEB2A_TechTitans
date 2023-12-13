<?php

class Medicament1
{
    private ?int $id = null;
    private ?string $nom = null;
    private ?string $typ = null;
    private ?string $lieu = null;
    private ?string $dispon = null;
    private ?string $date_ajout = null;
    private ?string $piece_jointe = null; // Nouvelle colonne pour la pièce jointe

    public function __construct(
        $id = null,
        $nom,
        $typ,
        $lieu,
        $dispon,
        $date_ajout = null,
        $piece_jointe = null
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->typ = $typ;
        $this->lieu = $lieu;
        $this->dispon = $dispon;
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

    public function getTyp()
    {
        return $this->typ;
    }

    public function setTyp($typ)
    {
        $this->typ = $typ;
        return $this;
    }

    public function getLieu()
    {
        return $this->lieu;
    }

    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
        return $this;
    }

    public function getDispon()
    {
        return $this->dispon;
    }

    public function setDispon($dispon)
    {
        $this->dispon = $dispon;
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
