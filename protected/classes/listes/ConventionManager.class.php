<?php

class ConventionManager
{

    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }


    public function add(String $convention): bool
    {
        $reqSQL = 'INSERT INTO CONVENTION (intitule_convention) VALUES (:intituleConvention)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':intituleConvention', $convention, PDO::PARAM_STR);
        return $reqPreparee->execute();
    }

    public function delete(Int $id): bool
    {
        $reqSQL = 'DELETE FROM CONVENTION WHERE id_convention = :id';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':id', $id);
        return $reqPreparee->execute();
    }

    public function getAll(): ?array
    {
        $tabAll = array();

        $reqSQL = "SELECT id_convention, intitule_convention FROM CONVENTION";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($convention = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new Convention($convention->id_convention, $convention->intitule_convention);
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }

    public function get(Int $num): ?Convention
    {
        $sql = 'SELECT id_convention, intitule_convention FROM CONVENTION WHERE id_convention = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new Convention($res->id_convention, $res->intitule_convention);
    }

    public function getLast(): int
    {
        $sql = 'SELECT MAX(id_convention) as max FROM CONVENTION ';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return $res->max;
    }
}

?>
