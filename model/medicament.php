<?php

class Medicament
{
    private ?int $id = null;
    private ?string $nom = null; // Nouvelle colonne "nom"
    private ?string $typ = null;
    private ?string $lieu = null;
    private ?string $dispon = null;
    private ?string $date_ajout = null;

    public function __construct($id = null, $n, $t, $l, $d, $date_ajout = null)
    {
        $this->id = $id;
        $this->nom = $n; // Nouvelle colonne "nom"
        $this->typ = $t;
        $this->lieu = $l;
        $this->dispon = $d;
        $this->date_ajout = $date_ajout;
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
}
