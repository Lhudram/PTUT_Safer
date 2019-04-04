<?php

class CategorieSPManager
{

    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }


    public function add(String $categorieSP): bool
    {
        $reqSQL = 'INSERT INTO CATEGORIE_SP (code_categorie_sp) VALUES (:codeCatSP)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':codeCatSP', $categorieSP, PDO::PARAM_STR);
        return $reqPreparee->execute();
    }

    public function delete(Int $id): bool
    {
        $reqSQL = 'DELETE FROM CATEGORIE_SP WHERE id_categorie_sp = :id';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':id', $id);
        return $reqPreparee->execute();
    }

    public function getAll(): ?array
    {
        $tabAll = array();

        $reqSQL = "SELECT id_categorie_sp, code_categorie_sp FROM CATEGORIE_SP";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($categorieSP = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new CategorieSP($categorieSP->id_categorie_sp, $categorieSP->code_categorie_sp);
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }

    public function getLast(): int
    {
        $sql = 'SELECT MAX(id_categorie_sp) AS max FROM CATEGORIE_SP ';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return $res->max;
    }
}

?>