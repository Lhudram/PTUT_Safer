<?php

class StatutManager
{
    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }

    public function add(Statut $statut, Int $id): bool
    {
        $reqSQL = 'INSERT INTO STATUT VALUES (:idCollaborateur, :idConvention, :estAgirc)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':idCollaborateur', $id);
        $reqPreparee->bindValue(':idConvention', $statut->getIdConvention());
        $reqPreparee->bindValue(':estAgirc', $statut->getEstAgirc(), PDO::PARAM_BOOL);
        return $reqPreparee->execute();
    }

    public function get(Int $num): ?Statut
    {
        $sql = 'SELECT id_convention, est_agirc FROM statut WHERE id_collaborateur = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new Statut($res->id_convention, $res->est_agirc);
    }

    public function modifier(Statut $statut, Int $id): bool
    {
        $sql = 'UPDATE statut SET id_convention = :idConv, est_agirc = :agirc WHERE id_collaborateur = :id';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':idConv', $statut->getIdConvention());
        $requete->bindValue(':agirc', $statut->getEstAgirc(), PDO::PARAM_BOOL);
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function supprimer(Int $id): bool
    {
        $requete = $this->db->prepare('DELETE FROM statut WHERE id_collaborateur = :id');
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function estComplet(Statut $statut): bool
    {
        return !(empty($statut->getIdConvention()) || $statut->getEstAgirc() === null);
    }
}