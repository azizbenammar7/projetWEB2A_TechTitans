<?php
class pack
{
    private ?int $IDpack = null;
    private ?string $nompack = null;
    private ?string $description = null;
    private ?float $prix = null;
    private ?string $type = null;
    private ?int $disponibilite = null;
    private ?string $datedebut = null;
    private ?string $datefin = null;

    public function __construct($IDpack, $nompack, $description, $prix, $type, $disponibilite, $datedebut, $datefin)
    {
        $this->IDpack = $IDpack;
        $this->nompack = $nompack;
        $this->description = $description;
        $this->prix = $prix;
        $this->type = $type;
        $this->disponibilite = $disponibilite;
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;

    }
// getters
    public function getIdPack()
    {
        return $this->IDpack;
    }

    public function getNomPack()
    {
        return $this->nompack;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getDisponibilite()
    {
        return $this->disponibilite;
    }

    public function getDateDebut()
    {
        return $this->datedebut;
    }

    public function getDateFin()
    {
        return $this->datefin;
    }

// setters
    public function setNomPack($nompack)
    {
        $this->nompack = $nompack;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setDisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;
        return $this;
    }

    public function setDateDebut($datedebut)
    {
        $this->datedebut = $datedebut;
        return $this;
    }

    public function setDateFin($datefin)
    {
        $this->datefin = $datefin;
        return $this;
    }
}
?>
