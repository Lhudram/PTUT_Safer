<?php

class PersonnesAPrevenir
{
    private $nom1;
    private $tel1;
    private $nom2;
    private $tel2;

    public function __construct(?String $nom1, ?String $tel1, ?String $nom2, ?String $tel2)
    {
        $this->nom1 = empty($nom1) ? null : $nom1;
        $this->tel1 = $tel1 == "+33 " ? null : $tel1;
        $this->nom2 = empty($nom2) ? null : $nom2;
        $this->tel2 = $tel2 == "+33 " ? null : $tel2;
    }

    public function getNom1(): ?String
    {
        return $this->nom1;
    }

    public function getTel1(): ?String
    {
        return $this->tel1;
    }

    public function getNom2(): ?String
    {
        return $this->nom2;
    }

    public function getTel2(): ?String
    {
        return $this->tel2;
    }

}

?>
