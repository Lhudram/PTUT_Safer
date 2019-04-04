<?php

class PaysManager
{

    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }


    public function add(String $pays, String $codePays): bool
    {
        $reqSQL = 'INSERT INTO PAYS VALUES (:codePays, :intitulePays)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':codePays', $codePays, PDO::PARAM_STR);
        $reqPreparee->bindValue(':intitulePays', $pays, PDO::PARAM_STR);
        return $reqPreparee->execute();
    }

    public function delete(String $id): bool
    {
        $reqSQL = 'DELETE FROM PAYS WHERE code_pays = :id';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':id', $id, PDO::PARAM_STR);
        return $reqPreparee->execute();
    }

    public function getAll(): ?array
    {
        $tabAll = array();

        $reqSQL = "SELECT code_pays, intitule_pays FROM PAYS";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($pays = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new Pays($pays->code_pays, $pays->intitule_pays);
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }
}

?>
