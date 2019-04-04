<?php

class CategoriePosteManager
{

    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }


    public function add(String $categoriePoste): bool
    {
        $reqSQL = 'INSERT INTO CATEGORIE_POSTE (intitule_categorie_poste) VALUES (:intituleCategoriePoste)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':intituleCategoriePoste', $categoriePoste, PDO::PARAM_STR);
        return $reqPreparee->execute();
    }

    public function delete(Int $id): bool
    {
        $reqSQL = 'DELETE FROM CATEGORIE_POSTE WHERE id_categorie_poste = :id';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':id', $id);
        return $reqPreparee->execute();
    }

    public function getAll(): ?array
    {
        $tabAll = array();

        $reqSQL = "SELECT id_categorie_poste, intitule_categorie_poste FROM CATEGORIE_POSTE";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($categoriePoste = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new CategoriePoste($categoriePoste->id_categorie_poste, $categoriePoste->intitule_categorie_poste);
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }

    public function get(Int $num): ?CategoriePoste
    {
        $sql = 'SELECT id_categorie_poste, intitule_categorie_poste FROM CATEGORIE_POSTE WHERE id_categorie_poste = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new CategoriePoste($res->id_categorie_poste, $res->intitule_categorie_poste);
    }

    public function getLast(): int
    {
        $sql = 'SELECT MAX(id_categorie_poste) as max FROM CATEGORIE_POSTE ';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return $res->max;
    }
}

?>
