<?php

class SituationFamilialeManager
{

    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }


    public function add(String $situationFamiliale): bool
    {
        $reqSQL = 'INSERT INTO SITUATION_FAMILIALE (intitule_situation_familiale) VALUES (:intituleSituationFamiliale)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':intituleSituationFamiliale', $situationFamiliale, PDO::PARAM_STR);
        return $reqPreparee->execute();
    }

    public function delete(Int $id): bool
    {
        $reqSQL = 'DELETE FROM SITUATION_FAMILIALE WHERE id_situation_familiale = :id';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':id', $id);
        return $reqPreparee->execute();
    }

    public function getAll(): ?array
    {
        $tabAll = array();

        $reqSQL = "SELECT id_situation_familiale, intitule_situation_familiale FROM SITUATION_FAMILIALE";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();
        while ($situationFamiliale = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new SituationFamiliale($situationFamiliale->id_situation_familiale, $situationFamiliale->intitule_situation_familiale);
        }

        $reqPreparee->closeCursor();

        return $tabAll;
    }

    public function get(Int $num): ?SituationFamiliale
    {
        $sql = 'SELECT id_situation_familiale, intitule_situation_familiale FROM SITUATION_FAMILIALE WHERE id_situation_familiale = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new SituationFamiliale($res->id_situation_familiale, $res->intitule_situation_familiale);
    }

    public function getLast(): int
    {
        $sql = 'SELECT MAX(id_situation_familiale) as max FROM SITUATION_FAMILIALE ';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return $res->max;
    }
}

?>
