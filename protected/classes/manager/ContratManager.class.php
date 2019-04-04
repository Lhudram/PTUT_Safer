<?php

class ContratManager
{
    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }

    public function add(Contrat $contrat, Int $id): bool
    {
        $reqSQL = 'INSERT INTO CONTRAT VALUES (:idCollaborateur, :idNature, :dateDebut, :finPeriodeEssai, :idTypeEntree, :idEtablissement)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':idCollaborateur', $id);
        $reqPreparee->bindValue(':idNature', $contrat->getIdNature());
        $reqPreparee->bindValue(':dateDebut', $contrat->getDateDebut());
        $reqPreparee->bindValue(':finPeriodeEssai', $contrat->getFinPeriodeEssai());
        $reqPreparee->bindValue(':idTypeEntree', $contrat->getIdTypeEntree());
        $reqPreparee->bindValue(':idEtablissement', $contrat->getIdEtablissement());
        return $reqPreparee->execute();
    }

    public function get(Int $num): ?Contrat
    {
        $sql = 'SELECT id_naturecontrat, date_debut, fin_periode_essai, id_type_entree_contrat, id_etablissement FROM contrat WHERE id_collaborateur = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new Contrat($res->id_naturecontrat, $res->date_debut, $res->fin_periode_essai, $res->id_type_entree_contrat, $res->id_etablissement);
    }

    public function modifier(Contrat $contrat, Int $id): bool
    {
        $sql = 'UPDATE contrat SET id_naturecontrat = :idNatureContrat, date_debut = :dateDebut, fin_periode_essai = :finPeriode, id_type_entree_contrat = :idType, id_etablissement = :idEtablissement WHERE id_collaborateur = :id';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':idNatureContrat', $contrat->getIdNature());
        $requete->bindValue(':dateDebut', $contrat->getDateDebut(), PDO::PARAM_STR);
        $requete->bindValue(':finPeriode', $contrat->getFinPeriodeEssai(), PDO::PARAM_STR);
        $requete->bindValue(':idType', $contrat->getIdTypeEntree());
        $requete->bindValue(':idEtablissement', $contrat->getIdEtablissement());
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function supprimer(Int $id): bool
    {
        $requete = $this->db->prepare('DELETE FROM contrat WHERE id_collaborateur = :id');
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function estComplet(Contrat $contrat): bool
    {
        return !(empty($contrat->getIdNature()) || empty($contrat->getDateDebut()) || empty($contrat->getFinPeriodeEssai()) || empty($contrat->getIdTypeEntree()) || empty($contrat->getIdEtablissement()));
    }
}