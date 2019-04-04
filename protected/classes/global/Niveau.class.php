<?php

class Niveau
{

    private $id;
    private $code;
    private $minRemuneration;
    private $maxRemuneration;

    public function __construct(?Int $id, ?String $code, ?Int $minRemuneration, ?Int $maxRemuneration)
    {
        $this->id = $id;
        $this->code = $code;
        $this->minRemuneration = $minRemuneration;
        $this->maxRemuneration = $maxRemuneration;
    }


    public function getId(): ?Int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getCode(): ?String
    {
        return $this->code;
    }

    public function setCode($code): void
    {
        $this->code = $code;
    }

    public function getMinRemuneration(): ?Int
    {
        return $this->minRemuneration;
    }

    public function setMinRemuneration($minRemuneration): void
    {
        $this->minRemuneration = $minRemuneration;
    }

    public function getMaxRemuneration(): ?Int
    {
        return $this->maxRemuneration;
    }

    public function setMaxRemuneration($maxRemuneration): void
    {
        $this->maxRemuneration = $maxRemuneration;
    }
}

?>