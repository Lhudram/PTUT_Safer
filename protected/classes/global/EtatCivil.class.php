<?php

class EtatCivil
{
    private $idCollaborateur;
    private $civilite;
    private $nom;
    private $prenom;
    private $nomJeuneFille;
    private $idSituationFamiliale;
    private $nbEnfants;
    private $estComplet;

    public function __construct(?String $civilite, ?String $nom, ?String $prenom, ?String $nomJeuneFille, ?Int $idSituationFamiliale, ?String $nbEnfants, ?bool $estComplet)
    {
        if (empty($civilite)) {
            $this->civilite = null;
        } else {
            $this->civilite = ($civilite == "1") ? 1 : (($civilite == "2") ? 2 : null);
        }
        if (empty($nom)) {
            $this->nom = null;
        } else {
            $this->nom = $nom;
        }
        if (empty($prenom)) {
            $this->prenom = null;
        } else {
            $this->prenom = $prenom;
        }
        if (empty($nomJeuneFille)) {
            $this->nomJeuneFille = null;
        } else {
            $this->nomJeuneFille = $nomJeuneFille;
        }
        if (empty($idSituationFamiliale)) {
            $this->idSituationFamiliale = null;
        } else {
            $this->idSituationFamiliale = $idSituationFamiliale;
        }
        if (!isset($nbEnfants) || $nbEnfants == "") {
            $this->nbEnfants = null;
        } else {
            $this->nbEnfants = $nbEnfants;
        }
        $this->estComplet = $estComplet;
    }

    public function getIdCollaborateur(): ?Int
    {
        return $this->idCollaborateur;
    }

    public function setIdCollaborateur($idCollaborateur): void
    {
        $this->idCollaborateur = $idCollaborateur;
    }

    public function getCivilite(): ?Int
    {
        return $this->civilite;
    }

    public function setCivilite($civilite): void
    {
        $this->civilite = $civilite;
    }

    public function getNom(): ?String
    {
        return $this->nom;
    }

    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    public function getPrenom(): ?String
    {
        return $this->prenom;
    }

    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }

    public function getNomJeuneFille(): ?String
    {
        return $this->nomJeuneFille;
    }

    public function setNomJeuneFille($nomJeuneFille): void
    {
        $this->nomJeuneFille = $nomJeuneFille;
    }

    public function getIdSituationFamiliale(): ?Int
    {
        return $this->idSituationFamiliale;
    }

    public function setIdSituationFamiliale($idSituationFamiliale): void
    {
        $this->idSituationFamiliale = $idSituationFamiliale;
    }

    public function getEstComplet(): ?bool
    {
        return $this->estComplet;
    }

    public function setEstComplet($estComplet): void
    {
        $this->estComplet = $estComplet;
    }

    public function getNbEnfants(): ?Int
    {
        return $this->nbEnfants;
    }

    public function setNbEnfants(?Int $nbEnfants): void
    {
        $this->nbEnfants = $nbEnfants;
    }

}

?>
