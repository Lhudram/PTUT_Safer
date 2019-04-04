<?php

class ModaliteExerciceTravail
{

    private $id;
    private $intitule;

    public function __construct(?Int $id, ?String $intitule)
    {
        $this->id = $id;
        $this->intitule = $intitule;
    }


    public function getId(): ?Int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
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