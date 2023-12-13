<?php

class Type1
{
    private ?int $id = null;
    private ?string $typ = null;

    public function __construct($id = null, $typ)
    {
        $this->id = $id;
        $this->typ = $typ;
    }

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
}
