<?php

class ParagrapheContratTravail
{
    private $indice;
    private $estObligatoire;
    private $estArticle;
    private $afficheTitre;
    private $intitule;
    private $contenu;

    public function __construct(?Int $indice, ?Bool $estObligatoire, ?Bool $estArticle, ?Bool $afficheArticle, ?String $intitule, ?String $contenu)
    {
        $this->indice = $indice;
        $this->afficheTitre =$afficheArticle;
        $this->estObligatoire = $estObligatoire;
        $this->estArticle = $estArticle;
        $this->intitule = $intitule;
        $this->contenu = $contenu;
    }

    public function getIndice(): ?Int
    {
        return $this->indice;
    }

    public function setIndice($indice): void
    {
        $this->indice = $indice;
    }

    public function getEstObligatoire(): ?Bool
    {
        return $this->estObligatoire;
    }

    public function setEstObligatoire($estObligatoire): void
    {
        $this->estObligatoire = $estObligatoire;
    }

    public function getEstArticle(): ?Bool
    {
        return $this->estArticle;
    }

    public function setEstArticle($estArticle): void
    {
        $this->estArticle = $estArticle;
    }

    public function getIntitule(): ?String
    {
        return $this->intitule;
    }

    public function setIntitule($intitule): void
    {
        $this->intitule = $intitule;
    }

    public function getContenu(): ?String
    {
        return $this->contenu;
    }

    public function setContenu($contenu): void
    {
        $this->contenu = $contenu;
    }

    public function getAfficheTitre(): ?Bool
    {
        return $this->afficheTitre;
    }

    public function setAfficheTitre($afficheTitre): void
    {
        $this->afficheTitre = $afficheTitre;
    }
}

?>
