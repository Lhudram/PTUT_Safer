<?php

class EmploiCCNManager
{

    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }


    public function add(String $emploiCCN, int $idCatSp, int $idNiveau): bool
    {
        $reqSQL = 'INSERT INTO EMPLOI_CCN (intitule_emploi_ccn, id_categoriesp, id_niveau) VALUES (:intituleEmploiCCN, :idCategorieSP, :idNiveau)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':intituleEmploiCCN', $emploiCCN, PDO::PARAM_STR);
        $reqPreparee->bindValue(':idCategorieSP', $idCatSp);
        $reqPreparee->bindValue(':idNiveau', $idNiveau);
        return $reqPreparee->execute();
    }

    public function delete(Int $id): bool
    {
        $reqSQL = 'DELETE FROM EMPLOI_CCN WHERE id_emploi_ccn = :id';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':id', $id);
        return $reqPreparee->execute();
    }

    public function getAll(): ?array
    {
        $tabAll = array();

        $reqSQL = "SELECT id_emploi_ccn, intitule_emploi_ccn, id_categoriesp, id_niveau FROM EMPLOI_CCN ORDER BY id_emploi_ccn";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($emploiCCN = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new EmploiCCN($emploiCCN->id_emploi_ccn, $emploiCCN->intitule_emploi_ccn, $emploiCCN->id_categoriesp, $emploiCCN->id_niveau);
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }

    public function get(Int $num): ?EmploiCCN
    {
        $sql = 'SELECT id_emploi_ccn, intitule_emploi_ccn, id_categoriesp, id_niveau FROM EMPLOI_CCN WHERE id_emploi_ccn = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new EmploiCCN($res->id_emploi_ccn, $res->intitule_emploi_ccn, $res->id_categoriesp, $res->id_niveau);
    }

    public function getLast(): ?int
    {
        $sql = 'SELECT MAX(id_emploi_ccn) AS max FROM EMPLOI_CCN ';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return $res->max;
    }

    public function getMission(Int $id): ?String
    {
        $sql = 'SELECT mission FROM EMPLOI_CCN WHERE id_emploi_ccn = :id';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':id', $id);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return $res->mission;
    }

    public function updateMission(String $mission, Int $id): ?bool
    {
        $sql = 'UPDATE emploi_ccn SET mission = :mission WHERE id_emploi_ccn = :id';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':mission', $mission, PDO::PARAM_STR);
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }
}