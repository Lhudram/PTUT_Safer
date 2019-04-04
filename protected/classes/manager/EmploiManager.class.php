<?php

class EmploiManager
{
    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }

    public function add(Emploi $emploi, Int $id): bool
    {
        $reqSQL = 'INSERT INTO EMPLOI VALUES (:idCollaborateur, :idEmploiCCN, :idIndice, :coefficient)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':idCollaborateur', $id);
        $reqPreparee->bindValue(':idEmploiCCN', $emploi->getIdEmploiCCN());
        $reqPreparee->bindValue(':idIndice', $emploi->getIdIndice());
        $reqPreparee->bindValue(':coefficient', $emploi->getCoefficient());
        return $reqPreparee->execute();
    }

    public function get(Int $num): ?Emploi
    {
        $sql = 'SELECT id_emploi_ccn, coefficient FROM emploi WHERE id_collaborateur = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new Emploi($res->id_emploi_ccn, $res->coefficient);
    }

    public function modifier(Emploi $emploi, Int $id): bool
    {
        $sql = 'UPDATE emploi SET id_emploi_ccn = :idCCN, coefficient = :coeff WHERE id_collaborateur = :id';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':idCCN', $emploi->getIdEmploiCCN());
        $requete->bindValue(':coeff', $emploi->getCoefficient());
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function supprimer(Int $id): bool
    {
        $requete = $this->db->prepare('DELETE FROM emploi WHERE id_collaborateur = :id');
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function estComplet(Emploi $emploi): bool
    {
        return !(empty($emploi->getCoefficient()) || empty($emploi->getIdEmploiCCN()));
    }
}