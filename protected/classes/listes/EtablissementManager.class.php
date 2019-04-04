<?php

class EtablissementManager
{

    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }

    public function add(String $etablissement, String $adresse): bool
    {
        $reqSQL = 'INSERT INTO ETABLISSEMENT (intitule_etablissement, adresse_etablissement) VALUES (:intituleEtablissement, :adresse)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':intituleEtablissement', $etablissement, PDO::PARAM_STR);
        $reqPreparee->bindValue(':adresse', $adresse, PDO::PARAM_STR);
        return $reqPreparee->execute();
    }

    public function delete(Int $id): bool
    {
        $reqSQL = 'DELETE FROM ETABLISSEMENT WHERE id_etablissement = :id';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':id', $id);
        return $reqPreparee->execute();
    }

    public function getAll(): ?array
    {
        $tabAll = array();

        $reqSQL = "SELECT id_etablissement, intitule_etablissement,adresse_etablissement FROM ETABLISSEMENT";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($etablissement = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new Etablissement($etablissement->id_etablissement, $etablissement->intitule_etablissement, $etablissement->adresse_etablissement);
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }

    public function get(Int $num): ?Etablissement
    {
        $sql = 'SELECT id_etablissement, intitule_etablissement, adresse_etablissement FROM ETABLISSEMENT WHERE id_etablissement = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new Etablissement($res->id_etablissement, $res->intitule_etablissement, $res->adresse_etablissement);
    }

    public function getLast(): int
    {
        $sql = 'SELECT MAX(id_etablissement) AS max FROM ETABLISSEMENT ';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return $res->max;
    }
}