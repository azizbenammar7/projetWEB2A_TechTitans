<?php

class Commentaire
{
    private ?int $IDcommentaire = null;
    private ?string $text_of_commentaire = null;
    private ?int $publication = null;

    public function __construct(?int $IDcommentaire = null, string $text_of_commentaire = null, ?int $publication = null)
    {
        $this->IDcommentaire = $IDcommentaire;
        $this->text_of_commentaire = $text_of_commentaire;
        $this->publication = $publication;
    }

    public function getIDcommentaire()
    {
        return $this->IDcommentaire;
    }

    public function getTextOfCommentaire()
    {
        return $this->text_of_commentaire;
    }

    public function getPublicationId()
    {
        return $this->publication;
    }

    public function setIDcommentaire(?int $IDcommentaire)
    {
        $this->IDcommentaire = $IDcommentaire;
        return $this;
    }

    public function setTextOfCommentaire(string $text_of_commentaire)
    {
        $this->text_of_commentaire = $text_of_commentaire;
        return $this;
    }

    public function setPublicationId(?int $publication)
    {
        $this->publication = $publication;
        return $this;
    }
}
?>