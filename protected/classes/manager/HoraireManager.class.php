<?php

class HoraireManager
{
    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }

    public function add(Horaire $horaire, Int $id): bool
    {
        $reqSQL = 'INSERT INTO HORAIRE VALUES (:idCollaborateur, :nbHeuresTravaillees, :idModaliteExerciceTravail)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':idCollaborateur', $id);
        $reqPreparee->bindValue(':nbHeuresTravaillees', $horaire->getNbHeuresTravaillees(), PDO::PARAM_STR);
        $reqPreparee->bindValue(':idModaliteExerciceTravail', $horaire->getIdModaliteExerciceTravail());
        return $reqPreparee->execute();
    }

    public function get(Int $num): ?Horaire
    {
        $sql = 'SELECT nb_heures_travaillees, id_modalite_exercice_travail FROM horaire WHERE id_collaborateur = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new Horaire($res->nb_heures_travaillees, $res->id_modalite_exercice_travail);
    }

    public function modifier(Horaire $horaire, Int $id): bool
    {
        $sql = 'UPDATE horaire SET nb_heures_travaillees = :nbHeures, id_modalite_exercice_travail = :idModalite WHERE id_collaborateur = :id';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':nbHeures', $horaire->getNbHeuresTravaillees(), PDO::PARAM_STR);
        $requete->bindValue(':idModalite', $horaire->getIdModaliteExerciceTravail());
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function supprimer(Int $id): bool
    {
        $requete = $this->db->prepare('DELETE FROM horaire WHERE id_collaborateur = :id');
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function estComplet(Horaire $horaire): bool
    {
        return !(empty($horaire->getNbHeuresTravaillees()) || empty($horaire->getIdModaliteExerciceTravail()));
    }
}