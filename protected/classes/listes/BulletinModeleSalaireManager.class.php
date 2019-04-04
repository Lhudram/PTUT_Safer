<?php

class BulletinModeleSalaireManager
{

    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }


    public function add(BulletinModeleSalaire $bulletinModeleSalaire): bool
    {
        $reqSQL = 'INSERT INTO BULLETIN_MODELE_SALAIRE (intitule_bulletin_modele_salaire) VALUES (:intituleBulletinModeleSalaire)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':intituleBulletinModeleSalaire', $bulletinModeleSalaire->getIntitule());
        return $reqPreparee->execute();
    }

    public function getAll(): ?array
    {
        $tabAll = array();

        $reqSQL = "SELECT id_bulletin_modele_salaire, intitule_bulletin_modele_salaire FROM BULLETIN_MODELE_SALAIRE";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($bulletinModeleSalaire = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new BulletinModeleSalaire($bulletinModeleSalaire->id_bulletin_modele_salaire, $bulletinModeleSalaire->intitule_bulletin_modele_salaire);
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }

    public function get(Int $num): ?BulletinModeleSalaire
    {
        $sql = 'SELECT id_bulletin_modele_salaire, intitule_bulletin_modele_salaire FROM BULLETIN_MODELE_SALAIRE WHERE id_bulletin_modele_salaire = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new BulletinModeleSalaire($res->id_bulletin_modele_salaire, $res->intitule_bulletin_modele_salaire);
    }

    public function getLast(): int
    {
        $sql = 'SELECT MAX(id_bulletin_modele_salaire) AS max FROM BULLETIN_MODELE_SALAIRE ';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return $res->max;
    }

    public function delete(Int $id): bool
    {
        $requete = $this->db->prepare("DELETE FROM bulletin_modele_salaire WHERE id_bulletin_modele_salaire = :id");
        $requete->bindValue(":id", $id);
        return $requete->execute();
    }
}

?>
