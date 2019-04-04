<?php

class CategorieSP
{

    private $id;
    private $code;

    public function __construct(?Int $id, ?String $code)
    {
        $this->id = $id;
        $this->code = $code;
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
}

?>