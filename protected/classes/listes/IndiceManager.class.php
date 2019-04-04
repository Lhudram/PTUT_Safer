<?php

class IndiceManager
{

    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }


    public function add(Int $indice): bool
    {
        $reqSQL = 'INSERT INTO INDICE (valeur_indice) VALUES (:valeurIndice)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':valeurIndice', $indice);
        return $reqPreparee->execute();
    }

    public function delete(Int $id): bool
    {
        $reqSQL = 'DELETE FROM INDICE WHERE id_indice = :id';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':id', $id);
        return $reqPreparee->execute();
    }

    public function getAll(): ?array
    {
        $tabAll = array();

        $reqSQL = "SELECT id_indice, valeur_indice FROM INDICE";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($indice = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new Indice($indice->id_indice, $indice->valeur_indice);
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }

    public function get(Int $num): ?Indice
    {
        $sql = 'SELECT id_indice, valeur_indice FROM INDICE WHERE id_indice = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new Indice($res->id_indice, $res->valeur_indice);
    }

    public function update(Float $valeur, Int $id): bool
    {
        $sql = 'UPDATE indice SET valeur_indice = :valeur WHERE id_indice = :id';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':valeur', $valeur);
        $requete->bindValue(":id", $id);
        return $requete->execute();
    }

    public function getLast(): int
    {
        $sql = 'SELECT MAX(id_indice) AS max FROM INDICE ';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return $res->max;
    }
}

?>
