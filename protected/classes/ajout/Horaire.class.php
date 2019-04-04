<?php

class Horaire
{
    private $nbHeuresTravaillees;
    private $idModaliteExerciceTravail;

    public function __construct(?String $nbHeuresTravaillees, ?Int $idModaliteExerciceTravail)
    {
        $this->nbHeuresTravaillees = empty($nbHeuresTravaillees) ? null : $nbHeuresTravaillees;
        $this->idModaliteExerciceTravail = $idModaliteExerciceTravail;
    }

    public function getNbHeuresTravaillees(): ?Float
    {
        return $this->nbHeuresTravaillees;
    }

    public function getIdModaliteExerciceTravail(): ?Int
    {
        return $this->idModaliteExerciceTravail;
    }

}

?>
