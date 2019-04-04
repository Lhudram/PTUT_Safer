<?php

class Collaborateur
{
    private $etatCivil;
    private $immatriculation;
    private $coordonnees;
    private $contrat;
    private $poste;
    private $emploi;
    private $statut;
    private $idBulletinModele;
    private $horaire;
    private $personnesAPrevenir;

    public function __construct(?EtatCivil $etatCivil, ?Immatriculation $immatriculation, ?Coordonnees $coordonnees, ?Contrat $contrat,
                                ?Poste $poste, ?Emploi $emploi, ?Statut $statut, ?Int $idBulletinModele, ?Horaire $horaire, ?PersonnesAPrevenir $personnesAPrevenir)
    {
        $this->etatCivil = $etatCivil;
        $this->immatriculation = $immatriculation;
        $this->coordonnees = $coordonnees;
        $this->contrat = $contrat;
        $this->poste = $poste;
        $this->emploi = $emploi;
        $this->statut = $statut;
        $this->idBulletinModele = $idBulletinModele;
        $this->horaire = $horaire;
        $this->personnesAPrevenir = $personnesAPrevenir;
    }

    public function getEtatCivil(): ?EtatCivil
    {
        return $this->etatCivil;
    }

    public function getImmatriculation(): ?Immatriculation
    {
        return $this->immatriculation;
    }

    public function getCoordonnees(): ?Coordonnees
    {
        return $this->coordonnees;
    }

    public function getContrat(): ?Contrat
    {
        return $this->contrat;
    }

    public function getPoste(): ?Poste
    {
        return $this->poste;
    }

    public function getEmploi(): ?Emploi
    {
        return $this->emploi;
    }

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function getIdBulletinModele(): ?Int
    {
        return $this->idBulletinModele;
    }

    public function getHoraire(): ?Horaire
    {
        return $this->horaire;
    }

    public function getPersonnesAPrevenir(): ?PersonnesAPrevenir
    {
        return $this->personnesAPrevenir;
    }
}

?>
