<?php

class NatureContratManager
{

    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }


    public function add(String $natureContrat): bool
    {
        $reqSQL = 'INSERT INTO NATURE_CONTRAT (intitule_nature_contrat) VALUES (:intituleNatureContrat)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':intituleNatureContrat', $natureContrat, PDO::PARAM_STR);
        return $reqPreparee->execute();
    }

    public function delete(Int $id): bool
    {
        $reqSQL = 'DELETE FROM NATURE_CONTRAT WHERE id_nature_contrat = :id';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':id', $id);
        return $reqPreparee->execute();
    }

    public function getAll(): ?array
    {
        $tabAll = array();

        $reqSQL = "SELECT id_nature_contrat, intitule_nature_contrat FROM NATURE_CONTRAT";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($natureContrat = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new NatureContrat($natureContrat->id_nature_contrat, $natureContrat->intitule_nature_contrat);
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }

    public function get(Int $num): ?NatureContrat
    {
        $sql = 'SELECT id_nature_contrat, intitule_nature_contrat FROM NATURE_CONTRAT WHERE id_nature_contrat = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new NatureContrat($res->id_nature_contrat, $res->intitule_nature_contrat);
    }

    public function getLast(): int
    {
        $sql = 'SELECT MAX(id_nature_contrat) as max FROM NATURE_CONTRAT ';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return $res->max;
    }
}