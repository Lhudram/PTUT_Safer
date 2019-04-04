<?php

class ImmatriculationManager
{
    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }

    public function add(Immatriculation $immatriculation, Int $id): bool
    {
        $reqSQL = 'INSERT INTO IMMATRICULATION VALUES (:idCollaborateur, :dateNaissance, :numeroDepartementNaissance, :codePaysNaissance, :communeNaissance, ' .
            ':codeCommuneNaissance, :nationalite, :numeroImmatriculation, :email)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':idCollaborateur', $id);
        $reqPreparee->bindValue(':dateNaissance', $immatriculation->getDateNaissance(), PDO::PARAM_STR);
        $reqPreparee->bindValue(':numeroDepartementNaissance', $immatriculation->getDepNaissance(), PDO::PARAM_STR);
        $reqPreparee->bindValue(':codePaysNaissance', $immatriculation->getPaysNaissance(), PDO::PARAM_STR);
        $reqPreparee->bindValue(':communeNaissance', $immatriculation->getCommuneNaissance(), PDO::PARAM_STR);
        $reqPreparee->bindValue(':codeCommuneNaissance', $immatriculation->getCodeCommuneNaissance());
        $reqPreparee->bindValue(':nationalite', $immatriculation->getNationalite(), PDO::PARAM_STR);
        $reqPreparee->bindValue(':numeroImmatriculation', $immatriculation->getNumImmatriculation());
        $reqPreparee->bindValue(':email', $immatriculation->getEmail(), PDO::PARAM_STR);
        return $reqPreparee->execute();
    }

    public function get(Int $num): ?Immatriculation
    {
        $sql = 'SELECT date_naissance, numero_departement_naissance, code_pays_naissance, commune_naissance, code_commune_naissance, nationalite, numero_immatriculation, email FROM immatriculation WHERE id_collaborateur = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new Immatriculation($res->date_naissance, $res->numero_departement_naissance, $res->code_pays_naissance, $res->commune_naissance,
            $res->code_commune_naissance, $res->nationalite, $res->numero_immatriculation, $res->email);
    }

    public function modifier(Immatriculation $immatriculation, Int $id): bool
    {
        $sql = 'UPDATE immatriculation SET date_naissance = :dateNaiss, numero_departement_naissance = :numDepNaiss, code_pays_naissance = :codePaysNaiss, commune_naissance = :communeNaiss, code_commune_naissance = :codeCommuneNaiss,' .
            ' nationalite = :nationalite, numero_immatriculation= :numImma, email = :email WHERE id_collaborateur = :id';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':dateNaiss', $immatriculation->getDateNaissance(), PDO::PARAM_STR);
        $requete->bindValue(':numDepNaiss', $immatriculation->getDepNaissance(), PDO::PARAM_STR);
        $requete->bindValue(':codePaysNaiss', $immatriculation->getPaysNaissance(), PDO::PARAM_STR);
        $requete->bindValue(':communeNaiss', $immatriculation->getCommuneNaissance(), PDO::PARAM_STR);
        $requete->bindValue(':codeCommuneNaiss', $immatriculation->getCodeCommuneNaissance());
        $requete->bindValue(':nationalite', $immatriculation->getNationalite(), PDO::PARAM_STR);
        $requete->bindValue(':numImma', $immatriculation->getNumImmatriculation(), PDO::PARAM_STR);
        $requete->bindValue(':email', $immatriculation->getEmail(), PDO::PARAM_STR);
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function supprimer(Int $id): bool
    {
        $requete = $this->db->prepare('DELETE FROM immatriculation WHERE id_collaborateur = :id');
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function estComplet(Immatriculation $immatriculation): bool
    {
        return !(empty($immatriculation->getDateNaissance()) || empty($immatriculation->getDepNaissance()) || empty($immatriculation->getPaysNaissance()) || empty($immatriculation->getCommuneNaissance())
            || empty($immatriculation->getCodeCommuneNaissance()) && empty($immatriculation->getNationalite()) && empty($immatriculation->getNumImmatriculation()));
    }
}