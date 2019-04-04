<?php

class DepartementManager
{

    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }


    public function add(String $departemennumero, String $departementintitule): bool
    {
        $reqSQL = 'INSERT INTO DEPARTEMENT VALUES (:numeroDepartement, :intituleDepartement)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':numeroDepartement', $departemennumero, PDO::PARAM_STR);
        $reqPreparee->bindValue(':intituleDepartement', $departementintitule, PDO::PARAM_STR);
        return $reqPreparee->execute();
    }

    public function delete(String $id): bool
    {
        $reqSQL = 'DELETE FROM DEPARTEMENT WHERE numero_departement = :id';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':id', $id, PDO::PARAM_STR);
        return $reqPreparee->execute();
    }

    public function getAll(): ?array
    {
        $tabAll = array();

        $reqSQL = "SELECT numero_departement, intitule_departement FROM DEPARTEMENT";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($departement = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new Departement($departement->numero_departement, $departement->intitule_departement);
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }

    public function get(String $num): ?Departement
    {
        $sql = 'SELECT numero_departement, intitule_departement FROM DEPARTEMENT WHERE numero_departement = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new Departement($res->numero_departement, $res->intitule_departement);
    }
}

?>
