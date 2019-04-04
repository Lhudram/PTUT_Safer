<?php

class ModaliteExerciceTravailManager
{

    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }


    public function add(String $modaliteExerciceTravail): bool
    {
        $reqSQL = 'INSERT INTO MODALITE_EXERCICE_TRAVAIL (intitule_modalite_exercice_travail) VALUES (:intituleModaliteExerciceTravail)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':intituleModaliteExerciceTravail', $modaliteExerciceTravail, PDO::PARAM_STR);
        return $reqPreparee->execute();
    }

    public function delete(Int $id): bool
    {
        $reqSQL = 'DELETE FROM MODALITE_EXERCICE_TRAVAIL WHERE id_modalite_exercice_travail = :id';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':id', $id);
        return $reqPreparee->execute();
    }

    public function getAll(): ?array
    {
        $tabAll = array();

        $reqSQL = "SELECT id_modalite_exercice_travail, intitule_modalite_exercice_travail FROM MODALITE_EXERCICE_TRAVAIL";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($modaliteExerciceTravail = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new ModaliteExerciceTravail($modaliteExerciceTravail->id_modalite_exercice_travail, $modaliteExerciceTravail->intitule_modalite_exercice_travail);
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }

    public function get(Int $num): ?ModaliteExerciceTravail
    {
        $sql = 'SELECT id_modalite_exercice_travail, intitule_modalite_exercice_travail FROM MODALITE_EXERCICE_TRAVAIL WHERE id_modalite_exercice_travail = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new ModaliteExerciceTravail($res->id_modalite_exercice_travail, $res->intitule_modalite_exercice_travail);
    }

    public function getLast(): int
    {
        $sql = 'SELECT MAX(id_modalite_exercice_travail) as max FROM MODALITE_EXERCICE_TRAVAIL ';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return $res->max;
    }
}

?>
