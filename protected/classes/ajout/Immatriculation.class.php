<?php

class Immatriculation
{
    private $dateNaissance;
    private $departementNaissance;
    private $paysNaissance;
    private $communeNaissance;
    private $codeCommuneNaissance;
    private $nationalite;
    private $numeroImmatriculation;
    private $email;

    public function __construct(?String $dateNaiss, ?String $nomDepNaiss, ?String $codePays, ?String $communeNaiss, ?String $codeCommuneNaiss, ?String $nationalite, ?String $numImmatri, ?String $email)
    {
        $this->dateNaissance = empty($dateNaiss) ? null : $dateNaiss;
        $this->departementNaissance = empty($nomDepNaiss) ? null : $nomDepNaiss;
        $this->paysNaissance = empty($codePays) ? null : $codePays;
        $this->communeNaissance = empty($communeNaiss) ? null : $communeNaiss;
        $this->codeCommuneNaissance = empty($codeCommuneNaiss) ? null : $codeCommuneNaiss;
        $this->nationalite = empty($nationalite) ? null : $nationalite;
        $this->numeroImmatriculation = empty($numImmatri) ? null : $numImmatri;
        $this->email = empty($email) ? null : $email;
    }

    public function getDateNaissance(): ?String
    {
        return $this->dateNaissance;
    }

    public function getDepNaissance(): ?String
    {
        return $this->departementNaissance;
    }

    public function getPaysNaissance(): ?String
    {
        return $this->paysNaissance;
    }

    public function getCommuneNaissance(): ?String
    {
        return $this->communeNaissance;
    }

    public function getCodeCommuneNaissance(): ?Int
    {
        return $this->codeCommuneNaissance;
    }

    public function getNationalite(): ?String
    {
        return $this->nationalite;
    }

    public function getImmatriculationAff(): ?array
    {
        $res = explode(' ', $this->getNumImmatriculation());
        return $res;
    }

    public function getNumImmatriculation(): ?String
    {
        return $this->numeroImmatriculation;
    }

    public function getEmail(): ?String
    {
        return $this->email;
    }

}

?>
