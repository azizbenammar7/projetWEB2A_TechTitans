<?php
class Reclamation
{
    private ?int $id = null;
    private ?string $typ = null;
    private ?string $description = null;
    private ?string $piece_jointe = null;
    private ?string $date_ajout = null;
    private ?int $etat = null;
    private ?int $user = null;

    public function __construct($id = null, $typ, $description, $piece_jointe, $date_ajout = null, $etat = null, $user= null)
    {
        $this->id = $id;
        $this->typ = $typ;
        $this->description = $description;
        $this->piece_jointe = $piece_jointe;
        $this->date_ajout = $date_ajout;
        $this->etat = $etat;
        $this->user = $user;
    }

    // Getters and Setters

    public function getId()
    {
        return $this->id;
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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getPieceJointePath()
    {
        return $this->piece_jointe;
    }

    public function setPieceJointePath($piece_jointe)
    {
        $this->piece_jointe = $piece_jointe;
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

    public function getEtat()
    {
        return $this->etat;
    }

    public function setEtat($etat)
    {
        $this->etat = $etat;
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
