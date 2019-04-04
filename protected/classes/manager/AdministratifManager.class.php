<?php

class AdministratifManager
{
    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }

    public function add(PersonnesAPrevenir $personnesAPrevenir, Int $id): bool
    {
        $reqSQL = 'INSERT INTO ADMINISTRATIF VALUES (:idCollaborateur, :nomPersonneAPrevenir1, :telPersonneAPrevenir1, :nomPersonneAPrevenir2, :telPersonneAPrevenir2)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':idCollaborateur', $id);
        $reqPreparee->bindValue(':nomPersonneAPrevenir1', $personnesAPrevenir->getNom1(), PDO::PARAM_STR);
        $reqPreparee->bindValue(':telPersonneAPrevenir1', $personnesAPrevenir->getTel1(), PDO::PARAM_STR);
        $reqPreparee->bindValue(':nomPersonneAPrevenir2', $personnesAPrevenir->getNom2(), PDO::PARAM_STR);
        $reqPreparee->bindValue(':telPersonneAPrevenir2', $personnesAPrevenir->getTel2(), PDO::PARAM_STR);
        return $reqPreparee->execute();
    }

    public function get($num): ?PersonnesAPrevenir
    {
        $sql = 'SELECT nom_personne_a_prevenir_1, tel_personne_a_prevenir_1, nom_personne_a_prevenir_2, tel_personne_a_prevenir_2 FROM administratif WHERE id_collaborateur = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new PersonnesAPrevenir($res->nom_personne_a_prevenir_1, $res->tel_personne_a_prevenir_1, $res->nom_personne_a_prevenir_2, $res->tel_personne_a_prevenir_2);
    }

    public function modifier(PersonnesAPrevenir $personnesAPrevenir, Int $id): bool
    {
        $sql = 'UPDATE administratif SET nom_personne_a_prevenir_1 = :nom1, tel_personne_a_prevenir_1 = :tel1, nom_personne_a_prevenir_2 = :nom2, tel_personne_a_prevenir_2 = :tel2 WHERE id_collaborateur = :id';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':nom1', $personnesAPrevenir->getNom1());
        $requete->bindValue(':tel1', $personnesAPrevenir->getTel1());
        $requete->bindValue(':nom2', $personnesAPrevenir->getNom2());
        $requete->bindValue(':tel2', $personnesAPrevenir->getTel2());
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function supprimer(Int $id): bool
    {
        $requete = $this->db->prepare('DELETE FROM administratif WHERE id_collaborateur = :id');
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }
}