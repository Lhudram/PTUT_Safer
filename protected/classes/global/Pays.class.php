<?php

class Pays
{

    private $code;
    private $intitule;

    public function __construct(?String $code, ?String $intitule)
    {
        $this->code = $code;
        $this->intitule = $intitule;
    }


    public function getCode(): ?String
    {
        return $this->code;
    }

    public function setCode($code): void
    {
        $this->code = $code;
    }

    public function getIntitule(): ?String
    {
        return $this->intitule;
    }

    public function setIntitule($intitule): void
    {
        $this->intitule = $intitule;
    }
}

?>
