<?php

class DepartementPosteManager
{

    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }


    public function add(String $departementPoste): bool
    {
        $reqSQL = 'INSERT INTO DEPARTEMENT_POSTE (intitule_departement_poste) VALUES (:intituleDepartementPoste)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':intituleDepartementPoste', $departementPoste, PDO::PARAM_STR);
        return $reqPreparee->execute();
    }

    public function delete(Int $id): bool
    {
        $reqSQL = 'DELETE FROM DEPARTEMENT_POSTE WHERE id_departement_poste = :id';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':id', $id);
        return $reqPreparee->execute();
    }

    public function getAll(): ?array
    {
        $tabAll = array();

        $reqSQL = "SELECT id_departement_poste, intitule_departement_poste FROM DEPARTEMENT_POSTE";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($departementPoste = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new DepartementPoste($departementPoste->id_departement_poste, $departementPoste->intitule_departement_poste);
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }


    public function get(Int $num): ?DepartementPoste
    {
        $sql = 'SELECT id_departement_poste, intitule_departement_poste FROM DEPARTEMENT_POSTE WHERE id_departement_poste = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new DepartementPoste($res->id_departement_poste, $res->intitule_departement_poste);
    }

    public function getLast(): int
    {
        $sql = 'SELECT MAX(id_departement_poste) as max FROM DEPARTEMENT_POSTE ';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return $res->max;
    }
}

?>
