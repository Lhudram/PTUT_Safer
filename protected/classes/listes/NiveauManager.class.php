<?php

class NiveauManager
{

    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }


    public function add(String $niveau, int $minRemun, int $maxRemun): bool
    {
        $reqSQL = 'INSERT INTO NIVEAU (code_niveau, min_remuneration, max_remuneration) VALUES (:codeNiveau, :minRemuneration, :maxRemuneration)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':codeNiveau', $niveau, PDO::PARAM_STR);
        $reqPreparee->bindValue(':minRemuneration', $minRemun);
        $reqPreparee->bindValue(':maxRemuneration', $maxRemun);
        return $reqPreparee->execute();
    }

    public function delete(Int $id): bool
    {
        $reqSQL = 'DELETE FROM NIVEAU WHERE id_niveau = :id';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':id', $id);
        return $reqPreparee->execute();
    }

    public function getAll(): ?array
    {
        $tabAll = array();

        $reqSQL = "SELECT id_niveau, code_niveau, min_remuneration, max_remuneration FROM NIVEAU";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($niveau = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new Niveau($niveau->id_niveau, $niveau->code_niveau, $niveau->min_remuneration, $niveau->max_remuneration);
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }

    public function getLast(): int
    {
        $sql = 'SELECT MAX(id_niveau) as max FROM NIVEAU ';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return $res->max;
    }
}

?>