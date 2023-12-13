<?php

class Commentaire
{
    private ?int $IDcommentaire = null;
    private ?string $text_of_commentaire = null;
    private ?int $publication = null;

    public function __construct(?int $IDcommentaire = null, ?string $text_of_commentaire = null, ?int $publication = null) // Change this line
    {
        $this->IDcommentaire = $IDcommentaire;
        $this->text_of_commentaire = $text_of_commentaire;
        $this->publication = $publication;
    }

    public function getIDcommentaire(): ?int
    {
        return $this->IDcommentaire;
    }

    public function getTextOfCommentaire(): ?string
    {
        return $this->text_of_commentaire;
    }

    public function getPublication() : ?int
    {
        return $this->publication;
    }

    public function setIDcommentaire(?int $IDcommentaire)
    {
        $this->IDcommentaire = $IDcommentaire;
        return $this;
    }

    public function setTextOfCommentaire(string $text_of_commentaire) : void
    {
        $this->text_of_commentaire = $text_of_commentaire;
        
    }

    public function setPublication(?int $publication): void
    {
        $this->publication = $pubID;
        
    }
}
?>