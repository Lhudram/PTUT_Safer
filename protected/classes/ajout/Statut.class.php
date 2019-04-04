<?php

class Statut
{
    private $idConvention;
    private $estAgirc;

    public function __construct(?Int $idConvention, ?Bool $estAgirc)
    {
        $this->idConvention = empty($idConvention) ? null : $idConvention;
        $this->estAgirc = !empty($estAgirc);
    }

    public function getIdConvention(): ?Int
    {
        return $this->idConvention;
    }

    public function getEstAgirc(): Bool
    {
        return $this->estAgirc;
    }


}

?>
