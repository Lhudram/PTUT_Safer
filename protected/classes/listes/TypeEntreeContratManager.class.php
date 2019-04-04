<?php

class TypeEntreeContratManager
{

    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }


    public function add(String $typeEntreeContrat): bool
    {
        $reqSQL = 'INSERT INTO TYPE_ENTREE_CONTRAT (intitule_type_entree_contrat) VALUES (:intituleTypeEntreeContrat)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':intituleTypeEntreeContrat', $typeEntreeContrat, PDO::PARAM_STR);
        return $reqPreparee->execute();
    }

    public function delete(Int $id): bool
    {
        $reqSQL = 'DELETE FROM TYPE_ENTREE_CONTRAT WHERE id_type_entree_contrat = :id';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':id', $id);
        return $reqPreparee->execute();
    }

    public function getAll(): ?array
    {
        $tabAll = array();

        $reqSQL = "SELECT id_type_entree_contrat, intitule_type_entree_contrat FROM TYPE_ENTREE_CONTRAT";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($typeEntreeContrat = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new TypeEntreeContrat($typeEntreeContrat->id_type_entree_contrat, $typeEntreeContrat->intitule_type_entree_contrat);
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }

    public function get(Int $num): ?TypeEntreeContrat
    {
        $sql = 'SELECT id_type_entree_contrat, intitule_type_entree_contrat FROM TYPE_ENTREE_CONTRAT WHERE id_type_entree_contrat = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new TypeEntreeContrat($res->id_type_entree_contrat, $res->intitule_type_entree_contrat);
    }

    public function getLast(): int
    {
        $sql = 'SELECT MAX(id_type_entree_contrat) as max FROM TYPE_ENTREE_CONTRAT ';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return $res->max;
    }
}

?>
