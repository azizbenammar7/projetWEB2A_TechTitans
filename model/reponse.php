<?php

class Reponse
{
    private ?int $idreponse = null;
    private ?string $description = null;
    private ?int $etat = null;
    private ?int $reclamation = null;

    public function __construct(?string $description, ?int $etat, ?int $reclamation)
    {
        $this->description = $description;
        $this->etat = $etat;
        $this->reclamation = $reclamation;
    }

    public function getIdReponse(): ?int
    {
        return $this->idreponse;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(?int $etat): void
    {
        $this->etat = $etat;
    }

    public function getReclamation(): ?int
    {
        return $this->reclamation;
    }

    public function setReclamation(?int $reclamation): void
    {
        $this->reclamation = $reclamation;
    }
}

?>
